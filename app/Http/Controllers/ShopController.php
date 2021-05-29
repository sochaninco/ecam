<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\City;
use App\Coupon;
use App\MessageCenter;
use App\PageShops;
use App\Product;
use App\ProductOrder;
use App\ProductOrderDetail;
use App\ProductThumnail;
use App\PromotionType;
use App\Role;
use App\ShopProduct;
use App\ShopTheme;
use App\SubCategory;
use App\Thumbnails;
use App\User;
use App\WishList;
use Illuminate\Support\Facades\File;
use Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Image;
use Illuminate\Support\Facades\Validator;
use Hash;


class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected function userId($user_id){
        $checkParent = User::where('id',Auth::user()->id)->first();
        if($checkParent->parent_id != 0){
            $userId = $checkParent->parent_id;
        }elseif ($checkParent->user_role == 1){
            $userId = $user_id;
        }
        else{
            $userId = $checkParent->id;
        }
        return $userId;
    }
    protected function package_expired_date(){
        $getUser = User::find(Auth::user()->id);
        $packageExpiredDate = $getUser->package_expired_date;
        return $packageExpiredDate;
    }

    protected function check_credit($userId){
        $user = User::find($userId);
        if($user->no_product == 0){
            flash()->error('Please Top up for get more credit');
            return false;
        }
            return true;

    }
    protected function credit_deduct($userId,$type){
        $userBalance = User::find($userId);
        if($type == 'post_product'){
                $userBalance->no_product -= 1;
                $userBalance->save();

        }elseif ($type== 'renew'){
                $userBalance->renew -= 1;
                $userBalance->save();

        }


    }
    public function shop_page($UserID){
//        $user_id = $this->userId();
        $ShopInfo = PageShops::where('user_id',$UserID)->first();
        $ShopImage = $ShopInfo->shop_image;
        $products = ShopProduct::where('user_id',$ShopInfo->user_id)->orderBy('id','desc')->paginate(12);
        return view('pages.users.products',compact('products','ShopImage'));

    }
    public function new_shop(){
        $location = City::pluck('name','id');
        $shopTheme = ShopTheme::pluck('shop_type','id');
        return view('pages.users.new_shop',compact('location','shopTheme'));
    }
    public function save_new_shop(Request $request){
        $data = $request->all();
        if(isset($data['shop_image']) || isset($data['shop_image_small'])){
            $validator = Validator::make($request->all(),
                ['shop_name'=> 'required',
                    'city'=>'required',
                    'shop_logo'=>'required',
                ]);
        }else{
            $validator = Validator::make($request->all(),
                ['shop_name'=> 'required',
                    'city'=>'required',
                    'shop_logo'=>'required',
                    'shop_theme'=>'required',
                ]);
        }
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if (isset($data['shop_image'])) {
            $image = Image::make($data['shop_image'])->resize(null, 150, function ($constraint) {
                $constraint->aspectRatio();});
            $imageName = $data['shop_name']. '.' . $data['shop_image']->getClientOriginalExtension();
            $image->save('images/user-shop/'. $imageName);
            $data['shop_image'] = $imageName;
        }

        if (isset($data['shop_logo'])) {
            $image = Image::make($data['shop_logo'])->resize(null, 150, function ($constraint) {
                $constraint->aspectRatio();});
            $imageName = $data['shop_name']. '-logo.' . $data['shop_logo']->getClientOriginalExtension();
            $image->save('images/user-shop/'. $imageName);
            $data['shop_logo'] = $imageName;
        }
        if (isset($data['shop_image_small'])) {
            $image = Image::make($data['shop_image_small'])->resize(340, 200);
            $imageName = $data['shop_name']. '-banner-small.' . $data['shop_image_small']->getClientOriginalExtension();
            $image->save('images/user-shop/'. $imageName);
            $data['shop_image_small'] = $imageName;
        }
        if(isset($data['promotion'])){
            $updateShop = PageShops::where('user_id',$this->userId())->first();
            $updateShop->update(['promotion_status'=>'1']);
        }

        $shop = new PageShops($data);
        Auth::user()->PageShop()->save($shop);

        flash()->success('Shop Information add successfully');
        return redirect('shop/'.$data['shop_name']);

    }
    public function shop_new_product($userId){
        $user_id = $this->userId($userId);
        $CheckShopID = PageShops::where('user_id',$user_id)->first();
        $ShopID = $CheckShopID->id;
        //check product
        $CountShopProduct = ShopProduct::where('user_id',$user_id)->count();
        $CountShopProduct++;
        $ProuductByShop = str_pad($CountShopProduct, 3, "0", STR_PAD_LEFT);
        $sku = $ShopID.$ProuductByShop;
        $Category = Category::where('parent_id',0)->pluck('name', 'id');
        $subByCat = Category::where('parent_id','!=',0)->pluck('name','id');
        $SubCategory = SubCategory::get();
        $brand = [];
        $promotion = PromotionType::where('user_id',$user_id)->pluck('type','id');
        $CheckLocation = PageShops::where('user_id',$userId)->first();
        $location = isset($CheckLocation->city)?($CheckLocation->city):null;
        $couponCode = Coupon::where('user_id',$user_id)->pluck('type','id');
        $expiredDateStr = $this->package_expired_date();
        return view('pages.users.shop_new_product',compact('Category','subByCat','SubCategory','brand','promotion','location','sku','userId','couponCode','expiredDateStr'));
    }
    public function uploadThumbnails($user_id,Request $request){
        $Count = ShopProduct::count();
//        $input = Input::all();
        $userId = Auth::user()->id;
        $checkParentUser = User::find($userId);
        if($checkParentUser->parent_id != 0){
            $userId = $checkParentUser->parent_id;
        }

//        $imageName = 'P_'.$id. '.' . rand(11111, 99999)->getClientOriginalExtension();
//        $image->save('images/thumbnails' . $imageName);
        $image = Image::make($request->file('file'))->resize(120, 120);
        $IMG2 = Image::make($request->file('file'))->resize(250, 250);
        $IMG3 = Image::make($request->file('file'))->resize(400, 400);
        $IMG4 = Image::make($request->file('file'))->resize(900,900);
        $destinationPath = 'images/thumbnails/shop/'; // upload path
        $des2 = 'images/thumbnails/medium/';
        $des3 = 'images/thumbnails/large/';
        $des4= 'images/thumbnails/';
        $extension = $request->file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = 'shop_'.$Count. '_' . rand(11111, 99999) . '.' . $extension; // renameing image
        $upload_success = $image->save($destinationPath. $fileName); // uploading file to given path
        $upload2 = $IMG2->save($des2. $fileName);
        $upload3 = $IMG3->save($des3. $fileName);
        $upload4 = $IMG4->save($des4. $fileName);

        if ($upload_success) {
            $thumbnails = new Thumbnails;
            $thumbnails->image = $fileName;
//            $thumbnails->product_id = $Count+1;
            $thumbnails->user_id=$userId;
            $thumbnails->save();
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }
    public function uploadThumbnails_editPage($user_id,$product_id,Request $request){
        $Count = ShopProduct::count();
        $data = $request->all();

        $userId = Auth::user()->id;
        $checkParentUser = User::find($userId);
        if($checkParentUser->parent_id != 0){
            $userId = $checkParentUser->parent_id;
        }

//        $imageName = 'P_'.$id. '.' . rand(11111, 99999)->getClientOriginalExtension();
//        $image->save('images/thumbnails' . $imageName);
        $image = Image::make($data['file'])->resize(120, 120);
        $IMG2 = Image::make($data['file'])->resize(250, 250);
        $IMG3 = Image::make($data['file'])->resize(400, 400);
        $IMG4 = Image::make($data['file'])->resize(900,900);
        $destinationPath = 'images/thumbnails/shop/'; // upload path
        $des2 = 'images/thumbnails/medium/';
        $des3 = 'images/thumbnails/large/';
        $des4= 'images/thumbnails/';
        $extension = $data['file']->getClientOriginalExtension(); // getting file extension
        $fileName = 'shop_'.$Count. '_' . rand(11111, 99999) . '.' . $extension; // renameing image
        $upload_success = $image->save($destinationPath. $fileName); // uploading file to given path
        $upload2 = $IMG2->save($des2. $fileName);
        $upload3 = $IMG3->save($des3. $fileName);
        $upload4 = $IMG4->save($des4. $fileName);

        if ($upload_success) {
            $thumbnails = new Thumbnails;
            $thumbnails->image = $fileName;
            $thumbnails->product_id = $product_id;
            $thumbnails->user_id=$userId;
            $thumbnails->save();
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }
    public function save_shop_new_product($userId,Request $request){
        $data = $request->all();
//        $data['user_id'] = $userId;
        $userId = Auth::user()->id;
        $checkParentUser = User::find($userId);
        if($checkParentUser->parent_id != 0){
            $userId = $checkParentUser->parent_id;
        }
        $data['user_id'] = $userId;
        $validator = Validator::make($request->all(),
            [
//                'code'=> 'required',
                'name'=> 'required',
                'cost'=>'required',
                'price'=>'required',
                'category_id'=>'required',
                'sub_category_id'=>'required',
                'quantity'=>'required',
                'unit'=>'required'
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if (isset($data['image'])) {
            $image = Image::make($data['image'])->resize(900,900);
            $imageName = 'P_'. rand(11111, 99999). '.' . $data['image']->getClientOriginalExtension();
            $image->save('images/user-shop/product/' . $imageName);
            $data['image'] = $imageName;
        }
        if (isset($data['feature_image_detail'])) {
            $image = Image::make($data['feature_image_detail'])->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();});
            $imageNameFeature = 'P_'. rand(11111, 99999). '.' . $data['feature_image_detail']->getClientOriginalExtension();
            $image->save('images/user-shop/product/' . $imageNameFeature);
            $data['feature_image_detail'] = $imageNameFeature;
        }
        if (isset($data['feature_image_detail_1'])) {
            $image = Image::make($data['feature_image_detail_1'])->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();});
            $imageNameFeature1 = 'P_'. rand(11111, 99999). '.' . $data['feature_image_detail_1']->getClientOriginalExtension();
            $image->save('images/user-shop/product/' . $imageNameFeature1);
            $data['feature_image_detail_1'] = $imageNameFeature1;
        }
        if (isset($data['feature_image_detail_2'])) {
            $image = Image::make($data['feature_image_detail_2'])->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();});
            $imageNameFeature2 = 'P_'. rand(11111, 99999). '.' . $data['feature_image_detail_2']->getClientOriginalExtension();
            $image->save('images/user-shop/product/' . $imageNameFeature2);
            $data['feature_image_detail_2'] = $imageNameFeature2;
        }
        if (isset($data['feature_image_detail_3'])) {
            $image = Image::make($data['feature_image_detail_3'])->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();});
            $imageNameFeature3 = 'P_'. rand(11111, 99999). '.' . $data['feature_image_detail_3']->getClientOriginalExtension();
            $image->save('images/user-shop/product/' . $imageNameFeature3);
            $data['feature_image_detail_3'] = $imageNameFeature3;
        }
        if (isset($data['feature_image_detail_4'])) {
            $image = Image::make($data['feature_image_detail_4'])->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();});
            $imageNameFeature4 = 'P_'. rand(11111, 99999). '.' . $data['feature_image_detail_4']->getClientOriginalExtension();
//            $domain = 'http://heangsochan.com';
            $image->save('images/user-shop/product/' . $imageNameFeature4);
            $data['feature_image_detail_4'] = $imageNameFeature4;
        }
        if(isset($data['video_upload'])){

            $videoUpload = $data['video_upload'];
            $filename = $videoUpload->getClientOriginalName();
            $path = public_path().'/images/user-shop/video/';
            $data['video_upload'] = 'V_'.rand(11111,99999).'.'.$videoUpload->getClientOriginalExtension();
            $videoUpload->move($path, $data['video_upload']);
        }

        if(!$this->check_credit($userId)){
            flash()->error('Not enough credits! Please register member before post product.');
            return back()->withInput();
        }
        $ShopProduct = new ShopProduct($data);
        $ShopProduct->save();
//        Auth::user()->PageShop()->save($ShopProduct);

        if($ShopProduct){
            $type = 'post_product';
            $this->credit_deduct($userId,$type);
            Thumbnails::where('user_id',$this->userId($userId))->where('product_id',0)
                ->update(['product_id'=>$ShopProduct->id]);
        }
        flash()->success('Your Product add successfully');
        return redirect('em-user/'.$this->userId($userId).'/my_shop');
    }
    public function list_user_product($userId){
        $user_id = $this->userId($userId);
        $expiredDateStr = $this->package_expired_date();
        $Products = ShopProduct::where('user_id',$user_id)->get();
        $ShopInfo = PageShops::where('user_id',$user_id)->first();
        $ShopName = $ShopInfo->shop_name;
        return view('pages.users.list_user_product',compact('Products','ShopName','userId','expiredDateStr'));
    }
    public function list_user_order($userId){
//        $successOrder = ProductOrderDetail::where(['user_id'=>$userId,'status'=>1])->get();
        /*$successOrder = ProductOrderDetail::
        join('users','product_order_details.user_id','=','users.id')
            ->select('product_order_details.*','users.first_name','users.last_name','users.phone as order_phone','users.address as order_address')
            ->where('product_order_details.status',1)
            ->where('product_order_details.user_id',$userId)
            ->get();*/
        $successOrder = ProductOrder::join('users','product_orders.user_id','=','users.id')
            ->select('product_orders.*','users.first_name','users.last_name','users.phone as order_phone','users.address as order_address')
            ->where('product_orders.order_status',1)
            ->where('product_orders.user_id',$userId)
            ->orderBy('product_orders.id','desc')
            ->get();
        $pendingOrder = ProductOrderDetail::join('users','product_order_details.user_id','=','users.id')
            ->select('product_order_details.*','users.first_name','users.last_name','users.phone as order_phone','users.address as order_address')
            ->where('product_order_details.status',0)
            ->where('product_order_details.user_id',$userId)
            ->get();
        $ShopInfo = PageShops::where('user_id',$userId)->first();
        if($ShopInfo) {
            $ShopName = $ShopInfo->shop_name;
        }
        else{
            $ShopName = "Shop Name";
        }

            return view('pages.users.list_user_order',compact('successOrder','pendingOrder','ShopName','userId'));
        /*}else{
            return redirect('em-user/'.$userId.'/new_shop');
        }*/

    }
    public function list_customer_order($userId){
        $successOrder = ProductOrderDetail::where(['shop_id'=>$userId,'status'=>1])->get();
        $pendingOrder = ProductOrderDetail::where(['shop_id'=>$userId,'status'=>0])->get();
        $ShopInfo = PageShops::where('user_id',$userId)->first();
        $ShopName = $ShopInfo->shop_name;
        return view('pages.users.list_customer_order',compact('successOrder','pendingOrder','ShopName','userId'));
    }
    public function message_from_shop($user_id,$shop_id,$product_from,$product_id){
        if($product_from == 1){
            $product = Product::find($product_id);
        }
        else{
            $product = ShopProduct::find($product_id);
        }
        $customer = User::find($user_id);
        $shop = PageShops::where('user_id',$shop_id)->first();
        return view('pages.users.message_from_shop',compact('customer','shop','product'));
    }
    public function save_message_from_shop(Request $request,$user_id,$shop_id,$product_from,$product_id){
        $data = $request->all();
        $data['user_id'] = $user_id;
        $data['shop_id'] = $shop_id;
        $data['product_from'] = $product_from;
        $data['product_id'] = $product_id;
        $data['message_type'] = 'from_shop';
        $message = new MessageCenter($data);
        $message->save();
        return redirect('em-user/'.$shop_id.'/customer_orders');
    }

    public function message_to_shop($user_id,$shop_id,$product_from,$product_id){
        if($product_from == 1){
            $product = Product::find($product_id);
        }
        else{
            $product = ShopProduct::find($product_id);
        }
        $customer = User::find($user_id);
        $shop = PageShops::where('user_id',$shop_id)->first();
        return view('pages.users.message_to_shop',compact('customer','shop','product'));
    }
    public function save_message_to_shop(Request $request,$user_id,$shop_id,$product_from,$product_id){
        $data = $request->all();
        $data['user_id'] = $user_id;
        $data['shop_id'] = $shop_id;
        $data['product_from'] = $product_from;
        $data['product_id'] = $product_id;
        $data['message_type'] = 'to_shop';
        $message = new MessageCenter($data);
        $message->save();
        return redirect('em-user/'.$user_id.'/my_message_center');
    }

    public function chat_form(Request $request){
        $data = $request->all();
        $shop = $data['shop'];
        return view('pages.users.chat_to_shop',compact('shop'));

    }
    public function user_wish_list($userId){
        $wishLists = WishList::where('user_id',$userId)->get();
        return view('pages.users.user_wish_list',compact('wishLists','userId'));
    }
    public function user_shop($userId){
        $ShopInfo = PageShops::where('user_id',$userId)->first();
        if($ShopInfo){
            $location = City::pluck('name','id');
            $shopTheme = ShopTheme::pluck('shop_type','id');
            return view('pages.users.shop_info',compact('ShopInfo','location','shopTheme','userId'));
        }else{
            return redirect('em-user/'.$userId.'/new_shop');
        }
    }
    public function update_shop_info($userId,Request $request){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['shop_name'=> 'required',
             'city'=>'required'
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        $update = PageShops::where('user_id',$this->userId($userId))->first();
        $shopImage = $update->shop_image;
        $shopImageSmall = $update->shop_image_small;
        $shopLogo = $update->shop_logo;
        if(isset($data['shop_image'])) {
            if(File::exists("images/user-shop/$shopImage")) File::delete("images/user-shop/$shopImage");
            $image = Image::make($data['shop_image'])->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();});
            $imageName = $data['shop_name']. '.' . $data['shop_image']->getClientOriginalExtension();
            $image->save('images/user-shop/'. $imageName);
            $data['shop_image'] = $imageName;
        }
        if(isset($data['shop_image_small'])) {
            if(File::exists("images/user-shop/$shopImageSmall")) File::delete("images/user-shop/$shopImageSmall");
            $image = Image::make($data['shop_image_small'])->resize(null, 250, function ($constraint) {
                $constraint->aspectRatio();});
            //$image = Image::make($data[''])->resize(340, 250);
            $imageName = $data['shop_name']. '-banner-small.' . $data['shop_image_small']->getClientOriginalExtension();
            $image->save('images/user-shop/'. $imageName);
//            $jpg = (string) Image::make('images/user-shop/EMFood Service-banner-small.jpg')->encode('webp', 75);

            $data['shop_image_small'] = $imageName;
        }

        if(isset($data['shop_logo'])) {
            if(File::exists("images/user-shop/$shopLogo")) File::delete("images/user-shop/$shopLogo");

            $image = Image::make($data['shop_logo'])->resize(null, 150, function ($constraint) {
                $constraint->aspectRatio();});
            $imageName = $data['shop_name']. '-logo.' . $data['shop_logo']->getClientOriginalExtension();
            $image->save('images/user-shop/'. $imageName);
            $data['shop_logo'] = $imageName;
        }

        $update->update($data);

        flash()->info('Shop Information Update Successfully');
        return redirect()->back();


    }
    public function delete_product($userId,$product_id){
        $delete = ShopProduct::find($product_id);
        if($delete->status == 0){
            $delete->update(['status'=>1]);
            flash()->error('Product has been disable');
        }else{
            $delete->update(['status'=>0]);
            flash()->info('Product has been enable to list');
        }
        return redirect('em-user/'.$this->userId($userId).'/my_shop');
    }
    public function delete_product_from_list($userId,$product_id){
        $delete = ShopProduct::find($product_id);
        $imgName = $delete->image;
        if(File::exists("images/user-shop/product/$imgName")) File::delete("images/user-shop/product/$imgName");
        if(File::exists("images/user-shop/product/$delete->feature_image_detail")) File::delete("images/user-shop/product/$delete->feature_image_detail");
        if(File::exists("images/user-shop/product/$delete->feature_image_detail_1")) File::delete("images/user-shop/product/$delete->feature_image_detail_1");
        if(File::exists("images/user-shop/product/$delete->feature_image_detail_2")) File::delete("images/user-shop/product/$delete->feature_image_detail_2");
        if(File::exists("images/user-shop/product/$delete->feature_image_detail_3")) File::delete("images/user-shop/product/$delete->feature_image_detail_3");
        if(File::exists("images/user-shop/product/$delete->feature_image_detail_4")) File::delete("images/user-shop/product/$delete->feature_image_detail_4");
        $deletethumb = Thumbnails::where('product_id',$product_id)->get();
        foreach ($deletethumb as $thumb){
            $thumbName = $thumb->image;
            if(File::exists("images/thumbnails/shop/$thumbName")) File::delete("images/thumbnails/shop/$thumbName");
            if(File::exists("images/thumbnails/$thumbName")) File::delete("images/thumbnails/$thumbName");
            $thumb->delete();
        }
        $delete->delete();
        flash()->info('Product has been delete from list');
        return redirect('em-user/'.$this->userId($userId).'/my_shop');
    }
    public function edit_product($userId,$product_id){
        $user_id = $this->userId($userId);
        $Product = ShopProduct::find($product_id);
        $Category = Category::pluck('name', 'id');
        $SubCategory = Category::where('id',$Product->sub_category_id)->first();
        $brand = Brand::where('category_id',$Product->category_id)->pluck('name','id');
        $thumbnails = Thumbnails::where('product_id',$product_id)->get();
        $CheckShopID = PageShops::where('user_id',$user_id)->first();
        $ShopID = $CheckShopID->id;
        //check product
        $CountShopProduct = ShopProduct::where('user_id',$user_id)->count();
        $CountShopProduct++;
        $ProuductByShop = str_pad($CountShopProduct, 3, "0", STR_PAD_LEFT);
        $sku = $Product->sku;
        $promotion = PromotionType::where('user_id',$user_id)->pluck('type','id');
        $CheckLocation = ShopProduct::where('id',$product_id)->first();
        $location = isset($CheckLocation->location)?($CheckLocation->location):null;
        $couponCode = Coupon::where('user_id',$user_id)->pluck('type','id');
        $expiredDateStr = $this->package_expired_date();
        return view('pages.users.shop_edit_product',compact('promotion','Product','sku','Category','SubCategory','brand','location','thumbnails','userId','couponCode','expiredDateStr'));
    }
    public function update_product($userId,$product_id,Request $request){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            [
//                'code'=> 'required',
                'name'=> 'required',
                'cost'=>'required',
                'price'=>'required',
                'category_id'=>'required',
                'sub_category_id'=>'required',
                'quantity'=>'required',
                'unit'=>'required'
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if (isset($data['image'])) {
            $image = Image::make($data['image'])->resize(900,900);
            $imageName = 'P_'. rand(11111, 99999). '.' . $data['image']->getClientOriginalExtension();
            $image->save('images/user-shop/product/' . $imageName);
            $data['image'] = $imageName;
        }
        if (isset($data['feature_image_detail'])) {
            $image = Image::make($data['feature_image_detail'])->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();});
            $imageNameFeature = 'P_'. rand(11111, 99999). '.' . $data['feature_image_detail']->getClientOriginalExtension();
            $image->save('images/user-shop/product/' . $imageNameFeature);
            $data['feature_image_detail'] = $imageNameFeature;
        }
        if (isset($data['feature_image_detail_1'])) {
            $image = Image::make($data['feature_image_detail_1'])->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();});
            $imageNameFeature1 = 'P_'. rand(11111, 99999). '.' . $data['feature_image_detail_1']->getClientOriginalExtension();
            $image->save('images/user-shop/product/' . $imageNameFeature1);
            $data['feature_image_detail_1'] = $imageNameFeature1;
        }
        if (isset($data['feature_image_detail_2'])) {
            $image = Image::make($data['feature_image_detail_2'])->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();});
            $imageNameFeature2 = 'P_'. rand(11111, 99999). '.' . $data['feature_image_detail_2']->getClientOriginalExtension();
            $image->save('images/user-shop/product/' . $imageNameFeature2);
            $data['feature_image_detail_2'] = $imageNameFeature2;
        }
        if (isset($data['feature_image_detail_3'])) {
            $image = Image::make($data['feature_image_detail_3'])->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();});
            $imageNameFeature3 = 'P_'. rand(11111, 99999). '.' . $data['feature_image_detail_3']->getClientOriginalExtension();
            $image->save('images/user-shop/product/' . $imageNameFeature3);
            $data['feature_image_detail_3'] = $imageNameFeature3;
        }
        if (isset($data['feature_image_detail_4'])) {
            $image = Image::make($data['feature_image_detail_4'])->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();});
            $imageNameFeature4 = 'P_'. rand(11111, 99999). '.' . $data['feature_image_detail_4']->getClientOriginalExtension();
            $image->save('images/user-shop/product/' . $imageNameFeature4);
            $data['feature_image_detail_4'] = $imageNameFeature4;
        }
        if(isset($data['video_upload'])){

            $videoUpload = $data['video_upload'];
            $filename = $videoUpload->getClientOriginalName();
            $path = public_path().'/images/user-shop/video/';
            $videoUpload->move($path, $filename);
            $data['video_upload'] = 'V_'.rand(11111,99999).'.'.$videoUpload->getClientOriginalExtension();
        }

        if(isset($data['promotion'])){
            $updateShop = PageShops::where('user_id',$this->userId($userId))->first();
            $updateShop->update(['promotion_status'=>'1']);
        }
        $update = ShopProduct::find($product_id);
        $update->update($data);

        flash()->info('Product Update Successfully');
        return redirect('em-user/'.$this->userId($userId).'/my_shop');

    }
    public function renew_product($userId,$product_id){
        $userId = $this->userId($userId);
        $renew = ShopProduct::find($product_id);
        $renew->touch();
        if($renew){
            $type = 'renew';
            $this->credit_deduct($userId,$type);
        }
        flash()->success('Congratulation! your product is renew');
        return redirect()->back();
    }
    public function delete_thumbnail($id){
        $delete = Thumbnails::find($id);
        $imgName = $delete->image;
        if(File::exists("images/thumbnails/$imgName")) File::delete("images/thumbnails/$imgName");
        if(File::exists("images/thumbnails/shop/$imgName")) File::delete("images/thumbnails/shop/$imgName");
        $delete->delete();

    }
    public function delete_video($productId,$videoName){
        $update = ShopProduct::find($productId);
        /*$imgName = $delete->image;*/
        if(File::exists("images/user-shop/video/$videoName")) File::delete("images/user-shop/video/$videoName");
        $update->video_upload = '';
        $update->save();

    }
    public function delete_feature_image($type,$id){
        $update = ShopProduct::find($id);
        if($type == 1){
            $imgName = $update->feature_image_detail;
            if(File::exists("images/user-shop/product/$imgName")) File::delete("images/user-shop/product/$imgName");
            $update->update(['feature_image_detail'=>null]);
        }
        elseif($type == 2){
            $imgName = $update->feature_image_detail_1;
            if(File::exists("images/user-shop/product/$imgName")) File::delete("images/user-shop/product/$imgName");
            $update->update(['feature_image_detail_1'=>null]);
        }
        elseif($type == 3){
            $imgName = $update->feature_image_detail_2;
            if(File::exists("images/user-shop/product/$imgName")) File::delete("images/user-shop/product/$imgName");
            $update->update(['feature_image_detail_2'=>null]);
        }
        elseif($type == 4){
            $imgName = $update->feature_image_detail_3;
            if(File::exists("images/user-shop/product/$imgName")) File::delete("images/user-shop/product/$imgName");
            $update->update(['feature_image_detail_3'=>null]);
        }
        elseif($type == 5){
            $imgName = $update->feature_image_detail_4;
            if(File::exists("images/user-shop/product/$imgName")) File::delete("images/user-shop/product/$imgName");
            $update->update(['feature_image_detail_4'=>null]);
        }
    }
    public function get_subcategory($categoryID){
        $SubCategory = Category::where('parent_id',$categoryID)->get();
//        print_r($SubCategory);
        $subcat='';

        foreach ($SubCategory as $key=>$Sub){
            if($key == 0){
                $subcat .='<option value="">'.'Select any sub category...'.'</option>';
            }
            $subcat .= "<option value='".$Sub->id."'>".$Sub->name."</option>";
        }

        return $subcat;
    }
    public function get_category_by_shop($shop){
        $products = ShopProduct::where('user_id',$shop)->get();
        $pro = '';
        foreach ($products as $key=>$product){
            if($key == 0){
                $products .='<option value="">'.'Select any product ...'.'</option>';
            }
            $pro .= "<option value='".$product->id."'>".$product->name."</option>";
        }

        return $pro;

    }
    public function get_brand($CategoryID){
        $Brands = Brand::where('category_id',$CategoryID)->get();
        $brand ='';
        foreach ($Brands as $key=>$b){
            if($key == 0){
                $brand .='<option value="">'.'Select any brand...'.'</option>';
            }
            $brand .= "<option value='".$b->id."'>".$b->name."</option>";
        }
        return $brand;
    }
    public function my_promotion($userId){
        $promotion = PromotionType::where('user_id',$userId)->get();
        return view('pages.users.list_user_promotion',compact('promotion','userId'));
    }
    public function new_promotion($userId){
        return view('pages.users.new_promotion',compact('userId'));
    }
    public function save_promotion(Request $request,$userId){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['type'=> 'required']);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        $data['user_id']= $userId;
        PromotionType::create($data);
        flash()->success('promotion add success');
        return redirect('em-user/'.$userId.'/my_promotion');
    }
    public function edit_promotion($userId,$pro_id){
        $promotion = PromotionType::find($pro_id);
        return view('pages.users.edit_promotion',compact('userId','promotion'));
    }
    public function update_promotion(Request $request,$userId,$pro_id){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['type'=> 'required']);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        $update = PromotionType::find($pro_id);
        $update->update($data);
        flash()->info('promotion update successfully');
        return redirect('em-user/'.$userId.'/my_promotion');

    }
    public function delete_promotion($userId,$pro_id){
        $delete = PromotionType::find($pro_id);
        $delete->delete();
        flash()->error('promotion delete successfully');
        return redirect('em-user/'.$userId.'/my_promotion');

    }

    public function my_coupon($userId){
        $coupons = Coupon::where('user_id',$userId)->get();
        return view('pages.users.list_user_coupons',compact('coupons','userId'));
    }
    public function new_coupon($userId){
        return view('pages.users.new_coupon',compact('userId'));
    }
    public function save_coupon(Request $request,$userId){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['type'=> 'required']);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        $data['user_id']= $userId;
        Coupon::create($data);
        flash()->success('coupon add success');
        return redirect('em-user/'.$userId.'/my_coupons');
    }
    public function edit_coupon($userId,$cou_id){
        $coupon = Coupon::find($cou_id);
        return view('pages.users.edit_coupon',compact('userId','coupon'));
    }
    public function update_coupon(Request $request,$userId,$cou_id){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['type'=> 'required']);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        $update = Coupon::find($cou_id);
        $update->update($data);
        flash()->info('Coupon update successfully');
        return redirect('em-user/'.$userId.'/my_coupons');

    }
    public function delete_coupon($userId,$cou_id){
        $delete = Coupon::find($cou_id);
        $delete->delete();
        flash()->error('coupon delete successfully');
        return redirect('em-user/'.$userId.'/my_coupons');

    }

    public function my_shipping_address($userId){
        $shippingInfo = PageShops::where('user_id',$userId)->first();
        $city = City::pluck('name','id');
        /*if($shippingInfo){*/
            return view('pages.users.shipping_info',compact('shippingInfo','city','userId'));
        /*}else{
            return redirect('em-user/'.$userId.'/new_shop');
        }*/

    }
    public function update_shipping_address(Request $request,$userId){
        $data = $request->all();
        $shippingInfo = PageShops::where('user_id',$userId)->first();
        $shippingInfo->update($data);

        flash()->info('Shipping Information Update Successfully');
        return redirect()->back();
    }

    public function shop_member($userId){
        $users = User::where('parent_id',$userId)->get();
        return view('pages.users.shop_member',compact('users','userId'));

    }
    public function create_shop_member($userId){
        $roles = Role::whereIn('id',[2,3,4,5,6,7])->pluck('display_name','id');
        return view('pages.users.create_shop_member',compact('roles','userId'));
    }
    public function  save_shop_member($userId,Request $request){
    $this->validate($request, [
        'first_name' => 'required',
        'last_name' =>'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|same:confirm-password',
//            'roles' => 'required'
    ]);


    $input = $request->all();
    $input['password'] = Hash::make($input['password']);
    $input['parent_id'] = $userId;


    $user = User::create($input);
    foreach ($request->input('roles') as $key => $value) {
        $user->attachRole($value);
    }

    flash()->success('Shop member created successfully');
    return redirect('em-user/'.$userId.'/shop_member');
}

}
