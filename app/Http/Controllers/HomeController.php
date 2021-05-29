<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Cart;
use App\Category;
use App\City;
use App\Coupon;
use App\FooterPage;
use App\FooterType;
use App\Http\Requests;
use App\Packages;
use App\PageManagement;
use App\PageShops;
use App\Product;
use App\ProductOrder;
use App\ProductOrderDetail;
use App\ProductThumnail;
use App\PromotionType;
use App\ShopProduct;
use App\ShopTheme;
use App\Slide;
use App\SubCategory;
use App\Thumbnails;
use App\TransactionMember;
use App\User;
use App\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    protected function userId($userId){
        $checkParent = \App\User::where('id',Auth::user()->id)->first();
        if($checkParent->parent_id != 0){
            $userId = $checkParent->parent_id;
        }elseif ($checkParent->user_role == 1){
            $userId = $userId;
        }
        else{
            $userId = $checkParent->id;
        }
        return $userId;
    }
    public function get_product_sort_by($selected){
        if($selected == 'name-asc'){
            $userProducts = ShopProduct::where('status',0)->orderBy('name','asc')->take(16)->get();
            $products = Product::where('featured','!=',Null)->orderBy('name','asc')->paginate(16);
        }elseif ($selected == 'name-desc'){
            $userProducts = ShopProduct::where('status',0)->orderBy('name','desc')->take(16)->get();
            $products = Product::where('featured','!=',Null)->orderBy('name','desc')->paginate(16);
        }elseif ($selected == 'price-asc'){
            $userProducts = ShopProduct::where('status',0)->orderBy('price','asc')->take(16)->get();
            $products = Product::where('featured','!=',Null)->orderBy('price','asc')->paginate(16);
        }else{
            $userProducts = ShopProduct::where('status',0)->orderBy('price','desc')->take(16)->get();
            $products = Product::where('featured','!=',Null)->orderBy('price','desc')->paginate(16);
        }

        return view('pages.product_sort',compact('userProducts','products'));
    }
    public function index()
    {
//        Session::forget('cart');
        $categories = Category::where('parent_id',0)->get();
        $categories_menu = Category::where('parent_id',0)
            ->get();
        $categories_tab = Category::orderBy('id','desc')->take(6)->get();
        $feature_items = Product::where('featured','!=',Null)->inRandomOrder()->orderBy('id','desc')->take(12)->get();
        $UserProduct = ShopProduct::with('ShopProductThumbnail')->where('status',0)->inRandomOrder()->orderBy('id','desc')->take(12)->get();
        $latestProduct = ShopProduct::with('ShopProductThumbnail')->where('status',0) ->orderBy('id','desc')->take(12)->get();
        $recomment_items = Product::where('featured','!=',Null)->where('quantity','>=',2)->orderBy('id','desc')->take(20)->get();
        $pageManagement = PageManagement::where(['id'=>14])->first();
        if($pageManagement->status == 0){
            $slides = Slide::where(['status'=>0,'type'=>0])->orderBy('id','desc')->get();
        }else{
            $slides = Slide::where(['status'=>0,'type'=>1])->orderBy('id','desc')->get();
        }


        $product = Product::pluck('name','id');
        $promotionHome = ShopProduct::where('status',0)
            ->whereBetween('discount_rate',[10,99])
            ->get();
        $flashSale = ShopProduct::where('status',0)
            ->whereBetween('discount_rate',[1,50])
            ->inRandomOrder()
            ->orderBy('discount_rate','desc')
            ->take(12)
            ->get();
        return view('pages.home',compact('categories','categories_tab','categories_menu','feature_items','recomment_items','slides','UserProduct','product','latestProduct','promotionHome','flashSale'));
    }
    public function contact(){
        return view('pages.contact');
    }
    public function products(Request $request){
        $categories = Category::where('parent_id',0)->get();
        $categories_menu = Category::where('parent_id',0)->get();
        $CategoryBrand = Brand::get();
        $categoryName = '';
        $UserProducts = ShopProduct::where('status',0)->inRandomOrder()->orderBy('id','desc')->take(12)->get();
        $products = Product::where('featured','!=',Null)->orderBy('id','desc')->paginate(24);

        
        $countProducts = Product::where('featured','!=',Null)->count();
        $RelatedProducts = ShopProduct::where('status',0)->orderBy('id','asc')->take(6)->get();
        $RandomProducts = ShopProduct::where('status',0)->inRandomOrder()->take(3)->get();
        if ($request->ajax()) {
            $view = view('pages.ajax-load-product',compact('products'))->render();
            return response()->json(['html'=>$view]);
        }
        return view('pages.products',compact('countProducts','products','CategoryBrand','categories','categories_menu','UserProducts','RelatedProducts','RandomProducts','categoryName'));
    }

    public function products_list_view(){
        $categories = Category::where('parent_id',0)->get();
        $CategoryBrand = Brand::get();
        $ShopInfo = PageShops::where('user_id',1)->first();
        $UserProducts = ShopProduct::where('status',0)->inRandomOrder()->orderBy('id','desc')->take(12)->get();
        $products = Product::where('featured','!=',Null)->orderBy('id','desc')->paginate(12);
        $RelatedProducts = ShopProduct::where('status',0)->orderBy('id','asc')->take(6)->get();
        $RandomProducts = ShopProduct::where('status',0)->inRandomOrder()->take(3)->get();
        return view('pages.products_list_view',compact('products','CategoryBrand','categories','UserProducts','RelatedProducts','RandomProducts','ShopInfo'));
    }
    public function all_category(){
        $categories = Category::where('parent_id',0)->get();
        return view('pages.all_category',compact('categories'));
    }
    public function product_by_category(Request $request,$c_id){
        $categories = Category::where('parent_id',0)->get();
        $CategoryBrand = Brand::where('category_id',$c_id)->get();
        $SubCatMenu = Category::where('parent_id',$c_id)->get();
        $category = Category::where('id',$c_id)->first();
        $categoryName = $category->name;
        $products = Product::where('featured','!=',Null)->where([['category_id',$c_id]])->orderBy('id','desc')->paginate(14);
        $UserProducts = ShopProduct::where(['status'=>0,'category_id'=>$c_id])->inRandomOrder()->orderBy('id','desc')->take(16)->get();
        $countProductStore = Product::where('featured','!=',Null)->where([['category_id',$c_id]])->count();
        $countUserProducts = ShopProduct::where(['status'=>0,'category_id'=>$c_id])->count();
        $countProducts = $countProductStore+$countUserProducts;
        $RelatedProducts = ShopProduct::where(['status'=>0,'category_id'=>$c_id])->orderBy('id','asc')->take(6)->get();
        $RandomProducts = ShopProduct::where(['status'=>0,'category_id'=>$c_id])->inRandomOrder()->take(3)->get();
        /*if ($request->ajax()) {
            $products = $UserProducts;
            $view = view('pages.ajax-load-product',compact('products'))->render();
            return response()->json(['html'=>$view]);
        }*/
        return view('pages.products',compact('countProducts','CategoryBrand','SubCatMenu','products','categories','UserProducts','RelatedProducts','RandomProducts','categoryName'));
    }
    public function product_by_subcategory($subcat_id){
        $getCategory = Category::where('id',$subcat_id)->first();
        $category = Category::pluck('name','id');
        $categoryName = $category[$getCategory->parent_id];
        $CategoryBrand = Brand::where('category_id',$getCategory->parent_id)->get();
        $subcategory = Category::where('parent_id',$getCategory->parent_id)->get();
//        join('sma_subcategories','sma_categories.id','=','sma_subcategories.category_id')
//            ->select('sma_categories.*')
//            ->groupBy('id')
//            ->get();
        $SubCatMenu = Category::where('parent_id',$getCategory->parent_id)->get();
        $products = Product::where('featured','!=',Null)->where('subcategory_id',$subcat_id)->orderBy('id','desc')->paginate(12);
        $countProductStore = Product::where('featured','!=',Null)->where('subcategory_id',$subcat_id)->count();
        $sub_info = Category::where('id',$subcat_id)->first();
        $sub_name = $sub_info->name;
        $RelatedProducts = ShopProduct::where(['status'=>0,'sub_category_id'=>$subcat_id])->orderBy('id','asc')->take(6)->get();
        $UserProducts = ShopProduct::where(['status'=>0,'sub_category_id'=>$subcat_id])->inRandomOrder()->orderBy('id','desc')->take(12)->get();
        $countUserProducts = ShopProduct::where(['status'=>0,'sub_category_id'=>$subcat_id])->count();
        $RandomProducts = ShopProduct::where(['status'=>0,'sub_category_id'=>$subcat_id])->inRandomOrder()->take(3)->get();
        $countProducts = $countProductStore+$countUserProducts;
        return view('pages.products',compact('countProducts','products','CategoryBrand','categoryName','subcategory','sub_name','UserProducts','SubCatMenu','RelatedProducts','RandomProducts'));
    }
    public function product_by_brand($brand_id){
        $categories = Category::where('parent_id',0)->get();
        $SubCatMenu = [];
        $categoryInfo = Brand::find($brand_id);
        $cateID = $categoryInfo->category_id;
        $CategoryBrand = Brand::where('category_id',$cateID)->get();
        $ListBrand = Brand::where('category_id',$cateID)->get();
        $products = Product::where('featured','!=',Null)->where('brand',$brand_id)->orderBy('id','desc')->paginate(12);
        $countProductStore = Product::where('featured','!=',Null)->where('brand',$brand_id)->count();
        $brand_info = Brand::where('id',$brand_id)->first();
        $brand_name = $brand_info->name;
        $UserProducts = ShopProduct::where(['status'=>0,'brand'=>$brand_id])->inRandomOrder()->orderBy('id','desc')->take(12)->get();
        $countUserProducts = ShopProduct::where(['status'=>0,'brand'=>$brand_id])->count();
        $countProducts = $countProductStore+$countUserProducts;
        $RelatedProducts = ShopProduct::where(['status'=>0,'brand'=>$brand_id])->orderBy('id','asc')->take(6)->get();
        $RandomProducts = ShopProduct::where(['status'=>0,'brand'=>$brand_id])->inRandomOrder()->take(3)->get();
        return view('pages.products',compact('countProducts','products','categories','SubCatMenu','CategoryBrand','brand_name','UserProducts','RelatedProducts','RandomProducts','ListBrand'));
    }
    public function product_by_city($city_id){
        $categories = Category::where('parent_id',0)->get();
        $ListCity = City::get();
        $Cities = City::where('id',$city_id)->first();
        $CityName = $Cities->name;
        $UserProducts = ShopProduct::where(['status'=>0,'location'=>$city_id])->orderBy('id','desc')->paginate(12);
        $RelatedProducts = ShopProduct::where(['status'=>0,'location'=>$city_id])->orderBy('id','asc')->take(6)->get();
        $RandomProducts = ShopProduct::where(['status'=>0,'location'=>$city_id])->inRandomOrder()->take(3)->get();
        return view('pages.products',compact('categories','CityName','UserProducts','RelatedProducts','RandomProducts','ListCity'));
    }
//    public function category_tab($cat_id){
//        $categories = Category::get();
//        $feature_items = Product::orderBy('id','desc')->take(8)->get();
//        $recomment_items = Product::where('quantity','>=',2)->orderBy('id','desc')->take(20)->get();
//        return view('pages.home',compact('categories','feature_items','recomment_items'));
//    }
    public function detail($p_id){
        $categories = Category::where('parent_id',0)->get();
        $product = Product::
        join('sma_categories','sma_products.category_id','=','sma_categories.id')
            ->select('sma_products.*','sma_categories.name as c_name')->
            where([['sma_products.id',$p_id]])->first();
        $firstImage = ProductThumnail::where(['product_id'=>$p_id])->first();
        $thumbnails = ProductThumnail::where('product_id',$p_id)->get();
        $countThumbnails = ProductThumnail::where('product_id',$p_id)->count();
        $popular_items = Product::where('featured','!=',Null)->where('views','>=',5)->take(5)->get();
        $premium_items = ShopProduct::where('premium_product',2)->take(5)->get();
        $get_cat = Product::findorfail($p_id);
        $c_id = $get_cat->category_id;
        //increase view on page product
        $update = Product::find($p_id);
        $update->timestamps = false;
        $update->views = ($product->views)+1;
        $update->save();
        $ShopInfo = PageShops::where('user_id',1)->first();
        $checkMember = [];
        $related = Product::where('featured','!=',Null)->orderBy('id','desc')->where('category_id',$c_id)->take(4)->get();
        $productByShop = Product::where('featured','!=',Null)->inRandomOrder()->take(6)->get();
        $recomment_items = Product::where('featured','!=',Null)->orderBy('id','desc')->where('quantity','<=',2)->take(20)->get();
        return view('pages.product_detail',compact('categories','product','ShopInfo','related','recomment_items','thumbnails','countThumbnails','firstImage','popular_items','premium_items','checkMember','productByShop'));
    }
    public function shop_product_detail($p_id){
        $categories = Category::where('parent_id',0)->get();
        $product = ShopProduct::
        join('sma_categories','shop_products.category_id','=','sma_categories.id')
            ->select('shop_products.*','sma_categories.name as c_name')->
            where([['shop_products.id',$p_id]])->first();
        $popular_items = Product::where('featured','!=',Null)->where('views','>=',5)->take(5)->get();
        $premium_items = ShopProduct::where('premium_product',2)->take(5)->get();
        $firstImage = Thumbnails::where(['product_id'=>$p_id],['user_id',$product->user_id])->first();
        $thumbnails = Thumbnails::where(['product_id'=>$p_id],['user_id',$product->user_id])->get();
        $countThumbnails = Thumbnails::where(['product_id'=>$p_id],['user_id',$product->user_id])->count();
        $get_cat = ShopProduct::findorfail($p_id);
        $c_id = $get_cat->category_id;
        $related = ShopProduct::orderBy('id','desc')->where(['category_id'=>$c_id],['user_id'=>$product->user_id],['status'=>0])->take(4)->get();
        $productByShop = ShopProduct::where(['user_id'=>$product->user_id],['status'=>0])->inRandomOrder()->take(6)->get();
        $ShopInfo = PageShops::where('user_id',$product->user_id)->first();
        $recomment_items = ShopProduct::orderBy('id','desc')->where('quantity','<=',2)->where(['user_id'=>$product->user_id],['status'=>0])->take(20)->get();
        $checkMember = User::where('id',$product->user_id)->first();
        return view('pages.product_detail',compact('categories','product','firstImage','related','recomment_items','thumbnails','countThumbnails','ShopInfo','popular_items','premium_items','checkMember','productByShop'));
    }
    public function search(Request $request){
        $data = $request->all();
        $q['name'] = $request->input('name','');
        $q['category_id'] = $request->input('category_id','');

        $_item = ShopProduct::orderBy('id','DESC');

        foreach ($q as $k=>$v)
        {
            $this->k = $k;
            $this->searchWords = preg_split('/\s+/', $v);// explode(' ', $v);

            $_item->where(function($w) {

                foreach($this->searchWords as $word){
                    if(trim($word) != '') {
                        if($this->k == 'name'){
                            $w->orWhere($this->k ,'LIKE','%'.$word.'%');
                        }else{
                            $w->orWhere($this->k,$word);
                        }
                    }
                }

            });

        }

        $products = $_item->paginate(24);
        foreach ($q as $k=>$v)
        {
            if(trim($v) != '')
            {
                $products->appends($k,$v);
            }
        }
        $countProducts = $_item->count();
        $CategoryBrand = Brand::get();
        $categories_menu = Category::where('parent_id',0)
            ->get();
        $categories = Category::where('parent_id',0)->get();
        $RandomProducts = ShopProduct::where(['status'=>0])->inRandomOrder()->take(3)->get();
        $categoryName = '';
        return view('pages.products',compact('countProducts','products','categories','RandomProducts','CategoryBrand','categoryName','categories_menu'));
    }

    public function FooterPage($FooterType,$FooterPage){
        $footers = FooterPage::where('name',$FooterPage)->first();
        return view('pages.footer_page',compact('footers'));
    }
    public function shop_page($shop_name){
//        $user_id = Auth::user()->id;
        $subName = 'New Product';
        $ShopInfo = PageShops::where('shop_name',$shop_name)->first();
        $categories = Category::join('shop_products','sma_categories.id','=','shop_products.category_id')
            ->select('sma_categories.*')
            ->where('shop_products.user_id',$ShopInfo->user_id)
            ->groupBy('id')
            ->get();
        $products = ShopProduct::where('user_id',$ShopInfo->user_id)
            ->where('status',0)
            ->inRandomOrder()->orderBy('id','desc')->paginate(12);
        $newProducts =ShopProduct::where('user_id',$ShopInfo->user_id)
            ->where('status',0)
            ->orderBy('id','desc')->take(4)->get();
        $RandomProducts = ShopProduct::where('status',0)
            ->inRandomOrder()->take(3)->get();
        $countProducts = ShopProduct::where('user_id',$ShopInfo->user_id)
            ->where('status',0)
            ->count();
        $CategoryBrand = Brand::get();
        return view('pages.products',compact('countProducts','subName','categories','newProducts','CategoryBrand','products','RandomProducts','ShopInfo'));

    }
    public function all_product_by_shop($shop_name){
        $subName = 'All Product';
        $ShopInfo = PageShops::where('shop_name',$shop_name)->first();
        $ShopImage = $ShopInfo->shop_image;
        $categories = Category::join('shop_products','sma_categories.id','=','shop_products.category_id')
            ->select('sma_categories.*')
            ->where('shop_products.user_id',$ShopInfo->user_id)
            ->groupBy('id')
            ->get();
        $products = ShopProduct::where('user_id',$ShopInfo->user_id)->inRandomOrder()->orderBy('id','desc')->paginate(16);
        $countProducts = ShopProduct::where('user_id',$ShopInfo->user_id)->count();
        $newProducts =[];
        $CategoryBrand = Brand::get();
        $RandomProducts = ShopProduct::where('status',0)->inRandomOrder()->take(3)->get();
        return view('pages.products',compact('subName','categories','newProducts','CategoryBrand','products','countProducts','ShopImage','RandomProducts','ShopInfo'));
    }
    public function new_arrival_product_by_shop($shop_name){
        $subName = 'New Product';
        $ShopInfo = PageShops::where('shop_name',$shop_name)->first();
        $ShopImage = $ShopInfo->shop_image;
        $categories = Category::join('shop_products','sma_categories.id','=','shop_products.category_id')
            ->select('sma_categories.*')
            ->where('shop_products.user_id',$ShopInfo->user_id)
            ->groupBy('id')
            ->get();
        $products = [];
        $CategoryBrand = Brand::get();
        $newProducts =ShopProduct::where('user_id',$ShopInfo->user_id)->orderBy('id','desc')->take(16)->get();
        $countProducts = ShopProduct::where('user_id',$ShopInfo->user_id)->count();
        $RandomProducts = ShopProduct::where('status',0)->inRandomOrder()->take(3)->get();
        return view('pages.products',compact('subName','categories','newProducts','products','countProducts','ShopImage','RandomProducts','ShopInfo','CategoryBrand'));
    }
    public function top_selling_product_by_shop($shop_name){
        $subName = 'Top Selling';
        $ShopInfo = PageShops::where('shop_name',$shop_name)->first();
        $ShopImage = $ShopInfo->shop_image;
        $categories = Category::join('shop_products','sma_categories.id','=','shop_products.category_id')
            ->select('sma_categories.*')
            ->where('shop_products.user_id',$ShopInfo->user_id)
            ->groupBy('id')
            ->get();
        $products = [];
        $bestSeller =\DB::table('product_order_details')
            ->select('*', \DB::raw('sum(qty) as sumOrder'))
            ->where('shop_id',$ShopInfo->user_id)->where('status',1)
            ->orderBy('sumOrder','desc')
            ->groupBy('product_id')->get();
        $RandomProducts = ShopProduct::where('status',0)->inRandomOrder()->take(3)->get();
        return view('pages.shop_top_selling',compact('subName','categories','bestSeller','products','ShopImage','RandomProducts','ShopInfo'));
    }

    public function shop_product_by_subcategory($shop_id,$sub_id){
        $getSubcategory = Category::where('id',$sub_id)->first();
        $subName = $getSubcategory->name;
        $ShopInfo = PageShops::where('user_id',$shop_id)->first();
        $categories = Category::join('shop_products','sma_categories.id','=','shop_products.category_id')
            ->select('sma_categories.*')
            ->where('shop_products.user_id',$ShopInfo->user_id)
            ->groupBy('id')
            ->get();
        $CategoryBrand = Brand::get();
        $ShopImage = $ShopInfo->shop_image;
        $products = ShopProduct::where('user_id',$shop_id)->where('sub_category_id',$sub_id)->inRandomOrder()->orderBy('id','desc')->paginate(12);
        $countProducts  = ShopProduct::where('user_id',$shop_id)->where('sub_category_id',$sub_id)->count();
        $newProducts = [];
        $RandomProducts = ShopProduct::where('status',0)->inRandomOrder()->take(3)->get();
        return view('pages.products',compact('subName','categories','newProducts','CategoryBrand','products','countProducts','ShopImage','RandomProducts','ShopInfo'));
    }
    public function shop_contact($shop_name){
        $ShopInfo = PageShops::where('shop_name',$shop_name)->first();
        $ShopImage = $ShopInfo->shop_image;
        $categories = Category::join('shop_products','sma_categories.id','=','shop_products.category_id')
            ->select('sma_categories.*')
            ->where('shop_products.user_id',$ShopInfo->user_id)
            ->groupBy('id')
            ->get();
        $RandomProducts = ShopProduct::where('status',0)->inRandomOrder()->take(3)->get();
        return view('pages.shop_contact',compact('ShopInfo','ShopImage','categories','RandomProducts'));
    }

    public function getAddToCart(Request $request,$product_id,$product_from,$qty_order){
        if($product_from == 1){
            $product = Product::find($product_id);
        }
        else{
            $product = ShopProduct::find($product_id);
        }
//        Cart::add('293ad', 'Product 1', 1, 9.99);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
//        if(Auth::check() && Auth::user()->id == $product->user_id){
//            return '<script type="text/javascript">alert("You can not buy your own product!");</script>';
//        }
        $cart = new Cart($oldCart);
        $cart->add($product,$product_id,$qty_order,$product_from);
        $request->session()->put('cart',$cart);
        if(Session::has('cart')){
            $totalQty = Session::get('cart')->totalQty;
        }
        return $totalQty;

    }
    public function getWishList(Request $request,$product_id,$product_from){
        if($product_from == 1){
            $product = Product::find($product_id);
        }
        else{
            $product = ShopProduct::find($product_id);
        }
//        Cart::add('293ad', 'Product 1', 1, 9.99);
        $wishList = WishList::where('user_id',Auth::user()->id)->where('product_id',$product_id)->first();
        if($wishList){
            return '<script>alert("product already exits")</script>';
        }else{
            //insert to wishlits table
            $insertWish = new WishList();
            $insertWish->user_id = Auth::user()->id;
            $insertWish->product_id = $product_id;
            $insertWish->product_from = $product_from;
            $insertWish->save();

            $wishCount = WishList::where('user_id',Auth::user()->id)->count();
            $totalWish = $wishCount;

            return $totalWish;
        }


    }
    public function delete_wishlist($wishListId){
        $wishList = WishList::find($wishListId);
        $wishList->delete();
        flash()->error('Wish Product remove from list');
        return redirect()->back();
    }
    public function shopping_cart(){
        if(!Session::has('cart')){
            return view('pages.orders.shopping_cart',['products'=>null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('pages.orders.shopping_cart',['products'=>$cart->items,'total_price'=>$cart->totalPrice]);

    }
    public function remove_item_cart(Request $request,$id){
        $cart = Session::get('cart');
        unset($cart->items[$id]);
        Session::put('cart', $cart);
        $totalQty = 0;
        if(Session::has('cart')){
            $totalQty = $cart->totalQty--;
        }
    }
    public function remove_item_confirm($id,$orderId){
        $orderDetail = ProductOrderDetail::where(['product_id'=>$id,'product_order_id'=>$orderId])->first();
        if($orderDetail){
            $orderDetail->delete();
        }
        $subTotalOrder = 0;
        $orderDetailGetSubTotal = ProductOrderDetail::where('product_order_id',$orderId)->get();
        foreach ($orderDetailGetSubTotal as $value){
            $subTotalOrder +=$value->amount;
        }

        $productOrder = ProductOrder::find($orderId);
        $productOrder->amount = $subTotalOrder;
        if($productOrder->discount != 0){
            $productOrder->total = $subTotalOrder * ($productOrder->discount /100);
        }else{
            $productOrder->total = $subTotalOrder;
        }
        $productOrder->save();

        return $subTotalOrder;

    }

    public function brand_zone(){
        $listBrand = Brand::get();
        $latestBrand = Brand::orderBy('id','asc')->get();
        $categories_menu = Category::where('parent_id',0)
            ->get();
        return view('pages.brand_zone',compact('listBrand','latestBrand'));
    }
    public function seller_zone(){
        $listShop = PageShops::whereNotIn('user_id',[1,3])->where('status',0)->orderBy('id','asc')->get();
        return view('pages.seller_zone',compact('listShop'));
    }
    public function beauty(){
        $beautyBrand = Brand::where('category_id',2)->orderBy('id','asc')->get();
        $beautySubcategory = Category::where('parent_id',2)->orderBy('id','asc')->get();
        return view('pages.beauty',compact('beautyBrand','beautySubcategory'));
    }
    public function cloth(){
        $clothBrand = Brand::where('category_id',5)->orderBy('id','asc')->get();
        $clothSubcategory = Category::where('parent_id',5)->orderBy('id','asc')->get();

        return view('pages.cloth',compact('clothBrand','clothSubcategory'));
    }
    public function best_seller(){
        $bestSeller = ProductOrderDetail::where('status',1)->groupBy('product_id')->get();
        return view('pages.best_seller',compact('bestSeller'));
    }
    public function discount_deal(){
        $discount50Up = ShopProduct::where('status',0)
            ->whereBetween('discount_rate',[51,99])
            ->get();
        $discount50_40 = ShopProduct::where('status',0)
            ->whereBetween('discount_rate',[40,50])
            ->orderBy('discount_rate','desc')
            ->get();
        $discount39_20 = ShopProduct::where('status',0)
            ->whereBetween('discount_rate',[20,39])
            ->orderBy('discount_rate','desc')
            ->get();
        $discount19_1 = ShopProduct::where('status',0)
            ->whereBetween('discount_rate',[1,19])
            ->orderBy('discount_rate','desc')
            ->get();
        return view('pages.discount_deal',compact('discount50Up','discount50_40','discount39_20','discount19_1'));
    }
    public function promotion(){
        $shops = PageShops::where('promotion_status','>',0)->get();
        $promotionStatus = PromotionType::pluck('type','id');
        return view('pages.promotion',compact('shops','promotionStatus'));
    }

    public function membership_list($userId){
        $packages = Packages::get();
        $userId = $this->userId($userId);
        $membership = User::where('id',$userId)->first();
        $tranInfo = TransactionMember::where('user_id',$userId)->where('status',1)->get();
        return view('pages.users.membership_list',compact('packages','membership','tranInfo','userId'));
    }
    public function membership_register($userId,$packageId){
        $package = Packages::find($packageId);
        return view('pages.users.membership_register',compact('userId','package'));
    }
    public function membership_transaction($user_id,$packageId,Request $request){
        $data = $request->all();
        $package = Packages::find($packageId);

        $transaction = new TransactionMember();
        $transaction->payment_type = $data['payment_type'];
        $transaction->package_id = $packageId;
        $transaction->user_id = $user_id;
        $transaction->save();

        //update balance in tbl user
        


        flash()->success('membership registered plz wait till admin approve ur payment');

        return redirect('em-user/'.$user_id.'/membership_list');
    }
}
