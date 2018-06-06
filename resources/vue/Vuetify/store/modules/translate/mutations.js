import { log } from '../../utils'

export default {
    emptyList(state) {
        state.List = []
    },
    setList(state, data) {
        state.List = data
    },
    setTranslateSelf(state, data) {
        state.translateSelf = data
    }
}
