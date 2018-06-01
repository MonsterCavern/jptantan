import { log } from '../../utils'
import Translate from '../../Model/Translate'

export default {
    async init({ commit, dispatch }) {},
    async getList({ commit, dispatch }, { targetType, number }) {
        try {
            const { data, status } = await Translate.select('*').
                orderBy('target_id').
                equal('target_type', targetType).
                equal('target_id', number).
                // page(1).
                limit(5).
                get()

            if (status === 200) {
                return data
            } else {
                log('A problem occurred while gathering the Translate.')
            }
        } catch (e) {
            log('Translate getList:' + e)
        }
    }
}
