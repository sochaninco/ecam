<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Cart;
use App\Category;
use App\City;
use App\FooterPage;
use App\FooterType;
use App\Http\Requests;
use App\PageShops;
use App\Product;
use App\ProductOrderDetail;
use App\ProductThumnail;
use App\ShopProduct;
use App\Slide;
use App\SubCategory;
use App\Thumbnails;
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
    public function index()
    {
//        Session::forget('cart');
        $categories = Category::where('parent_id',0)->get();
        $categories_menu = Category::where('parent_id',0)
            ->get();
        $categories_tab = Category::orderBy('id','desc')->take(6)->get();
        $feature_items = Product::inRandomOrder()->orderBy('id','desc')->take(8)->get();
        $UserProduct = ShopProduct::with('ShopProductThumbnail')->where('status',0)->inRandomOrder()->orderBy('id','desc')->take(12)->get();
        $recomment_items = Product::where('quantity','>=',2)->orderBy('id','desc')->take(20)->get();
        $slides = Slide::where('status',0)->get();
//        join('sma_products','slide_promotion.product_id','=','sma_products.id')
//            ->select('slide_promotion.*','sma_products.name')
//            ->where('slide_promotion.status',0)
//            ->get();
        $product = Product::pluck('name','id');
        return view('pages.home',compact('categories','categories_tab','categories_menu','feature_items','recomment_items','slides','UserProduct','product'));
    }
    public function contact(){
        return view('pages.contact');
    }
    public function products(){
        $categories = Category::where('parent_id',0)->get();
        $UserProducts = ShopProduct::where('status',0)->inRandomOrder()->orderBy('id','desc')->take(12)->get();
        $products = Product::orderBy('id','desc')->paginate(12);
        $RelatedProducts = ShopProduct::where('status',0)->orderBy('id','asc')->take(6)->get();
        $RandomProducts = ShopProduct::where('status',0)->inRandomOrder()->take(3)->get();
        return view('pages.products',compact('products','categories','UserProducts','RelatedProducts','RandomProducts'));
    }
    public function product_by_category($c_id){
        $categories = Category::where('parent_id',0)->get();
        $CategoryBrand = Brand::where('category_id',$c_id)->get();
        $SubCatMenu = Category::where('parent_id',$c_id)->get();
        $products = Product::where([['category_id',$c_id]])->orderBy('id','desc')->paginate(12);
        $UserProducts = ShopProduct::where(['status'=>0,'category_id'=>$c_id])->inRandomOrder()->orderBy('id','desc')->take(12)->get();
        $RelatedProducts = ShopProduct::where(['status'=>0,'category_id'=>$c_id])->orderBy('id','asc')->take(6)->get();
        $RandomProducts = ShopProduct::where(['status'=>0,'category_id'=>$c_id])->inRandomOrder()->take(3)->get();
        return view('pages.products',compact('CategoryBrand','SubCatMenu','products','categories','UserProducts','RelatedProducts','RandomProducts'));
    }
    public function product_by_subcategory($subcat_id){
        $categories = Category::where('parent_id',0)->get();
//        join('sma_subcategories','sma_categories.id','=','sma_subcategories.category_id')
//            ->select('sma_categories.*')
//            ->groupBy('id')
//            ->get();
        $products = Product::where('subcategory_id',$subcat_id)->orderBy('id','desc')->paginate(12);
        $sub_info = Category::where('id',$subcat_id)->first();
        $sub_name = $sub_info->name;
        $RelatedProducts = ShopProduct::where(['status'=>0,'sub_category_id'=>$subcat_id])->orderBy('id','asc')->take(6)->get();
        $UserProducts = ShopProduct::where(['status'=>0,'sub_category_id'=>$subcat_id])->inRandomOrder()->orderBy('id','desc')->take(12)->get();
        $RandomProducts = ShopProduct::where(['status'=>0,'sub_category_id'=>$subcat_id])->inRandomOrder()->take(3)->get();
        return view('pages.products',compact('products','categories','sub_name','UserProducts','RelatedProducts','RandomProducts'));
    }
    public function product_by_brand($brand_id){
        $categories = Category::where('parent_id',0)->get();
        $ListBrand = Brand::get();
        $products = Product::where('brand',$brand_id)->orderBy('id','desc')->paginate(12);
        $brand_info = Brand::where('id',$brand_id)->first();
        $brand_name = $brand_info->name;
        $UserProducts = ShopProduct::where(['status'=>0,'brand'=>$brand_id])->inRandomOrder()->orderBy('id','desc')->take(12)->get();
        $RelatedProducts = ShopProduct::where(['status'=>0,'brand'=>$brand_id])->orderBy('id','asc')->take(6)->get();
        $RandomProducts = ShopProduct::where(['status'=>0,'brand'=>$brand_id])->inRandomOrder()->take(3)->get();
        return view('pages.products',compact('products','categories','brand_name','UserProducts','RelatedProducts','RandomProducts','ListBrand'));
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
        $popular_items = Product::where('views','>=',5)->take(5)->get();
        $premium_items = ShopProduct::where('premium_product',0)->take(5)->get();
        $get_cat = Product::findorfail($p_id);
        $c_id = $get_cat->category_id;
        //increase view on page product
        $update = Product::find($p_id);
        $update->timestamps = false;
        $update->views = ($product->views)+1;
        $update->save();
        $ShopInfo = PageShops::where('user_id',1)->first();
        $related = Product::orderBy('id','desc')->where('category_id',$c_id)->take(4)->get();
        $recomment_items = Product::orderBy('id','desc')->where('quantity','<=',2)->take(20)->get();
        return view('pages.product_detail',compact('categories','product','ShopInfo','related','recomment_items','thumbnails','firstImage','popular_items','premium_items'));
    }
    public function shop_product_detail($p_id){
        $categories = Category::where('parent_id',0)->get();
        $product = ShopProduct::
        join('sma_categories','shop_products.category_id','=','sma_categories.id')
            ->select('shop_products.*','sma_categories.name as c_name')->
            where([['shop_products.id',$p_id]])->first();
        $popular_items = Product::where('views','>=',5)->take(5)->get();
        $premium_items = ShopProduct::where('premium_product',0)->take(5)->get();
        $firstImage = Thumbnails::where(['product_id'=>$p_id],['user_id',$product->user_id])->first();
        $thumbnails = Thumbnails::where(['product_id'=>$p_id],['user_id',$product->user_id])->get();
        $get_cat = ShopProduct::findorfail($p_id);
        $c_id = $get_cat->category_id;
        $related = ShopProduct::orderBy('id','desc')->where(['category_id'=>$c_id],['user_id'=>$product->user_id],['status'=>0])->take(4)->get();
        $ShopInfo = PageShops::where('user_id',$product->user_id)->first();
        $recomment_items = ShopProduct::orderBy('id','desc')->where('quantity','<=',2)->where(['user_id'=>$product->user_id],['status'=>0])->take(20)->get();
        return view('pages.product_detail',compact('categories','product','firstImage','related','recomment_items','thumbnails','ShopInfo','popular_items','premium_items'));
    }
    public function search(Request $request){
        $data = $request->all();
        $products = Product::where([['name','LIKE','%'.$data['name'].'%'],['category_id',$data['category_id']]])
            ->paginate(12);
        $products->appends($data);
        $categories = Category::where('parent_id',0)->get();
        $RandomProducts = ShopProduct::where(['status'=>0])->inRandomOrder()->take(3)->get();
        return view('pages.products',compact('products','categories','RandomProducts'));
    }

    public function FooterPage($FooterType,$FooterPage){
        $footers = FooterPage::where('name',$FooterPage)->first();
        return view('pages.footer_page',compact('footers'));
    }
    public function shop_page($shop_name){
//        $user_id = Auth::user()->id;
        $subName = 'New Product';
        $ShopInfo = PageShops::where('shop_name',$shop_name)->first();
        $ShopImage = $ShopInfo->shop_image;
        $categories = Category::join('shop_products','sma_categories.id','=','shop_products.category_id')
            ->select('sma_categories.*')
            ->where('shop_products.user_id',$ShopInfo->user_id)
            ->groupBy('id')
            ->get();
        $products = ShopProduct::where('user_id',$ShopInfo->user_id)->inRandomOrder()->orderBy('id','desc')->paginate(12);
        $newProducts =ShopProduct::where('user_id',$ShopInfo->user_id)->orderBy('id','desc')->take(4)->get();
        $RandomProducts = ShopProduct::where('status',0)->inRandomOrder()->take(3)->get();
        return view('pages.products',compact('subName','categories','newProducts','products','ShopImage','RandomProducts','ShopInfo'));

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
        $newProducts =[];
        $RandomProducts = ShopProduct::where('status',0)->inRandomOrder()->take(3)->get();
        return view('pages.products',compact('subName','categories','newProducts','products','ShopImage','RandomProducts','ShopInfo'));
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
        $newProducts =ShopProduct::where('user_id',$ShopInfo->user_id)->orderBy('id','desc')->take(16)->get();
        $RandomProducts = ShopProduct::where('status',0)->inRandomOrder()->take(3)->get();
        return view('pages.products',compact('subName','categories','newProducts','products','ShopImage','RandomProducts','ShopInfo'));
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
        $ShopImage = $ShopInfo->shop_image;
        $products = ShopProduct::where('user_id',$shop_id)->where('sub_category_id',$sub_id)->inRandomOrder()->orderBy('id','desc')->paginate(12);
        $newProducts = [];
        $RandomProducts = ShopProduct::where('status',0)->inRandomOrder()->take(3)->get();
        return view('pages.products',compact('subName','categories','newProducts','products','ShopImage','RandomProducts','ShopInfo'));
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
        $cart = new Cart($oldCart);
        $cart->add($product,$product_id,$qty_order,$product_from);
        $request->session()->put('cart',$cart);
        if(Session::has('cart')){
            $totalQty = Session::get('cart')->totalQty;
        }
        return $totalQty;

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
        return $cart->totalQty;
    }

    public function brand_zone(){
        $listBrand = Brand::get();
        $latestBrand = Brand::orderBy('id','asc')->get();
        return view('pages.brand_zone',compact('listBrand','latestBrand'));
    }
    public function seller_zone(){
        $listShop = PageShops::whereNotIn('user_id',[1,3])->orderBy('id','asc')->get();
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
}
