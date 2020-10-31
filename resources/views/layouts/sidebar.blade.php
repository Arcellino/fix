<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
            @if(Auth::user()->gambar == '')
                <img src="{{ asset('user.png') }} " class="rounded-circle" alt="User Image">
            @else
                <img class="rounded-circle" src="{{asset('images/user/'.Auth::user()->gambar)}}" alt="User Image">
            @endif
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name  }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->

            <li class="active"><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            @if(Auth::user()->level == 'admin')
            <li class="active"><a href="{{ route('user.index') }}"><i class="fa fa-user"></i> <span>Account</span></a></li>
            <li class="active"><a href="{{ route('categories.index') }}"><i class="fa fa-folder-o"></i> <span>Kategori</span></a></li>
            <li class="active"><a href="{{ route('materials.index') }}"><i class="fa fa-industry"></i> <span>Material</span></a></li>
            @endif
            
            @if(Auth::user()->level == 'admin')
            <li class="active"><a href="{{ route('customers.index') }}"><i class="fa fa-handshake-o"></i> <span>Customer</span></a></li>
            <li class="active"><a href="{{ route('suppliers.index') }}"><i class="fa fa-users"></i> <span>Supplier</span></a></li>
            <li class="active"><a href="{{ route('materialsOut.index') }}"><i class="fa fa-upload"></i> <span>Material Keluar</span></a></li>
            <li class="active"><a href="{{ route('materialsIn.index') }}"><i class="fa fa-download"></i> <span>Material Masuk</span></a></li>
            
            @endif
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
