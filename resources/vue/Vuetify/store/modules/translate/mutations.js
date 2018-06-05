import { log } from '../../utils'

export default {
    emptyList(state) {
        state.List = []
    },
    setList(state, data) {
        state.data = data
    },
    setTranslateEditting(state, data) {
        state.translateEditting = data
    },
    setTranslates(state, { data, index }) {
        log('Update Translate in Bokete[' + index + ']')
        state.data[index].translates = data
    }
}
