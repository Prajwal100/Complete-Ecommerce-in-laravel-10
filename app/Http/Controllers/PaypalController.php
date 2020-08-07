<?php

namespace App\Http\Controllers;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Provider;
class PaypalController extends Controller
{
    public function payment()
    {
        $cart = session('cart') ? session('cart') : '';
        // $total=0;
        // foreach($cart as $data){
        //     $total+= $data['amount'];
        // }
        // // return $total;
        // $data = [];
        // $data['items'] = array_map(function ($item) use($cart) {
        //     return [
        //         'name' => 'hello',
        //         'price' => $item['price'],
        //         'desc'  => 'Description for ItSolutionStuff.com',
        //         'qty' => $item['quantity']

        //     ];
        // }, $cart);
        // $data['items'] = [
        //     [
        //         'name' => 'ItSolutionStuff.com',
        //         'price' => 100,
        //         'desc'  => 'Description for ItSolutionStuff.com',
        //         'qty' => 1
        //     ],
        //     [
        //         'name' => 'ItSolutionStuff.com',
        //         'price' => 100,
        //         'desc'  => 'Description for ItSolutionStuff.com',
        //         'qty' => 1
        //     ],
        //     [
        //         'name' => 'ItSolutionStuff.com',
        //         'price' => 100,
        //         'desc'  => 'Description for ItSolutionStuff.com',
        //         'qty' => 1
        //     ],
           
        // ];
        
        // $data['invoice_id'] = 'ORD-'.strtoupper(uniqid());
        // $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        // $data['return_url'] = route('payment.success');
        // $data['cancel_url'] = route('payment.cancel');
        // $data['total'] = 100;
        // // return $data;
        $data = [];
        
        // return $cart;
        $data['items'] = array_map(function ($item) use($cart) {
            return [
                'name' => $item['title'],
                'price' => $item['price'],
                'desc'  => 'Description for ItSolutionStuff.com',
                'qty' => $item['quantity']

            ];
        }, $cart);

        $data['invoice_id'] ='ORD-'.strtoupper(uniqid());
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');

        $total = 0;
        foreach($data['items'] as $item) {
            $total += $item['price']*$item['qty'];
        }

        $data['total'] = $total;
        // return $data;
        $provider = new ExpressCheckout;
  
        $response = $provider->setExpressCheckout($data);
    
        return redirect($response['paypal_link']);
    }
   
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }
  
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        // return $response;
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            session()->forget('cart');
            request()->session()->flash('success','You successfully pay from Paypal! Thank You');
            return redirect()->route('home');
        }
  
        request()->session()->flash('error','Something went wrong please try again!!!');
        return redirect()->back();
    }
}
