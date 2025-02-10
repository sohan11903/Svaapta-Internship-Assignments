function showState(countryId) {
    console.log("Country selected: " + countryId); // Debugging log
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
    console.log("State selected: " + stateId); // Debugging log
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
