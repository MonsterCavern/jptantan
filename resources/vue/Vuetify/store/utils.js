/**
 * Created by Kylart on 26/07/2017.
 */

import Axios from 'axios'
export { default as moment } from 'moment'
export { default as _ } from 'lodash'

export const log = (...messages) => {
    console.log(`[${new Date().toLocaleTimeString()}]:`, ...messages)
}

export const axios = function(url, method, data) {
    let config = {
        url: url,
        method: method.toLowerCase()
        // headers: { 'X-SESSION': user.getSess() }
    }

    return Axios(config).
        then(response => {
            let data = response.data

            return response
        }).
        catch(error => {
            // console.log(error)
            // notify('error', lang.translate(error))
        })
}

export const isRoot = {
    root: true
}
