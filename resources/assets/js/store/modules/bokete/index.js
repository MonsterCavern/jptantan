// import state from './state.js'
// import mutations from './mutations.js'
import actions from './actions.js'
import getters from './getters.js'

const state = {
  data: [],
  object: {}
}
const mutations = {
  setData(state, data) {
    state.data = data
  },
  setObject(state, data) {
    state.object = data
  }
}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
