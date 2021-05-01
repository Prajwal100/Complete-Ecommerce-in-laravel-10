<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Baner\Store;
use App\Http\Requests\Baner\Update;
use App\Models\Banner;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $banners = Banner::orderBy('id', 'DESC')->paginate(10);
        return view('backend.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Store  $request
     * @return RedirectResponse
     */
    public function store(Store $request): RedirectResponse
    {
        $status = Banner::create($request->all());
        if ($status) {
            request()->session()->flash('success', 'Banner successfully added');
        } else {
            request()->session()->flash('error', 'Error occurred while adding banner');
        }
        return redirect()->route('banner.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  Banner  $banner
     * @return Application|Factory|View
     */
    public function edit(Banner $banner)
    {
        return view('backend.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Update  $request
     * @param  Banner  $banner
     * @return RedirectResponse
     */
    public function update(Update $request, Banner $banner): RedirectResponse
    {
        $status = $banner->update($request->all());
        if ($status) {
            request()->session()->flash('success', 'Banner successfully updated');
        } else {
            request()->session()->flash('error', 'Error occurred while updating banner');
        }
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Banner  $banner
     * @return RedirectResponse
     */
    public function destroy(Banner $banner): RedirectResponse
    {
        $status = $banner->delete();
        if ($status) {
            request()->session()->flash('success', 'Banner successfully deleted');
        } else {
            request()->session()->flash('error', 'Error occurred while deleting banner');
        }
        return redirect()->route('banner.index');
    }
}
