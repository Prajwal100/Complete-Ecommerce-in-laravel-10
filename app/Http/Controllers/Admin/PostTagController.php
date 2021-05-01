<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\Store;
use App\Models\PostTag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $postTags = PostTag::orderBy('id', 'DESC')->paginate(10);
        return view('backend.posttag.index', compact('postTags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('backend.posttag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        $slug = Str::slug($request->title);
        $count = PostTag::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug.'-'.date('ymdis').'-'.rand(0, 999);
        }
        $data['slug'] = $slug;
        $status = PostTag::create($data);
        if ($status) {
            request()->session()->flash('success', 'Post Tag Successfully added');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }
        return redirect()->route('post-tag.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  PostTag  $postTag
     * @return Application|Factory|View
     */
    public function edit(PostTag $postTag)
    {
        return view('backend.posttag.edit', compact('postTag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Store  $request
     * @param  PostTag  $postTag
     * @return RedirectResponse
     */
    public function update(Store $request, PostTag $postTag): RedirectResponse
    {
        $status = $postTag->update($request->all());
        if ($status) {
            request()->session()->flash('success', 'Post Tag Successfully updated');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }
        return redirect()->route('post-tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PostTag  $postTag
     * @return RedirectResponse
     */
    public function destroy(PostTag $postTag): RedirectResponse
    {
        $status = $postTag->delete();

        if ($status) {
            request()->session()->flash('success', 'Post Tag successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting post tag');
        }
        return redirect()->route('post-tag.index');
    }
}
