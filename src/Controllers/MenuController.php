<?php

namespace Oxygencms\Menus\Controllers;

use JavaScript;
use Oxygencms\Menus\Models\Menu;
use Oxygencms\Menus\Requests\MenuRequest;
use Oxygencms\Core\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('index', Menu::class);

        $models = Menu::allWithAccessors(['edit_url', 'update_url'], ['links']);

        JavaScript::put(['models' => $models]);

        return view('oxygencms::admin.menus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Menu::class);

        return view('oxygencms::admin.menus.create', ['menu' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MenuRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(MenuRequest $request)
    {
        $this->authorize('create', Menu::class);

        $menu = Menu::create($request->validated());

        notification("$menu->model_name successfully created.");

        return redirect()->route('admin.menu.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Menu $menu
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Menu $menu)
    {
        $this->authorize('edit', Menu::class);

        $models = $menu->links->each->append(['edit_url', 'model_name']);

        JavaScript::put(['models' => $models]);

        return view('oxygencms::admin.menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MenuRequest $request
     * @param Menu $menu
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $this->authorize('update', Menu::class);

        $menu->update($request->validated());

        notification("$menu->model_name successfully updated.");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Menu $menu
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy(Menu $menu)
    {
        $this->authorize('delete', Menu::class);

        $menu->delete();

        return jsonNotification($menu->model_name . ' successfully deleted.');
    }
}
