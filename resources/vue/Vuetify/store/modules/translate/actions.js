import { log } from '../../utils'
import Translate from './Translate'

export default {
    async init({ commit, dispatch }) {},
    async getList({ commit, dispatch }, { targetType, number }) {
        try {
            const { data, status } = await Translate.limit(5).
                where('target_type', targetType).
                where('target_id', number).
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
