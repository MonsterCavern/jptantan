export default {
    items: [
        {
            title: true,
            name: "後台介面"
        },
        {
            name: "管理者 功能",
            url: "/admin/admins",
            icon: "fas fa-road"
        },
        {
            name: "會員 功能",
            url: "/admin/users",
            icon: "fas fa-puzzle-piece",
            children: [
                {
                    name: "Logs",
                    url: "/history",
                    icon: "fas fa-user"
                }
            ]
        },
        {
            divider: true
        }
        // {
        //   name: "儲值功能",
        //   icon: "fas fa-money-bill-alt",
        //   children: [
        //     {
        //       name: "儲值功能",
        //       url: "/bolt",
        //       icon: "fas fa-bolt"
        //     },
        //     {
        //       name: "儲值紀錄",
        //       url: "/history",
        //       icon: "fas fa-history"
        //     }
        //   ]
        // },
        // {
        //   divider: true
        // },
        // {
        //   name: "訂單系統",
        //   icon: "fas fa-folder-open",
        //   children: [
        //     {
        //       name: "店家資訊",
        //       url: "/stores",
        //       icon: "fas fa-road"
        //     }
        //   ]
        // }
    ]
};
