<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#61-title
    |
    */

    'title' => 'Nexus360',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#62-logo
    |
    */

    'logo' => '<b>Nexus360</b>',
    'logo_img' => 'favicon.png',
    'logo_img_class' => 'brand-image-xl',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Nexus360',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#63-layout
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Extra Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#64-classes
    |
    */

    'classes_body' => '',
    'classes_brand' => 'navbar-primary',
    'classes_brand_text' => '',
    'classes_content_header' => 'container-fluid px-4',
    'classes_content' => 'container-fluid px-4',
    'classes_sidebar' => 'sidebar-dark-red bg-primary elevation-2',
    'classes_sidebar_nav' => 'nav-child-indent  nav-legacy',
    'classes_topnav' => 'navbar-light navbar-white border-bottom-0',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#65-sidebar
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#66-control-sidebar-right-sidebar
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#67-urls
    |
    */

    'use_route_url' => false,

    'dashboard_url' => '/',

    'logout_url' => 'logout',

    'login_url' => 'login',

    'register_url' => null,

    'password_reset_url' => 'password/reset',

    'password_email_url' => 'password/email',

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#68-laravel-mix
    |
    */

    'enabled_laravel_mix' => true,

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#69-menu
    |
    */

    'menu' => [
        // [
        //     'text' => 'search',
        //     'search' => true,
        //     'topnav' => true,
        // ],
        [
            'text' => 'Agent Activity',
            'url' => 'agentactivity',
            'icon' => 'fas fa-business-time',
            'can' => 'agentactivity.index'
        ],
        [
            'text' => 'Activity Supervisor',
            'url' => 'agentactivity/supervisor',
            'icon' => 'fas fa-binoculars',
            'can' => 'agentactivity.supervisor'
        ],
        
        [
            'text' => 'CGM',
            'icon' => 'fa fa-cubes',
            'can' => 'cgm.appointmenttracker',
            'submenu' => [
                [
                    'text' => 'Appointment Tracker',
                    'url' => 'cgm/appointmenttracker',
                    'active' => ['cgm/appointmenttracker','cgm/appointmenttracker/*'],
                    'icon' => 'fa fa-calendar-check',
                    'can' => 'cgm.appointmenttracker'
                ],
                [
                    'text' => 'Upload List',
                    'url' => 'cgm/uploadlist',
                    'icon' => 'fa fa-upload',
                    'can' => 'cgm.uploadlist'
                ],
                [
                    'text' => 'Download List',
                    'url' => 'cgm/downloadlists',
                    'icon' => 'fas fa-download',
                    'can' => 'cgm.downloadlists'
                ],
                [
                    'text' => 'QA',
                    'url' => 'cgm/qa',
                    'icon' => 'fas fa-tasks',
                    'can' => 'cgm.qa'
                ],
                [
                    'text' => 'Reports Appointment',
                    'url' => 'cgm/reports',
                    'can' => 'cgm.reports'
                ]

            ]
        ],
        
        [
            'text' => 'Enercare',
            'icon' => 'icon-enercare',
            'can' => 'enercare',
            'submenu' => [
                [
                    'text' => 'Call Tracker',
                    'icon' => 'fas fa-list-ul',
                    'url' => 'enercare/calltracker',
                    'can' => 'enercare.calltracker'
                ],
                [
                    'text' => 'Reports',
                    'icon' => 'fas fa-chart-line',
                    'can' => 'enercare.reports',
                    'submenu' => [
                        [
                            'text' => 'Sales',
                            'url' => 'enercare/reports/sales',
                            'can' => 'enercare.reportsales'
                        ]
                    ]
                ],
                [
                    'text' => 'Uploads',
                    'icon' => 'fa fa-upload',
                    'can' => 'enercare.uploads',
                    'submenu' => [
                        [
                            'text' => 'Agent Performance',
                            'url' => 'enercare/uploads/agentperformance',
                            'can' => 'enercare.uploadagentperformance'
                        ]
                    ]
                ]
            ]
        ],
        
        [
            'text' => 'Reports',
            'icon' => 'fas fa-chart-line',
            'can' => 'agentactivity.report',
            'submenu' => [
                [
                    'text' => 'Agent Activity',
                    'url' => 'agentactivity/report',
                    'can' => 'agentactivity.report'
                ]
            ]
        ],
        
        [
            'text' => 'MANAGEMENT',
            'can'   => 'users.index',
            'icon' => 'fa fa-cog',
            'submenu' => [
                [
                    'text' => 'Users',
                    'url'  => 'users',
                    'active' => ['users', 'users/*'],
                    'icon' => 'fas fa-users',
                    'can'  => 'users.index',
                ],
                [
                    'text' => 'Roles',
                    'url'  => 'roles',
                    'active' => ['roles', 'roles/*'],
                    'icon' => 'fas fa-tags',
                    'can'  => 'roles.index',
                ],
                [
                    'text' => 'Upload MasterFile',
                    'url'  => 'management/uploadmasterfile',
                    'icon' => 'fa fa-upload',
                    'can'  => 'masterfile.upload',
                ],
            ]
        ],





        // [
        //     'text'        => 'pages',
        //     'url'         => 'admin/pages',
        //     'icon'        => 'far fa-fw fa-file',
        //     'label'       => 4,
        //     'label_color' => 'success',
        // ],
        // ['header' => 'account_settings'],
        // [
        //     'text' => 'profile',
        //     'url'  => 'admin/settings',
        //     'icon' => 'fas fa-fw fa-user',
        // ],
        // [
        //     'text' => 'change_password',
        //     'url'  => 'admin/settings',
        //     'icon' => 'fas fa-fw fa-lock',
        // ],
        // [
        //     'text'    => 'multilevel',
        //     'icon'    => 'fas fa-fw fa-share',
        //     'submenu' => [
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text'    => 'level_one',
        //             'url'     => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'level_two',
        //                     'url'  => '#',
        //                 ],
        //                 [
        //                     'text'    => 'level_two',
        //                     'url'     => '#',
        //                     'submenu' => [
        //                         [
        //                             'text' => 'level_three',
        //                             'url'  => '#',
        //                         ],
        //                         [
        //                             'text' => 'level_three',
        //                             'url'  => '#',
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //         ],
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //     ],
        // ],
        // ['header' => 'labels'],
        // [
        //     'text'       => 'important',
        //     'icon_color' => 'red',
        // ],
        // [
        //     'text'       => 'warning',
        //     'icon_color' => 'yellow',
        // ],
        // [
        //     'text'       => 'information',
        //     'icon_color' => 'aqua',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#610-menu-filters
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#611-plugins
    |
    */

    'plugins' => [
        [
            'name' => 'Datatables',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css',
                ],
            ],
        ],
        [
            'name' => 'Select2',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        [
            'name' => 'Chartjs',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        [
            'name' => 'Sweetalert2',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        [
            'name' => 'Pace',
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],
];
