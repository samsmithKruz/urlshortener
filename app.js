let submit = document.querySelector("input[type=submit]"),
    ajax = (data, callback) => {
        let xhr = new XMLHttpRequest;
        data.data = data.data || "";
        if (data.method.toLowerCase() == 'get') {
            xhr.open('GET', data.url, true);
        } else {
            xhr.open('POST', data.url, true);
        }
        xhr.send(data.data);
        xhr.onload = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                callback(xhr.response);
            }
        }
    };
submit.onclick = e => {
    e.preventDefault();
    let url = document.querySelector("input[type=text]");
    if (url.value.length < 1) {
        alert("Url cannot be empty")
    } else {
        ajax({
            url : './api.php',
            method: 'post',
            data: `{"url":"${url.value}"}`
        },i=>{
            console.log(i);
        })
    }
}