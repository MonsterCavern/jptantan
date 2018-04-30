import Admin from "../containers/manage/Admin";
import AdminGroup from "../containers/manage/AdminGroup";
import Role from "../containers/manage/Role";
import Permission from "../containers/manage/Permission";
import User from "../containers/manage/User";

export default {
    path: "/manage",
    // name: "Manage",
    redirect: "manage/admins",
    component: {
        render(c) {
            return c("router-view");
        }
    },
    children: [
        {
            path: "admin_groups/:id?",
            component: AdminGroup,
            props: true
        },
        {
            path: "admins/:id?",
            component: Admin,
            props: true
        },
        {
            path: "users/:id?",
            component: User,
            props: true
        },
        {
            path: "roles/:id?",
            component: Role,
            props: true
        },
        {
            path: "permissions/:id?",
            component: Permission,
            props: true
        }
    ]
};
