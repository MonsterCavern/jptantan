export default {
    items: [
        {
            title: true,
            name: "歡迎使用 JPtantan"
        },
        {
            name: "管理者 功能",
            url: "/manage",
            icon: "fas fa-road",
            children: [
                {
                    name: "管理者群組",
                    url: "/manage/admin_groups",
                    icon: "fas fa-user"
                },
                {
                    name: "管理者列表",
                    url: "/manage/admins",
                    icon: "fas fa-user"
                },
                {
                    name: "使用者列表",
                    url: "/manage/users",
                    icon: "fas fa-user"
                },
                {
                    name: "身份管理",
                    url: "/manage/roles",
                    icon: "fas fa-user"
                },
                {
                    name: "權限管理",
                    url: "/manage/permissions",
                    icon: "fas fa-user"
                }
            ]
        },
        {
            divider: true
        },
        {
            name: "登出",
            url: "/logout",
            icon: "fas fa-road"
        }
    ]
};
