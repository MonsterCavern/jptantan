// Views - Pages
import Page404 from "@components/views/pages/Page404";
import Page500 from "@components/views/pages/Page500";
// import Login from "../views/pages/Login";
// import Register from "../views/pages/Register";

export default {
    path: "/pages",
    redirect: "/pages/p404",
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
        }
    // {
    //     path: "login",
    //     name: "Login",
    //     component: Login
    // },
    // {
    //     path: "register",
    //     name: "Register",
    //     component: Register
    // }
    ]
};
