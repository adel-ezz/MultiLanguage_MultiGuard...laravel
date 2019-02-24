<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard/') }}/dist/img/user2-160x160.jpg" class="img-circle"
                     alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::guard('admin')->user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">ALL Title</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="@if(Route::current()->getName()=='admins.index')active @endif"><a
                        href="{{ route('admins.index') }}"><i class="fa fa-users"></i> <span>@lang('Admins')</span></a>
            </li>
            <li class="@if(Route::current()->getName()=='departments.index')active @endif"><a
                        href="{{ route('departments.index') }}"><i class="fa fa-bars"></i> <span>@lang('Departments')</span></a>
            </li>
            <li class="@if(Route::current()->getName()=='users.index')active @endif"><a
                        href="{{ route('users.index') }}"><i class="fa fa-bars"></i> <span>@lang('users')</span></a>
            </li>
            {{--<li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>--}}
            {{--{{ dd(strpos(URL::current(),'admin/categories') ) }}--}}
            {{--<li class="treeview @if(strpos(URL::current(),'admin/categories') !== false) active @endif">--}}
            {{--<a href="#"><i class="fa fa-bars"></i> <span>Categories</span>--}}
            {{--<span class="pull-right-container">--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--<ul class="treeview-menu">--}}
            {{--<li class="@if(\Request::path() =="admin/categories") active @endif"><a href="{{ url('admin/categories') }}"><i class="fa fa-server"></i> List All</a></li>--}}
            {{--<li class="@if(\Request::path() =="admin/categories/create") active @endif"><a href="{{ url('admin/categories/create') }}"><i class="fa fa-plus"></i> Add New</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li>
                    <a rel="alternate" hreflang="{{ $localeCode }}"
                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                </li>
            @endforeach
        </ul>




    <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>