<?php

  namespace App\Http\Controllers;

  use App\Http\Helper;
  use App\Http\Requests\Order\Store;
  use App\Models\Cart;
  use App\Models\Order;
  use App\Models\Shipping;
  use App\Models\User;
  use App\Notifications\StatusNotification;
  use Carbon\Carbon;
  use Illuminate\Contracts\Foundation\Application;
  use Illuminate\Contracts\View\Factory;
  use Illuminate\Contracts\View\View;
  use Illuminate\Http\RedirectResponse;
  use Illuminate\Http\Request;
  use Illuminate\Http\Response;
  use Illuminate\Support\Str;
  use Notification;
  use PDF;

  class OrderFrontController extends Controller
  {

    /**
     * Store a newly created resource in storage.
     *
     * @param  Store  $request
     * @return RedirectResponse
     */
    public function store(Store $request): RedirectResponse
    {
      if (empty(Cart::whereUserId(auth()->user()->id)->where('order_id', null)->first())) {
        request()->session()->flash('error', 'Cart is Empty !');
        return back();
      }

      $order = new Order();
      $order_data = $request->all();
      $order_data['order_number'] = 'ORD-'.strtoupper(Str::random(10));
      $order_data['user_id'] = $request->user()->id;
      $order_data['shipping_id'] = $request->shipping;
      $shipping = Shipping::where('id', $order_data['shipping_id'])->pluck('price');
      // return session('coupon')['value'];
      $order_data['sub_total'] = Helper::totalCartPrice();
      $order_data['quantity'] = Helper::cartCount();
      if (session('coupon')) {
        $order_data['coupon'] = session('coupon')['value'];
      }
      if ($request->shipping) {
        if (session('coupon')) {
          $order_data['total_amount'] = Helper::totalCartPrice() + $shipping[0] - session('coupon')['value'];
        } else {
          $order_data['total_amount'] = Helper::totalCartPrice() + $shipping[0];
        }
      } else {
        if (session('coupon')) {
          $order_data['total_amount'] = Helper::totalCartPrice() - session('coupon')['value'];
        } else {
          $order_data['total_amount'] = Helper::totalCartPrice();
        }
      }
      // return $order_data['total_amount'];
      $order_data['status'] = "new";
      if (request('payment_method') == 'paypal') {
        $order_data['payment_method'] = 'paypal';
        $order_data['payment_status'] = 'paid';
      } else {
        $order_data['payment_method'] = 'cod';
        $order_data['payment_status'] = 'Unpaid';
      }
      $order->fill($order_data);
      $order->save();
      if ($order) {
        $users = User::where('role', 'admin')->first();
      }
      $details = [
          'title'     => 'New order created',
          'actionURL' => route('order.show', $order->id),
          'fas'       => 'fa-file-alt',
      ];
      Notification::send($users, new StatusNotification($details));
      if (request('payment_method') == 'paypal') {
        return redirect()->route('payment')->with(['id' => $order->id]);
      } else {
        session()->forget('cart');
        session()->forget('coupon');
      }
      Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => $order->id]);

      // dd($users);
      request()->session()->flash('success', 'Your product successfully placed in order');
      return redirect()->route('home');
    }

    /**
     * @return Application|Factory|View
     *
     */
    public function orderTrack()
    {
      return view('frontend.pages.order-track');
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function productTrackOrder(Request $request): RedirectResponse
    {
      // return $request->all();
      $order = Order::where('user_id', auth()->user()->id)->where('order_number',
          $request->order_number)->first();
      if ($order) {
        if ($order->status == "new") {
          request()->session()->flash('success', 'Your order has been placed. please wait.');
          return redirect()->route('home');
        } elseif ($order->status == "process") {
          request()->session()->flash('success', 'Your order is under processing please wait.');
          return redirect()->route('home');
        } elseif ($order->status == "delivered") {
          request()->session()->flash('success', 'Your order is successfully delivered.');
          return redirect()->route('home');
        } else {
          request()->session()->flash('error', 'Your order canceled. please try again');
          return redirect()->route('home');
        }
      } else {
        request()->session()->flash('error', 'Invalid order numer please try again');
        return back();
      }
    }
    /**
     * @param  Request  $request
     * @return Response
     */
    // PDF generate
    public function pdf(Request $request): Response
    {
      $order = Order::getAllOrder($request->id);
      // return $order;
      $file_name = $order->order_number.'-'.$order->first_name.'.pdf';
      // return $file_name;
      $pdf = PDF::loadview('backend.order.pdf', compact('order'));
      return $pdf->download($file_name);
    }
    /**
     * @param  Request  $request
     * @return array
     */
    // Income chart
    public function incomeChart(Request $request): array
    {
      $year = Carbon::now()->year;
      $items = Order::with(['cart_info'])->whereYear('created_at', $year)->where('status', 'delivered')->get()
          ->groupBy(function ($d) {
            return Carbon::parse($d->created_at)->format('m');
          });
      $result = [];
      foreach ($items as $month => $item_collections) {
        foreach ($item_collections as $item) {
          $amount = $item->cart_info->sum('amount');
          $m = intval($month);
          isset($result[$m]) ? $result[$m] += $amount : $result[$m] = $amount;
        }
      }
      $data = [];
      for ($i = 1; $i <= 12; $i++) {
        $monthName = date('F', mktime(0, 0, 0, $i, 1));
        $data[$monthName] = (!empty($result[$i])) ? number_format((float)($result[$i]), 2, '.', '') : 0.0;
      }
      return $data;
    }
  }
