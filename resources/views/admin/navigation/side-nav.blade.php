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
                "title" => "settings",
                "subItems" => [
                    [
                        "icon" => "supervised_user_circle",
                        "title" => __('menu-item.Users'),
                        "src" => "/admin/users"
                    ]
                ]
            ],
            [
                "title" => "settings",
                "subItems" => [
                    [
                        "icon" => "supervised_user_circle",
                        "title" => __('menu-item.Roles'),
                        "src" => "/admin/roles"
                    ]
                ]
            ],
            [
                "title" => "settings",
                "subItems" => [
                    [
                        "icon" => "supervised_user_circle",
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
