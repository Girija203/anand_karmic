<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.png') }}">

    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/daterangepicker/daterangepicker.css') }}">
    <script src="{{ asset('assets/admin/js/vendor.min.js') }}"></script>
    <!-- Vector Map css -->
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Theme Config Js -->
    <script src="{{ asset('assets/admin/js/config.js') }}"></script>
    <!-- Theme Config Js -->
    <script src="{{ asset('assets/admin/js/common.js') }}"></script>
    @include('Admin.theme_css')

    <!-- App css -->
    <link href="{{ asset('assets/admin/css/app.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">


        <!-- ========== Topbar Start ========== -->
        <div class="navbar-custom">
            <div class="topbar container-fluid">
                <div class="d-flex align-items-center gap-1">

                    <!-- Topbar Brand Logo -->
                    <div class="logo-topbar">
                        <!-- Logo light -->
                        <a href="{{ route('dashboard') }}" class="logo-light">
                            <span class="logo-lg">
                                <img src="{{ asset('assets/admin/images/logo.png') }}" alt="logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('assets/admin/images/logo-sm.png') }}" alt="small logo">
                            </span>
                        </a>

                        <!-- Logo Dark -->
                        <a href="{{ route('dashboard') }}" class="logo-dark">
                            <span class="logo-lg">
                                <img src="{{ asset('assets/admin/images/logo-dark.png') }}" alt="dark logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('assets/admin/images/logo-sm.png') }}" alt="small logo">
                            </span>
                        </a>
                    </div>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="button-toggle-menu">
                        <i class="ri-menu-line"></i>
                    </button>

                    <!-- Horizontal Menu Toggle Button -->
                    <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>

                    <!-- Topbar Search Form -->

                </div>

                <ul class="topbar-menu d-flex align-items-center gap-3">

                    <li class="dropdown">
                        @php
                            if (auth()->user()) {
                                $unreadNotification = auth()->user()->unreadNotifications;
                                $order_Notifications = $unreadNotification->filter(function ($notification) {
                                    return $notification->type == 'App\Notifications\OrderNotification';
                                });
                                $order_Notification = $order_Notifications->sortByDesc('created_at')->take(5);
                                $order_Notify_Count = $order_Notification->count();
                            } else {
                                $order_Notify_Count = 0;
                            }
                        @endphp

                        <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false" style="position: relative">
                            <div class="badge d-none d-sm-inline-block"
                                style="position: absolute;top: 40px;right: -15px;">
                                <span class="badge text-bg-primary float-end" style="font-size: 12px" id="order_count"
                                    @if ($order_Notify_Count == 0) hidden @endif>{{ $order_Notify_Count }}</span>
                            </div>
                            <span>
                                <h5 class="my-0 fw-normal">
                                    <i class="ri-file-list-3-line d-none d-sm-inline-block align-middle"
                                        style="font-size: 25px"></i>
                                </h5>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                            @if (auth()->user())
                                <div id="order_list">
                                    @foreach ($order_Notification as $notification)
                                        @if ($notification->unread() && $notification->read_at == null)
                                            <a href="{{ route('order_messages.read.one', ['id' => $notification->id]) }}"
                                                class="dropdown-item">
                                                <i class="ri-user-fill fs-18 align-middle me-1"></i>
                                                <span><b>{{ $notification->data['name'] }}</b> </span>Ordered
                                                <p>
                                                    <small
                                                        class="text-primary">{{ $notification->created_at->diffForHumans() }}</small>
                                                </p>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                                @if ($order_Notify_Count > 0)
                                    <form class="mx-2" action="{{ route('order_messages.read.all') }}"
                                        method="POST">
                                        @csrf
                                        <button class="card widget-flat text-bg-primary" type="submit">Mark all as
                                            Read</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </li>

                    <li class="dropdown">
                        @php
                            if (auth()->user()) {
                                $unreadNotifications = auth()->user()->unreadNotifications;
                                $contact_Notifications = $unreadNotifications->filter(function ($notification) {
                                    return $notification->type == 'App\Notifications\ContactNotification';
                                });
                                $contact_Notification = $contact_Notifications->sortByDesc('created_at')->take(5);
                                $contact_Notify_Count = $contact_Notification->count();
                            } else {
                                $contact_Notify_Count = 0;
                            }
                        @endphp

                        <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false" style="position: relative">
                            <div class="badge d-none d-sm-inline-block"
                                style="position: absolute;top: 40px;right: -15px;">
                                <span class="badge text-bg-primary float-end" style="font-size: 12px" id="notify_count"
                                    @if ($contact_Notify_Count == 0) hidden @endif>{{ $contact_Notify_Count }}</span>
                            </div>
                            <span>
                                <h5 class="my-0 fw-normal">
                                    <i class="ri-notification-3-line d-none d-sm-inline-block align-middle"
                                        style="font-size: 25px"></i>
                                </h5>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                            @if (auth()->user())
                                <div id="notification_list">
                                    @foreach ($contact_Notification as $notification)
                                        @if ($notification->unread() && $notification->read_at == null)
                                            <a href="{{ route('contact_messages.read.one', ['id' => $notification->id]) }}"
                                                class="dropdown-item">
                                                <i class="ri-user-fill fs-18 align-middle me-1"></i>
                                                <span><b>{{ $notification->data['name'] }}</b> </span>Contacted
                                                <p>
                                                    <small
                                                        class="text-primary">{{ $notification->created_at->diffForHumans() }}</small>
                                                </p>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                                @if ($contact_Notify_Count > 0)
                                    <form class="mx-2" action="{{ route('contact_messages.read.all') }}"
                                        method="POST">
                                        @csrf
                                        <button class="card widget-flat text-bg-primary" type="submit">Mark all as
                                            Read</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar">
                                @if (auth()->check() && auth()->user()->image)
                                    <img src="{{ asset('storage/' . auth()->user()->image) }}" class="user-img"
                                        alt="user-image" width="32" class="rounded-circle" />
                                @else
                                    <img src="{{ asset('assets/admin/images/users/avatar-1.jpg') }}" alt="user-image"
                                        width="32" class="rounded-circle">
                                @endif
                            </span>
                            <span class="d-lg-block d-none">
                                <h5 class="my-0 fw-normal">Thomson <i
                                        class="ri-arrow-down-s-line d-none d-sm-inline-block align-middle"></i></h5>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                            <!-- item-->
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <!-- item-->
                            <a href="{{ route('accountsetting.index') }}" class="dropdown-item">
                                <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            {{-- <a href="pages-profile.html" class="dropdown-item">
                                <i class="ri-settings-4-line fs-18 align-middle me-1"></i>
                                <span>Settings</span>
                            </a>

                            <!-- item-->
                            <a href="pages-faq.html" class="dropdown-item">
                                <i class="ri-customer-service-2-line fs-18 align-middle me-1"></i>
                                <span>Support</span>
                            </a>

                            <!-- item-->
                            <a href="auth-lock-screen.html" class="dropdown-item">
                                <i class="ri-lock-password-line fs-18 align-middle me-1"></i>
                                <span>Lock Screen</span>
                            </a> --}}

                            <!-- item-->
                            <a href="{{ route('admin.logout') }}" class="dropdown-item">
                                <i class="ri-logout-box-line fs-18 align-middle me-1"></i>
                                <span>Logout</span>
                            </a>
                            <!-- <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form> -->
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ========== Topbar End ========== -->


        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">

            <!-- Brand Logo Light -->
            <a href="{{ route('dashboard') }}" class="logo logo-light">
                <span class="logo-lg">
                    <img src="{{ asset('assets/admin/images/logo.png') }}" alt="logo">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('assets/admin/images/logo-sm.png') }}" alt="small logo">
                </span>
            </a>

            <!-- Brand Logo Dark -->
            <a href="{{ route('dashboard') }}" class="logo logo-dark">
                <span class="logo-lg">
                    <img src="{{ asset('assets/admin/images/logo-dark.png') }}" alt="dark logo"
                        style="height:45px;">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('assets/admin/images/logo-sm.png') }}" alt="small logo">
                </span>
            </a>

            <!-- Sidebar -left -->
            <div class="h-100" id="leftside-menu-container" data-simplebar>
                <!--- Sidemenu -->
                <ul class="side-nav">

                    <li class="side-nav-item">
                        <a href="{{ route('dashboard') }}" class="side-nav-link">
                            <i class="ri-dashboard-3-line"></i>
                            <span class="badge bg-success float-end">9+</span>
                            <span> Dashboard </span>
                        </a>
                    </li>
                    {{-- Manage Category --}}
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#categorypages" aria-expanded="false"
                            aria-controls="categorypages" class="side-nav-link">
                            <i class="ri-pages-line"></i>
                            <span> Manage Categories </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="categorypages">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ route('category.index') }}">Category</a>
                                </li>
                                <li>
                                    <a href="{{ route('subcategory.index') }}">SubCategory</a>
                                </li>
                                <li>
                                    <a href="{{ route('childcategory.index') }}">ChildCategory</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- color --}}
                     <li class="side-nav-item">
                        <a href="{{ route('colors.index') }}" class="side-nav-link">
                            <i class="ri-dashboard-3-line"></i>
                            <span>Color</span>
                        </a>
                    </li>
                    
                    {{-- Manage Product --}}
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#productpages" aria-expanded="false"
                            aria-controls="productpages" class="side-nav-link">
                            <i class="ri-pages-line"></i>
                            <span> Manage Products </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="productpages">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ route('brand.index') }}">Brand</a>
                                </li>
                                <li>
                                    <a href="{{ route('productspecificationkey.index') }}">Product Specification
                                        Key</a>
                                </li>
                                <li>
                                    <a href="{{ route('product.create') }}">Product create</a>
                                </li>
                                <li>
                                    <a href="{{ route('product.index') }}">Product </a>
                                </li>
                                <li>
                                    <a href="{{ route('products.outOfStock') }}">Stock Out </a>
                                </li>
                                <li>
                                    <a href="{{ route('review.index') }}">Product review </a>
                                </li>
                                <li>
                                    <a href="{{ route('report.index') }}">Product Report </a>
                                </li>
                                {{-- <li>
                                    <a href="{{ route('productmeta.index') }}">Product Meta </a>
                                </li> --}}
                                <li>
                                    <a href="{{ route('product_show_cases.index') }}">Product Show Case </a>
                                </li>
                                <li>
                                    <a href="{{ route('show_case_products.index') }}">Show Case Product</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- Manage Orders --}}
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#orders" aria-expanded="false" aria-controls="orders"
                            class="side-nav-link">
                            <i class="ri-pages-line"></i>
                            <span>Manage Order </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="orders">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ route('orders.all') }}">All Order</a>
                                </li>
                                <li>
                                    <a href="{{ route('orders.pending') }}">Pending Order</a>
                                </li>

                                <li>
                                    <a href="{{ route('orders.progress') }}">Progress Order</a>
                                </li>
                                <li>
                                    <a href="{{ route('orders.delivered') }}">Delivered Orders</a>
                                </li>
                                <li>
                                    <a href="{{ route('orders.completed') }}">Completed Orders</a>
                                </li>
                                <li>
                                    <a href="{{ route('orders.declined') }}">Declined Orders</a>
                                </li>
                                <li>
                                    <a href="{{ route('orders.cashONDelivery') }}">Cash On Delivery</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- Inventory Managment --}}
                    <li class="side-nav-item">
                        <a href="{{ route('inventory.index') }}" class="side-nav-link">
                            <i class="ri-dashboard-3-line"></i>
                            <span>Inventory</span>
                        </a>
                    </li>
                    {{-- Ecommerce --}}
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#productspages" aria-expanded="false"
                            aria-controls="productspages" class="side-nav-link">
                            <i class="ri-pages-line"></i>
                            <span>Ecommerce </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="productspages">
                            <ul class="side-nav-second-level">
                                <li>

                                    <a href="{{ route('shippings.index') }}">Shipping Rule</a>
                                </li>
                                <li>
                                    <a href="{{ route('payment_methods.index') }}">Payment Method</a>
                                </li>
                                 <li>
                                    <a href="{{ route('coupon_types.index') }}">Coupon Type</a>
                                </li>

                                <li>
                                    <a href="{{ route('coupons.index') }}">Coupon</a>
                                </li>
                                
                            </ul>
                        </div>
                        {{-- 
                        <li class="side-nav-item">
                            <a href="{{ route('inventory.index') }}" class="side-nav-link">
                                <i class="ri-dashboard-3-line"></i>
                                <span>Inventory</span>
                            </a>
                        </li> --}}

                    </li>
                    {{-- User Managmenent --}}
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false"
                            aria-controls="sidebarPages" class="side-nav-link">
                            <i class="ri-pages-line"></i>
                            <span> User Management </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ route('users.index') }}">User</a>
                                </li>
                                <li>
                                    <a href="{{ route('roles.index') }}">Role</a>
                                </li>
                                <li>
                                    <a href="{{ route('permissions.index') }}">Permission</a>
                                </li>
                                <li>
                                    <a href="{{ route('permission_groups.index') }}">Permission Group</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    {{-- Settings --}}
                    <li class="side-nav-item">
                        <a href="{{ route('settings.index') }}" class="side-nav-link">
                            <i class="ri-dashboard-3-line"></i>
                            <span> Setting </span>
                        </a>
                    </li>
                    {{-- Website footer --}}
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#footerPages" aria-expanded="false"
                            aria-controls="footerPages" class="side-nav-link">
                            <i class="ri-pages-line"></i>
                            <span>Website Footer</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="footerPages">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ route('footers.index') }}">Footer</a>
                                </li>
                                <li>
                                    <a href="{{ route('footer_links.index') }}">First Column Link</a>
                                </li>
                                <li>
                                    <a href="{{ route('second_columns.index') }}">Second Column Link</a>
                                </li>
                                <li>
                                    <a href="{{ route('third_columns.index') }}">Third Column Link</a>
                                </li>
                                <li>
                                    <a href="{{ route('social_media_links.index') }}">Social Media Link</a>
                                </li>


                            </ul>
                        </div>
                    </li>
                    {{-- Contact Message --}}
                    <li class="side-nav-item">
                        <a href="{{ route('contact_messages.index') }}" class="side-nav-link">
                            <i class="ri-dashboard-3-line"></i>
                            <span> Contact Message </span>
                        </a>
                    </li>

                    {{-- Blogs --}}
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#blogPages" aria-expanded="false"
                            aria-controls="blogPages" class="side-nav-link">
                            <i class="ri-pages-line"></i>
                            <span>Blogs</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="blogPages">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ route('blog_posts.index') }}">Blog Post</a>
                                </li>
                                <li>
                                    <a href="{{ route('blog_categories.index') }}">Blog Category</a>
                                </li>
                                <li>
                                    <a href="{{ route('blog_tags.index') }}">Blog Tag</a>
                                </li>
                                <li>
                                    <a href="{{ route('blog_comments.index') }}">Blog Comment</a>
                                </li>
                                <li>
                                    <a href="{{ route('meta_types.index') }}">Meta Type</a>
                                </li>
                                <li>
                                    <a href="{{ route('meta_keys.index') }}">Meta Key</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    {{-- Location Settings --}}
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#location" aria-expanded="false" aria-controls="location"
                            class="side-nav-link">
                            <i class="ri-pages-line"></i>
                            <span>Location </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="location">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ route('countries.index') }}">Country</a>
                                </li>

                                <li>
                                    <a href="{{ route('states.index') }}">State</a>
                                </li>

                                <li>
                                    <a href="{{ route('cities.index') }}">City</a>
                                </li>
                                <li>
                                    <a href="{{ route('currencies.index') }}">Currency</a>
                                </li>

                            </ul>
                        </div>


                    <li class="side-nav-item">
                        <a href="{{ route('subscriber.index') }}" class="side-nav-link">
                            <i class="ri-dashboard-3-line"></i>
                            <span>Subscriber</span>
                        </a>
                    </li>
                    </li>


                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#managewebsite" aria-expanded="false"
                            aria-controls="managewebsite" class="side-nav-link">
                            <i class="ri-pages-line"></i>
                            <span> Pages </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="managewebsite">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ route('contactpage.index') }}">

                                        Contact Page
                                    </a>
                                </li>
                                 <li>
                                    <a href="{{ route('about_sections.index') }}">

                                        About Section
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('terms.index') }}">Terms & Condition</a>
                                </li>
                                <li>
                                    <a href="{{ route('privacypolicy.index') }}">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="{{ route('faq.index') }}">FAQ</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                </ul>
                <!--- End Sidemenu -->

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- ========== Left Sidebar End ========== -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        @yield('content')

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Vendor js -->

    <!-- Daterangepicker js -->
    <script src="{{ asset('assets/admin/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Apex Charts js -->
    <script src="{{ asset('assets/admin/vendor/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector Map js -->
    <script src="{{ asset('assets/admin/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}">
    </script>
    <script
        src="{{ asset('assets/admin/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}">
    </script>

    <!-- Dashboard App js -->
    <script src="{{ asset('assets/admin/js/pages/dashboard.js') }}"></script>


    <!-- App js -->
    <script src="{{ asset('assets/admin/js/app.js') }}"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



    <script>
        $(document).ready(function() {
            @if (session('success'))
                toastr.success('{{ session('success') }}');
            @endif

            @if (session('error'))
                toastr.error('{{ session('error') }}');
            @endif

            @if (session('info'))
                toastr.info('{{ session('info') }}');
            @endif

            @if (session('warning'))
                toastr.warning('{{ session('warning') }}');
            @endif
        });
    </script>





    {{-- Toater  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    {{-- For Contact Notification --}}
    <script>
        var contact_Notify_Count = @json($contact_Notify_Count);
        Pusher.logToConsole = true;
        var pusher = new Pusher('f6700b65ed665872ec5e', {
            cluster: 'ap2'
        });
        var channel = pusher.subscribe('notification');
        channel.bind('noify', function(data) {
            if (data.name) {
                let notificationList = document.getElementById('notification_list');
                let notifyCount = document.getElementById('notify_count');
                let currentCount = notifyCount == null ? 0 : parseInt(notifyCount.textContent);
                let newCount = notifyCount == null ? 1 : (currentCount > 4 ? currentCount : currentCount + 1);
                if (notifyCount != null) {
                    notifyCount.textContent = newCount;
                    notifyCount.removeAttribute('hidden');
                }
                contact_Notify_Count > 4 ? (notificationList.removeChild(notificationList.lastElementChild)) : '';
                let notificationTime = new Date();
                let currentTime = new Date();
                let diff = Math.floor((currentTime - notificationTime) / 60000);
                let timeAgo = diff > 1 ? diff + ' mins ago' : 'just now';
                let newNotification = `<a href="{{ route('contact_messages.index') }}" class="dropdown-item">
                    <i class="ri-user-fill fs-18 align-middle me-1"></i>
                    <span><b>${data.name}</b></span> Contacted 
                    <p>
                        <small class="text-primary">${timeAgo}</small>
                        </p>
                        </a>`;
                notificationList.insertAdjacentHTML('afterbegin', newNotification);
            }
        });
    </script>

    {{-- For Order Notification --}}
    <script>
        var order_Notify_Count = @json($order_Notify_Count);
        Pusher.logToConsole = true;
        var pusher = new Pusher('f6700b65ed665872ec5e', {
            cluster: 'ap2'
        });
        var channel = pusher.subscribe('order_notification');
        channel.bind('order', function(data) {
            if (data.name) {
                let notificationList = document.getElementById('order_list');
                let orderCount = document.getElementById('order_count');
                let currentCount = orderCount == null ? 0 : parseInt(orderCount.textContent);
                let newCount = orderCount == null ? 1 : (currentCount > 4 ? currentCount : currentCount + 1);
                if (orderCount != null) {
                    orderCount.textContent = newCount;
                    orderCount.removeAttribute('hidden');
                }
                order_Notify_Count > 4 ? (notificationList.removeChild(notificationList.lastElementChild)) : '';
                let notificationTime = new Date();
                let currentTime = new Date();
                let diff = Math.floor((currentTime - notificationTime) / 60000);
                let timeAgo = diff > 1 ? diff + ' mins ago' : 'just now';
                let newNotification = `<a href="{{ route('orders.all') }}" class="dropdown-item">
                            <i class="ri-user-fill fs-18 align-middle me-1"></i>
                            <span><b>${data.name}</b></span> Ordered 
                            <p>
                                <small class="text-primary">${timeAgo}</small>
                            </p>
                        </a>`;
                notificationList.insertAdjacentHTML('afterbegin', newNotification);
            }
        });
    </script>

</body>

</html>
