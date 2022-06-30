<?php namespace App\Http\Controllers;

use App\User;
use Cache;
use Common\Core\BaseController;
use Common\Database\MigrateAndSeed;
use Common\Settings\DotEnvEditor;
use Common\Settings\Setting;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Schema;

class UpdateController extends BaseController {
    /**
     * @var DotEnvEditor
     */
    private $dotEnvEditor;

    /**
     * @var Setting
     */
    private $setting;

    /**
     * @var User
     */
    private $user;

    /**
     * @param DotEnvEditor $dotEnvEditor
     * @param Setting $setting
     * @param User $user
     */
	public function __construct(DotEnvEditor $dotEnvEditor, Setting $setting, User $user)
	{
        $this->user = $user;
        $this->setting = $setting;
        $this->dotEnvEditor = $dotEnvEditor;

        if ( ! config('common.site.disable_update_auth') && version_compare(config('common.site.version'), $this->getAppVersion()) === 0) {
            $this->middleware('isAdmin');
        }
    }

    /**
     * Show update view.
     *
     * @return Factory|View
     */
    public function show()
    {
        return view('update');
    }

    /**
     * Perform the update.
     *
     * @return RedirectResponse
     */
    public function update()
	{
        //fix "index is too long" issue on MariaDB and older mysql versions
        Schema::defaultStringLength(191);

        app(MigrateAndSeed::class)->execute();

        $version = $this->getAppVersion();
        $envConfig = [
            'APP_VERSION' => $version,
            'NOTIFICATIONS_ENABLED' => true,
            'ENABLE_CUSTOM_DOMAINS' => true,
        ];

        if ( ! config('site.common.static_file_delivery')) {
            $envConfig['STATIC_FILE_DELIVERY'] = null;
        }
        if ( ! config('site.common.public_disk_driver')) {
            $envConfig['PUBLIC_DISK_DRIVER'] = 'local';
        }

        $this->dotEnvEditor->write($envConfig);

        Cache::flush();

        return redirect()->back()->with('status', 'Updated the site successfully.');
	}


    /**
     * Get new app version.
     *
     * @return string
     */
    private function getAppVersion()
    {
        try {
            return $this->dotEnvEditor->load(base_path('env.example'))['app_version'];
        } catch (Exception $e) {
            return '2.2.1';
        }
    }
}
