/*
    Author: Corinne Mullan
    Date: 2018-06-04
    Description: The purpose of this file is to validate the registration form with JS to improve the user's experience when
                 filling out the registration form (the form will be validated a second time on the server side using php
                 for security purposes)
    Work Done: Added popovers to form fields,
               Added custom jquery-validate rules and messages for the main fields

    Modified By: Joshua Mcnabb
    Date: 2018-06-05 - 2018-06-07
    Work Done: Made jquery-validate work with every field
               Added input masks for home and business phone numbers
*/
$(document).ready(function() {
    $('#firstname').popover({content: "Please enter your first name", placement: "top", trigger: "focus"});
    $('#lastname').popover({content: "Please enter your last name", placement: "top", trigger: "focus"});
    $('#address').popover({content: "Please enter your address", placement: "top", trigger: "focus"});
    $('#city').popover({content: "Please enter your city", placement: "top", trigger: "focus"});
    //$('#province').popover({content: "Please select your province", placement: "bottom", trigger: "focus"});
    $('#postalcode').popover({content: "Please enter your postal code as A1A 1A1", placement: "top", trigger: "focus"});
    $('#country').popover({content: "Please enter your country", placement: "top", trigger: "focus"});
    $('#homephone').popover({content: "Please enter your home phone number using digits only", placement: "top", trigger: "focus"});
    $('#businessphone').popover({content: "Please enter your business phone number using digits only", placement: "top", trigger: "focus"});
    $('#email').popover({content: "Please enter your email address", placement: "top", trigger: "focus"});
    $('#username').popover({content: "Please choose a username containing only letters and numbers", placement: "top", trigger: "focus"});
    $('#password').popover({content: "Please choose a password", placement: "top", trigger: "focus"});
    $('#confirm').popover({content: "Please re-enter the password", placement: "top", trigger: "focus"});

    $('#homephone').mask('1 (000) 000-0000', {'translation': {0: {pattern: /[0-9]/}}});
    $('#businessphone').mask('1 (000) 000-0000', {'translation': {0: {pattern: /[0-9]/}}});

    // Custom email regular expression
    /*$.validator.methods.email = function(value, element) {
        return this.optional(element) || /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
    }

    // Jquery-validate (Corinne)
    $('#createAccount').validate({
        rules: {
            firstname: {
                required: true,
                minlength: 2,
                maxlength: 25 // The maxlength of the CustFirstName in the database
            },
            lastname: {
                required: true,
                minlength: 2,
                maxlength: 25
            },
            postalcode: { postalCodeCA: true }, // Use custom validator method for postal code
            businessphone: {
                minlength: 11,
                maxlength: 11,
                digits: true
            },
            homephone: {
                minlength: 11,
                maxlength: 11,
                digits: true
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            postalcode: { postalcode: "Postal code should be in the format A1A 1A1" },
            businessphone: {
                minlength: "Business phone number should be 10 digits",
                maxlength: "Business phone number should be 10 digits",
                digits: "Business phone number should contain only digits"
            },
            homephone: {
                minlength: "Home phone number should be 10 digits",
                maxlength: "Home phone number should be 10 digits",
                digits: "Home phone number should contain only digits"
            },
            email: { email: "Please enter a valid email address" }
        }
    });*/
    // Jquery-validate (Corinne)
});
