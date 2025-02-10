<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data Form</title>
    <script src="all_js/request.js"></script>
    <link rel="stylesheet" href="all_css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="all_js/validation.js"></script>
    <style>
        /* Add some basic styling for the error messages */
        .error {
            color: red;
            font-size: 12px;
            margin-top:-15px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <form id="userForm" action="/submit" method="POST" enctype="multipart/form-data">
            <h2>Personal Information</h2>
            <div class="form-content">
                <!-- Left Section -->
                <div class="left-section">
                    <label for="firstName">First Name <span>*</span></label>
                    <input type="text" id="firstName" name="firstName" >
                    <div id="firstNameError" class="error"></div>

                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName">
                    <div id="lastNameError" class="error"></div>

                    <label for="email">Email ID <span>*</span></label>
                    <input type="email" id="email" name="email" required>
                    <div id="emailError" class="error"></div>

                    <div class="gender-container">
                        <label>Gender</label>
                        <div class="gender-value">
                            <div class="gender-val">
                                <input type="radio" id="male" name="gender" value="Male" required>
                                <label for="male">Male</label>
                            </div>
                            <div class="gender-val">
                                <input type="radio" id="female" name="gender" value="Female" required>
                                <label for="female">Female</label>
                            </div>
                        </div>
                    </div>

                    <label for="address1">Address Line 1 <span>*</span></label>
                    <input type="text" id="address1" name="address1" required>
                    <div id="address1Error" class="error"></div>

                    <label for="address2">Address Line 2</label>
                    <input type="text" id="address2" name="address2">
                    <div id="address2Error" class="error"></div>

                    <label for="profilePic">Profile Pic</label>
                    <input type="file" id="profilePic" name="profilePic">
                    <div id="profilePicError" class="error"></div>
                </div>

                <!-- Right Section -->
                <div class="right-section">
                    <label for="country">Country <span>*</span></label>
                    <select name="country" id="countrySel" onchange="showState(this.value)" onclick="showState(this.value)">
                        <option value="">Select Your Country</option>
                        <option value="india">India</option>
                        <option value="united state">United States</option>
                        <option value="australia">Australia</option>
                        <option value="canada">Canada</option>
                    </select>
                    <div id="countryError" class="error"></div>

                    <label for="state">State <span>*</span></label>
                    <select id="stateDropdown" onchange="showCity(this.value)" onclick="showCity(this.value)">
                        <option value="">Select Your State</option>
                    </select>
                    <div id="stateError" class="error"></div>

                    <label for="city">City <span>*</span></label>
                    <select id="cityDropdown">
                        <option value="">Select Your City</option>
                    </select>
                    <div id="cityError" class="error"></div>

                    <div class="checkbox-container">
                        <label>Technology</label>
                        <div class="checkbox-value">
                            <div class="checkbox-val">
                                <input type="checkbox" id="javascript" name="technology[]" value="JavaScript">
                                <label for="javascript">JavaScript</label>
                            </div>
                            <div class="checkbox-val">
                                <input type="checkbox" id="python" name="technology[]" value="Python">
                                <label for="python">Python</label>
                            </div>
                            <div class="checkbox-val">
                                <input type="checkbox" id="java" name="technology[]" value="Java">
                                <label for="java">Java</label>
                            </div>
                            <div class="checkbox-val">
                                <input type="checkbox" id="cplus" name="technology[]" value="C++">
                                <label for="cplus">C++</label>
                            </div>
                            <div class="checkbox-val">
                                <input type="checkbox" id="php" name="technology[]" value="php">
                                <label for="php">PHP</label>
                            </div>
                        </div>
                    </div>

                    <label for="username">Username <span>*</span></label>
                    <input type="text" id="username" name="username" required>
                    <div id="usernameError" class="error"></div>

                    <label for="password">Password <span>*</span></label>
                    <input type="password" id="password" name="password" required>
                    <div id="passwordError" class="error"></div>

                    <label for="password">Confirm Password <span>*</span></label>
                    <input type="password" id="conpassword" name="conpassword" required>
                    <div id="conpasswordError" class="error"></div>
                   
                </div>
            </div>
            <div class="button-container">
                <button type="submit" class="sub">Submit</button>
                <button type="button" class="view">View User</button>
            </div>
        </form>
    </div>
    <script src="all_js/live_error.js"></script>
</body>

</html>
