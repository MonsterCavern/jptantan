import { log } from '../../utils'
import Bokete from '../../Model/Bokete'

export default {
    async init({ commit, dispatch }) {
        console.log('[INIT] Bokete')

        try {
            const { data, status } = await Bokete.limit(5).get()

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
        let translates = await dispatch(
            'translate/getList',
            { number: number, targetType: 'boketes' },
            { root: true }
        )

        log(translates)
        commit('setTranslates', { data: translates, index: index })
    }
}
