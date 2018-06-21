import qs from 'qs'
import axios from 'axios'

import { Model as BaseModel } from 'vue-api-query'
BaseModel.$http = axios

export default class Model extends BaseModel {
    // define a base url for a REST API
    baseURL() {
        return location.pathname + 'api'
    }

    // implement a default request method
    request(config) {
        let headers = {
            'Content-Type': 'application/json;charset=utf-8',
            'X-Requested-With': 'XMLHttpRequest'
        }

        if (typeof localStorage.getObject !== 'undefined' && localStorage.getObject('user')) {
            if (localStorage.getObject('user').hasOwnProperty('token')) {
                let token = localStorage.getObject('user')['token']

                headers['Authorization'] = 'Bearer ' + token
            }
        }

        config.headers = headers

        config.paramsSerializer = function(params) {
            return qs.stringify(params, { arrayFormat: 'brackets' })
        }

        return this.$http.
            request(config).
            then(response => {
                response.data.status = response.status
                return response
            }).
            catch(error => {
                console.log(error)
                // notify('error', lang.translate(error))
            })
    }
}
