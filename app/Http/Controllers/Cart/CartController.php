<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Order;
use App\Product;
use App\Notification;

class CartController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$viewcart = User::findOrFail(Auth::user()->id)->cart()->orderBy('id', 'desc')->get();

    	return view('cart.index', compact('viewcart'));
    }

    public function addProductcart($id)
    {
    	$checkP = \DB::table('product_user')
    				 ->where('product_id', $id)
                     ->where('user_id', Auth::user()->id)->get();
        if(count($checkP) > 0) {
        	return redirect()->back()->with('message', 'Already has this product in cart.');
        }   else {

        	$addCart = User::findOrFail(Auth::user()->id);
    		$addCart->cart()->attach($id);
    		if($addCart)
	        {
	        	return redirect()->back()->with('message', 'Product cart added successfully.');
	        }
	        else {
	        	return redirect()->back()->with('message', 'Something wrong. Please try again.');
	        }
        }         
    }

    public function destroyProductcart($id)
    {
    	$deleteCart = \DB::table('product_user')
    				 ->where('product_id', $id)
                     ->where('user_id', Auth::user()->id)
                     ->delete();

    	if($deleteCart)
        {
        	return redirect()->back()->with('message', 'Product cart delete successfully.');
        }
        else {
        	return redirect()->back()->with('message', 'Something wrong. Please try again.');
        }
    }

    public function storeProductorder(Request $request)
    {
    	$return = false;
        $total = 0;
    	for($i=1; $i <= count($request->product_id); $i++ ) {
            if($request->quantity[$i] != 0) {
    	    	$order = new Order;
    	    	$order->user_id = Auth::user()->id;
    	    	$order->product_id = $request->product_id[$i];
    	    	$order->quantity   = $request->quantity[$i];
    	    	$order->save();
                $product = Product::findOrFail($request->product_id[$i]);
                $quantityCh =  \DB::table('products')->where('id', $request->product_id[$i])->decrement('quantity', $request->quantity[$i]);
                
                $total += ($request->price[$i] * $request->quantity[$i]);

                if($product->quantity <=10) {
                    $message = 'Product Name : '.$product->name.' Product Id : '.$product->id.' quantity is less than 10.';
                    $notification = Notification::create([
                        'message' => $message,
                    ]);
                }

    	    	$return = true;
            } else {
                return redirect()->back()->with('message', 'Something wrong. Please try again.');
            }
    	}

    	if($return)
        {
        	$deleteCart = \DB::table('product_user')
                     ->where('user_id', Auth::user()->id)
                     ->delete();
            if($deleteCart)
	        {
	        	return view('cart.payment', compact('total'))->with('message', 'Product order Complete.');
	        }
	        else {
	        	return redirect()->back()->with('message', 'Something wrong. Please try again.');
	        }      
        }
        else {
        	return redirect()->back()->with('message', 'Something wrong. Please try again.');
        }
    }

    public function viewOrder()
    {
    	$order = Order::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
    	return view('cart.order', compact('order'));
    }

    public function activeOrder($id)
    {
        $a = Order::findOrFail($id);
        $a->active = 1;
        $a->save();

        if($a) {
             $user = User::findOrFail($a->user_id);

        \Mail::send('emails.orderComplete', ['user' => $user], function ($m) use ($user) {
            $m->from('shajib50cse@gmail.com', 'Eshopper');

            $m->to($user->email, $user->name)->subject('Order Complete!');
        });

            return back();
        } else {
            return back();
        }
    }
}
