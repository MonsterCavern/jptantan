import Sample from "@pages/Sample"
export default {
    name: "sample",
    path: "/sample",
    component: Sample,
    beforeEnter: (to, from, next) => {
        next()
    }
}
