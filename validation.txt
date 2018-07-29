document.body.onload = function () {
    var Form = $('#registerForm');
    Form.on('submit', function (e) {
        formValidation(e, e.target);
    });
};
// Validates that the input string is a valid date formatted as "mm/dd/yyyy"
function formValidation (e, F) {
    var errorInputs = validateInputs(F.id),
        errorDate = isValidDate(F.id),
        errorSelect = checkSelect(F.id),
        errorImage = checkImages(F.id);
    if (!errorDate) {
        $('#' + F.id + ' input[name="birthdate"]').addClass('border-danger');
    } else {
        $('#' + F.id + ' input[name="birthdate"]').removeClass('border-danger');
    }
    if (errorInputs || !errorDate || errorSelect || errorImage) {
        console.log('error');
        e.preventDefault();
    }
}
function checkImages(Form) {
    var error = false;
    var img = $('#' + Form + ' input[name="img"]')[0]   ;
    if(img.files.length === 0) {
        $(img).siblings('label').addClass('border-danger');
        error = true;
    } else {
        $(img).siblings('label').removeClass('border-danger');
        error = false;
    }
    return error;
}
function isValidDate(Form) {
    var dateString = $('#' + Form + ' input[name="birthdate"]').val();
    // First check for the pattern
    if(!(/^\d{1,2}\/\d{1,2}\/\d{4}$/).test(dateString)) {
        return false;
    }

    // Parse the date parts to integers
    var parts = dateString.split("/");
    var day = parseInt(parts[1], 10);
    var month = parseInt(parts[0], 10);
    var year = parseInt(parts[2], 10);

    // Check the ranges of month and year
    if(year < 1000 || year > 3000 || month == 0 || month > 12) {
        return false;
    }

    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    // Adjust for leap years
    if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
        monthLength[1] = 29;

    // Check the range of the day
    return day > 0 && day <= monthLength[month - 1];
}
function validateInputs(Form) {
    var error = false;
    $('input[type="text"]:not([name="birthdate"]), input[type="email"]', $('#' + Form)).each(function () {
        var input = $(this),
            regEx = input.data('check'),
            v = input.val();
        if (v === '' || v.match(regEx)) {
            input.addClass('border-danger');
            error = true;
        } else {
            input.removeClass('border-danger');
        }
    });
    return error;
}
function checkSelect(Form) {
    var selectBox = $('#' + Form + ' select');
    if (selectBox.val() === '') {
        selectBox.addClass('border-danger');
        return true;
    } else {
        selectBox.removeClass('border-danger');
        return false;
    }
}


// file extension check
var validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
function ValidateSingleInput(fileInput) {
    if (fileInput.type == "file") {
        var sFileName = fileInput.value;
        if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < validFileExtensions.length; j++) {
                var sCurExtension = validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }

            if (!blnValid) {
                alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + validFileExtensions.join(", "));
                fileInput.value = "";
                return false;
            }
        }
    }
    return true;
}