function resetForm(formId) {
    var myForm = document.getElementById(formId);

    for (var i = 0; i < myForm.elements.length; i++) {
        if ('submit' != myForm.elements[i].type && 'reset' != myForm.elements[i].type) {
            myForm.elements[i].checked = false;
            myForm.elements[i].value = '';
            myForm.elements[i].selectedIndex = 0;
        }
    }
}

function togglePassword(input_el) {
    $(input_el).find( 'i' ).toggleClass("glyphicon-eye-open glyphicon-eye-close");
    var input = $($(input_el).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
}