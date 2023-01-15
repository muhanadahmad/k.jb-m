<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">Dashboard</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    </li>
                    <!-- menu item todo-->
                    <li>
                        <a href="{{route('category.index')}}"><i class="ti-menu-alt"></i><span class="right-nav-text">Category
                                </span> </a>
                    </li>

                    <li>
                        <a href="{{route('product.index')}}"><i class="ti-menu-alt"></i><span class="right-nav-text">Product
                                </span> </a>
                    </li>


                    <li>
                        <a href="{{route('store.index')}}"><i class="ti-menu-alt"></i><span class="right-nav-text">Store
                                </span> </a>
                    </li>


                    <li>
                        <a href="{{route('user.index')}}"><i class="ti-menu-alt"></i><span class="right-nav-text">User
                                </span> </a>
                    </li>

                    <li>
                        <a href="{{route('setting.edit')}}"><i class="ti-menu-alt"></i><span class="right-nav-text">Setting
                                </span> </a>
                    </li>



                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
