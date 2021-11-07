var inputField;
var searchBtn;
var result;
window.onload = function () {
    inputField = document.getElementById("country");
    searchBtn = document.getElementById("lookup");
    result = document.getElementById("result");
    searchBtn.addEventListener("click", function (e) {
        e.preventDefault;
        fetch(`./world.php?country=${inputField.value.trim()}&context=countries`)
            .then(res => res.text())
            .then(data => result.innerHTML = data);
    })
}