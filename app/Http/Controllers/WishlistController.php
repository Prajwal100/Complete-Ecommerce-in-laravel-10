<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Product;
class WishlistController extends Controller
{
    protected $product=null;
    public function __construct(Product $product){
        $this->product=$product;
    }
    public function wishlist(Request $request){
        // dd($request->all());
        if(Auth::check()){
            $qty=$request->quantity;
            $this->product=$this->product->find($request->pro_id);
            if(!$this->product){
                return response()->json(['status'=>false,'msg'=>'Product not found please try again','data'=>null]);
            }
            $current_item=array(
                'id'=>$this->product->id,
                'title'=>$this->product->title,
                'link'=>route('product-detail',$this->product->slug),
                'price'=>$this->product->price,
                'summary'=>$this->product->summary,
                'photo'=>$this->product->photo,
            );
            $price=$this->product->price;
            if($this->product->discount){
                $price=($price-($price*$this->product->discount)/100);
            }
            $current_item['price']=$price;

            $wishlist=session('wishlist') ? session('wishlist') : null;

            if($wishlist){
                // if already product in wishlist
                $index=null;
                foreach($wishlist as $key=>$value){
                    if($value['id']==$this->product->id){
                        $index=$key;
                    break;
                    }
                }

                if($index !==null){
                    $wishlist[$index]['quantity']=$qty;
                    $wishlist[$index]['amount']=ceil($qty*$price);
                    if($wishlist[$index]['quantity']<=0){
                        unset($wishlist[$index]);
                    }
                }
                else{
                    $current_item['quantity']=$qty;
                    $current_item['amount']=ceil($price*$qty);
                    $wishlist[]=$current_item;
                }
            }
            else{
                $current_item['quantity']=$qty;
                $current_item['amount']=ceil($price*$qty);
                $wishlist[]=$current_item;
            }

            session()->put('wishlist',$wishlist);
            return response()->json(['status'=>true,'msg'=>'Product successfully placed in wishlist','data'=>$wishlist]);
        }
        else{
            return response(['status'=>false,'msg'=>'You need to login first','data'=>null]);
        }
    }

    public function removeWishlist(Request $request){
        $index=$request->index;
        $wishlist=session('wishlist');
        unset($wishlist[$index]);
        session()->put('wishlist',$wishlist);
        request()->session()->flash('success','Your product successfully removed from wishlist');
        return redirect()->back();
    }
}
