self.onmessage = function(event) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', event.data.url);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            postMessage(xhr.responseText);
        }
    }
    xhr.send(JSON.stringify({_token: event.data._token}));
}
