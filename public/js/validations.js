//keyup" means that the code runs every time the user releases a key while typing in the username field.
let username = document.getElementById('userName');
let password = document.getElementById('password');
let isUsernameAvailable = false; // Track username availability
let confirmPass = document.getElementById('confirmPassword');
let fileInput = document.getElementById('fileInput'); // Assuming the file input has an id of 'fileInput'


username.onkeyup = function () {
    var user = username.value.trim();
    var statusMessage = document.getElementById("username_status");

    if (user === "") {
        statusMessage.innerHTML = "";
        isUsernameAvailable = false;
        return;
    }


    if (user.length >= 3) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/check-username", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Add CSRF token header required by Laravel
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                if (xhr.responseText === "taken") {
                    statusMessage.innerHTML = "<span class='text-danger'>Username already taken , try another user name</span>";
                    isUsernameAvailable = false;
                } else {
                    statusMessage.innerHTML = "<span class='text-success'>Username available </span>";
                    isUsernameAvailable = true;
                }
            }
        };

        xhr.send("username=" + encodeURIComponent(user));
    }
}
    

let nameLength = document.createElement("p");
nameLength.textContent = "username must be at least 3 characters long";
nameLength.style.fontSize = "15px";
nameLength.style.color = "red";
nameLength.style.margin = "0";

username.onblur = function () {
    if (this.value.length < 3) {
        username.parentNode.insertBefore(nameLength, username.nextSibling.nextSibling);
        //this.focus();
        return false;
    }
    if (username.nextSibling.nextSibling.tagName == "P") {
        username.nextSibling.nextSibling.remove();

    }

    if (!isUsernameAvailable) {
        //username.focus(); // Force user to stay in username field
        return false;
    }
};

//password validation 
let passlength = document.createElement("P");
passlength.textContent = "Password must be at least 8 characters long, contain at least one number, and one special character (e.g., @, #, $, etc.).";
passlength.style.fontSize = "15px";
passlength.style.color = "red";
passlength.style.margin = "0";

const passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*.])[A-Za-z0-9!@#$%^&*.]{8,}$/;

password.onblur = function () {
    if (!passwordRegex.test(this.value)) {
        // Show error message
        if (!password.nextElementSibling || password.nextElementSibling.tagName !== "P") {
            password.parentNode.insertBefore(passlength, password.nextSibling.nextSibling);
        }
        //this.focus();
        return false;
    }

    // Remove error message if valid
    if (password.nextElementSibling && password.nextElementSibling.tagName === "P") {
        password.nextElementSibling.remove();
    }
};

//confirmed password validation
let confirmed = document.createElement("P");
confirmed.textContent = "Passwords do not match , try again";
confirmed.style.fontSize = "15px";
confirmed.style.color = "red";
confirmed.style.margin = "0";

confirmPass.onblur = function () {
    if (this.value != password.value) {
        confirmPass.parentNode.insertBefore(confirmed, confirmPass.nextSibling.nextSibling);
        // Disable the file input to prevent file upload
        //fileInput.disabled = true;  // Disable the file input
        //this.focus();
        return false;

    }
    if (confirmPass.nextSibling.nextSibling.tagName == "P") {
        confirmPass.nextSibling.nextSibling.remove();

    }
    //fileInput.disabled = false;

};

//email validation
let email = document.getElementById('email'); // Assuming the input id is 'email'
let emailError = document.createElement("P");
emailError.textContent = "Please enter a valid email address.";
emailError.style.fontSize = "15px";
emailError.style.color = "red";
emailError.style.margin = "0";

//at least one char in domain , after .
const emailRegex = /^(?=.*[a-zA-Z])[^\s@]+@[^\s@]*[a-zA-Z][^\s@]*\.[^\s@]*[a-zA-Z][^\s@]*$/;


email.onblur = function () {
    if (!emailRegex.test(this.value)) {
        if (!email.nextElementSibling || email.nextElementSibling.tagName !== "P") {
            email.parentNode.insertBefore(emailError, email.nextSibling.nextSibling);
        }
        //this.focus();
        return false;
    }
    if (email.nextElementSibling && email.nextElementSibling.tagName === "P") {
        email.nextElementSibling.remove();
    }
};

//phone number validation 
let phoneNumber = document.getElementById('phone'); // Assuming the input id is 'phoneNumber'
let phoneError = document.createElement("P");
phoneError.textContent = "Please enter a valid phone number (9 to 11 digits, numbers only, no spaces or special characters).";
phoneError.style.fontSize = "15px";
phoneError.style.color = "red";
phoneError.style.margin = "0";

const phoneRegex = /^[0-9]{9,11}$/;

phoneNumber.onblur = function () {
    if (!phoneRegex.test(this.value)) {
        if (!phoneNumber.nextElementSibling || phoneNumber.nextElementSibling.tagName !== "P") {
            phoneNumber.parentNode.insertBefore(phoneError, phoneNumber.nextSibling.nextSibling);
        }
        //this.focus();
        return false;
    }
    if (phoneNumber.nextElementSibling && phoneNumber.nextElementSibling.tagName === "P") {
        phoneNumber.nextElementSibling.remove();
    }
};

//full name validation 
const fullNameInput = document.getElementById("fullName");
// Create <p> element for Full Name validation
let fullNameError = document.createElement("p");
fullNameError.textContent = "Full Name must contain only letters and spaces (at least 3 characters).";
fullNameError.style.fontSize = "15px";
fullNameError.style.color = "red";
fullNameError.style.margin = "0";

fullNameInput.onblur = function () {
    const regex = /^[a-zA-Z\s]{3,50}$/;

    if (!regex.test(this.value.trim())) {
        // Insert the <p> message if not already inserted
        if (!fullNameInput.nextElementSibling || fullNameInput.nextElementSibling.tagName !== "P") {
            fullNameInput.parentNode.insertBefore(fullNameError, fullNameInput.nextSibling.nextSibling);
        }
        //this.focus();
        return false;
    }

    // Remove <p> message if full name is valid
    if (fullNameInput.nextElementSibling && fullNameInput.nextElementSibling.tagName === "P") {
        fullNameInput.nextElementSibling.remove();
    }
};



/* whatsapp number validation */
var countryPrefix = document.getElementById("countryPrefix");
var whatsappNumber = document.getElementById('whatsappNumber');
var checkWhatsappNumberBtn = document.getElementById("checkWhatsappNumberBtn");
var apiKey = "f4d7692d53msh0e8e04966683c30p118e4cjsnd9175f4c94d7";
var whatsappMsg = document.getElementById("whatsappMsg");

checkWhatsappNumberBtn.addEventListener("click", async function () {
    var whatsappNumberValue = whatsappNumber.value;
    whatsappNumberValue = countryPrefix.value + whatsappNumberValue;
    console.log(whatsappNumberValue);
    var check = await checkWhatsappNumber(whatsappNumberValue);
    if (check === true) {
        successMsg(whatsappMsg, "Valid Whatsapp Number!");
        console.log("valid");
    }
    else {
        errorMsg(whatsappMsg, "Invalid Whatsapp Number!");
        console.log("Invalid");
    }
})

async function checkWhatsappNumber(number) {
    try {
        var response = await fetch("https://whatsapp-number-validator3.p.rapidapi.com/WhatsappNumberHasItWithToken", {
            method: "POST",
            body: JSON.stringify(
                {
                    phone_number: number
                }
            ),
            headers: {
                'Content-Type': 'application/json',
                'x-rapidapi-host': 'whatsapp-number-validator3.p.rapidapi.com',
                'x-rapidapi-key': 'f4d7692d53msh0e8e04966683c30p118e4cjsnd9175f4c94d7'
            }
        })
        var finalResponse = await response.json();
        console.log(finalResponse);
        console.log(finalResponse.status);
        if (finalResponse.status == "valid") {
            return true;
        }
        return false;
    }
    catch (error) {
        console.error("Error: ", error);
        return false;
    }
}


function successMsg(element, msg) {
    element.classList.replace("text-danger", "text-success");
    element.innerHTML = msg;
    console.log("hello from success");
}

function errorMsg(element, msg) {
    element.classList.replace("text-success", "text-danger");
    element.innerHTML = msg;
    console.log("hello from error");
}


/* view password */
var viewPasswordBtn = document.getElementById("viewPassword");
viewPasswordBtn.addEventListener("click", function () {
    if (password.type == "password" && confirmPass.type == "password") {
        password.type = "text";
        confirmPass.type = "text";
    }
    else {
        password.type = "password";
        confirmPass.type = "password";
    }
})

/*document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('registrationForm');
    const errorBox = document.getElementById('errorMessage');
    const successBox = document.getElementById('successMessage');

    // Hide alerts initially
    //errorBox.classList.add("d-none");
    //successBox.classList.add("d-none");

    form.addEventListener('submit', function (e) {
        // Manually trigger all .onblur validations (e.g. password, email, etc.)
        document.querySelectorAll("#registrationForm input").forEach(input => input.blur());

        const hasErrorMessages = Array.from(form.querySelectorAll("p")).some(p =>
            getComputedStyle(p).color === "rgb(255, 0, 0)" // red in RGB
        );
        
        const usernameStatus = typeof isUsernameAvailable !== "undefined" ? isUsernameAvailable : true;

        if (hasErrorMessages || !usernameStatus) {
            e.preventDefault();
            errorBox.textContent = hasErrorMessages ? "Please correct all errors." : "Username is not available.";
            errorBox.classList.remove("d-none");
            successBox.classList.add("d-none");
            return false;
        }

        // All good
        errorBox.classList.add("d-none");
        successBox.textContent = "Registration form submitted successfully!";
        successBox.classList.remove("d-none");
        form.style.display='none';
        //form.classList.add("d-none"); // optionally hide the form

    });

    // Hide error alert as soon as any field is updated
    document.querySelectorAll("#registrationForm input, #registrationForm select").forEach(el => {
        el.addEventListener("input", () => {
            const hasErrors = form.querySelectorAll("p").length > 0;
            if (!hasErrors && isUsernameAvailable) {
                errorBox.classList.add("d-none");
            }
        });
    });
});*/





/*document.addEventListener('DOMContentLoaded', function () {
    let form = document.getElementById('registrationForm');
    let successMessage = document.getElementById('successMessage');

    if (form && successMessage) {
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Stop page reload
            successMessage.classList.remove('d-none'); // Show message
            //form.reset(); // Clear form fields
            form.style.display = 'none'; // Optionally hide the form
        });
    } else {
        console.warn("Form or success message not found.");
    }
});*/


