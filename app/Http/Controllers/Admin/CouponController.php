<?php

  namespace App\Http\Controllers\Admin;

  use App\Http\Controllers\Controller;
  use App\Http\Requests\Coupon\Store;
  use App\Http\Requests\Coupon\Update;
  use App\Models\Coupon;
  use Illuminate\Contracts\Foundation\Application;
  use Illuminate\Contracts\View\Factory;
  use Illuminate\Contracts\View\View;
  use Illuminate\Http\RedirectResponse;

  class CouponController extends Controller
  {
    public function __construct()
    {
      $this->middleware('permission:coupon-list');
      $this->middleware('permission:coupon-create', ['only' => ['create', 'store']]);
      $this->middleware('permission:coupon-edit', ['only' => ['edit', 'update']]);
      $this->middleware('permission:coupon-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
      $coupons = Coupon::orderBy('id', 'DESC')->paginate('10');
      return view('backend.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
      return view('backend.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Store  $request
     * @return RedirectResponse
     */
    public function store(Store $request): RedirectResponse
    {
      $coupon = Coupon::create($request->all());
      if ($coupon) {
        request()->session()->flash('success', 'Coupon Successfully added');
      } else {
        request()->session()->flash('error', 'Please try again!!');
      }
      return redirect()->route('coupons.edit', $coupon);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Coupon  $coupon
     * @return Application|Factory|View
     */
    public function edit(Coupon $coupon)
    {
      return view('backend.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Update  $request
     * @param  Coupon  $coupon
     * @return RedirectResponse
     */
    public function update(Update $request, Coupon $coupon): RedirectResponse
    {
      $status = $coupon->update($request->all());
      if ($status) {
        request()->session()->flash('success', 'Coupon Successfully updated');
      } else {
        request()->session()->flash('error', 'Please try again!!');
      }
      return redirect()->route('coupons.edit', $coupon);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Coupon  $coupon
     * @return RedirectResponse
     */
    public function destroy(Coupon $coupon): RedirectResponse
    {
      if ($coupon) {
        $status = $coupon->delete();
        if ($status) {
          request()->session()->flash('success', 'Coupon successfully deleted');
        } else {
          request()->session()->flash('error', 'Error, Please try again');
        }
        return redirect()->route('coupon.index');
      }
    }


  }
