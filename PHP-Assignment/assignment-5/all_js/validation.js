$(document).ready(function () {
  // Handle the click event of the "View User" button
  $(".view").click(function (e) {
    e.preventDefault();
    window.location.href = "display_details.php"; // Specify your target page
  });

  $(".sub").click(function (event) {
    event.preventDefault(); // Prevent default form submission (no page reload)

    var firstname = $("#firstName").val().trim();
    var lastname = $("#lastName").val().trim();
    var email = $("#email").val().trim();
    var password = $("#password").val().trim();
    var conpassword = $("#conpassword").val().trim();
    var address = $("#address1").val().trim();
    var address2 = $("#address2").val().trim();
    var country = $("#countrySel").val().trim();
    var state = $("#stateDropdown").val().trim();
    var city = $("#cityDropdown").val().trim();
    var user = $("#username").val().trim();
    var filein = $("#profilePic")[0].files[0];

  //  Validation logic (same as your existing code)
    if (firstname.length === 0) {
      alert("Enter Firstname");
      return;
    } else {
      for (let i = 0; i < firstname.length; i++) {
        let v = firstname[i];
        if (!(v >= "A" && v <= "Z") && !(v >= "a" && v <= "z")) {
          alert("Not allow special character and space in Firstname");
          return;
        }
      }
    }
    if (lastname.length !== 0) {
      for (let i = 0; i < lastname.length; i++) {
        let v = lastname[i];
        if (!(v >= "A" && v <= "Z") && !(v >= "a" && v <= "z")) {
          alert("Not allow special character and space in Lastname");
          return;
        }
      }
    }
    const mail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.match(mail)) {
      alert("Please enter a valid email address");
      return;
    }
    var gender = $("input[name='gender']:checked").val();
    
    if (address === "") {
      alert("Please enter an address");
      return;
    }
    if (address2 !== "" && address2.length < 3) {
      alert(
        "Remove space from address2 and if written, enter at least 3 characters"
      );
      return;
    }
    if (country === "") {
      alert("Please select country");
      return;
    }
    if (state === "") {
      alert("Please select state");
      return;
    }
    if (city === "") {
      alert("Please select city");
      return;
    }
    var technologies = [];
    $("input[name='technology[]']:checked").each(function () {
      technologies.push($(this).val());
    });
    var techString = technologies.join(","); // Combine selected values into a comma-separated string

    if (user === "") {
      alert("Please enter username");
      return;
    } else if (user.length < 4 || user.length > 20) {
      alert("Username should be between 4 to 20 characters");
      return;
    } else if (!/^[a-zA-Z0-9_]+$/.test(user)) {
      alert("Username can only contain letters, numbers, and underscores");
      return;
    }
    if (password.length < 8) {
      alert("Password must be at least 8 characters");
      return;
    }
    if (password !== conpassword){
      alert("confirm-password doesn't match with password");
      return;
    }
    const allowedExtensions = ["image/jpeg", "image/png", "image/jpg"];
    if (!filein) {
    } else if (filein.size > 1024 * 1024) {
      alert("File size should not exceed 1 MB.");
      return;
    } else if (!allowedExtensions.includes(filein.type)) {
      alert("Only JPG, JPEG, and PNG files are allowed.");
      return;
    }
   // If all validations pass, proceed with sending data to PHP using AJAX
    var formData = new FormData();
    formData.append("firstName", firstname);
    formData.append("lastName", lastname);
    formData.append("email", email);
    formData.append("gender", gender);
    formData.append("password", password);
    formData.append("address1", address);
    formData.append("address2", address2);
    formData.append("country", country);
    formData.append("state", state);
    formData.append("city", city);
    formData.append("technologies", techString);
    formData.append("username", user);
    formData.append("profilePic", filein);

    // AJAX request to submit the form data
    $.ajax({
      url: "insert_data.php",
      method: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        // Handle the response from PHP
        if (response === "success") {
          alert("Data submitted successfully!");
          window.location.href = "display_details.php";
        } else {
          alert("Failed to submit data: " + response);
        }
      },
      error: function (xhr, status, error) {
        alert("There was an error submitting the form. Please try again.");
        console.error(xhr.responseText);
      },
    });
  });
});
