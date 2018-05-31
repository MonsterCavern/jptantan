import { axios, log } from '@local/vue/Vuetify/store/utils'

export default {
    async init({ commit, dispatch }) {
        console.log('[INIT] Bokete')

        try {
            const { data, status } = await axios('/api/boketes', 'get')

            console.log(data, status)

            if (status === 200) {
                commit('set', data.data)
            } else {
                log('A problem occurred while gathering the news.')
                setTimeout(() => {
                    dispatch('init')
                }, 30 * 1000)
            }
        } catch (e) {
            log('A problem occurred while gathering the news.')
            console.log(e)
            // setTimeout(() => {
            //     dispatch('init')
            // }, 30 * 1000)
        }
    }
}
