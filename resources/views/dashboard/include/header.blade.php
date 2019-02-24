<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Adel Ezz</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    @if(app()->getLocale()=='ar')
        <link rel="stylesheet" href="{{asset('dashboard/rtl/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('dashboard/rtl/dist/css/AdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{asset('dashboard/rtl/dist/css/skins/_all-skins.min.css')}}">
        <link rel="stylesheet" href="{{asset('dashboard/rtl/dist/fonts/fonts-fa.css')}}">
        <link rel="stylesheet" href="{{asset('dashboard/rtl/dist/css/bootstrap-rtl.min.css')}}">
        <link rel="stylesheet" href="{{asset('dashboard/rtl/dist/css/rtl.css')}}">
        <link rel="stylesheet" href="{{asset('dashboard/rtl/dist/css/AdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{asset('dashboard/rtl/dist/fonts/fonts-fa.css')}}">
        <link rel="stylesheet" href="{{asset('dashboard/rtl/dist/css/bootstrap-rtl.min.css')}}">
        <link rel="stylesheet" href="{{asset('dashboard/rtl/dist/css/rtl.css')}}">
    @else
        <link rel="stylesheet" href="{{ asset('dashboard/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/dist/css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/dist/css/skins/skin-blue.min.css') }}">
@endif


@yield('css')
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="{{ url('admin/') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->

                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{ asset('dashboard/') }}/dist/img/user2-160x160.jpg" class="user-image"
                                 alt="User Image">

                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ \Auth::guard('admin')->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{ asset('dashboard/') }}/dist/img/user2-160x160.jpg" class="img-circle"
                                     alt="User Image">

                                <p>
                                    {{ \Auth::guard('admin')->user()->name }}
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ url('/') }}" class="btn btn-default btn-flat">@lang('site')</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('admin/logout') }}" class="btn btn-default btn-flat">@lang('Logout')</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                </ul>
            </div>
        </nav>
    </header>
