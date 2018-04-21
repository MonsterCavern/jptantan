import Vue from "vue";
import Router from "vue-router";

// Containers

// Views

// Views - Pages
import Page404 from "../views/pages/Page404";
import Page500 from "../views/pages/Page500";
import Login from "../views/pages/Login";
import Register from "../views/pages/Register";

Vue.use(Router);

export default new Router({
    mode: "history", // Demo is living in GitHub.io, so required!
    // linkActiveClass: "open active",
    scrollBehavior: () => ({ y: 0 }),
    routes: [
        {
            path: "/admin",
            redirect: "/admin/dashboard",
            name: "Home"
            // children: [
            //     {
            //         path: "dashboard",
            //         name: "Dashboard",
            //         component: Dashboard
            //     }
            // ]
        },
        {
            path: "/admin/pages",
            redirect: "/admin/pages/p404",
            name: "Pages",
            component: {
                render(c) {
                    return c("router-view");
                }
            },
            children: [
                {
                    path: "404",
                    name: "Page404",
                    component: Page404
                },
                {
                    path: "500",
                    name: "Page500",
                    component: Page500
                },
                {
                    path: "login",
                    name: "Login",
                    component: Login
                },
                {
                    path: "register",
                    name: "Register",
                    component: Register
                }
            ]
        }
    ]
});
