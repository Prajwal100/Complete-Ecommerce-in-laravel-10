<?php

  namespace App\Http\Controllers;

  use App\Http\Requests\Review\Store;
  use App\Models\Product;
  use App\Models\ProductReview;
  use App\Models\User;
  use App\Notifications\StatusNotification;
  use Illuminate\Contracts\Foundation\Application;
  use Illuminate\Contracts\View\Factory;
  use Illuminate\Contracts\View\View;
  use Illuminate\Http\RedirectResponse;
  use Illuminate\Http\Request;
  use Notification;

  class ProductReviewController extends Controller
  {
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
      $reviews = ProductReview::getAllReview();

      return view('backend.review.index', compact('reviews'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Store  $request
     * @return RedirectResponse
     */
    public function store(Store $request): RedirectResponse
    {
      $product_info = Product::getProductBySlug($request['slug']);
      $data = $request->all();
      $data['product_id'] = $product_info->id;
      $data['user_id'] = $request->user()->id;
      $data['status'] = 'active';
      // dd($data)q;
      $status = ProductReview::create($data);
      $user = User::role('super-admin')->get();
      $details = [
          'title'     => 'New Product Rating!',
          'actionURL' => route('product-detail', $product_info->slug),
          'fas'       => 'fa-star',
      ];
      Notification::send($user, new StatusNotification($details));
      if ($status) {
        request()->session()->flash('success', 'Thank you for your feedback');
      } else {
        request()->session()->flash('error', 'Something went wrong! Please try again!!');
      }
      return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  ProductReview  $productReview
     * @return Application|Factory|View
     */
    public function edit(ProductReview $productReview)
    {
      // return $review;
      return view('backend.review.edit', compact('productReview'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
      $review = ProductReview::findOrFail($id);
      if ($review) {
        $status = $review->update($request->all());
        if ($status) {
          request()->session()->flash('success', 'Review Successfully updated');
        } else {
          request()->session()->flash('error', 'Something went wrong! Please try again!!');
        }
      } else {
        request()->session()->flash('error', 'Review not found!!');
      }

      return redirect()->route('review.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
      $review = ProductReview::find($id);
      $status = $review->delete();
      if ($status) {
        request()->session()->flash('success', 'Successfully deleted review');
      } else {
        request()->session()->flash('error', 'Something went wrong! Try again');
      }
      return redirect()->route('review.index');
    }
  }
