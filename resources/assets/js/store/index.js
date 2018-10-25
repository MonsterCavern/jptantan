import Vue from "vue"
import Vuex from "vuex"
import * as modules from "./modules"

Vue.use(Vuex)

const state = {
  lang: "zh-CN",
  screenWidth: 0,
  screenHeight: 0,
  messages: [],
  user: {}
}

const mutations = {
  handleResize(state) {
    state.screenWidth = document.documentElement.clientWidth
    state.screenHeight = document.documentElement.clientHeight
  },
  setUser(state, data) {
    state.user = data
    localStorage.setObject("user", data)
  }
}

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
