<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Dropdowns</title>
    
    <link rel="stylesheet" href="style.css">
    <script src="request.js"></script>
</head>

<body>
    <div class="container">
        <h2>Select Your Location</h2>
        <div class="dropdown-container">
            <p>Select Your Country</p>
            <select name="country" onchange="showState(this.value)" onclick="showState(this.value)">
                <option value="">Select Your Country</option>
                <option value="1">India</option>
                <option value="2">United States</option>
                <option value="3">Australia</option>
                <option value="4">Canada</option>
            </select>
        </div>

        <div class="dropdown-container">
            <p>Select Your State</p>
            <select id="stateDropdown" onchange="showCity(this.value)" onclick="showCity(this.value)">
                <option value="" >Select Your State</option>
            </select>
        </div>

        <div class="dropdown-container">
            <p>Select Your City</p>
            <select id="cityDropdown">
                <option value="" >Select Your City</option>
            </select>
        </div>
    </div>
</body>

</html>
