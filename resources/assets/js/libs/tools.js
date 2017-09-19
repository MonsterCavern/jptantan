var optionsData = function (type, data) {
  var sess

  if (localStorage.getObject('user')) {
    sess = localStorage.getObject('user')['_sess']
  }

  if ((typeof data === 'undefined') || (data === '')) {
    data = {}
    data._sess = sess
  }

  if (typeof sess !== 'undefined') {
    data._sess = sess
  }

  if (type === 'get') {
    return $.param(data)
  } else {
    return JSON.stringify(data)
  }
}
module.exports = {
  dotoCase: function (url, type, data) {
    var options = {
      async: false,
      dataType: 'json',
      url: url,
      type: type
    }

    options.data = optionsData(type, data)
    if (localStorage.getObject('user')) {
      options.beforeSend = function setHeader (xhr) {
        xhr.setRequestHeader('X-SESSION', localStorage.getObject('user')['_sess'])
      }
    }
    var result = $.ajax(options)
    responseText = result.responseText

    if (typeof (responseText) === 'string') {
      try {
        responseText = JSON.parse(result.responseText)
      } catch (e) {
        responseText = {
          'message': 'IS NOT JSON'
        }
        // console.log(e);
      }
    }
    var json = responseText // jQuery.parseJSON
    return json
  }
}
