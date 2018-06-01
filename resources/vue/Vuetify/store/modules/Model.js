import axios from 'axios'
import { Model as BaseModel } from 'vue-api-query'
BaseModel.$http = axios

export default class Model extends BaseModel {
    // define a base url for a REST API
    baseURL() {
        return '/api'
    }

    // implement a default request method
    request(config) {
        // console.log(config)
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
