import qs from "qs"
import axios from "axios"

import { Model as BaseModel } from "vue-api-query"
BaseModel.$http = axios

export default class Model extends BaseModel {
  // define a base url for a REST API
  baseURL() {
    return "/api"
  }

  // override
  endpoint() {
    let base = this._fromResource || `${this.baseURL()}/${this.resource()}`

    base = this._customResource || base

    if (base) {
      if (this.hasId()) {
        return `${base}/${this.getPrimaryKey()}`
      } else {
        return base
      }
    }
  }

  // implement a default request method
  request(config) {
    let headers = {
      "Content-Type": "application/json;charset=utf-8",
      "X-Requested-With": "XMLHttpRequest",
      "Accept-Language": document.getElementsByTagName("html")[0].lang
    }

    if (
      typeof localStorage.getObject !== "undefined" &&
      localStorage.getObject("user")
    ) {
      if (localStorage.getObject("user").hasOwnProperty("token")) {
        let token = localStorage.getObject("user")["token"]

        headers["Authorization"] = "Bearer " + token
      }
    }

    config.headers = headers

    config.paramsSerializer = function (params) {
      return qs.stringify(params, { arrayFormat: "brackets" })
    }

    config.onUploadProgress = function (progressEvent) { }

    config.onDownloadProgress = function (progressEvent) { }

    // 最好不要在後面繼續接 then
    return this.$http.
      request(config).
      then(function (response) {
        var collection = response.data.data || response.data

        collection = Array.isArray(collection) ? collection : [collection]
        if (collection.length == 0) {
          // TODO: 偷懶沒 custom Error class
          throw {
            response: {
              data: {
                code: 200404,
                data: collection,
                message: ''
              }
            }
          }
        }

        return response
      }).
      catch(error => {
        //  捕抓不到之後的 then
        //  response sample
        // let response = {
        //   config: {},
        //   data: {
        //     code: 500,
        //     message: "",
        //     response_time: 0
        //   },
        //   headers: {},
        //   request: {},
        //   status: 500,
        //   statusText: ''
        // }
        return error.response
      }).
      finally(() => {
        /* 不論成功失敗，都做些事 */
        // 這裡不是 Promise 的最後尾
      })
  }
}
