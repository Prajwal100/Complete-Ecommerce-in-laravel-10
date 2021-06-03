<?php

    namespace App\Http\Controllers;

    use App\Events\MessageSent;
    use App\Http\Requests\Message\Store;
    use App\Models\Banner;
    use App\Models\Brand;
    use App\Models\Cart;
    use App\Models\Category;
    use App\Models\Coupon;
    use App\Models\Message;
    use App\Models\Post;
    use App\Models\PostCategory;
    use App\Models\PostTag;
    use App\Models\Product;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Spatie\Newsletter\Newsletter;

    class FrontendController extends Controller
    {


        /**
         * @return Application|Factory|View
         */
        public function index()
        {
            $featured = Product::whereStatus('active')->where('is_featured', 1)->orderBy('price',
                'DESC')->limit(2)->get();
            $posts = Post::whereStatus('active')->orderBy('id', 'DESC')->limit(3)->get();
            $banners = Banner::whereStatus('active')->limit(3)->orderBy('id', 'DESC')->get();
            // return $banner;
            $product_lists = Product::whereStatus('active')->orderBy('id', 'DESC')->limit(8)->get();
            $category_lists = Category::whereStatus('active')->where('is_parent', 1)->orderBy('title', 'ASC')->get();
            // return $category;
            return view('frontend.index', compact('featured', 'posts', 'banners', 'product_lists', 'category_lists'));
        }

        /**
         * @return Application|Factory|View
         */
        public function aboutUs()
        {
            return view('frontend.pages.about-us');
        }

        /**
         * @return Application|Factory|View
         */
        public function contact()
        {
            return view('frontend.pages.contact');
        }

        /**
         * @param $slug
         * @return Application|Factory|View
         */
        public function productDetail($slug)
        {
            $product_detail = Product::getProductBySlug($slug);
            return view('frontend.pages.product_detail', compact('product_detail'));
        }

        /**
         * @return array|Application|Factory|View
         */
        public function productGrids()
        {
            $products = Product::query();

            if (!empty($_GET['category'])) {
                $slug = explode(',', $_GET['category']);
                $cat_ids = Category::select('id')->whereIn('slug', $slug)->pluck('id')->toArray();
                $products->whereIn('cat_id', $cat_ids);
            }
            if (!empty($_GET['brand'])) {
                $slugs = explode(',', $_GET['brand']);
                $brand_ids = Brand::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
                return $brand_ids;
            }
            if (!empty($_GET['sortBy'])) {
                if ($_GET['sortBy'] == 'title') {
                    $products = $products->where('status', 'active')->orderBy('title', 'ASC');
                }
                if ($_GET['sortBy'] == 'price') {
                    $products = $products->orderBy('price', 'ASC');
                }
            }

            if (!empty($_GET['price'])) {
                $price = explode('-', $_GET['price']);
                $products->whereBetween('price', $price);
            }

            $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
            // Sort by number
            if (!empty($_GET['show'])) {
                $products = $products->where('status', 'active')->paginate($_GET['show']);
            } else {
                $products = $products->where('status', 'active')->paginate(9);
            }


            return view('frontend.pages.product-grids')->with('products', $products)->with('recent_products',
                $recent_products);
        }

        /**
         * @return array|Application|Factory|View
         */
        public function productLists()
        {
            $products = Product::query();

            if (!empty($_GET['category'])) {
                $slug = explode(',', $_GET['category']);
                // dd($slug);
                $cat_ids = Category::select('id')->whereIn('slug', $slug)->pluck('id')->toArray();
                // dd($cat_ids);
                $products->whereIn('cat_id', $cat_ids)->paginate;
                // return $products;
            }
            if (!empty($_GET['brand'])) {
                $slugs = explode(',', $_GET['brand']);
                return Brand::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            }
            if (!empty($_GET['sortBy'])) {
                if ($_GET['sortBy'] == 'title') {
                    $products = $products->where('status', 'active')->orderBy('title', 'ASC');
                }
                if ($_GET['sortBy'] == 'price') {
                    $products = $products->orderBy('price', 'ASC');
                }
            }

            if (!empty($_GET['price'])) {
                $price = explode('-', $_GET['price']);

                $products->whereBetween('price', $price);
            }

            $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
            // Sort by number
            if (!empty($_GET['show'])) {
                $products = $products->where('status', 'active')->paginate($_GET['show']);
            } else {
                $products = $products->where('status', 'active')->paginate(6);
            }
            // Sort by name , price, category


            return view('frontend.pages.product-lists')->with('products', $products)->with('recent_products',
                $recent_products);
        }

        /**
         * @param  Request  $request
         * @return RedirectResponse
         */
        public function productFilter(Request $request): RedirectResponse
        {
            $data = $request->all();
            $showURL = "";
            if (!empty($data['show'])) {
                $showURL .= '&show='.$data['show'];
            }

            $sortByURL = '';
            if (!empty($data['sortBy'])) {
                $sortByURL .= '&sortBy='.$data['sortBy'];
            }

            $catURL = "";
            if (!empty($data['category'])) {
                foreach ($data['category'] as $category) {
                    if (empty($catURL)) {
                        $catURL .= '&category='.$category;
                    } else {
                        $catURL .= ','.$category;
                    }
                }
            }

            $brandURL = "";
            if (!empty($data['brand'])) {
                foreach ($data['brand'] as $brand) {
                    if (empty($brandURL)) {
                        $brandURL .= '&brand='.$brand;
                    } else {
                        $brandURL .= ','.$brand;
                    }
                }
            }
            // return $brandURL;

            $priceRangeURL = "";
            if (!empty($data['price_range'])) {
                $priceRangeURL .= '&price='.$data['price_range'];
            }
            if (request()->is('e-shop.loc/product-grids')) {
                return redirect()->route('product-grids', $catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
            } else {
                return redirect()->route('product-lists', $catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
            }
        }

        /**
         * @param  Request  $request
         * @return Application|Factory|View
         */
        public function productSearch(Request $request)
        {
            $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
            $products = Product::orwhere('title', 'like', '%'.$request->search.'%')
                ->orwhere('slug', 'like', '%'.$request->search.'%')
                ->orwhere('description', 'like', '%'.$request->search.'%')
                ->orwhere('summary', 'like', '%'.$request->search.'%')
                ->orwhere('price', 'like', '%'.$request->search.'%')
                ->orderBy('id', 'DESC')
                ->paginate('9');
            return view('frontend.pages.product-grids')->with('products', $products)->with('recent_products',
                $recent_products);
        }

        /**
         * @param  Request  $request
         * @return Application|Factory|View
         */
        public function productBrand(Request $request)
        {
            $products = Brand::getProductByBrand($request->slug);
            $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
            if (request()->is('e-shop.loc/product-grids')) {
                return view('frontend.pages.product-grids')->with('products',
                    $products->products)->with('recent_products',
                    $recent_products);
            } else {
                return view('frontend.pages.product-lists')->with('products',
                    $products->products)->with('recent_products',
                    $recent_products);
            }
        }

        /**
         * @param  Request  $request
         * @return Application|Factory|View
         */
        public function productCat(Request $request)
        {
            $products = Category::getProductByCat($request->slug);
            $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();

            if (request()->is('e-shop.loc/product-grids')) {
                return view('frontend.pages.product-grids')->with('products',
                    $products->products)->with('recent_products',
                    $recent_products);
            } else {
                return view('frontend.pages.product-lists')->with('products',
                    $products->products)->with('recent_products',
                    $recent_products);
            }
        }

        /**
         * @param  Request  $request
         * @return Application|Factory|View
         */
        public function productSubCat(Request $request)
        {
            $products = Category::getProductBySubCat($request->sub_slug);
            // return $products;
            $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();

            if (request()->is('e-shop.loc/product-grids')) {
                return view('frontend.pages.product-grids')->with('products',
                    $products->sub_products)->with('recent_products', $recent_products);
            } else {
                return view('frontend.pages.product-lists')->with('products',
                    $products->sub_products)->with('recent_products', $recent_products);
            }
        }

        /**
         * @return array|Application|Factory|View
         */
        public function blog()
        {
            $post = Post::query();

            if (!empty($_GET['category'])) {
                $slug = explode(',', $_GET['category']);
                // dd($slug);
                return PostCategory::select('id')->whereIn('slug', $slug)->pluck('id')->toArray();
            }
            if (!empty($_GET['tag'])) {
                $slug = explode(',', $_GET['tag']);
                // dd($slug);
                $tag_ids = PostTag::select('id')->whereIn('slug', $slug)->pluck('id')->toArray();
                // return $tag_ids;
                $post->where('post_tag_id', $tag_ids);
                // return $post;
            }

            if (!empty($_GET['show'])) {
                $post = $post->where('status', 'active')->orderBy('id', 'DESC')->paginate($_GET['show']);
            } else {
                $post = $post->where('status', 'active')->orderBy('id', 'DESC')->paginate(9);
            }
            // $post=Post::where('status','active')->paginate(8);
            $rcnt_post = Post::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
            return view('frontend.pages.blog')->with('posts', $post)->with('recent_posts', $rcnt_post);
        }

        /**
         * @param $slug
         * @return Application|Factory|View
         */
        public function blogDetail($slug)
        {
            $post = Post::getPostBySlug($slug);
            $rcnt_post = Post::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
            // return $post;
            return view('frontend.pages.blog-detail')->with('post', $post)->with('recent_posts', $rcnt_post);
        }

        /**
         * @param  Request  $request
         * @return Application|Factory|View
         */
        public function blogSearch(Request $request)
        {
            // return $request->all();
            $rcnt_post = Post::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
            $posts = Post::orwhere('title', 'like', '%'.$request->search.'%')
                ->orwhere('quote', 'like', '%'.$request->search.'%')
                ->orwhere('summary', 'like', '%'.$request->search.'%')
                ->orwhere('description', 'like', '%'.$request->search.'%')
                ->orwhere('slug', 'like', '%'.$request->search.'%')
                ->orderBy('id', 'DESC')
                ->paginate(8);
            return view('frontend.pages.blog')->with('posts', $posts)->with('recent_posts', $rcnt_post);
        }

        /**
         * @param  Request  $request
         * @return RedirectResponse
         */
        public function blogFilter(Request $request)
        {
            $data = $request->all();
            // return $data;
            $catURL = "";
            if (!empty($data['category'])) {
                foreach ($data['category'] as $category) {
                    if (empty($catURL)) {
                        $catURL .= '&category='.$category;
                    } else {
                        $catURL .= ','.$category;
                    }
                }
            }

            $tagURL = "";
            if (!empty($data['tag'])) {
                foreach ($data['tag'] as $tag) {
                    if (empty($tagURL)) {
                        $tagURL .= '&tag='.$tag;
                    } else {
                        $tagURL .= ','.$tag;
                    }
                }
            }
            // return $tagURL;
            // return $catURL;
            return redirect()->route('blog', $catURL.$tagURL);
        }

        /**
         * @param  Request  $request
         * @return Application|Factory|View
         */
        public function blogByCategory(Request $request)
        {
            $post = PostCategory::getBlogByCategory($request->slug);
            $rcnt_post = Post::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
            return view('frontend.pages.blog')->with('posts', $post->post)->with('recent_posts', $rcnt_post);
        }

        /**
         * @param  Request  $request
         * @return Application|Factory|View
         */
        public function blogByTag(Request $request)
        {
            $post = Post::getBlogByTag($request->slug);
            $rcnt_post = Post::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
            return view('frontend.pages.blog')->with('posts', $post)->with('recent_posts', $rcnt_post);
        }

        /**
         * @return Application|Factory|View
         */

        /**
         * @param  Request  $request
         * @return RedirectResponse
         */
        public function couponStore(Request $request): RedirectResponse
        {
            // return $request->all();
            $coupon = Coupon::whereCode($request->code)->first();
            if (!$coupon) {
                request()->session()->flash('error', 'Invalid coupon code, Please try again');
                return back();
            }
            $total_price = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->sum('price');
            // dd($total_price);
            session()->put('coupon', [
                'id' => $coupon->id,
                'code' => $coupon->code,
                'value' => $coupon->discount($total_price),
            ]);
            request()->session()->flash('success', 'Coupon successfully applied');
            return redirect()->back();
        }

        public function subscribe(Request $request)
        {
            if (!Newsletter::isSubscribed($request->email)) {
                Newsletter::subscribePending($request->email);
                if (Newsletter::lastActionSucceeded()) {
                    request()->session()->flash('success', 'Subscribed! Please check your email');
                    return redirect()->route('home');
                } else {
                    Newsletter::getLastError();
                    return back()->with('error', 'Something went wrong! please try again');
                }
            } else {
                request()->session()->flash('error', 'Already Subscribed');
                return back();
            }
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  Store  $request
         * @return Response
         */
        public function messageStore(Store $request): Response
        {
            $message = Message::create($request->all());
            // return $message;
            $data = [];
            $data['url'] = route('message.show', $message->id);
            $data['date'] = $message->created_at->format('F d, Y h:i A');
            $data['name'] = $message->name;
            $data['email'] = $message->email;
            $data['phone'] = $message->phone;
            $data['message'] = $message->message;
            $data['subject'] = $message->subject;
            $data['photo'] = Auth()->user()->photo;
            // return $data;
            event(new MessageSent($data));
            exit();
        }
    }
