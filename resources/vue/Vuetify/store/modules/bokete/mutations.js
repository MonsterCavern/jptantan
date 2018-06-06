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
    },
    updateTranslateByTargetID(state, { data, index, translateId }) {
        console.log(data, index, translateId)
        const translateIndex = state.data[index].translates.findIndex(translate => translate.id == translateId)

        state.data[index].translates[translateIndex] = data
    }
}
