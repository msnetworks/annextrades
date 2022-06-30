<?php namespace Common\Settings;

use Artisan;
use Common\Core\BaseController;
use Common\SEttings\Events\SettingsSaved;
use Exception;
use File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use ReflectionClass;

class SettingsController extends BaseController {

    /**
     * @var Settings;
     */
    private $settings;

    /**
     * @var Request;
     */
    private $request;

    /**
     * @var DotEnvEditor
     */
    private $dotEnv;

    /**
     * @param Request $request
     * @param Settings $settings
     * @param DotEnvEditor $dotEnv
     */
    public function __construct(Request $request, Settings $settings, DotEnvEditor $dotEnv)
    {
        $this->request  = $request;
        $this->settings = $settings;
        $this->dotEnv = $dotEnv;
    }

    /**
     * @return array
     */
    public function index()
    {
        $this->authorize('index', Setting::class);

        return ['server' => $this->dotEnv->load(), 'client' => $this->settings->all(true)];
    }

    /**
     * @return JsonResponse
     */
    public function persist()
    {
        $this->authorize('update', Setting::class);

        $clientSettings = $this->cleanValues($this->request->get('client'));
        $serverSettings = $this->cleanValues($this->request->get('server'));

        // need to handle files before validating
        // TODO: maybe refactor this, if need to handle
        // something else besides google analytics certificate
        $this->handleFiles();

        if ($errResponse = $this->validateSettings($serverSettings, $clientSettings)) {
            return $errResponse;
        }

        if ($serverSettings) {
            $this->dotEnv->write($serverSettings);
        }

        if ($clientSettings) {
            $this->settings->save($clientSettings);
        }

        Artisan::call('cache:clear');

        event(new SettingsSaved($clientSettings, $serverSettings));

        return $this->success();
    }

    /**
     * @param string $config
     * @return array
     */
    private function cleanValues($config)
    {
        if ( ! $config) return [];
        $config = json_decode($config, true);
        foreach ($config as $key => $value) {
            $config[$key] = is_string($value) ? trim($value) : $value;
        }
        return $config;
    }

    private function handleFiles()
    {
        $files = $this->request->file('files');

        // store google analytics certificate file
        if ($certificateFile = Arr::get($files, 'certificate')) {
            File::put(storage_path('laravel-analytics/certificate.p12'), file_get_contents($certificateFile));
        }
    }

    /**
     * @param array $serverSettings
     * @param array $clientSettings
     * @return JsonResponse
     */
    private function validateSettings($serverSettings, $clientSettings)
    {
        // flatten "client" and "server" arrays into single array
        $values = array_merge(
            $serverSettings ?: [],
            $clientSettings ?: [],
            $this->request->file('files', [])
        );
        $keys = array_keys($values);
        $validators = config('common.setting-validators');

        foreach ($validators as $validator) {
            if (empty(array_intersect($validator::KEYS, $keys))) continue;

            try {
                if ($messages = app($validator)->fails($values)) {
                    return $this->error($messages);
                }
            // catch and display any generic error that might occur
            } catch (Exception $e) {
                // Common\Settings\Validators\GoogleLoginValidator => GoogleLoginValidator
                $class = (new ReflectionClass($validator))->getShortName();
                // GoogleLoginValidator => google-login-validator => google => google_group
                $groupName = explode('-', kebab_case($class))[0] . '_group';
                return $this->error([$groupName => str_limit($e->getMessage(), 200)]);
            }
        }
    }
}
