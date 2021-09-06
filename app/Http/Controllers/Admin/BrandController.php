<?php

  namespace App\Http\Controllers\Admin;

  use App\Http\Controllers\Controller;
  use App\Http\Requests\Brand\Store;
  use App\Models\Brand;
  use Illuminate\Contracts\Foundation\Application;
  use Illuminate\Contracts\View\Factory;
  use Illuminate\Contracts\View\View;
  use Illuminate\Http\RedirectResponse;

  class BrandController extends Controller
  {

    public function __construct()
    {
      $this->middleware('permission:brand-list');
      $this->middleware('permission:brand-create', ['only' => ['create', 'store']]);
      $this->middleware('permission:brand-edit', ['only' => ['edit', 'update']]);
      $this->middleware('permission:brand-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
      $brands = Brand::orderBy('id', 'DESC')->paginate();
      return view('backend.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
      return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Store  $request
     * @return RedirectResponse
     */
    public function store(Store $request): RedirectResponse
    {
      $brand = Brand::create($request->all());
      if ($brand) {
        request()->session()->flash('success', 'Brand successfully created');
      } else {
        request()->session()->flash('error', 'Error, Please try again');
      }
      return redirect()->route('brands.edit', $brand);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Brand  $brand
     * @return Application|Factory|View
     */
    public function edit(Brand $brand)
    {
      return view('backend.brand.edit', compact('brand'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Store  $request
     * @param  Brand  $brand
     * @return RedirectResponse
     */
    public function update(Store $request, Brand $brand): RedirectResponse
    {
      $status = $brand->update($request->all());
      if ($status) {
        request()->session()->flash('success', 'Brand successfully updated');
      } else {
        request()->session()->flash('error', 'Error, Please try again');
      }
      return redirect()->route('brands.edit', $brand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Brand  $brand
     * @return RedirectResponse
     */
    public function destroy(Brand $brand): RedirectResponse
    {
      $status = $brand->delete();
      if ($status) {
        request()->session()->flash('success', 'Brand successfully deleted');
      } else {
        request()->session()->flash('error', 'Error, Please try again');
      }
      return redirect()->route('brands.index');
    }
  }
