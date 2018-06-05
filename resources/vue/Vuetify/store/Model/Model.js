import qs from 'qs'
import axios from 'axios'

import { Model as BaseModel } from 'vue-api-query'
BaseModel.$http = axios

export default class Model extends BaseModel {
    constructor(...atributtes) {
        super()

        this._builder.equals = {
            equal: {}
        }

        if (atributtes.length !== 0) {
            Object.assign(this, ...atributtes)
        }

        if (this.baseURL === undefined) {
            throw new Error('You must declare baseURL() method.')
        }

        if (this.request === undefined) {
            throw new Error('You must declare request() method.')
        }

        if (this.$http === undefined) {
            throw new Error('You must set $http property')
        }
    }

    equal(key, value) {
        this._builder.equals.equal[key] = value
        return this
    }

    // define a base url for a REST API
    baseURL() {
        return '/api'
    }

    // implement a default request method
    request(config) {
        let headers = {
            'Content-Type': 'application/json'
        }

        if (config.method == 'GET') {
            config.params = Object.assign({}, this._builder.equals, config.params)
        } else {
            config.data = Object.assign({}, this._builder.equals, config.data)
        }
        console.log(localStorage)
        if (typeof localStorage.getObject !== 'undefined' && localStorage.getObject('user')) {
            let token = localStorage.getObject('user')['token']

            headers['Authorization'] = 'Bearer ' + token
        }

        config.headers = headers
        config.paramsSerializer = function(params) {
            // console.log(params)
            return qs.stringify(params, { arrayFormat: 'brackets' })
        }

        return this.$http.
            request(config).
            then(response => {
                // let data = response.data
                // console.log(response)
                response.data.status = response.status
                return response
            }).
            catch(error => {
                // console.log(error)
                // notify('error', lang.translate(error))
            })
    }
}
