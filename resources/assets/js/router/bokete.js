import Index from "@pages/Bokete/Index"
import Jumbotron from "@pages/Bokete/Jumbotron"

export default {
    name: "bokete",
    path: "/bokete",
    components: {
        default: Index,
        Jumbotron: Jumbotron
    },
    beforeEnter: (to, from, next) => {
        next()
    }
}
