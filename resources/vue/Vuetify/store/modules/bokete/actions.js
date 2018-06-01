import { log } from '../../utils'
import Bokete from './Bokete'

export default {
    async init({ commit, dispatch }) {
        console.log('[INIT] Bokete')

        try {
            const { data, status } = await Bokete.orderBy('ranting', '-number').
                limit(5).
                get()

            // log(data, status)

            if (status === 200) {
                commit('set', data)
            } else {
                log('A problem occurred while gathering the bokete.')
                setTimeout(() => {
                    dispatch('init')
                }, 30 * 1000)
            }
        } catch (e) {
            log('A problem occurred while gathering the bokete.')
            log(e)
            setTimeout(() => {
                dispatch('init')
            }, 30 * 1000)
        }
    },
    async updateTranslates({ commit, dispatch }, { number, index }) {
        log('[Update] Translate')
        let translates = await dispatch('translate/getList', { number: number, targetType: 'bokete' }, { root: true })

        log(translates)
        commit('setTranslates', { data: translates, index: index })
    }
}
