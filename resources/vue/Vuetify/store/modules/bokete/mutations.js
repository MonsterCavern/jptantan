import { log } from '../../utils'

export default {
    empty(state) {
        state.data = []
    },
    set(state, data) {
        state.data = data
    },
    setTranslates(state, { data, index }) {
        log('Update Translate in Bokete[' + index + ']')
        state.data[index].translates = data
    }
}
