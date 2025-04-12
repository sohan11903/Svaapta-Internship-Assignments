$(document).ready(function () {
    $('button').click(function () {
        event.preventDefault();
        var firstname = $('#fname').val().trim()
        var midname = $('#mname').val().trim()
        var lstname = $('#lname').val().trim()
        var email = $('#email').val().trim()
        var pw = $('#pas').val().trim()
        var cpw = $('#cpas').val().trim()
        const filein = $('#file')[0].files[0];

        if (firstname.length === 0) {
            alert('Enter Firstname');
            return;
        } else {
            for (let i = 0; i < firstname.length; i++) {
                let v = firstname[i];
                if (!(v >= 'A' && v <= 'Z') && !(v >= 'a' && v <= 'z')) {
                    alert('Not allow special character and space');
                    return;
                }
            }
        }
        if (midname.length !== 0) {
            for (let i = 0; i < midname.length; i++) {
                let v = midname[i];
                if (!(v >= 'A' && v <= 'Z') && !(v >= 'a' && v <= 'z')) {
                    alert('Not allow special character and space');
                    return;
                }
            }
        }
        if (lstname.length === 0) {
            alert('Enter Lastname');
            return;
        } else {
            for (let i = 0; i < lstname.length; i++) {
                let v = lstname[i];
                if (!(v >= 'A' && v <= 'Z') && !(v >= 'a' && v <= 'z')) {
                    alert('Not allow special character and space');
                    return;
                }
            }
        }
        const mail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email.match(mail)) {
            alert('Please enter a valid email address');
            return;
        }
        if (pw.length < 8 || pw !== cpw) {
            alert('Password must be at least 8 characters and must match confirmation');
            return;
        }
        
        const allowedExtensions = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!filein) {
            alert("Please select a file.");
            return;
        }
        else if (filein.size > 1024* 1024) {
            alert("File size should not exceed 1 MB.");
            return;
        }
        else if (!allowedExtensions.includes(filein.type)) {
            alert("Only jpg, jpeg, and png files are allowed.");
            return;
        }
        alert('success')
    })
}
)
$(document).ready(function() {
    $('#dept').change(function() {
        let selectedDept = $(this).val(); 
        let lab = $('.lab'); 
        let bodyc = $('#myBody');

        if (selectedDept == 'it') {
            lab.css('color', 'black');
            bodyc.css('background-color', 'grey');
        }
        if (selectedDept == 'mechanical') {
            lab.css('color', 'darkblue');
            bodyc.css('background-color', 'lightblue');
        }
        if (selectedDept == 'electrical') {
            lab.css('color', 'brown');
            bodyc.css('background-color', 'lightpink');
        }
    });
});

