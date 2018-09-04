import { log } from '../../utils'
import Bokete from '@model/Bokete'

export default {
  async getData({ commit, dispatch }, { select = [], search = {} }) {
    try {
      let model = new Bokete()

      if (select && select.length > 0) {
        model = model.select(select)
      }

      if (search && Object.keys(search).length > 0) {
        for (var key in search) {
          model = model.where(key, search[key])
        }
      }

      let result = await model.get()

      if (result.code == 200 && result.data.length > 0) {
        commit('setData', result.data)
        return result
      }

      if (result.message) {
        throw Error(result.message)
      }

    } catch (e) {
      log(e)
    }

  },
  async getBoketeByID({ commit, dispatch }, { Id }) {
    try {
      return await Bokete.find(Id).then(function (result) {
        if (result.code == 200) {
          commit('setObject', result.data)
        }
        return result
      })
    } catch (e) {
      log(e)
    }
  },
  async updateBoketeByID({ commit, dispatch }, { params }) {
    try {
      let model = new Bokete(params)

      return await model.save()
    } catch (e) {
      log(e)
    }
  }
}
