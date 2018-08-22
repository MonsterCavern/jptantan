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

        config.paramsSerializer = function(params) {
            return qs.stringify(params, { arrayFormat: "brackets" })
        }

        config.onUploadProgress = function(progressEvent) {}

        config.onDownloadProgress = function(progressEvent) {}

        return this.$http.
            request(config).
            then(function(response) {
                console.log(response)
                return response
            }).
            catch(error => {
                console.log(error.response)
                return error
            }).
            finally(() => {
                /* 不論成功失敗，都做些事 */
            })
    }
}
