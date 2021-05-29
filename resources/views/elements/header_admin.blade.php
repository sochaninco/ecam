<div id="wrapper">
    @if(Auth::check())
            <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand hidden-xs" href="{{url('/em-admin')}}">{{Auth::user()->last_name}}</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li>
                <a href="{{url('/pos')}}" class="btn btn-primary btn-xs">
                    POS
                </a>
            </li>
            <li>
                <a href="{{url('/dashboard')}}">
                    <i class="fa fa-dashboard"></i>
                </a>
            </li>
            <li>
                <a href="{{url('#')}}">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li>
                <a href="{{url('#')}}">
                    <i class="fa fa-shopping-cart"></i>
                </a>
            </li>
            <li>
                <a href="{{url('#')}}">
                    <i class="fa fa-area-chart"></i>
                </a>
            </li>
            <li>
                <a href="{{url('#')}}">
                    <i class="fa fa-send"></i>
                </a>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="{{url('/logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>

            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
        @if(!Request::is('pos'))
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                {{--@if(Auth::user()->user_role == 1)--}}
                    <ul class="nav" id="side-menu">
                    @permission('admin-area-access')
                    <li>
                        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="{{url('admin_shop_info')}}"><i class="fa fa-building-o"></i> Admin ShopInfo</a>
                    </li>
                    <li>
                        <a href="{{url('pos_sale_list')}}"><i class="fa fa-dollar"></i> POS Sale</a>
                    </li>
                    @endpermission
                    @permission('search-keyword-list')
                    <li><a href="{{url('admin_search_keyword')}}"><i class="fa fa-key"></i> Search Keyword</a> </li>
                    @endpermission
                    @permission('admin-product-list')
                    <li>
                        <a href="{{url('admin_product')}}"><i class="fa fa-puzzle-piece"></i> Products </a>
                    </li>
                    @endpermission
                    @permission('admin-print-label')
                    <li>
                        <a href="{{url('admin_print_label_form')}}"><i class="fa fa-barcode"></i> Print Label</a>
                    </li>
                    @endpermission
                    @permission('admin-promotion-list')
                    <li>
                        <a href="{{url('admin_promotion')}}">
                            <i class="fa fa-arrow-circle-o-down"></i> Admin Promotion
                        </a>
                    </li>
                    @endpermission
                    @permission('admin-package-list')
                    <li><a href="{{url('admin_packages')}}"><i class="fa fa-dollar"></i> Packages List</a> </li>
                    @endpermission
                    @permission('admin-transaction-list')
                    <li><a href="{{url('admin_transaction')}}"><i class="fa fa-info"></i> Transaction List </a> </li>
                    @endpermission
                    @permission('admin-payment-list')
                    <li><a href="{{url('admin_payment_list')}}"><i class="fa fa-dollar"></i> Payment List </a> </li>
                    @endpermission
                    @permission('payment-method-listing')
                    <li><a href="{{url('admin_payment_method')}}"><i class="fa fa-paypal"></i> Payment Method </a> </li>
                    @endpermission
                    @permission('customer-order-list')
                    <li>
                        <a href="{{url('admin_product_order')}}"><i class="fa fa-dropbox"></i> Customer Orders </a>
                    </li>
                    @endpermission
                    @permission('seller-status-list')
                    <li>
                        <a href="{{url('admin_product_seller')}}"><i class="fa fa-truck"></i> Seller Status </a>
                    </li>
                    @endpermission
                    @permission('admin-order-status')
                    <li>
                        <a href="{{url('admin_order_status')}}"><i class="fa fa-search"></i> Order Statuses </a>
                    </li>
                    @endpermission
                    @permission('admin-category-list')
                    <li>
                        <a href="{{url('admin_categories')}}"><i class="fa fa-th-list"></i> Categories </a>
                    </li>
                    @endpermission
                    @permission('admin-sub-category-list')
                    <li>
                        <a href="{{url('admin_subcategories')}}"><i class="fa fa-th-list"></i> Subcategories </a>
                    </li>
                    @endpermission
                    @permission('admin-brand-listing')
                    <li><a href="{{url('admin_brands')}}"><i class="fa fa-folder-o"></i> Brands </a> </li>
                    @endpermission
                    @permission('admin-slide-show-list')
                    <li>
                        <a href="{{url('admin_promotion_slide')}}"><i class="fa fa-dropbox"></i> Slide Show </a>
                    </li>
                    @endpermission
                    @permission('admin-promotion-slide-list')
                    <li>
                        <a href="{{url('admin_category_promotion_slide')}}"><i class="fa fa-dropbox"></i> Promotion Image Slide Show </a>
                    </li>
                    @endpermission
                    @permission('admin-banner-mobile-listing')
                    <li><a href="{{url('admin_top_banner_mobile')}}"><i class="fa fa-mobile"></i> Banner for Mobile Link </a> </li>
                    @endpermission
                    @permission('admin-pop-up-banner-list')
                    <li><a href="{{url('admin_pop_up_banner')}}"><i class="fa fa-image"></i> Pop Banner Promotion </a> </li>
                    @endpermission
                    @permission('admin-footer-type-list')
                    <li><a href="{{url('admin_footer_type')}}"><i class="fa fa-folder-o"></i> Footer Type</a> </li>
                    @endpermission
                    @permission('admin-footer-page-list')
                    <li><a href="{{url('admin_footer_page')}}"><i class="fa fa-file"></i> Footer Pages</a> </li>
                    @endpermission
                    @permission('admin-user-list')
                    <li><a href="{{url('admin_users')}}"><i class="fa fa-user"></i> Users </a> </li>
                    @endpermission
                    @permission('role-list')
                    <li><a href="{{url('roles')}}"><i class="fa fa-key"></i> Role</a> </li>
                    @endpermission
                    @permission('admin-page-management-listing')
                    <li><a href="{{url('admin_page_management')}}"><i class="fa fa-file"></i> Page Management </a> </li>
                    @endpermission
                    @permission('admin-theme-shop-listing')
                    <li><a  href="{{url('admin_theme_shop')}}"><i class="fa fa-tasks"></i> Theme Shop </a> </li>
                    @endpermission
                </ul>
                {{--@elseif(Auth::user()->user_role == 0)
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{{url('user_shop')}}"><i class="fa fa-building"></i> My Shop</a>
                        </li>
                        <li>
                            <a href="{{url('user_product')}}"><i class="fa fa-shopping-cart"></i> My Product</a>
                        </li>
                    </ul>
                @endif--}}
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
        @endif
    </nav>
@endif
