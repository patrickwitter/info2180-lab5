var inputField;
var lookupsearchBtn;
var result;
var citysearchBtn;
window.onload = function () {
    inputField = document.getElementById("country");
    lookupsearchBtn = document.getElementById("lookup");
    citysearchBtn = document.getElementById("lookupCity");
    result = document.getElementById("result");


    lookupsearchBtn.addEventListener("click", function (e) {
        search(e, true);
    });

    citysearchBtn.addEventListener("click", function (e) {
        search(e, false);
    });

    function search(e, islookupCoun) {
        e.preventDefault;
        let content = inputField.value.trim();
        let url = islookupCoun ? `./world.php?country=${content}&context=countries` : `./world.php?country=${content}&context=cities`;
        fetch(url)
            .then(res => res.text())
            .then(data => result.innerHTML = data);
    }

}