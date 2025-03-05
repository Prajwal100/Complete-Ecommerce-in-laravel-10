<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::latest('id')->paginate(10);
        return view('backend.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'nullable|string',
            'photo' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $slug = $this->generateUniqueSlug($request->title);
        $validatedData['slug'] = $slug;

        $banner = Banner::create($validatedData);

        $message = $banner
            ? 'Banner successfully added'
            : 'Error occurred while adding banner';

        return redirect()->route('banner.index')->with(
            $banner ? 'success' : 'error',
            $message
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Implement if needed
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('backend.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'nullable|string',
            'photo' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $status = $banner->update($validatedData);

        $message = $status
            ? 'Banner successfully updated'
            : 'Error occurred while updating banner';

        return redirect()->route('banner.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $status = $banner->delete();

        $message = $status
            ? 'Banner successfully deleted'
            : 'Error occurred while deleting banner';

        return redirect()->route('banner.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }

    /**
     * Generate a unique slug for the banner.
     *
     * @param  string  $title
     * @return string
     */
    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = Banner::where('slug', $slug)->count();

        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }

        return $slug;
    }
}
