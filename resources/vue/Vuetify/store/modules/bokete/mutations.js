import { log } from '@local/vue/Vuetify/store/utils'

export default {
    empty(state) {
        state.data = []
    },
    set(state, data) {
        state.data = data
    }
}
