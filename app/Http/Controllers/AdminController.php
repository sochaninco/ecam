<?php

namespace App\Http\Controllers;

use App\AdminPromotion;
use App\Brand;
use App\Category;
use App\CategorySlide;
use App\City;
use App\FooterPage;
use App\FooterType;
use App\OrderStatus;
use App\Packages;
use App\PageManagement;
use App\PageShops;
use App\PaymentInfo;
use App\PaymentMethod;
use App\PopUpBanner;
use App\PosSale;
use App\PosSaleDetail;
use App\PosSaleTmp;
use App\Product;
use App\ProductOrder;
use App\ProductOrderDetail;
use App\ProductThumnail;
use App\ProductVariants;
use App\Role;
use App\SearchKeyword;
use App\ShopProduct;
use App\ShopTheme;
use App\Slide;
use App\SubCategory;
use App\Thumbnails;
use App\TransactionMember;
use App\Unit;
use App\User;
use App\WarehouseProducts;
use App\WarehouseProductVariants;
use App\Warehouses;
use Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\PromotionType;
use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use Response;
use Illuminate\Support\Facades\Input;
use Image;
use Illuminate\Support\Facades\Validator;
use Hash;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected function shopType(){
        $shopType = ['Automatic'=>'Automatic',
                     'Beauty Product' => 'Beauty Product',
                     'Consumer Products'=>'Consumer Products',
                     'Electrical & Electronics' => 'Electrical & Electronics',
                     'Food & Berverage'=>'Food & Berverage',
        ];
        return $shopType;
    }
    protected function package_term(){
        $packageTerm = ['1 month' => '1 month',
                        '3 months' => '3 months',
                        '6 months' => '6 months',
                        '9 months' => '9 months',
                        '12 months' => '12 months',
                        '24 months' => '24 months',
                        '36 months' => '36 months',
            ];
        return $packageTerm;
    }
    public function dashboard(){
        $ShopInfo = [];
        if(Auth::user()->id == 1 || Auth::user()->id == 3){
            $ShopInfo = PageShops::where('user_id',1)->first();
        }
        $posSales = PosSale::with('user','warehouse')->take(5)->get();
        return view('pages.dashboard',compact('ShopInfo','posSales'));
    }
    public function admin_shop_info(){
        $ShopInfo = [];
        if(Auth::user()->id == 1 || Auth::user()->id == 3){
            $ShopInfo = PageShops::where('user_id',1)->first();
        }
        return view('pages.admin_shop_info',compact('ShopInfo'));
    }
    public function pos(){
        if(Auth::user()->user_role == 1){
            $products = Product::paginate(32);
        }else{
            $products = ShopProduct::where('user_id',Auth::user()->id)->paginate(32);
        }

        $categories = Category::where('parent_id',0)->get();
        $subcategories = Category::where('parent_id','!=',0)->get();
        $brands = Brand::get();
        $warehouses = Warehouses::get();
        return view('pages.pos',compact('categories','subcategories','brands','products','warehouses'));
    }
    public function save_pos(Request $request){
        $data = $request->all();
        print_r($data);
        //check order number
        $countPosSale = PosSale::count();
        $countPosSale++;
        $reference_no = str_pad($countPosSale, 6, "0", STR_PAD_LEFT);

        $posSaleTotal = 0;

        //save to pos sale detail
        $items = $data['item'];

        $allitems = [];
        foreach($items as $item){
            print_r($item);
            if(!empty($item['product_id'])){
                $allitems[]= new PosSaleDetail($item);

                //remove from pos sale tmp
                PosSaleTmp::where(['product_id'=>$item['product_id']],['user_id'=>Auth::user()->id])->delete();
            }
            $posSaleTotal += $item['quantity'] * $item['net_price'];
        }
        //save to order table
        $data['reference_no'] = $reference_no;
        $data['total']=$posSaleTotal;
        $posSale = PosSale::create($data);
        // save to order detail
        $posSale->posSaleDetail()->saveMany($allitems);



        return redirect('pos');
    }
    public function pos_sale_list(){
        $posSales = PosSale::with('user','warehouse')->get();
        return view('pages.pos_sale_list',compact('posSales'));
    }
    public function get_pos_sale_detail_pop_up($id){
        $posSaleDetail = PosSale::with('posSaleDetail','user','warehouse')->find($id);
       return view('pages.pos.pos_sale_detail',compact('posSaleDetail'));
    }
    public function getProductDataByCode(Request $request){
        $data = $request->all();
        $key = $data['key'];
        if(Auth::user()->user_role == 1){
            $product = Product::where('code',$data['code'])->first();
        }else{
            $product = ShopProduct::where('code',$data['code'])->first();
        }

//        print_r($request->all());
        //save to pos sale tmp table
        $checkExistItem = PosSaleTmp::where(['product_id'=>$product->id],['user_id'=>Auth::user()->id])->first();
        if($checkExistItem){
            return '<script type="text/javascript">alert("Item already exist");</script>';

        }
        $posSaleTmp = new PosSaleTmp();
        $posSaleTmp->product_id = $product->id;
        $posSaleTmp->qty = 1;
        $posSaleTmp->price = $product->price;
        $posSaleTmp->user_id = Auth::user()->id;
        $posSaleTmp->save();

        return view('pages.pos.pos-sale-product-list',compact('product','key'));
    }

    public function getProductByCategory(Request $request){
        $data = $request->all();
        $category = $data['category_id'];

        $products = $this->ajaxProduct($category,null,null);

        $subcategories = Category::where('parent_id',$category)->get();
        $scats         = '';
        if ($subcategories) {
            foreach ($subcategories as $category) {
                $scats .= '<button id="subcategory-' . $category->id . "\" type=\"button\" value='" . $category->id . "' class=\"btn-prni subcategory\" ><img src=\"" . asset('stock/assets/uploads/thumbs/') .'/'. ($category->image ? $category->image : 'no_image.png') . "\" class='img-rounded img-thumbnail' /><span>" . $category->name . '</span></button>';
            }
        }

        return Response::json(['products'=>$products,'subcategories'=>$scats]);

    }
    public function getProductBySubcategory(Request $request){
        $data = $request->all();
        $subcategory = $data['subcategory_id'];
        $prods = $this->ajaxProduct(null,$subcategory,null);

        return $prods;

    }
    public function getProductByBrand(Request $request){
        $data = $request->all();
        $brand = $data['brand_id'];
        $products = $this->ajaxProduct(null,null,$brand);

        return Response::json(['products'=>$products]);
    }
    public function ajaxProduct($category = null,$subcategory = null,$brand = null){

        if(Auth::user()->user_role == 1){
            if($category != null){
                $products = Product::where('category_id',$category)->paginate(32);
            }elseif($subcategory != null){
                $products = Product::where('subcategory_id',$subcategory)->paginate(32);
            }elseif($brand != null){
                $products = Product::where('brand',$brand)->paginate(32);
            }

        }else{
            if($category != null){
                $products = ShopProduct::where(['user_id'=>Auth::user()->id],['category_id'=>$category])->paginate(32);
            }elseif($subcategory != null){
                $products = ShopProduct::where(['user_id'=>Auth::user()->id],['subcategory_id'=>$subcategory])->paginate(32);
            }elseif($brand != null){
                $products = ShopProduct::where(['user_id'=>Auth::user()->id],['brand'=>$brand])->paginate(32);
            }

        }
        $prods = '<div>';
        if (!empty($products)) {
            foreach ($products as $product) {
                if(Auth::user()->user_role == 1){
                    $imgPath = 'stock/assets/uploads/thumbs/';
                    $imageName = $product->image;
                }else{
                    $imgPath = 'images/thumbnails/shop/';
                    $firstImage = Thumbnails::where('product_id',$product->id)->first();
                    $imageName = isset($firstImage->image)?$firstImage->image:$product->image;
                }

                $prods .= '<button id="product-' . $product->code . "\" type=\"button\" value='" . $product->code . "' title=\"" . $product->name . '" class="btn-prni btn-default' . ' product pos-tip" data-container="body"><img src="' . asset($imgPath). '/' . $imageName . '" alt="' . $product->name . "\" class='img-rounded' /><span>" . $product->name . '</span></button>';

            }
        }
        $prods .= '</div>';

        return $prods;
    }
    public function updatePosSaleTmp(Request $request){
        $data = $request->all();
        if($data['status'] == 'remove'){
            PosSaleTmp::where(['product_id'=>$data['id']],['user_id'=>Auth::user()->id])->delete();
        }elseif($data['status'] == 'update'){
            $update = PosSaleTmp::where(['product_id'=>$data['id']],['user_id'=>Auth::user()->id])->first();
            $update->update(['qty'=>$data['qty']]);
        }elseif($data['status'] == 'cancel'){
            PosSaleTmp::where('user_id',Auth::user()->id)->delete();
        }
    }
    public function admin_update_own_shop(Request $request){
        $data = $request->all();
        $validator = Validator::make($request->all(),
                ['shop_name'=> 'required',
                 'shop_email' => 'required',
                    'phone' => 'required',
                    'address' => 'required',
                    'website' => 'required',

                ]);
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
        $update = PageShops::where('user_id',1)->first();
        $update->update($data);
        flash()->info('Admin shop update successfully');
        return redirect('dashboard');
    }
    public function list_search_keyword(){
        $searchKeywords = SearchKeyword::get();
        return view('pages.admin_list_search_keyword',compact('searchKeywords'));
    }
    public function add_search_keyword(){
        $categories = Category::where('parent_id',0)->pluck('name','id');
        return view('pages.admin_add_search_keyword',compact('categories'));
    }
    public function save_search_keyword(Request $request){
        $data= $request->all();
        if($data['type'] == 1){
            $validator = Validator::make($request->all(),
                ['type'=>'required',
                    'keyword'=> 'required',
                ]);
        }else{
            $validator = Validator::make($request->all(),
                ['type'=>'required',
                    'keyword'=> 'required',
                    'link_to'=>'required',
                ]);
        }

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        SearchKeyword::create($data);
        flash()->success('Search Keyword add successfully');
        return redirect('admin_search_keyword');

    }
    public function delete_search_keyword($keywordId){
        SearchKeyword::find($keywordId)->delete();
        flash()->error('Search Keyword deleted');
        return redirect('admin_search_keyword');
    }
    public function edit_search_keyword($keywordId){
        $searchKeyword = SearchKeyword::find($keywordId);
        $categories = Category::where('parent_id',0)->pluck('name','id');
        return view('pages.admin_add_search_keyword',compact('searchKeyword','categories'));
    }
    public function update_search_keyword(Request $request,$keywordId){
        $data= $request->all();
        if($data['type'] == 1){
            $validator = Validator::make($request->all(),
                ['type'=>'required',
                    'keyword'=> 'required',
                ]);
        }else{
            $validator = Validator::make($request->all(),
                ['type'=>'required',
                    'keyword'=> 'required',
                    'link_to'=>'required',
                ]);
        }
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $searchKeyword = SearchKeyword::find($keywordId);
        $searchKeyword->update($data);

        SearchKeyword::where('label_promo','!=','')->update(['label_promo' => $data['label_promo']]);
        flash()->info('Search Keyword update successfully');
        return redirect('admin_search_keyword');
    }
    public function get_product($categoryID){
        $Products = Product::where('category_id',$categoryID)->get();
//        print_r($SubCategory);
        $data='';
        foreach ($Products as $key=>$product){
            if($key == 0){
                $data .='<option value="">'.'Select any product code...'.'</option>';
            }
            $data .= "<option value='".$product->id."'>".$product->code."</option>";
        }

        return $data;
    }
    public function get_product_detail_pop_up($proID){
        $productPopUp = Product::
        join('sma_categories','sma_products.category_id','=','sma_categories.id')
            ->select('sma_products.*','sma_categories.name as c_name')
            ->where('sma_products.id',$proID)->first();
        $brand = Brand::pluck('name','id');
        $unit = Unit::pluck('name','id');
        $subCategory = Category::pluck('name','id');
        $productVariants = ProductVariants::where('product_id',$proID)->get();
        $warehouseProductVariants = ProductVariants::
        join('sma_warehouses_products_variants','sma_product_variants.product_id','=','sma_warehouses_products_variants.product_id')
            ->select('sma_product_variants.*','sma_warehouses_products_variants.warehouse_id')
            ->where('sma_product_variants.product_id',$proID)
            ->where('sma_product_variants.quantity','>',0)
            ->where('sma_warehouses_products_variants.quantity','>',0)
            ->get();
        $warehouse = Warehouses::pluck('name','id');
        $warehouseQuantity = WarehouseProducts::where('product_id',$proID)
            ->where('quantity','>',0)->get();

        $productImages = ProductThumnail::where('product_id',$proID)->get();
        return view('pages.admin_product_detail_popUp',compact('productPopUp','unit','subCategory','productVariants','brand','warehouseProductVariants','warehouse','warehouseQuantity','productImages'));
    }
    public function get_product_image_pop_up($proID){
        $product = Product::where('id',$proID)->first();
        return view('pages.admin_product_image_popUp',compact('product'));
    }
    public function product(){
        $products = Product::
        join('sma_categories','sma_products.category_id','=','sma_categories.id')
            ->select('sma_products.*','sma_categories.name as c_name')
            ->get();
            /*where('sma_products.featured','!=',Null)->
        get();*/

        return view('pages.admin_product',compact('products'));
    }
    public function print_label_form(Request $request){
        $data = $request->all();
        $_products = Product::
        join('sma_categories','sma_products.category_id','=','sma_categories.id')
            ->select('sma_products.*','sma_categories.name as c_name');

        $q['sma_products.name'] = $request->input('name','');
        $q['category_id'] = $request->input('category','');
        $q['brand'] = $request->input('brand','');
        $width = $request->input('width');
        $height = $request->input('height');
        $image = $request->input('image');
        foreach ($q as $k=>$v)
        {
            $this->k = $k;
            $this->searchWords = preg_split('/\s+/', $v);// explode(' ', $v);
            $_products->where(function($w) {
                foreach($this->searchWords as $word){
                    if(trim($word) != '') {
                        if($this->k == 'sma_products.name'){
                            $w->orWhere($this->k ,'LIKE','%'.$word.'%');
                        }else{
                            $w->orWhere($this->k ,$word);
                        }

                    }
                }

            });
        }
        $products = $_products->get();

        $category = Category::where('parent_id',0)->pluck('name','id');
        $brand = Brand::pluck('name','id');
        return view('pages.admin_print_label_form',compact('category','brand','products','q','width','height','image'));
    }
    public function print_label(Request $request){
        $data = $request->all();
        $_products = Product::orderBy('id','ASC');
        $width = $request->input('width','');
        $height = $request->input('height','');
        $image = $request->input('image','');
        $q['id'] = $request->input('id','');
        $q['name'] = $request->input('name','');
        $q['category_id'] = $request->input('category','');
        $q['brand'] = $request->input('brand','');

        foreach ($q as $k=>$v)
        {
            $this->k = $k;
            $this->searchWords = preg_split('/\s+/', $v);// explode(' ', $v);
            $_products->where(function($w) {
                foreach($this->searchWords as $word){
                    if(trim($word) != '') {
                        if($this->k == 'name'){
                            $w->orWhere($this->k ,'LIKE','%'.$word.'%');
                        }else{
                            $w->orWhere($this->k ,$word);
                        }

                    }
                }

            });
        }
        $products = $_products->get();
        return view('pages.admin_print_label',compact('products','width','height','image'));
    }
    public function admin_promotion(){
        $promotions = AdminPromotion::get();
        return view('pages.admin_promotion_list',compact('promotions'));
    }
    public function admin_add_promotion(){
        return view('pages.admin_add_promotion');
    }
    public function admin_save_promotion(Request $request){
        $data= $request->all();
        $validator = Validator::make($request->all(),
            ['name'=> 'required',
//                'value'=> 'required',
//                'value_type'=>'required',
                'started_date'=>'required',
                'finished_date'=>'required',
                'image' =>'required'
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        $file = $request->file('image');
        $image = Image::make($request->file('image'))->resize(183, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $destinationPath = 'images/'; // upload path
        $extension = $request->file('image')->getClientOriginalExtension(); // getting file extension
        $fileName = 'promotion'.rand(10,1000). '.' . $extension; // renameing image

        if ($extension == 'gif') {
            copy($file->getRealPath(), $destinationPath.$fileName);
        }
        else {
            $image->save($destinationPath. $fileName);
        }
//        $image->save($destinationPath. $fileName); // uploading file to given path
        $data['image'] = $fileName;

        $imageDetail = Image::make($request->file('image_detail'))->resize(470, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $destinationPath = 'images/'; // upload path
        $extension = $request->file('image')->getClientOriginalExtension(); // getting file extension
        $fileName = 'promotion'.rand(10,1000). '.' . $extension; // renameing image
        $imageDetail->save($destinationPath. $fileName); // uploading file to given path
        $data['image_detail'] = $fileName;
        AdminPromotion::create($data);

        flash()->success('Admin Promotion save successfully');
        return redirect('admin_promotion');

    }
    public function edit_promotion($promotionId){
        $promotion = AdminPromotion::find($promotionId);
        return view('pages.admin_add_promotion',compact('promotion'));
    }
    public function update_promotion(Request $request,$promotionId){
        $data= $request->all();
        $validator = Validator::make($request->all(),
            ['name'=> 'required',
//                'value'=> 'required',
//                'value_type'=>'required',
                'started_date'=>'required',
                'finished_date'=>'required',
//                'image' =>'required'
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        $promotion = AdminPromotion::find($promotionId);
        $file = $request->file('image');
        if(isset($file)){
            $image = Image::make($request->file('image'))->resize(183, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $destinationPath = 'images/'; // upload path
            $extension = $request->file('image')->getClientOriginalExtension(); // getting file extension
            $fileName = 'promotion'.rand(10,1000). '.' . $extension; // renameing image
            $image->save($destinationPath. $fileName); // uploading file to given path
            if ($extension == 'gif') {
                copy($file->getRealPath(), $destinationPath.$fileName);
            }
            else {
                $image->save($destinationPath. $fileName);
            }
            $data['image'] = $fileName;
        }else{
            $data['image'] = $promotion->image;
        }

        if(isset($data['image_detail'])){
            $imageDetail = Image::make($request->file('image_detail'))->resize(470, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $destinationPath = 'images/'; // upload path
            $extension = $request->file('image_detail')->getClientOriginalExtension(); // getting file extension
            $fileName = 'promotion'.rand(10,1000). '.' . $extension; // renameing image
            $imageDetail->save($destinationPath. $fileName); // uploading file to given path
            $data['image_detail'] = $fileName;
        }else{
            $data['image_detail'] = $promotion->image_detail;
        }




        $promotion->update($data);

        flash()->info('Promotion update successfully');
        return redirect('admin_promotion');
    }
    public function delete_promotion($promotionId){
        $promotion = AdminPromotion::find($promotionId);
        $promotion->delete();

        flash()->error('Promotion has been deleted');
        return redirect('admin_promotion');
    }
    public function payment_list(){
        $paymentLists = ProductOrder::join('users','product_orders.user_id','=','users.id')
            ->select('product_orders.*','users.first_name','users.last_name','users.phone as order_phone','users.address as order_address')
            ->where('product_orders.order_status',1)
            ->get();

        return view('pages.admin_payment_list',compact('paymentLists'));
    }
    public function payment_update(Request $request,$orderId){
        $getPayment = ProductOrder::findorfail($orderId);
        if($getPayment){
            $getPayment->update(['payment_status'=>1]);

            flash()->info('OrderID = '.$getPayment->id.' got confirm');
        }else{
            flash()->error('Payment Confirm fails');
        }
        return redirect('admin_payment_list');
    }
    public function invoice_detail($orderId){
        $order = ProductOrder::with('ProductOrderDetail')->find($orderId);
        return view('pages.admin_invoice_detail',compact('order'));
    }
    public function payment_method_detail($orderId){
        $paymentInfo = PaymentInfo::where('order_id',$orderId)->first();
        return view('pages.admin_payment_detail',compact('paymentInfo'));
    }
    public function payment_delete($orderId){
        $order = ProductOrder::with('ProductOrderDetail')->find($orderId);


        if($order){
            $order->delete();
            $order->ProductOrderDetail()->delete();
            flash()->error('Payment & Order No : '.$order->id.' deleted');
            return redirect('admin_payment_list');
        }else{
            return redirect()->back();
        }
    }
    public function payment_print($orderId){
        $order = ProductOrder::with('ProductOrderDetail')->find($orderId);
        return view('pages.admin_invoice_print',compact('order'));
    }

    public function payment_method(){
        $paymentMethods = PaymentMethod::get();

        return view('pages.admin_payment_method',compact('paymentMethods'));
    }
    public function add_payment_method(){
        return view('pages.admin_add_payment_method');
    }
    public function save_payment_method(Request $request){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['name'=> 'required',
             'logo' =>'required',
                'account_number'=>'required'
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $file = $request->file('logo');
        if(isset($file)){
            $image = Image::make($request->file('logo'))->resize(26, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $destinationPath = 'images/payment/'; // upload path
            $extension = $request->file('logo')->getClientOriginalExtension(); // getting file extension
            $fileName = rand(10,1000). '.' . $extension; // renameing image
            $image->save($destinationPath. $fileName); // uploading file to given path
            if ($extension == 'gif') {
                copy($file->getRealPath(), $destinationPath.$fileName);
            }
            else {
                $image->save($destinationPath. $fileName);
            }
            $data['logo'] = $fileName;
        }

        $paymentSave = PaymentMethod::create($data);
        flash()->success('Payment Method added');
        return redirect('admin_payment_method');
    }
    public function edit_payment_method($paymentId){
        $paymentMethod = PaymentMethod::find($paymentId);
        return view('pages.admin_add_payment_method',compact('paymentMethod'));
    }
    public function update_payment_method(Request $request,$paymentId){
        $data = $request->all();
        $paymentMethod = PaymentMethod::find($paymentId);
        $validator = Validator::make($request->all(),
            ['name'=> 'required',
             'account_number'=>'required'
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        $file = $request->file('logo');
        if(isset($file)){
            $image = Image::make($request->file('logo'))->resize(26, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $destinationPath = 'images/payment/'; // upload path
            $extension = $request->file('logo')->getClientOriginalExtension(); // getting file extension
            $fileName = rand(10,1000). '.' . $extension; // renameing image
            $image->save($destinationPath. $fileName); // uploading file to given path
            if ($extension == 'gif') {
                copy($file->getRealPath(), $destinationPath.$fileName);
            }
            else {
                $image->save($destinationPath. $fileName);
            }
            $data['logo'] = $fileName;
        }else{
            $data['logo'] = $paymentMethod->logo;
        }

        $paymentMethod->update($data);
        flash()->info('Payment Method updated');

        return redirect('admin_payment_method');
    }
    public function delete_payment_method($paymentId){
        $paymentMethod = PaymentMethod::find($paymentId);
        if(File::exists("images/payment/$paymentMethod->logo")) File::delete("images/payment/$paymentMethod->logo");
        $paymentMethod->delete();

        flash()->error('Payment Method deleted');
        if($paymentMethod){
            return redirect('admin_payment_method');
        }
    }
    public function status_payment_method($paymentId){
        $paymentMethod = PaymentMethod::find($paymentId);
        if($paymentMethod->status == 0){
            $paymentMethod->update(['status'=>1]);
            flash()->info('Payment Method disabled');
        }else{
            $paymentMethod->update(['status'=>0]);
            flash()->info('Payment Method enable');
        }
        return redirect('admin_payment_method');
    }

    public function product_order(){

        return view('pages.admin_product_order');
    }
    public function supplier_supply(){
        return view('pages.admin_supplier_supply');
    }
    public function order_status(){
        $orderStatuses = OrderStatus::get();
        return view('pages.admin_order_status',compact('orderStatuses'));
    }
    public function edit_order_status($statusId){
        $order = OrderStatus::findorfail($statusId);
        return view('pages.edit_order_status',compact('order'));
    }
    public function update_order_status(Request $request,$statusId){
        $order = OrderStatus::findorfail($statusId);
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['status'=> 'required',
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $order->update($data);
        return redirect('admin_order_status');
    }
    public function add_product(){
        $category = Category::where('parent_id',0)->pluck('name','id');
        $subcategory = [];
        $brand = Brand::pluck('name','id');
        $units = Unit::get();
        return view('pages.add_product',compact('category','subcategory','brand','units'));
    }
    public function save_product(Request $request){
        $data= $request->all();
        $validator = Validator::make($request->all(),
            ['name'=> 'required',
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if (isset($data['image'])) {
            $image = Image::make($data['image'])->resize(225,225);
            $imageThumbs = Image::make($data['image'])->resize(60,60);
            $imageName = 'Pro_'.$data['code']. '.' . $data['image']->getClientOriginalExtension();
            $destinationPath = 'stock/assets/uploads/';
            $destinationPathThumbs ='stock/assets/uploads/thumbs/';
            $image->save($destinationPath. $imageName);
            $imageThumbs->save($destinationPathThumbs.$imageName);
            $data['image'] = $imageName;
        }
        $saveProduct = new Product();
        $saveProduct->timestamps = false;
        $saveProduct->name = $data['name'];
        $saveProduct->code = $data['code'];
        $saveProduct->slug = $data['slug'];
        $saveProduct->second_name = $data['second_name'];
        $saveProduct->barcode_symbology = $data['barcode_symbology'];
        $saveProduct->cost = $data['cost'];
        $saveProduct->price = $data['price'];
        $saveProduct->category_id = $data['category_id'];
        $saveProduct->subcategory_id = $data['subcategory_id'];
        $saveProduct->brand = $data['brand'];
        $saveProduct->unit = $data['unit'];
        $saveProduct->sale_unit = $data['sale_unit'];
        $saveProduct->purchase_unit = $data['purchase_unit'];
        $saveProduct->weight = $data['weight'];
        $saveProduct->alert_quantity = $data['alert_quantity'];
        $saveProduct->details = $data['details'];
        $saveProduct->product_details = $data['product_details'];
        $saveProduct->cf1 = $data['cf1'];
        $saveProduct->cf2 = $data['cf2'];
        $saveProduct->cf3 = $data['cf3'];
        $saveProduct->cf4 = $data['cf4'];
        $saveProduct->cf5 = $data['cf5'];
        $saveProduct->cf6 = $data['cf6'];
        if(isset($data['featured'])){
            $saveProduct->featured = $data['featured'];
        }
        if(isset($data['hide'])){
            $saveProduct->hide = $data['hide'];
        }
        if(isset($data['hide_pos'])){
            $saveProduct->hide_pos = $data['hide_pos'];
        }
        if(isset($data['image'])){
            $saveProduct->image =$data['image'];
        }
        $saveProduct->save();
        if($saveProduct){
            ProductThumnail::where('product_id',0)
                ->update(['product_id'=>$saveProduct->id]);
        }
        flash()->success('Product Save successfully');
        return redirect('admin_product');
    }
    public function edit_product($id){
        $product = Product::Find($id);
        $category = Category::where('parent_id',0)->pluck('name','id');
        $subcategory = Category::where('id',$product->subcategory_id)->first();
        $thumbnails = ProductThumnail::where('product_id',$id)->get();
        $brand = Brand::pluck('name','id');
        $units = Unit::get();
        return view('pages.edit_product',compact('product','category','subcategory','thumbnails','brand','units'));
    }
    public function update_product(Request $request,$id){
        $data= $request->all();
        $validator = Validator::make($request->all(),
            ['name'=> 'required',
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if (isset($data['image'])) {
            $image = Image::make($data['image'])->resize(225,225);
            $imageThumbs = Image::make($data['image'])->resize(60,60);
            $imageName = 'P_'.$id. '.' . $data['image']->getClientOriginalExtension();
            $destinationPath = 'stock/assets/uploads/';
            $destinationPathThumbs ='stock/assets/uploads/thumbs/';
            $image->save($destinationPath. $imageName);
            $imageThumbs->save($destinationPathThumbs.$imageName);
            $data['image'] = $imageName;
        }
        $update = Product::find($id);
        $update->timestamps = false;
        $update->name = $data['name'];
        $update->code = $data['code'];
        $update->slug = $data['slug'];
        $update->second_name = $data['second_name'];
        $update->barcode_symbology = $data['barcode_symbology'];
        $update->cost = $data['cost'];
        $update->price = $data['price'];
        $update->category_id = $data['category_id'];
        $update->subcategory_id = $data['subcategory_id'];
        $update->brand = $data['brand'];
        $update->unit = $data['unit'];
        $update->sale_unit = $data['sale_unit'];
        $update->purchase_unit = $data['purchase_unit'];
        $update->weight = $data['weight'];
        $update->quantity = $data['quantity'];
        $update->alert_quantity = $data['alert_quantity'];
        $update->details = $data['details'];
        $update->product_details = $data['product_details'];
        $update->cf1 = $data['cf1'];
        $update->cf2 = $data['cf2'];
        $update->cf3 = $data['cf3'];
        $update->cf4 = $data['cf4'];
        $update->cf5 = $data['cf5'];
        $update->cf6 = $data['cf6'];
        if(isset($data['featured'])){
            $update->featured = $data['featured'];
        }
        if(isset($data['hide'])){
            $update->hide = $data['hide'];
        }
        if(isset($data['hide_pos'])){
            $update->hide_pos = $data['hide_pos'];
        }
        if(isset($data['image'])){
            $update->image =$data['image'];
        }
        $update->save();
        flash()->success('Product Update successfully');
        return redirect('admin_product');
    }
    public function uploadThumbnails($id,Request $request){
        $input = $request->all();

//        $imageName = 'P_'.$id. '.' . rand(11111, 99999)->getClientOriginalExtension();
//        $image->save('images/thumbnails' . $imageName);
        $image = Image::make($request->file('file'))->resize(85, 84);
        $destinationPath = 'images/thumbnails/'; // upload path
        $extension = $request->file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = 'P_'.$id. '_' . rand(11111, 99999) . '.' . $extension; // renameing image
        $upload_success = $image->save($destinationPath. $fileName); // uploading file to given path

        if ($upload_success) {
            $thumbnails = new Thumbnails;
            $thumbnails->image = $fileName;
            $thumbnails->product_id = $id;
            $thumbnails->save();
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }
    public function adminUploadThumbnails($id,Request $request){
        $input = $request->all();


        $image = Image::make($request->file('file'))->resize(70, 70);
        $imageBig = Image::make($request->file('file'))->resize(900,900);
        $destinationPath = 'stock/assets/uploads/thumbs/'; // upload path
        $destinationPathBig = 'stock/assets/uploads/';
        $extension = $request->file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = 'Pro_admin_'.$id. '_' . rand(11111, 99999) . '.' . $extension; // renameing image
        $upload_success = $image->save($destinationPath. $fileName); // uploading file to given path
        $uploadBig = $imageBig->save($destinationPathBig.$fileName);
        if ($upload_success) {
            $thumbnails = new ProductThumnail;
            $thumbnails->timestamps = false;
            $thumbnails->photo = $fileName;
            $thumbnails->product_id = $id;
            $thumbnails->save();
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }
    public function delete_thumbnail($id){
        $delete = ProductThumnail::find($id);
        $imgName = $delete->photo;
        if(File::exists("stock/assets/uploads/thumbs/$imgName")) File::delete("stock/assets/uploads/thumbs/$imgName");
        $delete->delete();

    }
    public function category(){
//        $categories = Category::join('sma_subcategories','sma_categories.id','=','sma_subcategories.category_id')
//            ->select('sma_categories.*','sma_subcategories.name as sub_name','sma_subcategories.image as sub_image')
//            ->get();
        $categories = Category::where('parent_id',0)->get();
        return view('pages.admin_category',compact('categories'));
    }
    public function add_category(){
        return view('pages.add_category');
    }
    public function edit_category($id){
        $category = Category::Findorfail($id);
        return view('pages.edit_category',compact('category'));
    }
    public function update_category(Request $request,$id){
        $data= $request->all();
        $validator = Validator::make($request->all(),
            ['code'=> 'required',
                'name'=> 'required',
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if (isset($data['image'])) {
            $image = Image::make($data['image'])->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();});
            $imageName = 'C_'.$data['code']. '.' . $data['image']->getClientOriginalExtension();
            $image->save('images/' . $imageName);
            $data['image'] = $imageName;
        }
        if (isset($data['image_mobile'])) {
            $imageMobile = Image::make($data['image_mobile'])->resize(60, null, function ($constraint) {
                $constraint->aspectRatio();});
            $imageNameMobile = 'MC_'.$data['code']. '.' . $data['image_mobile']->getClientOriginalExtension();
            $imageMobile->save('images/' . $imageNameMobile);
            $data['image_mobile'] = $imageNameMobile;
        }
        $update = Category::find($id);
        $update->timestamps = false;
        $update->code = $data['code'];
        $update->name = $data['name'];
        if(isset($data['image'])){
            $update->image =$data['image'];
        }
        if(isset($data['image_mobile'])){
            $update->image_mobile =$data['image_mobile'];
        }
        $update->save();
        flash()->info('Category has been updated');
        return redirect('admin_categories');
    }

    public function pop_up_banner(){
        $popUps = PopUpBanner::get();
        return view('pages.admin_pop_up_banner',compact('popUps'));
    }
    public function add_pop_up(){
        return view('pages.add_pop_up_banner');
    }
    public function save_pop_up(Request $request){
        $data= $request->all();
        $validator = Validator::make($request->all(),
            [
                'image' =>'required'
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if(isset($data['image'])){
            $imageDetail = Image::make($request->file('image'))->resize(570, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $destinationPath = 'images/pop_up/'; // upload path
            $extension = $request->file('image')->getClientOriginalExtension(); // getting file extension
            $fileName = 'pop_up'.rand(10,1000). '.' . $extension; // renameing image
            $imageDetail->save($destinationPath. $fileName); // uploading file to given path
            $data['image'] = $fileName;
        }

        PopUpBanner::create($data);
        flash()->success('Pop Up added successfully');
        return redirect('admin_pop_up_banner');
    }
    public function edit_pop_up($popUpId){
        $popUp = PopUpBanner::findorfail($popUpId);
        return view('pages.add_pop_up_banner',compact('popUp'));
    }
    public function update_pop_up(Request $request, $popUpId){
        $data= $request->all();
        $popUp = PopUpBanner::findorfail($popUpId);

        if(isset($data['image'])){
            $imageDetail = Image::make($request->file('image'))->resize(570, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $destinationPath = 'images/pop_up/'; // upload path
            $extension = $request->file('image')->getClientOriginalExtension(); // getting file extension
            $fileName = 'pop_up'.rand(10,1000). '.' . $extension; // renameing image
            $imageDetail->save($destinationPath. $fileName); // uploading file to given path
            $data['image'] = $fileName;
        }else{
            $data['image'] = $popUp->image;
        }

        $popUp->update($data);

        flash()->info('Pop Up updated success');
        return redirect('admin_pop_up_banner');

    }
    public function delete_pop_up($popUpId){
        $popUp = PopUpBanner::findorfail($popUpId);
        if(File::exists("images/pop_up/$popUp->image")) File::delete("images/pop_up/$popUp->image");
        $popUp->delete();

        flash()->error('Pop Up Deleted');
        return redirect('admin_pop_up_banner');


    }
    public function update_status_pop_up($id){
        $get_pop_up = PopUpBanner::find($id);
        if($get_pop_up->status == 0){
            $get_pop_up->update(['status'=>1]);
            flash()->error('Pop Up show has been disable');
        }else{
            $get_pop_up->update(['status'=>0]);
            flash()->error('Pop Up show has been enable');
        }
        return redirect('admin_pop_up_banner');
    }

    public function subcategory(){
        $subcategories = Category::where('parent_id','>',0)
            ->get();
        $categories = Category::where('parent_id',0)->pluck('name','id');
        return view('pages.admin_subcategory',compact('subcategories','categories'));
    }
    public function edit_subcategory($id){
        $subcategory = Category::find($id);
        return view('pages.edit_subcategory',compact('subcategory'));
    }
    public function update_subcategory(Request $request, $id){
        $data= $request->all();
        $validator = Validator::make($request->all(),
            ['code'=> 'required',
                'name'=> 'required',
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if (isset($data['logo'])) {
            $image = Image::make($data['logo'])->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();});
            $imageName = 'Sub_'.$data['code']. '.' . $data['logo']->getClientOriginalExtension();
            $image->save('images/category/' . $imageName);

            $imageSmall = Image::make($data['logo'])->resize(60,null,function ($constraint){
                $constraint->aspectRatio();
            });
            $imageNameSmall = 'Sub_'.$data['code']. '.' . $data['logo']->getClientOriginalExtension();
            $imageSmall->save('images/category/sub-small/'.$imageNameSmall);
            $data['logo'] = $imageName;
        }
        $update = Category::find($id);
        $update->timestamps = false;
        $update->code = $data['code'];
        $update->name = $data['name'];
        if(isset($data['logo'])){
        $update->logo =$data['logo'];
        }
        $update->save();
        flash()->info('Subcategory updated successfully');
        return redirect('admin_subcategories');
    }

    public function slide_promotion(){
        $slides = Slide::get();
//        join('sma_products','slide_promotion.product_id','=','sma_products.id')
//            ->select('slide_promotion.*','sma_products.code')
//            ->where('slide_promotion.status',0)
//            ->get();
        $product = Product::pluck('code','id');
        return view('pages.admin_slide_promotion',compact('slides','product'));
    }
    public function add_slide(){
        $product_code = Product::orderBy('id','desc')->pluck('code','id');
        return view('pages.add_slide',compact('product_code'));
    }
    public function save_slide(Request $request){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['image'=> 'required',
                'type'=>'required'
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        $file = $request->file('image');
        if($data['type'] == 1){
            $image = Image::make($request->file('image'))->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
        }else{
            $image = Image::make($request->file('image'))->resize(null, 437, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $destinationPath = 'images/home/'; // upload path
        $extension = $request->file('image')->getClientOriginalExtension(); // getting file extension
        if(empty($data['product_id'])){
            $fileName = 'Slide_'.rand(10,1000). '.' . $extension; // renameing image
        }else{
            $fileName = 'Slide_'.$data['product_id']. '.' . $extension; // renameing image
        }
        if ($extension == 'gif') {
            copy($file->getRealPath(), $destinationPath.$fileName);
        }
        else {
            $image->save($destinationPath. $fileName);
        }

        $width = $image->width();
        $height = $image->height();
        $image->destroy();
//        $upload_success = $image->save($destinationPath. $fileName); // uploading file to given path


        $slide = new Slide;
        $slide->product_id = $data['product_id'];
        $slide->type = $data['type'];
        $slide->image = $fileName;
        $slide->external_link = $data['external_link'];
        if(isset($data['open_new_tab'])){
            $slide->open_new_tab = $data['open_new_tab'];
        }else{
            $slide->open_new_tab = 0;
        }
        $slide->save();
        flash()->success('Slide Promotion add successfully');
        return redirect('admin_promotion_slide');
    }
    public function update_status_slide($id){
        $get_slide = Slide::find($id);
        if($get_slide->status == 0){
            $get_slide->update(['status'=>1]);
            flash()->error('Slide show has been disable');
        }else{
            $get_slide->update(['status'=>0]);
            flash()->error('Slide show has been enable');
        }
        return redirect('admin_promotion_slide');
    }
    public function delete_slide($id){
        $get_slide = Slide::find($id);
        if(File::exists("images/home/$get_slide->image")) File::delete("images/home/$get_slide->image");
        $get_slide->delete();
        flash()->error('Slide show has been deleted');
        return redirect('admin_promotion_slide');
    }
    public function edit_slide($id){
        $product_code = Product::orderBy('id','desc')->pluck('code','id');
        $slide = Slide::find($id);
        return view('pages.edit_slide',compact('slide','product_code'));
    }
    public function update_slide(Request $request,$id){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['type'=> 'required'
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if(isset($data['image'])){
            $file = $request->file('image');
            if($data['type'] == 1){
                $image = Image::make($request->file('image'))->resize(null, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }else{
                $image = Image::make($request->file('image'))->resize(null, 437, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            $destinationPath = 'images/home/'; // upload path
            $extension = $request->file('image')->getClientOriginalExtension(); // getting file extension
            if(empty($data['product_id'])){
                $fileName = 'Slide_'.rand(10,1000). '.' . $extension; // renameing image
            }else{
                $fileName = 'Slide_'.$data['product_id']. '.' . $extension; // renameing image
            }

            if ($extension == 'gif') {
                copy($file->getRealPath(), $destinationPath.$fileName);
            }
            else {
                $image->save($destinationPath. $fileName);
            }

            $width = $image->width();
            $height = $image->height();
            $image->destroy();
//            $upload_success = $image->save($destinationPath. $fileName); // uploading file to given path
        }
        $slide = Slide::find($id);
        $slide->product_id = $data['product_id'];
        $slide->type = $data['type'];
        if(isset($data['image'])){
            $slide->image = $fileName;
        }
        $slide->external_link = $data['external_link'];
        if(isset($data['open_new_tab'])){
            $slide->open_new_tab = $data['open_new_tab'];
        }else{
            $slide->open_new_tab = 0;
        }
        $slide->save();
        flash()->success('Slide Promotion update successfully');
        return redirect('admin_promotion_slide');
    }

    public function category_slide(){
        $CategorySlide = CategorySlide::
        join('sma_categories','category_slides.category_id','=','sma_categories.id')
            ->select('category_slides.*','sma_categories.name')
            ->get();
        return view('pages.admin_category_slide',compact('CategorySlide'));
    }
    public function banner_link_mobile(){
        $banner = CategorySlide::where('slide_type',16)->first();
        return view('pages.admin_banner_link_mobile',compact('banner'));
    }
    public function add_banner_link_mobile(){
        return view('pages.add_banner_link_mobile');
    }
    public function save_banner_link_mobile(Request $request){
        $data = $request->all();
            $validator = Validator::make($request->all(),
                [
                    'url'=> 'required',
                ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        $file = $request->file('image_header_horizontal');
        $image = Image::make($request->file('image_header_horizontal'))->resize(null, 150, function ($constraint) {
            $constraint->aspectRatio();
        });
        $extension = $request->file('image_header_horizontal')->getClientOriginalExtension(); // getting file extension
        $destinationPath = 'images/home/'; // upload path
        $fileName = 'banner_link_mobile_'.rand(10,1000).'.'.$extension; // renameing image

        if ($extension == 'gif') {
            copy($file->getRealPath(), $destinationPath.$fileName);
        }
        else {
            $image->save($destinationPath. $fileName);
        }

        $width = $image->width();
        $height = $image->height();
        $image->destroy();
//        $upload_success = $image->save($destinationPath. $fileName); // uploading file to given path


        $slide = new CategorySlide;
        $slide->slide_type = 16;
        $slide->image = $fileName;
        $slide->url=$data['url'];
        if(isset($data['open_new_tab'])){
            $slide->open_new_tab = $data['open_new_tab'];
        }else{
            $slide->open_new_tab = 0;
        }
        $slide->save();
        flash()->success('Banner for mobile link add successfully');
        return redirect('admin_top_banner_mobile');
    }
    public function edit_banner_link_mobile($id){
        $bannerMobile = CategorySlide::find($id);
        return view('pages.edit_banner_link_mobile',compact('bannerMobile'));
    }
    public function update_banner_link_mobile(Request $request,$id){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            [
                'url'=> 'required',
            ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if(isset($data['image_header_horizontal'])){
            $file = $request->file('image_header_horizontal');
            $image = Image::make($request->file('image_header_horizontal'))->resize(null, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $extension = $request->file('image_header_horizontal')->getClientOriginalExtension(); // getting file extension
            $destinationPath = 'images/home/'; // upload path
            $fileName = 'banner_link_mobile_'.rand(10,1000).$extension; // renameing image
            if ($extension == 'gif') {
                copy($file->getRealPath(), $destinationPath.$fileName);
            }
            else {
                $image->save($destinationPath. $fileName);
            }

            $width = $image->width();
            $height = $image->height();
            $image->destroy();
//            $upload_success = $image->save($destinationPath. $fileName); // uploading file to given path
        }
        $slide = CategorySlide::find($id);
        $slide->slide_type = 16;
        if(isset($fileName)){
            $slide->image = $fileName;
        }
        $slide->url=$data['url'];
        if(isset($data['open_new_tab'])){
            $slide->open_new_tab = $data['open_new_tab'];
        }else{
            $slide->open_new_tab = 0;
        }
        $slide->save();
        flash()->success('Banner for mobile link update successfully');
        return redirect('admin_top_banner_mobile');
    }
    public function add_category_slide(){
        $product_code = [];
        $CategoryName = Category::where('parent_id',0)->orderBy('id','desc')->pluck('name','id');
        return view('pages.add_category_slide',compact('CategoryName','product_code'));
    }
    public function save_category_slide(Request $request){
        $data = $request->all();
        if($data['slide_type'] == 1){
            $validator = Validator::make($request->all(),
                [
                    'category_id'=> 'required',
                    'slide_type'=>'required',
//                    'product_id'=>'required',
                    'image_vertical'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 2){
            $validator = Validator::make($request->all(),
                [
//                    'category_id'=> 'required',
                    'slide_type'=>'required',
//                    'product_id'=>'required',
                    'image'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 4){
            $validator = Validator::make($request->all(),
                ['category_id'=> 'required',
                    'slide_type'=>'required',
//                    'product_id'=>'required',
                    'image_header_horizontal'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 5){
            $validator = Validator::make($request->all(),
                ['category_id'=> 'required',
                    'slide_type'=>'required',
//                    'product_id'=>'required',
                    'image_ads_left'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 6){
            $validator = Validator::make($request->all(),
                ['category_id'=> 'required',
                    'slide_type'=>'required',
//                    'product_id'=>'required',
                    'footer_image'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 7){
            $validator = Validator::make($request->all(),
                ['category_id'=> 'required',
                    'slide_type'=>'required',
//                    'product_id'=>'required',
                    'product_banner'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 8){
            $validator = Validator::make($request->all(),
                [
                    'category_id'=> 'required',
                    'slide_type'=>'required',
                    'brand_zone_banner'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 9){
            $validator = Validator::make($request->all(),
                [
                    'category_id'=> 'required',
                    'slide_type'=>'required',
                    'brand_zone_banner_haft'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 10){
            $validator = Validator::make($request->all(),
                [
                    'category_id'=> 'required',
                    'slide_type'=>'required',
                    'beauty_banner'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 11){
            $validator = Validator::make($request->all(),
                [
                    'slide_type'=>'required',
                    'banner_special_page'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 12){
            $validator = Validator::make($request->all(),
                [
                    'slide_type'=>'required',
                    'horizontal_shop_page'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 13){
            $validator = Validator::make($request->all(),
                [
                    'slide_type'=>'required',
                    'feature_banner'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 14){
            $validator = Validator::make($request->all(),
                [
                    'slide_type'=>'required',
                    'horizontal_top_mobile'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 15){
            $validator = Validator::make($request->all(),
                [
                    'slide_type'=>'required',
                    'image_ads_right'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 17){
            $validator = Validator::make($request->all(),
                [
                    'slide_type'=>'required',
                    'horizontal_after_top_mobile'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 18){
            $validator = Validator::make($request->all(),
                [
                    'category_id'=> 'required',
                    'slide_type'=>'required',
                    'style_display' =>'required',
                    'ecammall_category_banner'=> 'required',
                ]);
        }
        elseif($data['slide_type']){
            $validator = Validator::make($request->all(),
                ['category_id'=> 'required',
                    'slide_type'=>'required',
//                    'product_id'=>'required',
                    'image_header_vertical'=> 'required',
                ]);
        }
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if($data['slide_type'] == 1){
            $file = $request->file('image_vertical');
            $image = Image::make($request->file('image_vertical'))->resize(null, 410, function ($constraint) {
                $constraint->aspectRatio();
            });
            $extension = $request->file('image_vertical')->getClientOriginalExtension(); // getting file extension
        }elseif($data['slide_type']==2){
            $image = Image::make($request->file('image'))->resize(null, 100, function ($constraint) {
                $constraint->aspectRatio();
            });
            $extension = $request->file('image')->getClientOriginalExtension(); // getting file extension
        }
        elseif($data['slide_type']==4){
            $file = $request->file('image_header_horizontal');
            $image = Image::make($request->file('image_header_horizontal'))->resize(null, 80, function ($constraint) {
                $constraint->aspectRatio();
            });
            $extension = $request->file('image_header_horizontal')->getClientOriginalExtension(); // getting file extension
        }
        elseif($data['slide_type']==5){
            $file = $request->file('image_ads_left');
            $image = Image::make($request->file('image_ads_left'))->resize(null, 450, function ($constraint) {
                $constraint->aspectRatio();
            });
            $extension = $request->file('image_ads_left')->getClientOriginalExtension(); // getting file extension
        }
        elseif($data['slide_type']==6){
            $file = $request->file('footer_image');
            $image = Image::make($request->file('footer_image'))->resize(null, 155, function ($constraint) {
                $constraint->aspectRatio();
            });
            $extension = $request->file('footer_image')->getClientOriginalExtension(); // getting file extension
        }
        elseif($data['slide_type']==7){
            $file = $request->file('product_banner');
            $image = Image::make($request->file('product_banner'))->resize(null, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $extension = $request->file('product_banner')->getClientOriginalExtension(); // getting file extension
        }
        elseif($data['slide_type']==8){
            $file = $request->file('brand_zone_banner');
            $image = Image::make($request->file('brand_zone_banner'))->resize(null, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $extension = $request->file('brand_zone_banner')->getClientOriginalExtension(); // getting file extension
        }
        elseif($data['slide_type']==9){
            $file = $request->file('brand_zone_banner_haft');
            $image = Image::make($request->file('brand_zone_banner_haft'))->resize(null, 177, function ($constraint) {
                $constraint->aspectRatio();
            });
            $extension = $request->file('brand_zone_banner_haft')->getClientOriginalExtension(); // getting file extension
        }
        elseif($data['slide_type']==10){
            $file = $request->file('beauty_banner');
            $image = Image::make($request->file('beauty_banner'))->resize(null, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $extension = $request->file('beauty_banner')->getClientOriginalExtension(); // getting file extension
        }
        elseif($data['slide_type']==11){
            $file = $request->file('banner_special_page');
            $image = Image::make($request->file('banner_special_page'))->resize(null, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $extension = $request->file('banner_special_page')->getClientOriginalExtension(); // getting file extension
        }
        elseif($data['slide_type']==12){
            $file = $request->file('horizontal_shop_page');
            $image = Image::make($request->file('horizontal_shop_page'))->resize(null, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $extension = $request->file('horizontal_shop_page')->getClientOriginalExtension(); // getting file extension
        }
        elseif($data['slide_type']==13){
            $file = $request->file('feature_banner');
            $image = Image::make($request->file('feature_banner'))->resize(null, 154, function ($constraint) {
                $constraint->aspectRatio();
            });
            $extension = $request->file('feature_banner')->getClientOriginalExtension(); // getting file extension
        }
        elseif($data['slide_type']==14){
            $file = $request->file('horizontal_top_mobile');
        $image = Image::make($request->file('horizontal_top_mobile'))->resize(null, 220, function ($constraint) {
            $constraint->aspectRatio();
        });
            $extension = $request->file('horizontal_top_mobile')->getClientOriginalExtension(); // getting file extension
        }
        elseif($data['slide_type']==15){
            $file = $request->file('image_ads_right');
            $image = Image::make($request->file('image_ads_right'))->resize(null, 450, function ($constraint) {
                $constraint->aspectRatio();
            });
            $extension = $request->file('image_ads_right')->getClientOriginalExtension(); // getting file extension
        }
        elseif($data['slide_type']==17){
            $file = $request->file('horizontal_after_top_mobile');
            $image = Image::make($request->file('horizontal_after_top_mobile'))->resize(null, 220, function ($constraint) {
                $constraint->aspectRatio();
            });
            $extension = $request->file('horizontal_after_top_mobile')->getClientOriginalExtension(); // getting file extension
        }
        elseif($data['slide_type']==18){
            $file = $request->file('ecammall_category_banner');
            if($data['style_display'] == 1){
                $image = Image::make($request->file('ecammall_category_banner'))->resize(282, 460, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }elseif($data['style_display'] == 3) {
                $image = Image::make($request->file('ecammall_category_banner'))->resize(282, 153.33, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            else
            {
                $image = Image::make($request->file('ecammall_category_banner'))->resize(null, 180, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            $extension = $request->file('ecammall_category_banner')->getClientOriginalExtension(); // getting file extension
        }
        else{
            $file = $request->file('image_header_vertical');
            $image = Image::make($request->file('image_header_vertical'))->resize(null, 437, function ($constraint) {
                $constraint->aspectRatio();
            });
            $extension = $request->file('image_header_vertical')->getClientOriginalExtension(); // getting file extension
        }
        if(empty($data['product_id'])){
            $data['product_id'] = '';
        }
        $destinationPath = 'images/home/'; // upload path
        $fileName = 'CategorySlide_'.rand(10,1000).'_'.$data['category_id'].'_'.$data['product_id']. '.' . $extension; // renameing image
        if ($extension == 'gif') {
            copy($file->getRealPath(), $destinationPath.$fileName);
        }
        else {
            $image->save($destinationPath. $fileName);
        }

        $width = $image->width();
        $height = $image->height();
        $image->destroy();


        $slide = new CategorySlide;
        $slide->category_id = $data['category_id'];
        $slide->product_id = $data['product_id'];
        $slide->slide_type = $data['slide_type'];
        $slide->image = $fileName;
        if(isset($data['page'])){
            $slide->page = $data['page'];
        }
        if(isset($data['style_display'])){
            $slide->style_display = $data['style_display'];
        }
        $slide->url=$data['url'];
        if(isset($data['open_new_tab'])){
            $slide->open_new_tab = $data['open_new_tab'];
        }else{
            $slide->open_new_tab = 0;
        }
        $slide->save();
        flash()->success('Slide Category add successfully');
        return redirect('admin_category_promotion_slide');
    }
    public function delete_slide_category($id){
        $get_slide = CategorySlide::where('id',$id)->first();
        if(File::exists("images/home/$get_slide->image")) File::delete("images/home/$get_slide->image");
        $get_slide->delete();
        flash()->error('Slide Category has been deleted');
        return redirect('admin_category_promotion_slide');
    }

    public function edit_slide_category($id){
        $product_code = [];
        $CategoryName = Category::where('parent_id',0)->orderBy('id','desc')->pluck('name','id');
        $categorySlide = CategorySlide::where('id',$id)->first();
        return view('pages.edit_category_slide',compact('categorySlide','CategoryName','product_code'));
    }
    public function update_slide_category(Request $request,$id){
        $data = $request->all();
        if($data['slide_type'] == 1){
            $validator = Validator::make($request->all(),
                [
                    'category_id'=> 'required',
                    'slide_type'=>'required',
//                    'product_id'=>'required',
//                    'image_vertical'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 2){
            $validator = Validator::make($request->all(),
                [
//                    'category_id'=> 'required',
                    'slide_type'=>'required',
//                    'product_id'=>'required',
//                    'image'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 4){
            $validator = Validator::make($request->all(),
                [
                    'category_id'=> 'required',
                    'slide_type'=>'required',
//                    'product_id'=>'required',
//                    'image_header_horizontal'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 5){
            $validator = Validator::make($request->all(),
                ['category_id'=> 'required',
                    'slide_type'=>'required',
//                    'product_id'=>'required',
//                    'image_ads_left'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 6){
            $validator = Validator::make($request->all(),
                ['category_id'=> 'required',
                    'slide_type'=>'required',
//                    'product_id'=>'required',
//                    'footer_image'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 7){
            $validator = Validator::make($request->all(),
                ['category_id'=> 'required',
                    'slide_type'=>'required',
//                    'product_id'=>'required',
//                    'product_banner'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 8){
            $validator = Validator::make($request->all(),
                [
                    'category_id'=> 'required',
                    'slide_type'=>'required',
//                    'brand_zone_banner'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 9){
            $validator = Validator::make($request->all(),
                [
                    'category_id'=> 'required',
                    'slide_type'=>'required',
//                    'brand_zone_banner_haft'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 10){
            $validator = Validator::make($request->all(),
                [
                    'category_id'=> 'required',
                    'slide_type'=>'required',
//                    'beauty_banner'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 11){
            $validator = Validator::make($request->all(),
                [
                    'slide_type'=>'required',
//                    'banner_special_page'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 12){
            $validator = Validator::make($request->all(),
                [
                    'slide_type'=>'required',
//                    'horizontal_shop_page'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 13){
            $validator = Validator::make($request->all(),
                [
                    'slide_type'=>'required',
//                    'feature_banner'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 14){
            $validator = Validator::make($request->all(),
                [
                    'slide_type'=>'required',
//                    'horizontal_top_mobile'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 15){
            $validator = Validator::make($request->all(),
                [
                    'slide_type'=>'required',
//                    'image_ads_right'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 17){
            $validator = Validator::make($request->all(),
                [
                    'slide_type'=>'required',
//                    'horizontal_after_top_mobile'=> 'required',
                ]);
        }
        elseif($data['slide_type'] == 18){
            $validator = Validator::make($request->all(),
                [
                    'category_id'=> 'required',
                    'slide_type'=>'required',
                    'style_display' =>'required',
//                    'ecammall_category_banner'=> 'required',
                ]);
        }
        elseif($data['slide_type']){
            $validator = Validator::make($request->all(),
                ['category_id'=> 'required',
                    'slide_type'=>'required',
//                    'product_id'=>'required',
//                    'image_header_vertical'=> 'required',
                ]);
        }
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if($data['slide_type'] == 1){
            if(isset($data['image_vertical'])){
                $file = $request->file('image_vertical');
                $image = Image::make($request->file('image_vertical'))->resize(null, 410, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $extension = $request->file('image_vertical')->getClientOriginalExtension(); // getting file extension
            }
        }
        elseif($data['slide_type']==2){
            if(isset($data['image'])){
                $file = $request->file('image');
                $image = Image::make($request->file('image'))->resize(null, 100, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $extension = $request->file('image')->getClientOriginalExtension(); // getting file extension
            }
        }
        elseif($data['slide_type']==4){
            if(isset($data['image_header_horizontal'])){
                $file = $request->file('image_header_horizontal');
                $image = Image::make($request->file('image_header_horizontal'))->resize(null, 80, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $extension = $request->file('image_header_horizontal')->getClientOriginalExtension(); // getting file extension
            }
        }
        elseif($data['slide_type']==5){
            if(isset($data['image_ads_left'])){
                $file = $request->file('image_ads_left');
                $image = Image::make($request->file('image_ads_left'))->resize(null, 450, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $extension = $request->file('image_ads_left')->getClientOriginalExtension(); // getting file extension
            }
        }
        elseif($data['slide_type']==6){
            if(isset($data['footer_image'])){
                $file = $request->file('footer_image');
                $image = Image::make($request->file('footer_image'))->resize(null, 155, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $extension = $request->file('footer_image')->getClientOriginalExtension(); // getting file extension
            }
        }
        elseif($data['slide_type']==7){
            if(isset($data['product_banner'])){
                $file = $request->file('product_banner');
                $image = Image::make($request->file('product_banner'))->resize(null, 150, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $extension = $request->file('product_banner')->getClientOriginalExtension(); // getting file extension
            }
        }
        elseif($data['slide_type']==8){
            if(isset($data['brand_zone_banner'])){
                $file = $request->file('brand_zone_banner');
                $image = Image::make($request->file('brand_zone_banner'))->resize(null, 150, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $extension = $request->file('brand_zone_banner')->getClientOriginalExtension(); // getting file extension
            }
        }
        elseif($data['slide_type']==9){
            if(isset($data['brand_zone_banner_haft'])){
                $file = $request->file('brand_zone_banner_haft');
                $image = Image::make($request->file('brand_zone_banner_haft'))->resize(null, 177, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $extension = $request->file('brand_zone_banner_haft')->getClientOriginalExtension(); // getting file extension
            }
        }
        elseif($data['slide_type']==10){
            if(isset($data['beauty_banner'])){
                $file = $request->file('beauty_banner');
                $image = Image::make($request->file('beauty_banner'))->resize(null, 150, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $extension = $request->file('beauty_banner')->getClientOriginalExtension(); // getting file extension
            }
        }
        elseif($data['slide_type']==11){
            if(isset($data['banner_special_page'])){
                $file = $request->file('banner_special_page');
                $image = Image::make($request->file('banner_special_page'))->resize(null, 150, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $extension = $request->file('banner_special_page')->getClientOriginalExtension(); // getting file extension
            }
        }
        elseif($data['slide_type']==12){
            if(isset($data['horizontal_shop_page'])){
                $file = $request->file('horizontal_shop_page');
                $image = Image::make($request->file('horizontal_shop_page'))->resize(null, 100, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $extension = $request->file('horizontal_shop_page')->getClientOriginalExtension(); // getting file extension
            }
        }
        elseif($data['slide_type']==13){
            if(isset($data['feature_banner'])){
                $file = $request->file('feature_banner');
                $image = Image::make($request->file('feature_banner'))->resize(null, 154, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $extension = $request->file('feature_banner')->getClientOriginalExtension(); // getting file extension
            }

        }
        elseif($data['slide_type']==14){
            if(isset($data['horizontal_top_mobile'])){
                $file = $request->file('horizontal_top_mobile');
                $image = Image::make($request->file('horizontal_top_mobile'))->resize(null, 220, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $extension = $request->file('horizontal_top_mobile')->getClientOriginalExtension(); // getting file extension
            }
        }
        elseif($data['slide_type']==15){
            if(isset($data['image_ads_right'])){
                $file = $request->file('image_ads_right');
                $image = Image::make($request->file('image_ads_right'))->resize(null, 450, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $extension = $request->file('image_ads_right')->getClientOriginalExtension(); // getting file extension
            }
        }
        elseif($data['slide_type']==17){
            if(isset($data['horizontal_after_top_mobile'])){
                $file = $request->file('horizontal_after_top_mobile');
                $image = Image::make($request->file('horizontal_after_top_mobile'))->resize(null, 220, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $extension = $request->file('horizontal_after_top_mobile')->getClientOriginalExtension(); // getting file extension
            }

        }
        elseif($data['slide_type']==18){
            if(isset($data['ecammall_category_banner'])){
                $file = $request->file('ecammall_category_banner');
                if($data['style_display'] == 1){
                    $image = Image::make($request->file('ecammall_category_banner'))->resize(282, 460, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                elseif ($data['style_display'] == 3){
                    $image = Image::make($request->file('ecammall_category_banner'))->resize(282, 153.33, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                else{
                    $image = Image::make($request->file('ecammall_category_banner'))->resize(null, 180, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }

                $extension = $request->file('ecammall_category_banner')->getClientOriginalExtension(); // getting file extension
            }
        }
        else{
            if(isset($data['image_header_vertical'])){
                $file = $request->file('image_header_vertical');
                $image = Image::make($request->file('image_header_vertical'))->resize(null, 437, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $extension = $request->file('image_header_vertical')->getClientOriginalExtension(); // getting file extension
            }
        }
        if(empty($data['product_id'])){
            $data['product_id'] = '';
        }
        if(isset($image)){

            $destinationPath = 'images/home/'; // upload path
            $fileName = 'CategorySlide_'.rand(10,1000).'_'.$data['category_id'].'_'.$data['product_id']. '.' . $extension; // renameing image

            if ($extension == 'gif') {
                copy($file->getRealPath(), $destinationPath.$fileName);
            }
            else {
                $image->save($destinationPath. $fileName);
            }

            $width = $image->width();
            $height = $image->height();
            $image->destroy();


//            $upload_success = $image->save($destinationPath. $fileName); // uploading file to given path
        }

        $slide = CategorySlide::find($id);
        $slide->category_id = $data['category_id'];
        $slide->product_id = $data['product_id'];
        $slide->slide_type = $data['slide_type'];
        if(isset($image)){
            $slide->image = $fileName;
        }
        if(isset($data['page'])){
            $slide->page = $data['page'];
        }
        if(isset($data['style_display'])){
            $slide->style_display = $data['style_display'];
        }
        $slide->url=$data['url'];
        if(isset($data['open_new_tab'])){
            $slide->open_new_tab = $data['open_new_tab'];
        }else{
            $slide->open_new_tab = 0;
        }
        $slide->save();
        flash()->info('Slide Category update successfully');
        return redirect('admin_category_promotion_slide');
    }
    public function update_status_slide_category($id){
        $get_slide = CategorySlide::find($id);
        if($get_slide->status == 0){
            $get_slide->update(['status'=>1]);
            flash()->error('Slide show has been disable');
        }else{
            $get_slide->update(['status'=>0]);
            flash()->error('Slide show has been enable');
        }
        return redirect('admin_category_promotion_slide');
    }

    public function footer_type(){
        $FooterType = FooterType::where('status',0)->get();
        return view('pages.admin_footer_type',compact('FooterType'));
    }
    public function add_footer_type(){
        return view('pages.add_footer_type');
    }
    public function save_footer_type(Request $request){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['name'=> 'required',
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        FooterType::create($data);
        flash()->success('Footer Type save successfully');
        return redirect('admin_footer_type');
    }
    public function edit_footer_type($id){
        $FooterType = FooterType::find($id);
        return view('pages.edit_footer_type',compact('FooterType'));
    }
    public function update_footer_type(Request $request,$id){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['name'=> 'required',
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        $update = FooterType::find($id);
        $update->name = $data['name'];
        $update->save();

        flash()->info('Footer Type Update successfully');
        return redirect('admin_footer_type');
    }
    public function delete_footer_type($id){
        FooterType::where('id',$id)->delete();
        flash()->error('Delete Footer Type Successfully');
        return redirect('admin_footer_type');

    }
    public function footer_page(){
        $FooterPage = FooterPage::get();
        return view('pages.admin_footer_page',compact('FooterPage'));
    }
    public function add_footer_page(){
        $FooterType = FooterType::pluck('name','id');
        return view('pages.add_footer_page',compact('FooterType'));
    }
    public function save_footer_page(Request $request){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['name'=> 'required',
                'footer_type_id'=>'required',
                'description'=>'required',
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if (isset($data['image'])) {
            $image = Image::make($data['image'])->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();});
            $imageName = 'P_'. rand(11111, 99999). '.' . $data['image']->getClientOriginalExtension();
            $image->save('images/footer/' . $imageName);
            $data['image'] = $imageName;
        }
        $FooterPage = FooterPage::create($data);

        flash()->success('Footer page add successfully');
        return redirect('admin_footer_page');
    }
    public function edit_footer_page($id){
        $FooterPage = FooterPage::find($id);
        $FooterType = FooterType::pluck('name','id');
        return view('pages.edit_footer_page',compact('FooterPage','FooterType'));
    }
    public function update_footer_page(Request $request,$id){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['name'=> 'required',
                'footer_type_id'=>'required',
                'description'=>'required',
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if (isset($data['image'])) {
            $image = Image::make($data['image'])->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();});
            $imageName = 'P_'. rand(11111, 99999). '.' . $data['image']->getClientOriginalExtension();
            $image->save('images/footer/' . $imageName);
            $data['image'] = $imageName;
        }
        FooterPage::findorfail($id)->update($data);

        flash()->info('Footer Page update successfully');
        return redirect('admin_footer_page');

    }
    public function delete_footer_page($id){
        FooterPage::where('id',$id)->delete();
        flash()->error('Delete Footer page successfully');
        return redirect('admin_footer_page');
    }

    public function list_users(Request $request){
        //search function
        $_users = User::orderBy('id','ASC');

        $q['first_name'] = $request->input('first_name','');
        $q['email'] = $request->input('email','');
        foreach ($q as $k=>$v)
        {
            $this->k = $k;
            $this->searchWords = preg_split('/\s+/', $v);// explode(' ', $v);
            $_users->where(function($w) {
                foreach($this->searchWords as $word){
                    if(trim($word) != '') {
                        $w->orWhere($this->k ,'LIKE','%'.$word.'%');
                    }
                }

            });
        }
        $users = $_users->paginate(10);

        foreach ($q as $k=>$v)
        {
            if(trim($v) != '')
            {
                $users->appends($k,$v);
            }
        }


        return view('pages.admin_users',compact('users','q'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
//        print_r($Users->toArray()); // you will see the `fee` array
//        return view('pages.admin_users',compact('users'));
    }
    public function delete_user($user_id){
        $user = User::where('id',$user_id)->first();
        $shop = PageShops::where('user_id',$user_id)->first();
        if($user->activated == 1){
            $user->update(['activated'=>0]);
            if($shop)
                $shop->update(['status'=>1]);
            flash()->error('User & Shop has been disable and unactivated');
        }else{
            $user->update(['activated'=>1]);
            if($shop)
                $shop->update(['status'=>0]);
            flash()->info('User & Shop has been enable and active successfully');
        }
        return redirect('admin_users');
    }
    public function hard_delete_user($user_id){
        $user = User::where('id',$user_id)->first();
        $shop = PageShops::where('user_id',$user_id)->first();
        $userProduct = ShopProduct::where('user_id',$user_id)->get();
        if($user){
            $user->delete();
        }
        if($shop){
            $shopImage = $shop->shop_image;
            $shopImageSmall = $shop->shop_image_small;
            $shopLogo = $shop->shop_logo;
            if(File::exists("images/user-shop/$shopImage")) File::delete("images/user-shop/$shopImage");
            if(File::exists("images/user-shop/$shopImageSmall")) File::delete("images/user-shop/$shopImageSmall");
            if(File::exists("images/user-shop/$shopLogo")) File::delete("images/user-shop/$shopLogo");
            $shop->delete();
        }
        if(count($userProduct)>0){
            foreach ($userProduct as $delete){
//                $delete = ShopProduct::find($product_id);
                $imgName = $delete->image;
                if(File::exists("images/user-shop/product/$imgName")) File::delete("images/user-shop/product/$imgName");
                if(File::exists("images/user-shop/product/$delete->feature_image_detail")) File::delete("images/user-shop/product/$delete->feature_image_detail");
                if(File::exists("images/user-shop/product/$delete->feature_image_detail_1")) File::delete("images/user-shop/product/$delete->feature_image_detail_1");
                if(File::exists("images/user-shop/product/$delete->feature_image_detail_2")) File::delete("images/user-shop/product/$delete->feature_image_detail_2");
                if(File::exists("images/user-shop/product/$delete->feature_image_detail_3")) File::delete("images/user-shop/product/$delete->feature_image_detail_3");
                if(File::exists("images/user-shop/product/$delete->feature_image_detail_4")) File::delete("images/user-shop/product/$delete->feature_image_detail_4");
                $deletethumb = Thumbnails::where('product_id',$delete->id)->get();
                foreach ($deletethumb as $thumb){
                    $thumbName = $thumb->image;
                    if(File::exists("images/thumbnails/shop/$thumbName")) File::delete("images/thumbnails/shop/$thumbName");
                    if(File::exists("images/thumbnails/$thumbName")) File::delete("images/thumbnails/$thumbName");
                    if(File::exists("images/thumbnails/medium/$thumbName")) File::delete("images/thumbnails/medium/$thumbName");
                    if(File::exists("images/thumbnails/large/$thumbName")) File::delete("images/thumbnails/large/$thumbName");
                    $thumb->delete();
                }
                $delete->delete();
            }

        }
        flash()->error('User & Shop delete from system.');
        return redirect('admin_users');
    }
    public function activate_user($user_id){
        $user = User::find($user_id);
        $user->update(['activated'=>1]);
        flash()->success('User activated successfully');
        return redirect('admin_users');
    }
    public function user_shop($user_id){
        $Products = ShopProduct::where('user_id',$user_id)->get();
        $ShopInfo = PageShops::where('user_id',$user_id)->first();
        $ShopName = isset($ShopInfo->shop_name)?$ShopInfo->shop_name:'';
        return view('pages.user_shop',compact('Products','ShopName','ShopInfo'));
    }

    public function create_user(){
        $roles = Role::pluck('display_name','id');
        return view('pages.add_user',compact('roles'));
    }
    public function store_user(Request $request){
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' =>'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
//            'roles' => 'required'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = User::create($input);
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }

        flash()->success('User created successfully');
        return redirect()->route('admin_user');
    }
    public function edit_user($user_id){
        $userInfo = User::find($user_id);
        $ShopInfo = PageShops::where('user_id',$user_id)->first();
        $location = City::pluck('name','id');
        $shopTheme = ShopTheme::pluck('shop_type','id');
        $roles = Role::pluck('display_name','id');
        $userRole = $userInfo->roles->pluck('id','id')->toArray();
        if($ShopInfo){
            return view('pages.edit_user',compact('ShopInfo','location','userInfo','shopTheme','roles','userRole'));
        }else{
            flash()->error('No shop create to edit');
            return redirect('admin_users');
        }

    }
    public function update_user(Request $request,$user_id){
            $data = $request->all();
        if(!empty($data['password'])){
            $validator = Validator::make($request->all(),
                ['shop_name'=> 'required',
                    'password'=>'required|min:6|confirmed'
                ]);
        }
        else{
            $validator = Validator::make($request->all(),
                ['shop_name'=> 'required']);
        }
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        $update = PageShops::where('user_id',$user_id)->first();
        $shopImage = $update->shop_image;
        $shopImageSmall = $update->shop_image_small;
        $shopLogo = $update->shop_logo;
        if (isset($data['shop_image'])) {
            if(File::exists("images/user-shop/$shopImage")) File::delete("images/user-shop/$shopImage");
            $image = Image::make($data['shop_image'])->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();});
            $imageName = $data['shop_name']. '.' . $data['shop_image']->getClientOriginalExtension();
            $image->save('images/user-shop/'. $imageName);
            $data['shop_image'] = $imageName;
        }
        if (isset($data['shop_image_small'])) {
            if(File::exists("images/user-shop/$shopImageSmall")) File::delete("images/user-shop/$shopImageSmall");
            $image = Image::make($data['shop_image_small'])->resize(340, 250);
            $imageName = $data['shop_name']. '-banner-small.' . $data['shop_image_small']->getClientOriginalExtension();
            $image->save('images/user-shop/'. $imageName);
            $data['shop_image_small'] = $imageName;
        }

        if (isset($data['shop_logo'])) {
            if(File::exists("images/user-shop/$shopLogo")) File::delete("images/user-shop/$shopLogo");
            $image = Image::make($data['shop_logo'])->resize(null, 150, function ($constraint) {
                $constraint->aspectRatio();});
            $imageName = $data['shop_name']. '-logo.' . $data['shop_logo']->getClientOriginalExtension();
            $image->save('images/user-shop/'. $imageName);
            $data['shop_logo'] = $imageName;
        }

        $update->update($data);

        $updateUser = User::where('id',$user_id)->first();
        if(!empty($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }else{
            $data = Arr::except($data,array('password'));
        }

        //update table user
//        $user = User::find($user_id);
        $updateUser->update($data);
        DB::table('role_user')->where('user_id',$user_id)->delete();


        foreach ($request->input('roles') as $key => $value) {
            $updateUser->attachRole($value);
        }

        flash()->info('Shop Information Update Successfully');
        return redirect('admin_users');
    }
    public function create_user_shop($user_id){
        $user = User::where('id',$user_id)->first();
        $location = City::pluck('name','id');
        $shopTheme = ShopTheme::pluck('shop_type');
        return view('pages.admin_create_user_shop',compact('location','user','shopTheme'));
    }
    public function save_create_user_shop(Request $request,$user_id){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['shop_name'=> 'required',
                'city'=>'required',
                'shop_logo'=>'required',
            ]);
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
            $updateShop = PageShops::where('user_id',$user_id)->first();
            $updateShop->update(['promotion_status'=>'1']);
        }
        $data['user_id'] = $user_id;
        $shop = new PageShops($data);
        $shop->save();
//        Auth::user()->PageShop()->save($shop);

        flash()->success('Shop Information add successfully');
        return redirect('admin_users');
    }
    public function admin_add_product($user_id){
        $CheckShopID = PageShops::where('user_id',$user_id)->first();
        $ShopID = $CheckShopID->id;
        //check product
        $CountShopProduct = ShopProduct::where('user_id',$user_id)->count();
        $CountShopProduct++;
        $ProuductByShop = str_pad($CountShopProduct, 3, "0", STR_PAD_LEFT);
        $sku = $ShopID.$ProuductByShop;
        $Category = Category::where('parent_id',0)->pluck('name', 'id');
        $SubCategory = SubCategory::get();
        $brand = [];
        $promotion = PromotionType::where('user_id',$CheckShopID->user_id)->pluck('type','id');
        $CheckLocation = PageShops::where('shop_name',$CheckShopID->shop_name)->first();
        $location = isset($CheckLocation->city)?($CheckLocation->city):null;
        return view('pages.admin_add_product',compact('Category','SubCategory','brand','location','sku','user_id','promotion'));
    }
    public function admin_add_product_save($user_id,Request $request){
        $data = $request->all();
        $data['user_id'] = $user_id;
        $validator = Validator::make($request->all(),
            ['code'=> 'required',
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
            $data['video_upload'] = 'V_'.rand(11111,99999).'.'.$videoUpload->getClientOriginalExtension();
            $videoUpload->move($path, $data['video_upload']);
        }
        $ShopProduct = ShopProduct::create($data);
//        $ShopProduct->save($ShopProduct);

        Thumbnails::where('user_id',$user_id)->where('product_id',0)
            ->update(['product_id'=>$ShopProduct->id]);

        if(isset($data['promotion'])){
            $updateShop = PageShops::where('user_id',$user_id)->first();
            $updateShop->update(['promotion_status'=>'1']);
        }
        flash()->success('Your Product add successfully');
        return redirect('admin/user_shop/'.$user_id);
    }
    public function admin_edit_product_shop($product_id){
        $Product = ShopProduct::find($product_id);
        $user_id = $Product->user_id;
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
        $sku = $ShopID.$ProuductByShop;
        $promotion = PromotionType::where('user_id',$user_id)->pluck('type','id');
        $CheckLocation = ShopProduct::where('id',$product_id)->first();
        $location = isset($CheckLocation->location)?($CheckLocation->location):null;
        return view('pages.edit_product_shop',compact('Product','sku','Category','SubCategory','brand','location','thumbnails','promotion'));
    }
    public function admin_update_product_shop($product_id,Request $request){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['code'=> 'required',
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
            $data['video_upload'] = 'V_'.rand(11111,99999).'.'.$videoUpload->getClientOriginalExtension();
            $videoUpload->move($path, $data['video_upload']);
        }

        $update = ShopProduct::find($product_id);
        $update->update($data);

        if(isset($data['promotion'])){
            $updateShop = PageShops::where('user_id',$update->user_id)->first();
            $updateShop->update(['promotion_status'=>'1']);
        }

        flash()->info('Product Update Successfully');
        return redirect('admin/user_shop/'.$update->user_id);

    }
    public function admin_status_product_shop($product_id){
        $delete = ShopProduct::find($product_id);
        if($delete->status == 0){
            $delete->update(['status'=>1]);
            flash()->error('Product has been disable');
        }else{
            $delete->update(['status'=>0]);
            flash()->info('Product has been enable to list');
        }
        return redirect('admin/user_shop/'.$delete->user_id);
    }
    public function admin_delete_product_shop($product_id){
        $delete = ShopProduct::find($product_id);

        $imgName = $delete->image;
        if(File::exists("images/user-shop/product/$imgName")) File::delete("images/user-shop/product/$imgName");
        $deletethumb = Thumbnails::where('product_id',$product_id)->get();
        foreach ($deletethumb as $thumb){
            $thumbName = $thumb->image;
            if(File::exists("images/thumbnails/shop/$thumbName")) File::delete("images/thumbnails/shop/$thumbName");
            if(File::exists("images/thumbnails/medium/$thumbName")) File::delete("images/thumbnails/medium/$thumbName");
            if(File::exists("images/thumbnails/large/$thumbName")) File::delete("images/thumbnails/large/$thumbName");
            if(File::exists("images/thumbnails/$thumbName")) File::delete("images/thumbnails/$thumbName");
            $thumb->delete();
        }
        $delete->delete();
        flash()->error('Product has been delete successfully from list');
        return redirect('admin/user_shop/'.$delete->user_id);
    }
    public function list_brands(){
        $brands = Brand::get();
        $category = Category::where('parent_id',0)->pluck('name','id');
        return view('pages.list_brands',compact('brands','category'));
    }
    public function add_brands(){
        return view('pages.add_brands');
    }
    public function save_brands(Request $request){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['name'=> 'required',
                'describe'=>'required',
                'image'=>'required',
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if (isset($data['image'])) {
            $image = Image::make($data['image'])->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();});
            $imageName = $data['name']. '.' . $data['image']->getClientOriginalExtension();
            $image->save('images/brand/'. $imageName);
            $data['image'] = $imageName;
        }
        $save = Brand::create($data);
        flash()->success('Brands add successfully');

        return redirect('admin_brands');
    }
    public function edit_brands($id){
        $Brand = Brand::find($id);
        $Categories = Category::where('parent_id',0)->pluck('name','id');
        return view('pages.edit_brands',compact('Brand','Categories'));
    }
    public function update_brands(Request $request,$id){
        $data = $request->all();
        $update = Brand::find($id);
        $validator = Validator::make($request->all(),
            ['name'=> 'required',
                'code'=>'required',
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if (isset($data['banner'])) {
            $image = Image::make($data['banner'])->resize(null, 340, function ($constraint) {
                $constraint->aspectRatio();});
            $imageName = $data['name']. '.' . $data['banner']->getClientOriginalExtension();
            $image->save('images/brand/banner/'. $imageName);
            $data['banner'] = $imageName;
        }
        $update->timestamps = false;
        $update->code = $data['code'];
        $update->name = $data['name'];
        $update->category_id = $data['category_id'];
        if(isset($data['banner'])){
            $update->banner =$data['banner'];
        }
        $update->save();
        flash()->info('Brands updated successfully');
        return redirect('admin_brands');
    }
    public function delete_brands($id){
        $delete = Brand::find($id);
        if($delete->status == 0){
            $delete->update(['status'=>1]);
            flash()->error('Brands has been disable');
        }
        else{
            $delete->update(['status'=>0]);
            flash()->info('Brand has been enable');
        }
        return redirect('admin_brands');
    }
    public function page_management(){
        $pageManagement = PageManagement::get();
        return view('pages.page_management',compact('pageManagement'));
    }
    public function update_page_management($status,$block){
        PageManagement::where('block',$block)->update(['status'=>$status]);
    }

    public function theme_shop(){
        $themes = ShopTheme::get();
        return view('pages.theme_shop',compact('themes'));
    }
    public function add_theme_shop(){
        $shopType = $this->shopType();
        return view('pages.add_theme_shop',compact('shopType'));
    }
    public function save_theme_shop(Request $request){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['shop_type'=> 'required',
                'theme_banner'=>'required',
                'theme_banner_small'=>'required',
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if (isset($data['theme_banner'])) {
            $image = Image::make($data['theme_banner'])->resize(null, 150, function ($constraint) {
                $constraint->aspectRatio();});
            $imageName = rand(11111,99999). '.' . $data['theme_banner']->getClientOriginalExtension();
            $image->save('images/theme-shop/'. $imageName);
            $data['theme_banner'] = $imageName;
        }

        if (isset($data['theme_banner_small'])) {
            $image = Image::make($data['theme_banner_small'])->resize(340, 200);
            $imageName = rand(11111,99999). '-banner-small.' . $data['theme_banner_small']->getClientOriginalExtension();
            $image->save('images/theme-shop/'. $imageName);
            $data['theme_banner_small'] = $imageName;
        }

        $theme = new ShopTheme($data);
        $theme->save();
        flash()->success('Theme shop add successfully');
        return redirect('admin_theme_shop');

    }
    public function edit_theme_shop($id){
        $theme = ShopTheme::find($id);
        $shopType = $this->shopType();
        return view('pages.edit_theme_shop',compact('theme','shopType'));
    }
    public function update_theme_shop(Request $request,$id){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['shop_type'=> 'required',
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        $theme = ShopTheme::find($id);
        $path = 'images/theme-shop';
        if (isset($data['theme_banner'])) {
            $image = Image::make($data['theme_banner'])->resize(null, 150, function ($constraint) {
                $constraint->aspectRatio();});
            $imageName = rand(11111,99999). '.' . $data['theme_banner']->getClientOriginalExtension();
            $image->save('images/theme-shop/'. $imageName);
            $data['theme_banner'] = $imageName;
            if(File::exists("$path/$theme->theme_banner")) File::delete("$path/$theme->theme_banner");
        }

        if (isset($data['theme_banner_small'])) {
            $image = Image::make($data['theme_banner_small'])->resize(340, 200);
            $imageName = rand(11111,99999). '-banner-small.' . $data['theme_banner_small']->getClientOriginalExtension();
            $image->save('images/theme-shop/'. $imageName);
            $data['theme_banner_small'] = $imageName;
            if(File::exists("$path/$theme->theme_banner_small")) File::delete("$path/$theme->theme_banner_small");
        }


        $theme->update($data);

        flash()->info('Theme shop has been updated successfully');
        return redirect('admin_theme_shop');
    }
    public function delete_theme_shop($id){
        $theme = ShopTheme::find($id);
        $path = 'images/theme-shop';
        if(File::exists("$path/$theme->theme_banner")) File::delete("$path/$theme->theme_banner");
        if(File::exists("$path/$theme->theme_banner_small")) File::delete("$path/$theme->theme_banner_small");

        $theme->delete();
        flash()->error('Theme shop has been deleted');
        return redirect('admin_theme_shop');
    }
    public function get_shop_theme($themeId){
        $theme = ShopTheme::find($themeId);

        return view('pages.users.get_theme_info',compact('theme'));
    }
    public function delete_banner_shop($bannerName){
        $path = 'images/user-shop';
        if(File::exists("$path/$bannerName")) File::delete("$path/$bannerName");
        $shop = PageShops::where('shop_image',$bannerName)->first();
        $shop->update(['shop_image'=>'']);
    }
    public function delete_banner_shop_small($bannerNameSmall){
        $path = 'images/user-shop';
        if(File::exists("$path/$bannerNameSmall")) File::delete("$path/$bannerNameSmall");
        $shop = PageShops::where('shop_image_small',$bannerNameSmall)->first();
        $shop->update(['shop_image_small'=>'']);
    }

    public function packages_list(){
        $packages = Packages::get();
        return view('pages.admin_packages_list',compact('packages'));
    }
    public function add_package(){
        $packageTerm = $this->package_term();
        return view('pages.add_package',compact('packageTerm'));
    }
    public function save_package(Request $request){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['name'=> 'required',
                'price'=>'required',
                'package_term' =>'required',
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $save = Packages::create($data);

        if($save){
            flash()->success('Package add success');
            return redirect('admin_packages');
        }
    }
    public function edit_package($packageId){
        $package = Packages::find($packageId);
        $packageTerm = $this->package_term();
        return view('pages.add_package',compact('package','packageTerm'));
    }
    public function update_package(Request $request,$packageId){
        $data = $request->all();
        $validator = Validator::make($request->all(),
            ['name'=> 'required',
             'price'=>'required',
            ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if(!isset($data['shop_info'])){
            $data['shop_info'] = 0;
        }
        print_r($data);

        $package = Packages::find($packageId);
        $package->update($data);

        if($package){
            flash()->info('Package update success');
            return redirect('admin_packages');
        }
    }

    public function transaction_list(){
        $transactions = TransactionMember::get();
        $package = Packages::pluck('name','id');
        $user = User::pluck('last_name','id');
        return view('pages.admin_transaction_list',compact('transactions','package','user'));
    }
    public function transaction_approve($tranID){
        $transaction = TransactionMember::find($tranID);
        $transaction->status = 1;
        $transaction->save();
        $package = Packages::find($transaction->package_id);
//        print($package->id);
        if($transaction){
            //check expired package date
            $packageTerm = $this->package_term();
            foreach ($packageTerm as $term){
                if($package->package_term == '1 month'){
                    $expirePackage = Carbon::now()->addMonth(1);
                }elseif ($package->package_term == '3 months'){
                    $expirePackage = Carbon::now()->addMonth(3);
                }elseif ($package->package_term == '6 months'){
                    $expirePackage = Carbon::now()->addMonth(6);
                }elseif ($package->package_term == '6 months'){
                    $expirePackage = Carbon::now()->addMonth(6);
                }elseif ($package->package_term == '9 months'){
                    $expirePackage = Carbon::now()->addMonth(9);
                }elseif ($package->package_term == '12 months'){
                    $expirePackage = Carbon::now()->addMonth(12);
                }elseif ($package->package_term == '24 months'){
                    $expirePackage = Carbon::now()->addMonth(24);
                }elseif ($package->package_term == '36 months'){
                    $expirePackage = Carbon::now()->addMonth(36);
                }
            }

            $userBalance = User::find($transaction->user_id);
            $userBalance->package_id = $package->id;
            $userBalance->no_product = $package->no_product;
            $userBalance->auto_renew = $package->auto_renew;
            $userBalance->renew = $package->renew;
            $userBalance->featured_ads = $package->featured_ads;
            $userBalance->ads_general = $package->ads_general;
            $userBalance->ads_specific = $package->ads_specific;
            $userBalance->ads_custom = $package->ads_custom;
            $userBalance->shop_info = $package->shop_info;
            $userBalance->package_expired_date = $expirePackage;
            $userBalance->save();
        }

        return redirect('admin_transaction');
    }
    public function transaction_delete($tranID){
        $transaction = TransactionMember::find($tranID);
        $package = Packages::find($transaction->package_id);

        $userBalance = User::find($transaction->user_id);
        $userBalance->no_product = $package->no_product;
        $userBalance->auto_renew = $package->auto_renew;
        $userBalance->renew = $package->renew;
        $userBalance->featured_ads = $package->featured_ads;
        $userBalance->ads_general = $package->ads_general;
        $userBalance->ads_specific = $package->ads_specific;
        $userBalance->ads_custom = $package->ads_custom;
        $userBalance->shop_info = 0;
        $userBalance->save();

        if($userBalance){
            $transaction->delete();
        }
        return redirect('admin_transaction');
    }


}
