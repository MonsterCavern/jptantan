/**
 */

import Axios from 'axios'
export { default as moment } from 'moment'
export { default as _ } from 'lodash'

export const log = (...messages) => {
    console.log(`[${new Date().toLocaleTimeString()}]:%c`, 'color: yellow; font-style: italic; background-color: blue;padding: 2px', ...messages)
}

export const isRoot = {
    root: true
}
