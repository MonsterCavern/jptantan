function clearEvent(e) {
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
}

Storage.prototype.setObject = function(key, value) {
    this.setItem(key, JSON.stringify(value));
};

Storage.prototype.getObject = function(key) {
    var value = this.getItem(key);

    return value && JSON.parse(value);
};

function demoCase(url = "/", type = "GET", data = {}, options = {}) {
    var options = {
        dataType: "json",
        async: false,
        cache: false,
        contentType: false,
        processData: false
    };

    options.url = url;
    options.type = type;
    options.data = JSON.stringify(data);

    options.beforeSend = function setHeader(xhr) {
        if (localStorage.getObject("user")) {
            xhr.setRequestHeader(
                "Authorization",
                "Bearer " + localStorage.getObject("user")["token"]
            );
        }
        xhr.setRequestHeader("Content-Type", "application/json; charset=utf-8");
    };

    var result = $.ajax(options);

    responseText = result.responseText;
    if (typeof responseText == "string") {
        try {
            responseText = JSON.parse(result.responseText);
        } catch (e) {
            responseText = {
                code: 500,
                message: "IS not Json"
            };
        }
    }
    var json = responseText; // jQuery.parseJSON

    return json;
}
