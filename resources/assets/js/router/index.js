import Vue from "vue"
import Router from "vue-router"

Vue.use(Router)

// pages
import Login from "@pages/Login"

export function createRouter() {
    let langs = ["zh-TW", "en", "ja"]
    let lang = location.pathname.
        split("/").
        filter(n => n).
        shift()

    if (langs.indexOf(lang) == -1) {
        lang = ""
    }

    let baseURL = document.
        getElementsByTagName("base")[0].
        href.replace(window.origin, "")

    return new Router({
        mode: "history", //mode
        base: baseURL ? baseURL : "/" + lang,
        scrollBehavior: () => ({ y: 0 }),
        components: {
            render(c) {
                return c("router-view")
            }
        },
        routes: [
            { name: "index", path: "/" },
            {
                name: "login",
                path: "/login",
                component: Login,
                beforeEnter: (to, from, next) => {
                    localStorage.clear()
                    next()
                }
            },
            // Global redirect for 404
            { path: "*", redirect: "/" }
        ]
    })
}
