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

    'title' => 'HR - Management',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
        | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#62-favicon
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#63-logo
    |
    */

    'logo' => '<b>HR-Management</b>',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'HR-Management',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#64-user-menu
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#65-layout
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#661-authentication-views-classes
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#662-admin-panel-classes
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => 'container-fluid',
    'classes_content' => 'container-fluid',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/#67-sidebar
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/#68-control-sidebar-right-sidebar
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/#69-urls
    |
    */

    'use_route_url' => false,

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'login_url' => 'login',

    'register_url' => 'register',

    'password_reset_url' => 'password/reset',

    'password_email_url' => 'password/email',

    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#610-laravel-mix
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#611-menu
    |
    */

    'menu' => [
        [
            'text'        => 'Trang Chủ',
            'url'         => '/home',
            'icon'        => 'fas fa-tachometer-alt',
            'can'         => 'not_system',
            'submenu' => [
//
            [
                'text'    => 'Quản Lý Nhân Sự',
                'icon'    => 'fas fa-users',
                'can'         => 'not_systems',
                'can' => 'view_menu',
                'submenu' => [
                    [
                        'text' => 'Nhân sự',
                        'url'  => 'admin/user',
                    ],
                    [
                        'text' => 'Khu Vực',
                        'url'  => 'admin/area',
                    ],
//                [
//                    'text'    => 'Quản Lý',
//                    'icon'    => 'fas fa-users',
//                    'submenu' =>[
//                        [
//                            'text' => 'Chi Tiết Nhân Sự',
//                            'url'  => 'report/report_with_time',
//                        ],
//                        [
//                            'text' => 'Position',
//                            'url'  => 'admin/position',
//                        ],
                    [
                        'text' => 'Cửa Hàng',
                        'url'  => 'admin/store',
                    ],
//                        [
//                            'text' => 'Department',
//                            'url'  => 'admin/department',
//                        ],
//                        [
//                            'text' => 'Service',
//                            'url'  => 'admin/service',
//                        ],
//                    ]
//                ]


                ],
            ],
//
            [
                'text'    => 'THỐNG KÊ ',
                'icon'    => 'fas fa-clipboard-list',
                'submenu' => [
//                [
//                    'text' => 'Báo Cáo Theo Thời Gian',
//                    'url'  => 'report/report_with_time',
//                ],
//                [
//                    'text' => 'Báo Cáo Theo Nhân Viên',
//                    'url'  => 'report/report_with_user',
//                ],
                    [
                        'text' => '	Thống Kê Chấm Công',
                        'url'  => 'request/report_view',
                    ],
//                [
//                    'text' => 'Thống Kê Hợp Đồng',
//                    'url'  => 'admin/contract',
//                ],
                ],
            ],
            [
                'text'    => 'QUẢN LÝ CHẤM CÔNG',
                'icon'    => 'fas fa-blender-phone',
                'submenu' => [

//                [
//                    'text' => '	Chấm Công',
//                    'url'  => 'timekeeping/timekeeping_for_staff',
//                ],
                    [
                        'text' => 'Chấm Công Tháng',
                        'url'  => 'timekeeping/request_timekeeping',
                    ],
                    [
                        'text' => '	Quản Lý Chấm Công ',
                        'url'  => 'timekeeping/request_timekeeping/request_month',
                    ],


                ],
            ],
        ],
        ],
        [
            'text'        => 'Trang Chủ',
            'url'         => '/home1',
            'icon'        => 'fas fa-tachometer-alt',
            'can'         => 'system',
            'submenu' => [
                [
                    'text'    => 'Tạo tài khoản Admin 2',
                    'icon'    => 'fas fa-clipboard-list',
                    'url'     => '/admin1/view',
                    'can'     => 'admin_lv1'
                ],
                [
                    'text'    => 'Quản Lý Kho',
                    'icon'    => 'fas fa-clipboard-list',
                    'url'     => '/admin1/warehouse',
                    'can'     => 'admin_lv1'
                ],
                [
                    'text'    => 'Quản Lý Kết Nối',
                    'icon'    => 'fas fa-clipboard-list',
                    'can'     => 'admin_lv1',
                    'submenu' => [
                        [
                            'text'    => 'Landing page bán hàng',
                            'icon'    => 'fas fa-clipboard-list',
                            'url'     => '/admin1/connect/landingpage',
                            'can'     => 'admin_lv1'
                        ],
]
                ],
                [
                    'text'    => 'Tạo  người dùng ',
                    'icon'    => 'fas fa-clipboard-list',
                    'url'     => 'admin2/view',
                    'can'     => 'admin_lv2'
                ],
                [
                    'text'    => 'Quản lý nhà cung cấp',
                    'icon'    => 'fas fa-clipboard-list',
                    'url'     => '/admin2/supplier',
                    'can'     => 'admin_lv2'
                ],
                [
                    'text'    => 'Đối tác vận chuyển',
                    'icon'    => 'fas fa-clipboard-list',
                    'url'     => '/admin2/transporter',
                    'can'     => 'admin_lv2'
                ],
                [
                    'text'    => 'Sản Phẩm',
                    'icon'    => 'fas fa-clipboard-list',
                    'can'     => 'admin_lv2',
                    'submenu' =>[
                        [
                            'text'    => 'Thêm Sản Phẩm',
                            'url'     => '/admin2/product/add/new',
                            'can'     => 'admin_lv2',
                        ],
                       [
                           'text'    => 'Quản lý Sản Phẩm',
                           'url'     => '/admin2/product',
                           'can'     => 'admin_lv2',
                       ] ,
                    ]
                ],
                [
                    'text'    => 'Quản lý Kho',
                    'icon'    => 'fas fa-clipboard-list',
                    'can'     => 'admin_lv2',
                    'submenu' =>[
                        [
                            'text'    => 'Chuyển Sản Phẩm',
                            'url'     => '/admin2/chuyen_san_pham',
                            'can'     => 'admin_lv2',
                        ] ,
                        [
                            'text'    => 'Xác Nhận Sản Phẩm',
                            'url'     => '/admin2/tiep_nhan_san_pham',
                            'can'     => 'admin_lv2',
                        ],
                    ]
                ],
                [
                    'text'    => 'chương trình khuyến mại',
                    'icon'    => 'fas fa-clipboard-list',
                    'can'     => 'admin_lv2',
                    'submenu' =>[
                        [
                            'text'    => 'Tạo khuyến mại',
                            'url'     => '/admin2/sales_product',
                            'can'     => 'admin_lv2'
                        ],
                        [
                            'text'    => 'Danh Sách khuyến mại',
                            'url'     => '/admin2/list_sales_product',
                            'can'     => 'admin_lv2'
                        ],
                    ]
                ],
                [
                    'text'    => 'Chương trình thi đua',
                    'icon'    => 'fas fa-clipboard-list',
                    'can'     => 'admin_lv2',
                    'submenu'=>[

                        [
                            'text'    => 'Tạo chương trình thi đua',
                            'url'     => '/admin2/emulation_product',
                            'can'     => 'admin_lv2'
                        ],
                        [
                            'text'    => 'Danh sách chương trình',
                            'url'     => '/admin2/list_emulation_product',
                            'can'     => 'admin_lv2'
                        ],
                    ]
                ],
                [
                    'text'    => 'Giao mục tiêu bán hàng',
                    'icon'    => 'fas fa-clipboard-list',
                    'can'     => 'admin_lv2',
                    'submenu' => [
                        [
                            'text'    => 'Giao mục tiêu bán hàng',
                            'url'     => '/admin2/goal_product',
                            'can'     => 'admin_lv2'
                        ],
                        [
                            'text'    => 'Quản lý mục tiêu ',
                            'url'     => '/admin2/list_goal_product',
                            'can'     => 'admin_lv2'
                        ],
                    ]
                ],
                [
                    'text'    => 'Quản lý Nhóm',
                    'icon'    => 'fas fa-clipboard-list',
                    'url'     => 'admin2/group',
                    'can'     => 'admin_lv2'
                ],
                [
                    'text'    => 'Tạo Hạn Mức Thu Tiền',
                    'icon'    => 'fas fa-clipboard-list',
                    'url'     => '/admin2/add_han_muc',
                    'can'     => 'admin_lv2'
                ],
                [
                    'text'    => 'Quản lý Người Dùng',
                    'icon'    => 'fas fa-clipboard-list',
                    'url'     => '/admin2/lock_acc_user',
                    'can'     => 'admin_lv2'
                ],
                [
                    'text'    => 'Quản lý Hoàn Ứng',
                    'icon'    => 'fas fa-clipboard-list',
                    'url'     => 'admin2/danh_sach_hoan_ung',
                    'can'     => 'admin_lv2'
                ],
//                [
//                    'text'    => 'Truy cập Thông tin cá nhân',
//                    'icon'    => 'fas fa-clipboard-list',
//                    'url'     => '/user1/view_information',
//                    'can'     => 'user_lv1'
//                ],
                [
                    'text'    => 'Sản Phẩm',
                    'icon'    => 'fas fa-clipboard-list',
                    'can'     => 'user_lv2',
                    'submenu' =>[
                        [
                            'text'    => 'Quản lý Sản Phẩm',
                            'url'     => '/user2/list_product',
                            'can'     => 'user_lv2',
                        ] ,
                        [
                            'text'    => 'Bán Hàng',
                            'url'     => '/user2/list_view_product',
                            'can'     => 'user_lv2',
                        ] ,
                        [
                            'text'    => 'Hoàn Trả Ứng Tiền',
                            'url'     => 'user2/danh_sach_hoan_ung',
                            'can'     => 'user_lv2',
                        ] ,
                        [
                            'text'    => 'Giao Hàng',
                            'url'     => 'user2/danh_sach_giao_hang',
                            'can'     => 'user_lv2',
                        ] ,
                    ]
                ],
                [
                    'text'    => 'Khóa Tài Khoản Người Dùng',
                    'icon'    => 'fas fa-clipboard-list',
                    'url'     => '/user1/lock_acc_user',
                    'can'     => 'user_lv1'
                ],
                [
                    'text'    => 'Phân Quyền Sản Phẩm',
                    'icon'    => 'fas fa-clipboard-list',
                    'url'     => '/user1/phan_quyen_san_pham',
                    'can'     => 'user_lv1'
                ],
                [
                    'text'    => 'Kiểm tra hoàn ứng',
                    'icon'    => 'fas fa-clipboard-list',
                    'url'     => 'ktkt/danh_sach_hoan_ung',
                    'can'     => 'ktkt'
                ],

            ]
        ],
        // ['header' => 'labels'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#612-menu-filters
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#613-plugins
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
