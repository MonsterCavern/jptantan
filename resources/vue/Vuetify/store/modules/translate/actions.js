import { log } from '../../utils'
import Translate from '../../Model/Translate'

export default {
    async init({ commit, dispatch }) {},
    // 全部的翻譯內容, 並設定在 state.List
    async getList({ commit }) {},
    // 指定 類型與ID 的翻譯列表
    async getTranslates({ commit }, { targetType, targetID }) {
        try {
            var { data, status } = await Translate.select('*').
                params({
                    equal: {
                        target_type: targetType,
                        target_id: targetID
                    }
                }).
                orderBy('created_at').
                get()
        } catch (e) {
            log('In getTranslates: ' + e)
        } finally {
            if (status == 200) {
                return data
            } else {
                log('A problem occurred while gathering the getTranslates.')
            }
        }
    },
    // 指定類型與ID回應一個屬於自己的單獨內容, set Translate Bokete
    async getTranslateSelf({ commit }, { targetID, targetType }) {
        try {
            const { data, status } = await Translate.select('*').
                orderBy('created_at').
                params({
                    equal: {
                        target_type: targetType,
                        target_id: targetID
                    },
                    myself: 1
                }).
                limit(1).
                get()

            if (status === 200) {
                commit('setTranslateBokete', data[0])
            } else {
                log('A problem occurred while gathering the Translate.')
            }
        } catch (e) {
            log('Translate getList:' + e)
        }
    },
    // 指定 ID 更新 Content
    async updateContent({ commit, rootGetters }, { id, contents }) {
        try {
            let translate = new Translate({ id: id })

            let { data, status } = await translate.sync({ content: contents })

            if (status == 200) {
                let { index } = rootGetters['bokete/getBoketeByNumber'](data.data.target_id)

                commit(
                    'bokete/updateTranslateByTargetID',
                    {
                        data: data.data,
                        index: index,
                        translateId: data.data.id
                    },
                    { root: true }
                )
            }
        } catch (e) {
            log('Translate Update:' + e)
        }
    }
}
