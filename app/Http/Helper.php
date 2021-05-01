<?php

namespace App\Http;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Message;
use App\Models\Order;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Helper
{
    /**
     * @return Collection
     */
    public static function messageList(): Collection
    {
        return Message::whereNull('read_at')->orderBy('created_at', 'desc')->get();
    }

    /**
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getAllCategory()
    {
        $category = new Category();
        return $category->getAllParentWithChild();
    }

    /**
     * getHeaderCategory
     */
    public static function getHeaderCategory()
    {
        $category = new Category();
        // dd($category);
        $menu = $category->getAllParentWithChild();

        if ($menu) {
            ?>

            <li>
                <a href="javascript:void(0);">Category<i class="ti-angle-down"></i></a>
                <ul class="dropdown border-0 shadow">
                    <?php
                    foreach ($menu as $cat_info) {
                        if ($cat_info->child_cat->count() > 0) {
                            ?>
                            <li><a href="<?php
                                echo route('product-cat', $cat_info->slug); ?>"><?php
                                    echo $cat_info->title; ?></a>
                                <ul class="dropdown sub-dropdown border-0 shadow">
                                    <?php
                                    foreach ($cat_info->child_cat as $sub_menu) {
                                        ?>
                                        <li><a href="<?php
                                            echo route('product-sub-cat', [$cat_info->slug, $sub_menu->slug]); ?>"><?php
                                                echo $sub_menu->title; ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li><a href="<?php
                                echo route('product-cat', $cat_info->slug); ?>"><?php
                                    echo $cat_info->title; ?></a></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </li>
            <?php
        }
    }

    /**
     * @param  string  $option
     * @return Category[]|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|Collection
     */
    public static function productCategoryList($option = 'all')
    {
        if ($option = 'all') {
            return Category::orderBy('id', 'DESC')->get();
        }
        return Category::has('products')->orderBy('id', 'DESC')->get();
    }

    /**
     * @param  string  $option
     * @return PostTag[]|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|Collection
     */
    public static function postTagList($option = 'all')
    {
        if ($option = 'all') {
            return PostTag::orderBy('id', 'desc')->get();
        }
        return PostTag::has('posts')->orderBy('id', 'desc')->get();
    }

    /**
     * @param  string  $option
     * @return PostCategory[]|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|Collection
     */
    public static function postCategoryList($option = "all")
    {
        if ($option = 'all') {
            return PostCategory::orderBy('id', 'DESC')->get();
        }
        return PostCategory::has('posts')->orderBy('id', 'DESC')->get();
    }
    /**
     * @param  string  $user_id
     * @return int|mixed
     */
    // Cart Count
    public static function cartCount($user_id = '')
    {
        if (Auth::check()) {
            if ($user_id == "") {
                $user_id = auth()->user()->id;
            }
            return Cart::where('user_id', $user_id)->where('order_id', null)->sum('quantity');
        } else {
            return 0;
        }
    }

    /**
     * @return mixed
     */
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    /**
     * @param  string  $user_id
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection|int
     */
    public static function getAllProductFromCart($user_id = '')
    {
        if (Auth::check()) {
            if ($user_id == "") {
                $user_id = auth()->user()->id;
            }
            return Cart::with('product')->where('user_id', $user_id)->where('order_id', null)->get();
        } else {
            return 0;
        }
    }
    /**
     * @param  string  $user_id
     * @return int|mixed
     */
    // Total amount cart
    public static function totalCartPrice($user_id = '')
    {
        if (Auth::check()) {
            if ($user_id == "") {
                $user_id = auth()->user()->id;
            }
            return Cart::where('user_id', $user_id)->where('order_id', null)->sum('amount');
        } else {
            return 0;
        }
    }
    /**
     * @param  string  $user_id
     * @return int|mixed
     */
    // Wishlist Count
    public static function wishlistCount($user_id = '')
    {
        if (Auth::check()) {
            if ($user_id == "") {
                $user_id = auth()->user()->id;
            }
            return Wishlist::where('user_id', $user_id)->where('cart_id', null)->sum('quantity');
        } else {
            return 0;
        }
    }

    /**
     * @param  string  $user_id
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection|int
     */
    public static function getAllProductFromWishlist($user_id = '')
    {
        if (Auth::check()) {
            if ($user_id == "") {
                $user_id = auth()->user()->id;
            }
            return Wishlist::with('product')->where('user_id', $user_id)->where('cart_id', null)->get();
        } else {
            return 0;
        }
    }

    /**
     * @param  string  $user_id
     * @return int|mixed
     */
    public static function totalWishlistPrice($user_id = '')
    {
        if (Auth::check()) {
            if ($user_id == "") {
                $user_id = auth()->user()->id;
            }
            return Wishlist::where('user_id', $user_id)->where('cart_id', null)->sum('amount');
        } else {
            return 0;
        }
    }
    /**
     * @param $id
     * @param $user_id
     * @return int|string
     */
    // Total price with shipping and coupon
    public static function grandPrice($id, $user_id)
    {
        $order = Order::find($id);
        if ($order) {
            $shipping_price = (float) $order->shipping->price;
            $order_price = self::orderPrice($id, $user_id);
            return number_format((float) ($order_price + $shipping_price), 2, '.', '');
        } else {
            return 0;
        }
    }

    /**
     * @return string
     */
    // Admin home
    public static function earningPerMonth(): string
    {
        $month_data = Order::where('status', 'delivered')->get();
        // return $month_data;
        $price = 0;
        foreach ($month_data as $data) {
            $price = $data->cart_info->sum('price');
        }
        return number_format((float) ($price), 2, '.', '');
    }

    /**
     * @return Collection
     */
    public static function shipping(): Collection
    {
        return Shipping::orderBy('id', 'DESC')->get();
    }
}
