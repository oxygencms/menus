<?php

namespace Oxygencms\Menus\Controllers;

use Oxygencms\Menus\Models\Link;
use Oxygencms\Menus\Models\Menu;
use Oxygencms\Menus\Requests\LinkRequest;
use Oxygencms\Core\Controllers\Controller;

class LinkController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param Menu $menu
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Menu $menu)
    {
        $this->authorize('create', Link::class);

        $data = [
            'menu' => $menu,
            'link' => null,
        ];

        return view('oxygencms::admin.menus.links.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Menu        $menu
     * @param LinkRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Menu $menu, LinkRequest $request)
    {
        $this->authorize('create', Link::class);

        $link = $menu->links()->create($request->validated());

        notification("$link->model_name successfully created.");

        return redirect()->route('admin.menu.edit', $menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Menu $menu
     * @param Link $link
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Menu $menu, Link $link)
    {
        $this->authorize('update', Link::class);

        return view('oxygencms::admin.menus.links.edit', compact('menu', 'link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Menu        $menu
     * @param Link        $link
     * @param LinkRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Menu $menu, Link $link, LinkRequest $request)
    {
        $this->authorize('update', Link::class);

        $link->update($request->validated());

        notification("$link->model_name successfully updated.");

        return redirect()->route('admin.menu.edit', $menu);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Link $link
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Link $link)
    {
        $this->authorize('delete', Link::class);

        $link->delete();

        return jsonNotification($link->model_name . ' successfuly deleted.');
    }
}
