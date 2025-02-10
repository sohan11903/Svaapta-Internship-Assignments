function showState(countryId) {
    if (countryId == "") {
        document.getElementById("stateDropdown").innerHTML = "<option value=''>Select Your State</option>";
        document.getElementById("cityDropdown").innerHTML = "<option value=''>Select Your City</option>";
        return;
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("stateDropdown").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "state_search.php?q=" + countryId, true);
    xmlhttp.send();
}

function showCity(stateId) {
    if (stateId == "") {
        document.getElementById("cityDropdown").innerHTML = "<option value=''>Select Your City</option>";
        return;
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("cityDropdown").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "city_search.php?q=" + stateId, true);
    xmlhttp.send();
}