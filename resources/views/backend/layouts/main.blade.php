<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="{{asset('img/Logo_Padang.ico')}}" />

    <title>@yield('title', 'CMS Laravel')</title>

    <!-- Custom fonts for this template-->
    @include('backend.layouts.css')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('admin')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <li class="nav-item @yield('dashboard-admin')">
                <a class="nav-link" href="{{url('admin')}}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Data Master
            </div>
            <li class="nav-item @yield('author')">
                <a class="nav-link " href="{{url('admin/author')}}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Author</span>
                </a>
            </li>
            <li class="nav-item @yield('category')">
                <a class="nav-link " href="{{url('admin/category')}}">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Category</span>
                </a>
            </li>
            <li class="nav-item @yield('tag')">
                <a class="nav-link " href="{{url('admin/tag')}}">
                    <i class="fas fa-fw fa-tag"></i>
                    <span>Tag</span>
                </a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item @yield('article')">
                <a class="nav-link " href="{{url('admin/article')}}">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>Article</span>
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="row">
                                    <div class="col">
                                        @if (Auth::check())
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name}}</span>
                                        @else
                                            <!-- Guest display -->
                                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Guest</span>
                                        @endif

                                    </div>
                                </div>
                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }} ">
                            </a>
                            <!-- Dropdown - User Information -->
                            @if (Auth::check())
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>                                    
                                </div>
                            @endif
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Do you want to end session?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Choose "Yes" if you want to logout</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                    @if(Auth::check())
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-primary">Yes</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('backend.layouts.js')
</body>

</html>
