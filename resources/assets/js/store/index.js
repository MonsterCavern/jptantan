import Vue from "vue"
import Vuex from "vuex"
import * as modules from "./modules"

Vue.use(Vuex)

const state = {
    lang: "zh-CN",
    messages: [],
    user: {}
}

const mutations = {}

const actions = {}
// const getters = {}

export function createStore() {
    return new Vuex.Store({
        state,
        mutations,
        actions,
        // getters,
        modules
    })
}
