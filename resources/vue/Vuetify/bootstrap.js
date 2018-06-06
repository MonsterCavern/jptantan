/***/
Storage.prototype.setObject = function(key, value) {
    this.setItem(key, JSON.stringify(value))
}

Storage.prototype.getObject = function(key) {
    var value = this.getItem(key)

    return value && JSON.parse(value)
}

try {
    window.$ = window.jQuery = require('jquery')
    // require('bootstrap')
} catch (e) {
    console.log(e)
}
