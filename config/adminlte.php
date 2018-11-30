<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Title
      |--------------------------------------------------------------------------
      |
      | The default title of your admin panel, this goes into the title tag
      | of your page. You can override it per page with the title section.
      | You can optionally also specify a title prefix and/or postfix.
      |
     */

    'title' => 'Mun\'s shop',
    'title_prefix' => '',
    'title_postfix' => '',
    /*
      |--------------------------------------------------------------------------
      | Logo
      |--------------------------------------------------------------------------
      |
      | This logo is displayed at the upper left corner of your admin panel.
      | You can use basic HTML here if you want. The logo has also a mini
      | variant, used for the mini side bar. Make it 3 letters or so
      |
     */
    'logo' => '<b>Mun\'s shop</b>',
    'logo_mini' => '<b>MUN</b>',
    /*
      |--------------------------------------------------------------------------
      | Skin Color
      |--------------------------------------------------------------------------
      |
      | Choose a skin color for your admin panel. The available skin colors:
      | blue, black, purple, yellow, red, and green. Each skin also has a
      | ligth variant: blue-light, purple-light, purple-light, etc.
      |
     */
    'skin' => 'purple',
    /*
      |--------------------------------------------------------------------------
      | Layout
      |--------------------------------------------------------------------------
      |
      | Choose a layout for your admin panel. The available layout options:
      | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
      | removes the sidebar and places your menu in the top navbar
      |
     */
    'layout' => null,
    /*
      |--------------------------------------------------------------------------
      | Collapse Sidebar
      |--------------------------------------------------------------------------
      |
      | Here we choose and option to be able to start with a collapsed side
      | bar. To adjust your sidebar layout simply set this  either true
      | this is compatible with layouts except top-nav layout option
      |
     */
    'collapse_sidebar' => false,
    /*
      |--------------------------------------------------------------------------
      | URLs
      |--------------------------------------------------------------------------
      |
      | Register here your dashboard, logout, login and register URLs. The
      | logout URL automatically sends a POST request in Laravel 5.3 or higher.
      | You can set the request to a GET or POST with logout_method.
      | Set register_url to null if you don't want a register link.
      |
     */
    'dashboard_url' => 'admin',
    'logout_url' => 'logout',
    'logout_method' => null,
    'login_url' => 'admin/login',
    'register_url' => 'register',
    /*
      |--------------------------------------------------------------------------
      | Menu Items
      |--------------------------------------------------------------------------
      |
      | Specify your menu items to display in the left sidebar. Each menu item
      | should have a text and and a URL. You can also specify an icon from
      | Font Awesome. A string instead of an array represents a header in sidebar
      | layout. The 'can' is a filter on Laravel's built in Gate functionality.
      |
     */
    'menu' => [
        'Trang chủ',
        [
            'text' => 'Dashboard',
            'icon' => 'dashboard',
            'url' => 'admin/'
        ],
        'Khách hàng',
        [
            'text' => 'Quản lý khách hàng',
            'icon' => 'user-circle-o',
            'submenu' => [
                [
                    'text' => 'Danh sách khách hàng',
                    'icon' => 'list',
                    'url' => 'admin/customer',
                ],
                [
                    'text' => 'Danh sách nhóm khách hàng',
                    'icon' => 'list',
                    'url' => 'admin/customer-group',
                ]
            ]
        ],
        'Đơn hàng',
        [
            'text' => 'Quản lý đơn hàng',
            'icon' => 'dollar',
            'submenu' => [
                [
                    'text' => 'Danh sách đơn hàng',
                    'icon' => 'list',
                    'url' => 'admin/order',
                ],
                [
                    'text' => 'Thống kê doanh số',
                    'icon' => 'bar-chart',
                    'url' => '#',
                ]
            ],
        ],
        'Kho hàng',
        [
            'text' => 'Quản lý kho hàng',
            'icon' => 'check-square-o',
            'submenu' => [
                [
                    'text' => 'Sản phẩm trong kho',
                    'icon' => 'list',
                    'url' => 'admin/product-storage',
                ],
                [
                    'text' => 'Thống kê hàng tồn',
                    'icon' => 'list',
                    'url' => '#',
                ]
            ]
        ],
        'Sản phẩm',
        [
            'text' => 'Quản lý sản phẩm',
            'icon' => 'product-hunt',
            'submenu' => [
                [
                    'text' => 'Danh sách mẫu mã',
                    'icon' => 'list',
                    'url' => 'admin/production',
                ],
                [
                    'text' => 'Danh sách sản phẩm',
                    'icon' => 'list',
                    'url' => 'admin/production/detail',
                ],

                [
                    'text' => 'Quản lý size sản phẩm',
                    'icon' => 'list',
                    'url' => 'admin/product-size',
                ],
                [
                    'text' => 'Quản lý màu sản phẩm',
                    'icon' => 'list',
                    'url' => 'admin/product-color',
                ],
            ]
        ],
        'Tools',
        [
            'text' => 'Facebook',
            'icon' => 'facebook-f',
            'submenu' => [
                [
                    'text' => 'Share automation',
                    'icon' => 'list',
                    'url' => '#',
                ]
            ]
        ],
//        [
//            'text' => 'Quản lý thẻ',
//            'icon' => 'credit-card',
//            'submenu' => [
//                [
//                    'text' => 'Danh sách thẻ',
//                    'icon' => 'list',
//                    'url' => 'admin/card/list',
//                ],
//                [
//                    'text' => 'Thống kê',
//                    'icon' => 'bar-chart',
//                    'url' => 'admin/card/statistic',
//                ],
//                [
//                    'text' => 'Xuất thẻ',
//                    'icon' => 'credit-card',
//                    'url' => 'admin/card/form-export',
//                ],
//                [
//                    'text' => 'Thống kê thẻ',
//                    'icon' => 'bar-chart',
//                    'url' => 'admin/card/statistic-card',
//                ],
//                [
//                    'text' => 'Lấy lại danh sách thẻ',
//                    'icon' => 'credit-card',
//                    'url' => 'admin/card/forgot-excel',
//
//                ]
//            ],
//        ],
//        [
//            'text' => 'Quản lý giao dịch',
//            'icon' => 'amazon',
//            'submenu' => [
//                [
//                    'text' => 'Lịch sử mua thẻ',
//                    'icon' => 'money',
//                    'url' => 'admin/transaction',
//                ],
//                [
//                    'text' => 'Lịch sử nạp tiền',
//                    'icon' => 'bitcoin',
//                    'url' => 'admin/deposit',
//                ]
//            ],
//        ],
//        [
//            'text' => 'Quản lý Log',
//            'icon' => 'file-text-o',
//            'submenu' => [
//                [
//                    'text' => 'Log sử dụng',
//                    'icon' => 'list',
//                    'url' => 'admin/log/list',
//                ],
//                [
//                    'text' => 'Log cộng tiền',
//                    'icon' => 'list',
//                    'url' => 'admin/deposit/log',
//                ]
//            ],
//        ],
//        [
//            'text' => 'Quản lý cộng tiền',
//            'icon' => 'dollar',
//            'submenu' => [
////                [
////                    'text' => 'Cộng tiền đại lý v1',
////                    'icon' => 'dollar',
////                    'url' => 'admin/managemoney/add-money',
////                ],
//                [
//                    'text' => 'Cộng tiền đại lý v2',
//                    'icon' => 'dollar',
//                    'url' => 'admin/managemoney/add-money-v2',
//                ],
//            ],
//        ],
//        'User',
//        [
//            'text' => 'Quản lý user',
//            'icon' => 'group',
//            'submenu' => [
//                [
//                    'text' => 'Danh sách user',
//                    'icon' => 'list',
//                    'url' => 'admin/user/list',
//                ]
//            ],
//        ],
//        'Hệ thống',
//        [
//            'text' => 'Quản lý hệ thống',
//            'icon' => 'cloud',
//            'submenu' => [
//                [
//                    'text' => 'Clear cache',
//                    'icon' => 'trash-o',
//                    'url' => 'admin/applications/clear-cache',
//                ],
//                [
//                    'text' => 'Error Log',
//                    'icon' => 'warning',
//                    'url' => 'admin/applications/error-logs',
//                ],
//            ],
//        ],
//        [
//            'text' => 'Quản lý banner',
//            'icon' => 'cloud',
//            'submenu' => [
//                [
//                    'text' => 'Upload banner',
//                    'icon' => 'upload',
//                    'url' => 'admin/banner',
//                ],
//            ],
//        ],
//        [
//            'text' => 'Kiểm tra',
//            'icon' => 'check-square-o',
//            'submenu' => [
//                [
//                    'text' => 'Check Card',
//                    'icon' => 'check-circle-o',
//                    'url' => 'admin/cron/check-card',
//                ],
//                [
//                    'text' => 'Check Order',
//                    'icon' => 'check-circle-o',
//                    'url' => 'admin/cron/check-order',        
//                ],
//            ],
//        ],
//		
//		'Giao hàng tiết kiệm',
//        [
//            'text' => 'Quản lý giao hàng tiết kiệm',
//            'icon' => 'file-text-o',
//            'submenu' => [
//                [
//                    'text' => 'Thêm đại lý con',
//                    'icon' => 'list',
//                    'url' => 'admin/ghtk/index',
//                ]
//
//            ],
//        ],
//
//        'Tài khoản đại lý',
//        [
//            'text' => 'Quản lý tk đại lý',
//            'icon' => 'cloud',
//            'submenu' => [
//                [
//                    'text' => 'Thêm đại lý cấp 1',
//                    'icon' => 'list',
//                    'url' => 'admin/project/view-child-project',
//                ],
//                [
//                    'text' => 'Thêm đại lý cấp 2',
//                    'icon' => 'list',
//                    'url' => 'admin/project/view-child-project-level-2',
//                ]
//
//            ],
//        ],
    ],
    /*
      |--------------------------------------------------------------------------
      | Menu Filters
      |--------------------------------------------------------------------------
      |
      | Choose what filters you want to include for rendering the menu.
      | You can add your own filters to this array after you've created them.
      | You can comment out the GateFilter if you don't want to use Laravel's
      | built in Gate functionality
      |
     */
    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],
    /*
      |--------------------------------------------------------------------------
      | Plugins Initialization
      |--------------------------------------------------------------------------
      |
      | Choose which JavaScript plugins should be included. At this moment,
      | only DataTables is supported as a plugin. Set the value to true
      | to include the JavaScript file from a CDN via a script tag.
      |
     */
    'plugins' => [
        'datatables' => true,
        'select2' => true,
        'chartjs' => true,
    ],
];
