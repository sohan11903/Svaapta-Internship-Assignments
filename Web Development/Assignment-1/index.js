let lab = document.querySelectorAll('.lab')
document.getElementById('dept').addEventListener('change', function () {
    let selectedDept = document.getElementById('dept').value;
    if (selectedDept == 'it') {
        lab.forEach(function(txt) {
            txt.style.color = 'black';
        });
    }
    if (selectedDept == 'mechanical') {
       lab.forEach(function(txt) {
            txt.style.color = 'darkblue';
        });
    }
    if (selectedDept == 'electrical') {
        lab.forEach(function(txt) {
            txt.style.color = 'brown';
        });
    }
});
function getAns() {
    event.preventDefault();
    let firstname = document.getElementById("fname").value.trim();
    let midname = document.getElementById("mname").value.trim();
    let lstname = document.getElementById("lname").value.trim();
    let email = document.getElementById("email").value.trim();
    let pw = document.getElementById("pas").value.trim();
    let cpw = document.getElementById("cpas").value.trim();
    const filein = document.getElementById('file');

    let s = true
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
    const file = filein.files[0];
    const allowedExtensions = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!file) {
        alert("Please select a file.");
        return;
    }
    else if (file.size > 1024 * 1024) {
        alert("File size should not exceed 1 MB.");
        return;
    }
    else if (!allowedExtensions.includes(file.type)) {
        alert("Only jpg, jpeg, and png files are allowed.");
        return;
    }
    alert('success')

}
