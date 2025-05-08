let form = document.getElementById("form");
let fname = document.getElementById("fname");
let lname = document.getElementById("lname");
let address = document.getElementById("address");
let phone = document.getElementById("phone");
let email = document.getElementById("email");
let password = document.getElementById("password");
let cpassword = document.getElementById("cpassword");

let a = document.getElementById("one");
let b = document.getElementById("two");
let c = document.getElementById("three");
let d = document.getElementById("four");
let e = document.getElementById("five");
let f = document.getElementById("six");
let g = document.getElementById("seven");

// var numberRegex = /^\d+$/;

form.addEventListener("submit", (event) => {
    event.preventDefault(); // Prevent form submission


    var numberRegex = /\d/;   // Matches any digit (0-9)
    // var alphabetRegex = /^[a-zA-Z\s]+$/; //checks if the entire string is made up of only alphabetic characters and spaces.
    var aalphabetRegex = /[a-zA-Z]/; // checks if any part of the string contains at least one alphabetic character.
    var Regexstart= /^(?!98|97)\d+$/ //Number must not started form 98 or 97
    var emailRegex = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; // Validate email format




    // Reset previous error messages
    a.innerHTML = b.innerHTML = c.innerHTML = d.innerHTML = e.innerHTML = f.innerHTML = g.innerHTML = "";

    let isValid = true;

    // Validate First Name
    if (fname.value === "") {
        a.innerHTML = "First Name is required.";
        isValid = false;
    }else if (numberRegex.test(fname.value)) {
        a.innerHTML = "Numbers not allowed";
        isValid = false;
    }

    // Validate Last Name
    if (lname.value === "") {
        b.innerHTML = "Last Name is required.";
        isValid = false;
    }else if (numberRegex.test(lname.value)) {
        b.innerHTML = "Numbers not allowed";
        isValid = false;
    }

    // Validate Address
    if (address.value === "") {
        c.innerHTML = "Address is required.";
        isValid = false;
    }else if (numberRegex.test(address.value)) {
        c.innerHTML = "Numbers not allowed";
        isValid = false;
    }else if (address.value.length<=5){
        c.innerHTML = "Must contain more then 5 character";
        isValid = false;
    }

    // Validate Phone Number
    if (phone.value === "") {
        d.innerHTML = "Phone Number is required.";
        isValid = false;
    } else if (aalphabetRegex.test(phone.value)) {
        d.innerHTML = "Alphabet not allowed in Phone Number.";
        isValid = false;
    } else if (Regexstart.test(phone.value)) {
        d.innerHTML = "Phone Number must start with 98 or 97";
        isValid = false;
    } else if (phone.value.length !== 10) {
        d.innerHTML = "Phone Number must be 10 digits long.";
        isValid = false;
    }

    // Validate Email
    if (email.value === "") {
        e.innerHTML = "Email is required.";
        isValid = false;
    }else if(!emailRegex.test(email.value)){
        e.innerHTML="Check the email format";
        isValid = false;
    }

    // Validate Password
    if (password.value === "") {
        f.innerHTML = "Password is required.";
        isValid = false;
    } else if (password.value.length <= 4) {
        f.innerHTML = "Minimum length is 5 characters.";
        isValid = false;
    } else if (!aalphabetRegex.test(password.value)) {
        f.innerHTML = "Password must contain at least one letter.";
        isValid = false;
    } else if (!numberRegex.test(password.value)) {
        f.innerHTML = "Password must contain at least one number.";
        isValid = false;
    }
    
    // Validate Confirm Password
    if (cpassword.value === "") {
        g.innerHTML = "Please confirm your password.";
        isValid = false;
    } else if (password.value !== cpassword.value) {
        g.innerHTML = "Passwords do not match.";
        isValid = false;
    }

    // If all fields are valid, you can proceed with form submission (optional)
    if (isValid) {
        form.submit(); // Submit the form if all validations pass
    }
});
