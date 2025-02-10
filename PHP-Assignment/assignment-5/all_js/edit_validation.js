$(document).ready(function () {
    $(".view").click(function (e) {
        e.preventDefault();
        window.location.href = "display_details.php"; // Specify your target page
    });
  
    $(".sub").click(function (event) {
        event.preventDefault(); 
        var firstname = $("#firstName").val().trim();
        var lastname = $("#lastName").val().trim();
        var email = $("#email").val().trim();
        var gender = $("input[name='gender']:checked").val();
        var address = $("#address1").val().trim();
        var address2 = $("#address2").val().trim();
        var user = $("#username").val().trim();
        var filein = $("#profilepic")[0].files[0];
  
        // Validation logic (same as your existing code)
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
  
        // Skip file validation if no file is selected
        if (filein) {
            const allowedExtensions = ["image/jpeg", "image/png", "image/jpg"];
            if (filein.size > 1024 * 1024) {
                alert("File size should not exceed 1 MB.");
                return;
            } else if (!allowedExtensions.includes(filein.type)) {
                alert("Only JPG, JPEG, and PNG files are allowed.");
                return;
            }
        }
  
        // Prepare form data to be sent via AJAX
        var formData = new FormData();
        formData.append("id", $("#id").val());
        formData.append("firstName", firstname);
        formData.append("lastName", lastname);
        formData.append("email", email);
        formData.append("gender", gender);
        formData.append("address1", address);
        formData.append("address2", address2);
        formData.append("technologies", techString);
        formData.append("username", user);
        
        // Only append the file if one is selected
        if (filein) {
            formData.append("profilePic", filein);
        }
  
        // AJAX request to submit the form data
        $.ajax({
            url: "edit_data.php",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // Handle the response from PHP
                if (response === "success") {
                    alert("Data updated successfully!");
                    window.location.href = "display_details.php";
                } else {
                    alert("Failed to update data: " + response);
                }
            },
            error: function (xhr, status, error) {
                alert("There was an error updating the form. Please try again.");
                console.error(xhr.responseText);
            },
        });
    });
  });
  