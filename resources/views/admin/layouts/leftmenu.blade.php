<?php
$segment= Request::segment(2);
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('/')}}admintheme/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('admin::dashboard')}}" class="nav-link @if($segment=='dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item @if($segment=='manage-users') menu-open @endif">
                    <a href="#" class="nav-link @if($segment=='manage-users') active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Manage Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin::manageUsers')}}" class="nav-link @if($segment=='manage-users') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin::manageSubscription')}}" class="nav-link @if($segment=='manage-subscription-plan') active @endif">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Manage Subscription
                        </p>
                    </a>
                </li>
                {{--<li class="nav-item">--}}
                    {{--<a href="{{route('admin::manageQuestionLevel')}}" class="nav-link @if($segment=='manage-question-level') active @endif">--}}
                        {{--<i class="nav-icon fas fa-list"></i>--}}
                        {{--<p>--}}
                            {{--Manage Question Level--}}
                        {{--</p>--}}
                    {{--</a>--}}
                {{--</li>--}}
                <li class="nav-item">
                    <a href="{{route('admin::manageCoupon')}}" class="nav-link @if($segment=='manage-coupons') active @endif">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Manage Coupons
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin::manageUserSubscription')}}" class="nav-link @if($segment=='manage-teacher-subscription') active @endif">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Teacher Subscriptions
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>