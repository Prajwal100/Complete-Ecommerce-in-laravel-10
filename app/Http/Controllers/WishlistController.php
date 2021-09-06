<?php

  namespace App\Http\Controllers;

  use App\Models\Product;
  use App\Models\Wishlist;
  use Illuminate\Http\RedirectResponse;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Auth;

  class WishlistController extends Controller
  {

    protected ?Product $product = null;

    public function __construct(Product $product)
    {
      $this->product = $product;
    }

    public function wishlist(Request $request): RedirectResponse
    {
      if (empty($request->slug)) {
        request()->session()->flash('error', 'Invalid Products');
        return back();
      }
      $product = Product::where('slug', $request->slug)->firstOrFail();
      if (empty($product)) {
        request()->session()->flash('error', 'Invalid Products');
        return back();
      }
      if (Auth::check()) {
        $already_wishlist = Wishlist::whereUserId(auth()->user()->id)->whereCartId(null)->whereProductId($product->id)->first();
        if ($already_wishlist) {
          request()->session()->flash('error', 'You already placed in wishlist');
          return back();
        } else {
          $wishlist = new Wishlist;
          $wishlist->user_id = auth()->user()->id;
          $wishlist->product_id = $product->id;
          $wishlist->price = ($product->price - ($product->price * $product->discount) / 100);
          $wishlist->quantity = 1;
          $wishlist->amount = $wishlist->price * $wishlist->quantity;
          if ($wishlist->product->stock < $wishlist->quantity || $wishlist->product->stock <= 0) {
            return back()->with('error', 'Stock not sufficient!.');
          }
          $wishlist->save();
        }
        request()->session()->flash('success', 'Product successfully added to wishlist');
      } else {
        request()->session()->flash('error', 'Pls login added to wishlist');
      }
      return back();
    }

    public function wishlistDelete(Request $request): RedirectResponse
    {
      $wishlist = Wishlist::findOrFail($request->id);
      $wishlist->delete();
      request()->session()->flash('success', 'Wishlist successfully removed');
      return back();
    }
  }
