<?php namespace Common\Core;

use App\User;
use Common\Auth\Roles\Role;
use Common\Core\Prerender\HandlesSeo;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, HandlesSeo;

    /**
     * Authorize a given action for the current user
     * or guest if user is not logged in.
     *
     * @param  mixed  $ability
     * @param  mixed|array  $arguments
     * @return \Illuminate\Auth\Access\Response
     */
    public function authorize($ability, $arguments = [])
    {
        if (Auth::check()) {
            list($ability, $arguments) = $this->parseAbilityAndArguments($ability, $arguments);
            return app(Gate::class)->authorize($ability, $arguments);
        } else {
            $guest = new User();
            // make sure ID is not NULL to avoid false positives in authorization
            $guest->forceFill(['id' => -1]);
            $guest->setRelation('roles', Role::where('guests', 1)->get());
            return $this->authorizeForUser($guest, $ability, $arguments);
        }
    }

    /**
     * @param array $data
     * @param int $status
     * @param array $options
     * @return JsonResponse|Response
     */
    public function success($data = [], $status = 200, $options = [])
    {
        $data = $data ?: [];
        $data['status'] = 'success';

        if ($response = $this->handleSeo($data, $options)) {
            return $response;
        }

        foreach($data as $key => $value) {
            if ($value instanceof Arrayable) {
                $data[$key] = $value->toArray();
            }
        }

        return response()->json($data, $status);
    }

    /**
     * Return error response with specified messages.
     *
     * @param array $messages
     * @param int $status
     * @return JsonResponse
     */
    public function error($messages = [], $status = 422)
    {
        $data = ['status' => 'error', 'messages' => $messages ?: []];
        return response()->json($data, $status);
    }

    /**
     * Format the validation errors to be returned.
     *
     * @param  Validator  $validator
     * @return array
     */
    protected function formatValidationErrors(Validator $validator)
    {
        return BaseFormRequest::formatValidationErrors($validator);
    }
}
