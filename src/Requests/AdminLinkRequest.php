<?php

namespace Oxygencms\Menus\Requests;

use Oxygencms\Menus\Rules\EmptyWhen;
use Oxygencms\Menus\Rules\RouteExists;
use Oxygencms\Menus\Rules\CallableAction;
use Oxygencms\Menus\Rules\HasRequiredParameters;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Http\FormRequest;

class AdminLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $translatable = [
            'text' => 'required|array|distinct',
            'title' => 'required|array|distinct',
        ];

        // specify locales instead of using * wild card, useful in views
        foreach (config('app.locales') as $locale => $language) {
            $translatable["text.$locale"]  = 'required|string';
            $translatable["title.$locale"] = 'nullable|string';
        }

        $rules = [
            'route' => [
                'nullable',
                'required_without_all:url,action',
                'string',
                new RouteExists,
                new EmptyWhen('url', 'action')
            ],

            'url' => [
                'nullable',
                'required_without_all:route,action',
                'string',
                'URL',
                'active_url',
                new EmptyWhen('route', 'action')
            ],

            'action' => [
                'nullable',
                'required_without_all:route,url',
                'string',
                "regex:/^[a-zA-Z@\\\]+$/u",
                new CallableAction,
                new EmptyWhen('route', 'url'),
            ],

            'params' => $this->getParamsRules(),
            'parent_attrs' => 'nullable|string|json',
            'attrs' => 'nullable|string|json',
            'parent_class' => 'nullable|string',
            'class' => 'nullable|string',
            'target_blank' => 'sometimes|boolean',
            'online' => 'sometimes|boolean',
            'order_id' => 'sometimes|numeric',
        ];

        $rules = array_merge($translatable + $rules);

        return $rules;
    }

    /**
     * @return array
     */
    private function getParamsRules(): array
    {
        $route = $this->getRouteByNameOrAction();

        $rules = ['json', new HasRequiredParameters($route)];

        // nullable if the route does not require any params or if setting a url
        if ($route && !$route->parameterNames || !$route && $this->has('url')) {
            $rules = array_prepend($rules, 'nullable');
        }

        return $rules;
    }

    /**
     * @return \Illuminate\Routing\Route|null
     */
    protected function getRouteByNameOrAction()
    {
        $search = $this->get('route') ?: $this->get('action');

        $route = Route::getRoutes()->getByName($search);

        if ( ! $route) {
            $action = app()->getNamespace() . "Http\\Controllers\\" . $search;

            $route = Route::getRoutes()->getByAction($action);
        }

        return $route ? $route->bind(Request::createFromGlobals()) : $route;
    }
}
