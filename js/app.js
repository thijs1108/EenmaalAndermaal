$(document).foundation();


function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};

//function to check username availability
function check_availability() {

    //get the username
    var username = $('#username').val();
    if ($('#username').val().length < 4) {
        //if it's bellow the minimum show characters_error text '
        $('.username-box').html(
            '<div data-alert class="alert-box warning columns" style="background-color: rgba(211, 84, 0, 0.2) !important;">' +
            '<i class="fi-alert"></i> Moet groter dan drie tekens zijn' +
            '</div>'
        );
    } else {
        //use ajax to run the check
        $.post("includes/check_username_available.php", {
                username: username
            }
            , function (result) {
                //if the result is 1
                if (result == 1) {
                    //show that the username is available
                    $('.username-box').html(
                        '<div data-alert class="alert-box success columns" style="background-color: rgba(30, 130, 76, 0.2) !important;">' +
                        '<i class="fi-check"></i>' + username + ' is vrij' +
                        '</div>'
                    );
                } else {
                    //show that the username is NOT available
                    $('.username-box').html(
                        '<div data-alert class="alert-box warning columns" style="background-color: rgba(211, 84, 0, 0.2) !important;">' +
                        '<i class="fi-alert"></i>' + username + ' is niet vrij' +
                        '</div>'
                    );
                }
            });
    }

}

function check_password(){
    var password = $('#password').val();
    if ($('#password').val().length < 8) {
        //if it's bellow the minimum show characters_error text '
        $('.password-box').html(
            '<div data-alert class="alert-box warning columns" style="background-color: rgba(211, 84, 0, 0.2) !important;">' +
            '<i class="fi-alert"></i> Moet groter dan zeven tekens zijn' +
            '</div>'
        );
    }
    else{
        $('.password-box').html(
            ''
        );
    }
    check_second_password();
}

function check_second_password(){
    var password = $('#password').val();
    var second_password = $('#second_password').val();
    if (password!=second_password) {
        //if it's bellow the minimum show characters_error text '
        $('.second_password-box').html(
            '<div data-alert class="alert-box warning columns" style="background-color: rgba(211, 84, 0, 0.2) !important;">' +
            '<i class="fi-alert"></i> Niet gelijk aan eerste wachtwoord' +
            '</div>'
        );
    }
    else{
        $('.second_password-box').html(
            ''
        );
    }
}

function check_email(){
    var email = $('#email').val();
    if (!isValidEmailAddress(email)) {
        //if it's bellow the minimum show characters_error text '
        $('.email-box').html(
            '<div data-alert class="alert-box warning columns" style="background-color: rgba(211, 84, 0, 0.2) !important;">' +
            '<i class="fi-alert"></i> Geen valide e-mailadres' +
            '</div>'
        );
    }
    else{
        $('.email-box').html(
            ''
        );
    }
}
