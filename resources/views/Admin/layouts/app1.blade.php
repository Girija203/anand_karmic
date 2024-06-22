<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dyanmic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.ico') }}">

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
                        <a href="index.html" class="logo-light">
                            <span class="logo-lg">
                                <img src="{{ asset('assets/admin/images/logo.png') }}" alt="logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('assets/admin/images/logo-sm.png') }}" alt="small logo">
                            </span>
                        </a>

                        <!-- Logo Dark -->
                        <a href="index.html" class="logo-dark">
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





                    <!--
                        <li class="d-none d-sm-inline-block">
                            <a class="nav-link" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                                <i class="ri-settings-3-line fs-22"></i>
                            </a>
                        </li> -->

                    <!-- <li class="d-none d-sm-inline-block">
                            <div class="nav-link" id="light-dark-mode">
                                <i class="ri-moon-line fs-22"></i>
                            </div>
                        </li> -->

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar">
                                <img src="{{ asset('assets/admin/images/users/avatar-1.jpg') }}" alt="user-image"
                                    width="32" class="rounded-circle">
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
                            <a href="pages-profile.html" class="dropdown-item">
                                <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <a href="pages-profile.html" class="dropdown-item">
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
                            </a>

                            <!-- item-->
                            <a href="{{ route('admin.logout') }}"
                               
                                class="dropdown-item">
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
            <a href="index.html" class="logo logo-light">
                <span class="logo-lg">
                    <img src="{{ asset('assets/admin/images/logo.png') }}" alt="logo">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('assets/admin/images/logo-sm.png') }}" alt="small logo">
                </span>
            </a>

            <!-- Brand Logo Dark -->
            <a href="index.html" class="logo logo-dark">
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

                    <li class="side-nav-title">Main</li>

                    <li class="side-nav-item">
                        <a href="{{ route('dashboard') }}" class="side-nav-link">
                            <i class="ri-dashboard-3-line"></i>
                            <span class="badge bg-success float-end">9+</span>
                            <span> Dashboard </span>
                        </a>
                    </li>

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

                    <li class="side-nav-item">
                        <a href="{{ route('settings.index') }}" class="side-nav-link">
                            <i class="ri-dashboard-3-line"></i>
                            <span> Setting </span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="{{ route('contact_messages.index') }}" class="side-nav-link">
                            <i class="ri-dashboard-3-line"></i>
                            <span> Contact Message </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="{{ route('meta_types.index') }}" class="side-nav-link">
                            <i class="ri-dashboard-3-line"></i>
                            <span>Meta Type</span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="{{ route('meta_keys.index') }}" class="side-nav-link">
                            <i class="ri-dashboard-3-line"></i>
                            <span>Meta Key</span>
                        </a>
                    </li>

                    
                    <li class="side-nav-item">
                        <a href="{{ route('blog_tags.index') }}" class="side-nav-link">
                            <i class="ri-dashboard-3-line"></i>
                            <span>Blog Tag</span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="{{ route('blog_categories.index') }}" class="side-nav-link">
                            <i class="ri-dashboard-3-line"></i>
                            <span>Blog Category</span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="{{ route('blog_posts.index') }}" class="side-nav-link">
                            <i class="ri-dashboard-3-line"></i>
                            <span>Blog Post</span>
                        </a>
                    </li>

                     <li class="side-nav-item">
                        <a href="{{ route('blog_comments.index') }}" class="side-nav-link">
                            <i class="ri-dashboard-3-line"></i>
                            <span>Blog Comment</span>
                        </a>
                    </li>

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
                                    <a href="{{ route('productspecificationkey.index') }}">Product Specification Key</a>
                                </li>
                                <li>
                                    <a href="{{ route('product.create') }}">Product create</a>
                                </li>
                                <li>
                                    <a href="{{ route('product.index') }}">Product </a>
                                </li>
                               

                            </ul>
                        </div>

                        <li class="side-nav-item">
                            <a href="{{ route('inventory.index') }}" class="side-nav-link">
                                <i class="ri-dashboard-3-line"></i>
                                <span>Inventory</span>
                            </a>
                        </li>
    
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
    <script src="{{ asset('assets/admin/js/app.min.js') }}"></script>

</body>

</html>
