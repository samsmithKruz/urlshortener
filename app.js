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
    },
    copy_ = async e=>{
        e.preventDefault();
        let text = e.target.parentElement.querySelector("span").textContent;
        e.target.textContent = "copied";
        await navigator.clipboard.writeText(text);
        
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
            i = JSON.parse(i);
            document.querySelector(".result").classList.remove("hide");
            document.querySelector(".result").innerHTML += `
            <div class="link">
                    <span>${window.location.origin + '/urlshortener/' + i.route}</span>
                    <a href="#" onclick="copy_(event)">copy</a>
                </div>
                `;
        })
    }
}
