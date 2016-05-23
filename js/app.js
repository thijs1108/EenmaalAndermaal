$(document).foundation();

//function to check username availability
function check_availability() {

    //get the username
    var username = $('#username').val();
    if ($('#username').val().length < 4) {
        //if it's bellow the minimum show characters_error text '
        $('.username-box').html(
            '</div>' +
            '<div class="alert-box">' +
            '<div data-alert class="alert-box warning columns" style="background-color: rgba(211, 84, 0, 0.2) !important;">' +
            '<i class="fi-alert"></i> Moet groter dan drie tekens zijn' +
            '</div>' +
            '</div>' +
            '</td></tr>'
        );
    } else {
        //use ajax to run the check
        $.post("/EenmaalAndermaal/includes/check_username_available.php", {
                username: username
            }
            , function (result) {
                //if the result is 1
                if (result == 1) {
                    //show that the username is available
                    $('.username-box').html(
                        '</div>' +
                        '<div class="alert-box">' +
                        '<div data-alert class="alert-box success columns" style="background-color: rgba(30, 130, 76, 0.2) !important;">' +
                        '<i class="fi-check"></i>' + username + ' is vrij' +
                        '</div>' +
                        '</div>' +
                        '</td></tr>'
                    );
                } else {
                    //show that the username is NOT available
                    $('.username-box').html(
                        '</div>' +
                        '<div class="alert-box">' +
                        '<div data-alert class="alert-box warning columns" style="background-color: rgba(211, 84, 0, 0.2) !important;">' +
                        '<i class="fi-alert"></i>' + username + ' is niet vrij' +
                        '</div>' +
                        '</div>' +
                        '</td></tr>'
                    );
                }
            });
    }

}
