@extends('adminlte::master')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body',
    (config('adminlte.sidebar_mini', true) === true ?
        'sidebar-mini ' :
        (config('adminlte.sidebar_mini', true) == 'md' ?
         'sidebar-mini sidebar-mini-md ' : '')
    ) .
    (config('adminlte.layout_topnav') || View::getSection('layout_topnav') ? 'layout-top-nav ' : '') .
    (config('adminlte.layout_boxed') ? 'layout-boxed ' : '') .
    (!config('adminlte.layout_topnav') && !View::getSection('layout_topnav') ?
        (config('adminlte.layout_fixed_sidebar') ? 'layout-fixed ' : '') .
        (config('adminlte.layout_fixed_navbar') === true ?
            'layout-navbar-fixed ' :
            (isset(config('adminlte.layout_fixed_navbar')['xs']) ? (config('adminlte.layout_fixed_navbar')['xs'] == true ? 'layout-navbar-fixed ' : 'layout-navbar-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_navbar')['sm']) ? (config('adminlte.layout_fixed_navbar')['sm'] == true ? 'layout-sm-navbar-fixed ' : 'layout-sm-navbar-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_navbar')['md']) ? (config('adminlte.layout_fixed_navbar')['md'] == true ? 'layout-md-navbar-fixed ' : 'layout-md-navbar-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_navbar')['lg']) ? (config('adminlte.layout_fixed_navbar')['lg'] == true ? 'layout-lg-navbar-fixed ' : 'layout-lg-navbar-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_navbar')['xl']) ? (config('adminlte.layout_fixed_navbar')['xl'] == true ? 'layout-xl-navbar-fixed ' : 'layout-xl-navbar-not-fixed ') : '')
        ) .
        (config('adminlte.layout_fixed_footer') === true ?
            'layout-footer-fixed ' :
            (isset(config('adminlte.layout_fixed_footer')['xs']) ? (config('adminlte.layout_fixed_footer')['xs'] == true ? 'layout-footer-fixed ' : 'layout-footer-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_footer')['sm']) ? (config('adminlte.layout_fixed_footer')['sm'] == true ? 'layout-sm-footer-fixed ' : 'layout-sm-footer-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_footer')['md']) ? (config('adminlte.layout_fixed_footer')['md'] == true ? 'layout-md-footer-fixed ' : 'layout-md-footer-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_footer')['lg']) ? (config('adminlte.layout_fixed_footer')['lg'] == true ? 'layout-lg-footer-fixed ' : 'layout-lg-footer-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_footer')['xl']) ? (config('adminlte.layout_fixed_footer')['xl'] == true ? 'layout-xl-footer-fixed ' : 'layout-xl-footer-not-fixed ') : '')
        )
        : ''
    ) .
    (config('adminlte.sidebar_collapse') || View::getSection('sidebar_collapse') ? 'sidebar-collapse ' : '') .
    (config('adminlte.right_sidebar') && config('adminlte.right_sidebar_push') ? 'control-sidebar-push ' : '') .
    config('adminlte.classes_body')
)

@section('body_data',
(config('adminlte.sidebar_scrollbar_theme', 'os-theme-light') != 'os-theme-light' ? 'data-scrollbar-theme=' . config('adminlte.sidebar_scrollbar_theme')  : '') . ' ' . (config('adminlte.sidebar_scrollbar_auto_hide', 'l') != 'l' ? 'data-scrollbar-auto-hide=' . config('adminlte.sidebar_scrollbar_auto_hide')   : ''))

@php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $logout_url = $logout_url ? route($logout_url) : '' )
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('body')
    <div class="wrapper">
        @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))
        <nav class="main-header navbar {{config('adminlte.classes_topnav_nav', 'navbar-expand-md')}} {{config('adminlte.topnav_color', 'navbar-white navbar-light')}}">
            <div class="{{config('adminlte.classes_topnav_container', 'container')}}">
                @if(config('adminlte.logo_img_xl'))
                    <a href="{{ $dashboard_url }}" class="navbar-brand logo-switch">
                        <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}" alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}" class="{{config('adminlte.logo_img_class', 'brand-image-xl')}} logo-xs">
                        <img src="{{ asset(config('adminlte.logo_img_xl')) }}" alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}" class="{{config('adminlte.logo_img_xl_class', 'brand-image-xs')}} logo-xl">
                    </a>
                @else
                    <a href="{{ $dashboard_url }}" class="navbar-brand {{ config('adminlte.classes_brand') }}">
                        <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}" alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}" class="brand-image img-circle elevation-3" style="opacity: .8">
                        <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </span>
                    </a>
                @endif

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="nav navbar-nav">
                        @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                    </ul>
                </div>
            @else
            <nav class="main-header navbar {{config('adminlte.classes_topnav_nav', 'navbar-expand-md')}} {{config('adminlte.classes_topnav', 'navbar-white navbar-light')}}">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" @if(config('adminlte.sidebar_collapse_remember')) data-enable-remember="true" @endif @if(!config('adminlte.sidebar_collapse_remember_no_transition')) data-no-transition-after-reload="false" @endif @if(config('adminlte.sidebar_collapse_auto_size')) data-auto-collapse-size="{{config('adminlte.sidebar_collapse_auto_size')}}" @endif>
                            <i class="fas fa-bars"></i>
                            <span class="sr-only">{{ __('adminlte::adminlte.toggle_navigation') }}</span>
                        </a>
                    </li>
                    @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                    @yield('content_top_nav_left')
                </ul>
            @endif
                <ul class="navbar-nav ml-auto @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))order-1 order-md-3 navbar-no-expand @endif">
                    @yield('content_top_nav_right')
                    @if(Auth::user())
                        
                    <li class="nav-item dropdown user-menu">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="/img/user.jpg" class="user-image img-circle elevation-2" alt="User Image">
                                <span class="d-none d-md-inline">{{Auth::user()->name}}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                     <i class="fa fa-fw fa-power-off"></i> {{ __('adminlte::adminlte.log_out') }}
                                </a>
                                <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                                        @if(config('adminlte.logout_method'))
                                            {{ method_field(config('adminlte.logout_method')) }}
                                        @endif
                                        {{ csrf_field() }}
                                    </form>
                            </div>
                        </li>




                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            >
                                <i class="fa fa-fw fa-power-off"></i> {{ __('adminlte::adminlte.log_out') }}
                            </a>
                            <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                                @if(config('adminlte.logout_method'))
                                    {{ method_field(config('adminlte.logout_method')) }}
                                @endif
                                {{ csrf_field() }}
                            </form>
                        </li> --}}
                    @endif
                    @if(config('adminlte.right_sidebar'))
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-widget="control-sidebar" @if(!config('adminlte.right_sidebar_slide')) data-controlsidebar-slide="false" @endif @if(config('adminlte.right_sidebar_scrollbar_theme', 'os-theme-light') != 'os-theme-light') data-scrollbar-theme="{{config('adminlte.right_sidebar_scrollbar_theme')}}" @endif @if(config('adminlte.right_sidebar_scrollbar_auto_hide', 'l') != 'l') data-scrollbar-auto-hide="{{config('adminlte.right_sidebar_scrollbar_auto_hide')}}" @endif>
                                <i class="{{config('adminlte.right_sidebar_icon')}}"></i>
                            </a>
                        </li>
                    @endif
                </ul>
                @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))
                    </nav>
                @endif
            </nav>
        @if(!config('adminlte.layout_topnav') && !View::getSection('layout_topnav'))
        <aside class="main-sidebar {{config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4')}}">
            @if(config('adminlte.logo_img_xl'))
                <a href="{{ $dashboard_url }}" class="brand-link logo-switch">
                    <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}" alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}" class="{{config('adminlte.logo_img_class', 'brand-image-xl')}} logo-xs">
                    <img src="{{ asset(config('adminlte.logo_img_xl')) }}" alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}" class="{{config('adminlte.logo_img_xl_class', 'brand-image-xs')}} logo-xl">
                </a>
            @else
                <a href="{{ $dashboard_url }}" class="brand-link {{ config('adminlte.classes_brand') }}">
                    <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}" alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
                        {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                    </span>
                </a>
            @endif
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column {{config('adminlte.classes_sidebar_nav', '')}}" data-widget="treeview" role="menu" @if(config('adminlte.sidebar_nav_animation_speed') != 300) data-animation-speed="{{config('adminlte.sidebar_nav_animation_speed')}}" @endif @if(!config('adminlte.sidebar_nav_accordion')) data-accordion="false" @endif>
                        @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                    </ul>
                </nav>
            </div>
        </aside>
        @endif

        <div class="content-wrapper">
                
            @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))
            <div class="container">
            @endif

            <div class="content-header">
                <div class="{{config('adminlte.classes_content_header', 'container-fluid')}}">
                    @yield('content_header')
                </div>
            </div>
            
            <div class="content">
                <div class="{{config('adminlte.classes_content', 'container-fluid')}}">
                    <hr class="mt-0">
                        
                    @if(session('info'))
                                <div class="alert alert-success alertinfo">
                                    {{ session('info') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                    @endif
                    @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                    @endif

                 

                    <div class="modal fade" id="logoLoading" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                    data-keyboard="false" data-backdrop="static" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content shadow-none border-0 text-center">
                                <div class="modal-body ">
                                    <div class="row">
                                        <div class="col"></div>
                                        <div class="col"><img src="{{ asset('img/LOGOCP360.gif') }}" class="img-fluid"></div>
                                        <div class="col"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @cannot('login.withoutmf')
                    <wfm-update-popup-component></wfm-update-popup-component>
                    @endcannot

                    <iframe style="display: none;" src="{{'http://'. request()->getHost().':3000/popups'}}" frameborder="0" id="ifm_reminder"></iframe>
                    @yield('content')
                </div>
            </div>
            @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))
            </div>
            @endif
        </div>

        {{-- @hasSection('footer') --}}
        <footer class="main-footer">

                <strong>Copyright &copy; 2019 <a href="">Contact Point 360</a>.</strong> All rights reserved.
            {{-- @yield('footer') --}}
        </footer>
        {{-- @endif --}}

        @if(config('adminlte.right_sidebar'))
            <aside class="control-sidebar control-sidebar-{{config('adminlte.right_sidebar_theme')}}">
                @yield('right-sidebar')
            </aside>
        @endif

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
    <script>
        const popupCenter = ({url, w, h}) => {
            const dualScreenLeft = window.screenLeft !==  undefined ? window.screenLeft : window.screenX;
            const dualScreenTop = window.screenTop !==  undefined   ? window.screenTop  : window.screenY;
            const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
            const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
            const systemZoom = width / window.screen.availWidth;
            const left = (width - w) / 2 / systemZoom + dualScreenLeft
            const top = (height - h) / 2 / systemZoom + dualScreenTop
            const newWindow = window.open(url, '', 
            `
            postwindow,
            scrollbars=yes,
            width=${w / systemZoom}, 
            height=${h / systemZoom}, 
            top=${top}, 
            left=${left}
            `
            )
            if (window.focus) newWindow.focus();
            return newWindow
        }

        function PopupBlocked() {
            var PUtest = window.open(null,"","width=100,height=100");
            try {PUtest.close();localStorage.setItem("pop-up",new Date());return false;}
            catch(e) {alert('Pop-ups blocked.\n\n¡¡Please Enable It!!'); return true; }
        }

        if(localStorage.getItem("pop-up")){
            var datePopup = new Date(localStorage.getItem("pop-up"));
            var dateToday = new Date();
            var Difference_In_Time  = dateToday.getTime() - datePopup.getTime();
            var Difference_In_Days = Math.trunc(Difference_In_Time / (1000 * 3600 * 24));
            if (Difference_In_Days>0) {
                localStorage.removeItem("pop-up");
                PopupBlocked();
            }
        }else{
            PopupBlocked();
        }

        window.addEventListener("message", receiveReminder, false);
        function receiveReminder(event){
            let data = event.data;
            if(data.reminder && data.users){
                if(data.users.includes(window.userId)){
                    var popWindow = popupCenter({url: '/reminders/popup',  w: 900, h: 500}); 
                    popWindow.onload = function() {
                        popWindow.postMessage({msg:data.reminder});
                    };
                }
            }
        }
    </script>
@stop
