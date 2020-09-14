<side-menu-component :config="{{ json_encode([
        'menuItems' => [
            [
                "title" => "main",
                "subItems" => [
                    [
                    "icon" => "dashboard",
                    "title" => "Dashboard",
                    "src" => "/admin"
                    ]
                ]
            ],
            [
                "title" => "user-management",
                "subItems" => [
                    [
                        "icon" => "group",
                        "title" => __('menu-item.Users'),
                        "src" => "/admin/users"
                    ],
                    [
                        "icon" => "account_tree",
                        "title" => __('menu-item.Roles'),
                        "src" => "/admin/roles"
                    ],
                    [
                        "icon" => "assignment_ind",
                        "title" => __('menu-item.Permissions'),
                        "src" => "/admin/permissions"
                    ]
                ]
            ],
            [
                "title" => "claims",
                "subItems" => [
                    [
                        "icon" => "wysiwyg",
                        "title" => __('menu-item.Claims'),
                        "src" => "/admin/claims"
                    ]
                ]
            ]
        ],
        'widthCollapsed' => 45,
        'widthUncollapsed' => 200,
        'isMenuCollapsed' => true,
        'logoSrc' => '/images/logo.png',
    ]) }}"
></side-menu-component>
