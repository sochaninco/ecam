<?php

namespace App\Http\Controllers;

use App\City;
use App\MessageCenter;
use App\PageShops;
use App\PaymentInfo;
use App\PaymentMethod;
use App\Product;
use App\ProductOrder;
use App\ProductOrderDetail;
use App\ShippingOrder;
use App\ShopProduct;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Session;
use App\Cart;
use Image;
use Illuminate\Support\Facades\Input;
use Response;
use Illuminate\Support\Facades\File;

use App\Http\Requests;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected function package_expired_date(){
        $getUser = User::find(Auth::user()->id);
        $packageExpiredDate = $getUser->package_expired_date;
        return $packageExpiredDate;
    }
    public function my_ecammall($userId){
        $CheckShop = PageShops::where('user_id',$userId)->first();
        $expiredDateStr = $this->package_expired_date();
        /*if($CheckShop){*/
            $ShopProduct = ShopProduct::where(['status'=>0,'user_id'=>$userId])->get();
            $successOrder = ProductOrderDetail::where(['user_id'=>$userId,'status'=>1])->take(12)->get();
            $pendingOrder = ProductOrderDetail::where(['user_id'=>$userId,'status'=>0])->take(12)->get();
            $ShopInfo = PageShops::where('user_id',$userId)->first();
            if($ShopInfo){
                $ShopName = $ShopInfo->shop_name;
            }else{
                $ShopName = "Shop Name";
            }

            $Products = ShopProduct::where('user_id',$userId)->take(12)->get();
            return view('pages.users.my_ecammall',compact('ShopProduct','successOrder','pendingOrder','ShopName','Products','userId','expiredDateStr','CheckShop'));
        /*}
        else{
            $ShopProduct = '';
            return redirect('em-user/'.$userId.'/new_shop');
        }*/

    }
    public function my_account($userId){
        $Account = User::find($userId);
        $location = City::pluck('name','id');
        return view('pages.users.my_account',compact('location','Account','userId'));
    }
    public function update_my_account(Request $request,$userId){
        $data = $request->all();
        if(!empty($data['password'])){
            $validator = Validator::make($request->all(),
                ['phone'=> 'required',
                    'address'=> 'required',
                    'city'=> 'required|max:255',
                    'password' => 'required|min:6|confirmed',
                ]);
            if($validator->fails()){
                return back()->withInput()->withErrors($validator);
            }
            if (isset($data['image'])) {
                $image = Image::make($data['image'])->resize(98,112);
                $imageName = rand(11111, 99999). '.' . $data['image']->getClientOriginalExtension();
                $image->save('images/'.$imageName);
                $data['image'] = $imageName;
            }
            $data['password']= bcrypt($data['password']);
            $update = User::where('id',$userId)->first();
            $update->update($data);
        }
        else {
            $validator = Validator::make($request->all(),
                ['phone'=> 'required',
                    'city'=> 'required',
                    'address'=> 'required|max:255',
                ]);
            if($validator->fails()){
                return back()->withInput()->withErrors($validator);
            }
            if (isset($data['image'])) {
                $image = Image::make($data['image'])->resize(98,112);
                $imageName = rand(11111, 99999). '.' . $data['image']->getClientOriginalExtension();
                $image->save('images/'.$imageName);
                $data['image'] = $imageName;
            }
            $update = User::where('id',$userId)->first();
            $data['password']=$update->password;
            $update->update($data);
        }
        flash()->info('User updated successfully');
        return redirect('em-user/'.$userId.'/my_account');
    }
    public function uploadThumbnails(Request $request,$user_id){
        $data = $request->all();

        $image = Image::make($data['file'])->resize(98, 112);
        $destinationPath = 'images/'; // upload path
        $extension = $data['file']->getClientOriginalExtension(); // getting file extension
        $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
        $upload_success = $image->save($destinationPath. $fileName); // uploading file to given path

        if ($upload_success) {
            $update = User::where('id',$user_id)->first();
            if(File::exists("images/$update->image")) File::delete("images/$update->image");
            $data['image'] = $fileName;
            $update->update($data);
            $imgUpdate = '<img src="'.asset('images/'.$fileName).'">';
            return Response::json($imgUpdate, 200);
        } else {
            return Response::json('error', 400);
        }
    }
    public function user_product_buy_now(Request $request){
        $product_id = $request->product_id;
        $quantity_order = $request->quantity_order;
        $City = City::pluck('name','id');
        $BuyerInfo = User::where('id',Auth::user()->id)->first();
        $product = ShopProduct::find($product_id);

        return view('pages.orders.buy_now',compact('BuyerInfo','City','product','quantity_order'));
    }
    public function admin_product_buy_now(Request $request){
        $product_id = $request->product_id;
        $quantity_order = $request->quantity_order;
        $City = City::pluck('name','id');
        $BuyerInfo = User::where('id',Auth::user()->id)->first();
        $product = Product::find($product_id);
        return view('pages.orders.buy_now',compact('BuyerInfo','City','product','quantity_order'));
    }
    public function shopping_cart_product_buy_now(){
        $City = City::pluck('name','id');
        $BuyerInfo = User::where('id',Auth::user()->id)->first();
        if(!Session::has('cart')){
            return view('pages.orders.shopping_cart',['products'=>null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $pendingProduct = ProductOrderDetail::where(['status'=>0,'user_id'=>Auth::user()->id])->get();
        foreach ($pendingProduct as $pending){
            ProductOrder::where('id',$pending->product_order_id)->delete();
        }
        return view('pages.orders.buy_from_cart',['City'=>$City,'BuyerInfo'=>$BuyerInfo,'pendingProduct'=>$pendingProduct,'products'=>$cart->items,'total_price'=>$cart->totalPrice]);
    }
    public function product_order(Request $request){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['name'=>'required',
                'phone'=> 'required',
                'address'=> 'required',
                'city'=> 'required',
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        Session::forget('cart');
        if(!empty($data['orders'])){
            $items = $data['orders'];
            $allitems = [];
            $shipping = 0;
            $amount = 0;
            $total = 0;
            $discount = 0;
            foreach($items as $item){
                if(!empty($item['product_order_id'])){
                    ProductOrderDetail::where('id',$item['id'])->delete();
                }
                if(!empty($item['product_id'])){
                    if($item['product_from'] == 'admin'){
                        $item['product_from'] = 1;
//                        $getShopId = ['user_id'=>'0'];
                    }else{
                        $item['product_from'] = 0;
                        $getShopId = ShopProduct::where('id',$item['product_id'])->first();
                        $item['shop_id'] = $getShopId->user_id;
                    }
                    $amount += $item['amount'];
                    $total += $item['amount']-$discount;
                    $item['user_id']= Auth::user()->id;
                    $allitems[]= new ProductOrderDetail($item);
                }
            }
            //save to order table
            $data['user_id']=Auth::user()->id;
            $data['status']=0;
            $data['shipping_cost'] = $shipping;
            $data['amount']= $amount;
            $data['discount']=$discount;
            $data['total']=$total;
            $ProductOrder = ProductOrder::create($data);
            // save to order detail
            $ProductOrder->ProductOrderDetail()->saveMany($allitems);

            //update info in user table
            $user = User::find(Auth::user()->id);
//            $user->last_name = $data['name'];
            $user->address = $data['address'];
            $user->phone = $data['phone'];
            $user->update();

            $paymentMethod = $data['payment_method'];


            if($data['payment_method']== 0){
                return redirect('orders/'.$ProductOrder->id.'/confirm_payment');
            }
            else{
//                $City = City::pluck('name','id');
//                $BuyerInfo = User::where('id',Auth::user()->id)->first();
//                $Orders = ProductOrder::with('ProductOrderDetail')->where('id',$ProductOrder->id)->first();
//                return view('pages.orders.submit_payment',compact('order_id','City','BuyerInfo','Orders','paymentMethod'));
                return redirect('orders/'.$ProductOrder->id.'/submit_payment');
            }
        }

        return redirect('/');

    }
    public function confirm_payment($order_id){
        $City = City::pluck('name','id');
        $BuyerInfo = User::where('id',Auth::user()->id)->first();
        $Orders = ProductOrder::with('ProductOrderDetail')->where('id',$order_id)->first();
        $paymentMethod = PaymentInfo::where('order_id',$order_id)->first();


        return view('pages.orders.confirm_payment',compact('City','BuyerInfo','Orders','paymentMethod'));
    }
    public function submit_payment($order_id){
        $City = City::pluck('name','id');
        $BuyerInfo = User::where('id',Auth::user()->id)->first();
        $Orders = ProductOrder::with('ProductOrderDetail')->where('id',$order_id)->first();
        return view('pages.orders.submit_payment',compact('order_id','City','BuyerInfo','Orders'));
    }
    public function choose_method($methodId){
        $method = PaymentMethod::find($methodId);
        return view('pages.orders.choose_payment_method',compact('method'));
    }
    public function buyer_payment_info($methodId,$order_id){
        $method = PaymentMethod::find($methodId);
        return view('pages.orders.buyer_payment_info',compact('method','order_id'));
    }
    public function save_submit_payment(Request $request,$order_id){
        $data = $request->all();
        print_r($data);
        $data['order_id'] = $order_id;
        ProductOrder::where('id',$order_id)->update(['payment_method'=>$data['payment_method']]);
        $checkPayment = PaymentInfo::where('order_id',$order_id)->first();
        if($checkPayment){
            $checkPayment->update($data);
        }else{
            $payment = new PaymentInfo($data);
            Auth::user()->PaymentInfo()->save($payment);
        }


        return redirect('orders/'.$order_id.'/confirm_payment');
    }
    public function order_success(Request $request,$order_id){
        $data = $request->all();
        $checkPayment = PaymentInfo::where('order_id',$order_id)->first();
        $update = ProductOrder::findorfail($order_id);
        $items = $data['orders'];
        $allitems = [];
        foreach($items as $item){
            if(!empty($item['id'])){
                if($item['product_from'] == 'admin'){
                    $item['product_from'] = 1;
                }else{
                    $item['product_from'] = 0;
                }
                $item['status']=1;
                $check_order = ProductOrderDetail::where(['product_order_id'=>$order_id,'id'=>$item['id']])->first();
                if($check_order){
                    $check_order->update($item);
                }

            }
        }
        $update->update($data);
        Session::forget('cart');
        flash()->success('Your order is success');
        return view('pages.orders.order_success');
        /*if($checkPayment and $data['payment_method']== 0){
            $checkPayment->delete();
            $update->update(['payment_method'=>$data['payment_method']]);
            $items = $data['orders'];
            $allitems = [];
            foreach($items as $item){
                $item['status']=1;
                if(!empty($item['id'])){
                    if($item['product_from'] == 'admin'){
                        $item['product_from'] = 1;
                    }else{
                        $item['product_from'] = 0;
                    }
                    $check_order = ProductOrderDetail::where([['product_order_id',$order_id],['id',$item['id']]])->first();
                    $check_order->update($item);
                }
            }
            $update->update($data);
            Session::forget('cart');
            flash()->success('Your order is success');
            return view('pages.orders.order_success');
        }
        elseif(!$checkPayment and $data['payment_method'] == 1){
            return redirect('orders/'.$order_id.'/submit_payment');
        }
        elseif($checkPayment and $data['payment_method'] == 1){
            $items = $data['orders'];
            $allitems = [];
            foreach($items as $item){
                if(!empty($item['id'])){
                    if($item['product_from'] == 'admin'){
                        $item['product_from'] = 1;
                    }else{
                        $item['product_from'] = 0;
                    }
                    $item['status']=1;
                    $check_order = ProductOrderDetail::where([['product_order_id',$order_id],['id',$item['id']]])->first();
                    $check_order->update($item);
                }
            }
            $update->update($data);
            Session::forget('cart');
            flash()->success('Your order is success');
            return view('pages.orders.order_success');
        }
        elseif($data['payment_method'] == 0){
            $items = $data['orders'];
            $allitems = [];
            foreach($items as $item){
                if(!empty($item['id'])){
                    if($item['product_from'] == 'admin'){
                        $item['product_from'] = 1;
                    }else{
                        $item['product_from'] = 0;
                    }
                    $item['status']=1;
                    $check_order = ProductOrderDetail::where([['product_order_id',$order_id],['id',$item['id']]])->first();
                    $check_order->update($item);
                }
            }
            $update->update($data);
            Session::forget('cart');
            flash()->success('Your order is success');
            return view('pages.orders.order_success');
        }*/
//        if($checkPayment and ($data['payment_method'] == 0 || $data['payment_method'] == 1)){
//
//            //save to order detail
//            $items = $data['orders'];
//            $allitems = [];
//            foreach($items as $item){
//                if(!empty($item['id'])){
//                    if($item['product_from'] == 'admin'){
//                        $item['product_from'] = 1;
//                    }else{
//                        $item['product_from'] = 0;
//                    }
//                    $item['status']=1;
//                    $check_order = ProductOrderDetail::where([['product_order_id',$order_id],['id',$item['id']]])->first();
//                    $check_order->update($item);
//                }
//            }
//            $update->update($data);
//            flash()->success('Your order is success');
//            return view('pages.orders.order_success');
//        }
////        if($data['payment_method']== 0 and $checkPayment){
////
//////            return redirect('em-user/'.Auth::user()->id.'/my_orders');
////        }
//        elseif(!$checkPayment and $data['payment_method'] == 1){
//            return redirect('orders/'.$order_id.'/submit_payment');
//        }
    }
    public function pending_order_success(Request $request){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['name'=>'required',
                'phone'=> 'required',
                'address'=> 'required',
                'city'=> 'required',
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if(!empty($data['orders'])){
            $items = $data['orders'];
            $allitems = [];
            $shipping = 0;
            $amount = 0;
            $total = 0;
            $discount = 0;
            foreach($items as $item){
                ProductOrderDetail::where('id',$item['id'])->delete();
                if(!empty($item['product_id'])){
                    $amount += $item['amount'];
                    $total += $item['amount']-$discount;
                    $item['user_id']= Auth::user()->id;
                    $allitems[]= new ProductOrderDetail($item);
                }
            }
            //save to order table
            $data['user_id']=Auth::user()->id;
            $data['status']=1;
            $data['shipping_cost'] = $shipping;
            $data['amount']= $amount;
            $data['discount']=$discount;
            $data['total']=$total;
            $ProductOrder = ProductOrder::create($data);
            // save to order detail
            $ProductOrder->ProductOrderDetail()->saveMany($allitems);
            if($data['payment_method']== 0){
                return redirect('orders/'.$ProductOrder->id.'/confirm_payment');
            }
            else{
                return redirect('orders/'.$ProductOrder->id.'/submit_payment');
            }
        }
        Session::forget('cart');
        return redirect('/');
    }
    public function delete_order($order_id){
        $ProductOrder = ProductOrder::find($order_id);


        $ProductOrderDetail = ProductOrderDetail::where('product_order_id',$order_id)->first();
        $ProductOrderDetail->delete();
        if($ProductOrder){
            $ProductOrder->delete();
        }
        flash()->error('Your Orders has been deleted');
        return redirect('em-user/'.Auth::user()->id.'/my_orders');

    }
    public function start_shipping(Request $request,$orderId){
        $data = $request->all();
        $checkShipping = ShippingOrder::where('order_id',$orderId)->first();
        if($checkShipping){
            $checkShipping->status = $data['status'];
            $checkShipping->update();
        }else{
            $trackingNo = $orderId.'_'.rand(11111, 99999);
            $shippingOrder = new ShippingOrder;
            $shippingOrder->order_id = $orderId;
            $shippingOrder->tracking_no = $trackingNo;
            $shippingOrder->status = $data['status'];
            $shippingOrder->save();
        }

        //update status order detail table
        $productOrder = ProductOrderDetail::where(['product_order_id'=>$orderId,'product_id'=>$data['product_id']])->first();
        if($productOrder){
            print ($data['status']);
            $productOrder->order_status = $data['status'];
            $productOrder->update();
        }
        return redirect()->back();
    }

    public function pending_confirm(){
        $City = City::pluck('name','id');
        $BuyerInfo = User::where('id',Auth::user()->id)->first();
        $Orders = ProductOrderDetail::where(['user_id'=>Auth::user()->id,'status'=>0])->get();
        foreach ($Orders as $order){
            ProductOrder::where('id',$order->product_order_id)->delete();
        }
        return view('pages.orders.pending_confirm_payment',compact('City','BuyerInfo','Orders'));
    }
    public function pending_order_delete_item($id){
        ProductOrderDetail::where('id',$id)->delete();
    }
    public function message_center($user_id){
        $shopInfo = PageShops::where('user_id',$user_id)->first();
        $messagesToUserBuyerRole = MessageCenter::where(['user_id'=>$user_id,'message_type'=>'from_shop'])->get();
        $messageFromUserBuyerRole = MessageCenter::where(['user_id'=>$user_id,'message_type'=>'to_shop'])->get();

        $messageToUserShopOwner = MessageCenter::where(['shop_id'=>$user_id,'message_type'=>'from_shop'])->get();
        $messageFromUserShopOwner = MessageCenter::where(['shop_id'=>$user_id,'message_type'=>'to_shop'])->get();
        $shop = PageShops::pluck('shop_name','user_id');
        return view('pages.users.list_message',compact('messagesToUserBuyerRole','messageFromUserBuyerRole','messageToUserShopOwner','messageFromUserShopOwner','shop'));
    }
}
