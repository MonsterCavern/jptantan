import Vue from 'vue'
import Vuex from 'vuex'

// import state from './state'
// import mutations from './mutations'
// import actions from './actions'
// import getters from './getters'
import * as modules from './modules'

Vue.use(Vuex)

const state = {
    user: null,
    boketeContent: {
        after: null,
        before: null,
        note: null,
        relateds: null
    }
}

const mutations = {
    setUser(state, data) {
        state.user = data
        localStorage.setObject('user', data)
    },
    logout(state) {
        state.user = null
        localStorage.clear()
    }
}

export function createStore() {
    return new Vuex.Store({
        state,
        mutations,
        // actions,
        // getters,
        modules
    })
}
