import { log } from '../../utils'
import Translate from '../../Model/Translate'

export default {
    async init({ commit, dispatch }) {},
    async getList({ commit }, { targetType, number }) {
        try {
            const { data, status } = await Translate.select('*').
                orderBy('target_id').
                equal('target_type', targetType).
                equal('target_id', number).
                // page(1).
                limit(5).
                get()

            if (status === 200) {
                commit('setList', data)
            } else {
                log('A problem occurred while gathering the Translate.')
            }
        } catch (e) {
            log('Translate getList:' + e)
        }
    },
    async getTranslateByTargetIDFilterType({ commit }, { targetID, targetType }) {
        try {
            const { data, status } = await Translate.custom('api/translates').
                select('*').
                orderBy('created_at').
                params({
                    equal: {
                        target_type: targetType,
                        target_id: targetID
                    },
                    myself: 1
                }).
                limit(1).
                get().
                then(res => {
                    console.log(res)
                })

            if (status === 200) {
                commit('setTranslateEditting', data[0])
            } else {
                log('A problem occurred while gathering the Translate.')
            }
        } catch (e) {
            log('Translate getList:' + e)
        }
    }
}
