
function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}

function validateForm() {

    var name = document.getElementById('name');
    var amount = document.getElementById('amount');

    var nameErr = amountErr = true;

// Validate name
if(name == "") {
    printError("nameErr", "Please enter your name");
} else {
    var regex = /^[a-zA-Z]+$/;
    if(regex.test(name) === false) {
        printError("nameErr", "Please enter a valid name");
    } else {
        printError("nameErr", "");
        nameErr = false;
    }
}

// Validate amount
if(amount == "") {
    printError("amountErr", "Please enter amount");
} else {
    var regex = /^\d{0,2}(\.\d{1,2})?$/;
    if(regex.test(amount) === false) {
        printError("amountErr", "Please enter a valid amount");
    } else {
        printError("amountErr", "");
        amountErr = false;
    }
}


    if((nameErr || amountErr) == true) {
        return false;
    } else {
        var dataPreview = "You've entered the following details: \n" +
            "Name: " + name + "\n" +
            "Amount: " + amount + "\n";

        alert(dataPreview);
    }
};


