import { log } from '../../utils'

export default {
    emptyList(state) {
        state.List = []
    },
    setList(state, data) {
        state.List = data
    },
    setTranslateBokete(state, data) {
        if (typeof data !== 'object') {
            return false
        }
        if (!data.hasOwnProperty('content')) {
            return false
        }
        state.bokete = data
    }
}
