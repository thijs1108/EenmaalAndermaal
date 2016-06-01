$(document).foundation();

$('#submitregister').prop('disabled', true);
var valid = [];


function check_email(){
    var email = $('#email').val();
    if (!isValidEmailAddress(email)) {
        //if it's bellow the minimum show characters_error text '
        $('.email-box').html(
            '<div data-alert class="alert-box warning columns" style="background-color: rgba(211, 84, 0, 0.2) !important;">' +
            '<i class="fi-alert"></i> Geen valide e-mailadres' +
            '</div>'
        );
        valid['email']=false;
    }
    else{
        $('.email-box').html(
            ''
        );
        valid['email']=true;
    }
    check_total_valid();
}

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
        valid['username']=false;
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
                    valid['username']=true;
                } else {
                    //show that the username is NOT available
                    $('.username-box').html(
                        '<div data-alert class="alert-box warning columns" style="background-color: rgba(211, 84, 0, 0.2) !important;">' +
                        '<i class="fi-alert"></i>' + username + ' is niet vrij' +
                        '</div>'
                    );
                    valid['username']=false;
                }
            });
    }
    check_total_valid();

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
        valid['passwordone']=false;
    }
    else{
        $('.password-box').html(
            ''
        );
        valid['passwordone']=true;
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
        valid['passwordtwo']=false;
    }
    else{
        $('.second_password-box').html(
            ''
        );
        valid['passwordtwo']=true;
    }
    check_total_valid();
}

function check_voornaam(){
    var voornaam = $('#voornaam').val();
    if (voornaam.length<3) {
        //if it's bellow the minimum show characters_error text '
        $('.voornaam-box').html(
            '<div data-alert class="alert-box warning columns" style="background-color: rgba(211, 84, 0, 0.2) !important;">' +
            '<i class="fi-alert"></i> Voornaam moet minimaal drie tekens lang zijn' +
            '</div>'
        );
        valid['voornaam']=false;
    }
    else{
        $('.voornaam-box').html(
            ''
        );
        valid['voornaam']=true;
    }
    check_total_valid();
}

function check_achternaam(){
    var achternaam = $('#achternaam').val();
    if (achternaam.length<3) {
        //if it's bellow the minimum show characters_error text '
        $('.achternaam-box').html(
            '<div data-alert class="alert-box warning columns" style="background-color: rgba(211, 84, 0, 0.2) !important;">' +
            '<i class="fi-alert"></i> Achternaam moet minimaal drie tekens lang zijn' +
            '</div>'
        );
        valid['achternaam']=false;
    }
    else{
        $('.achternaam-box').html(
            ''
        );
        valid['achternaam']=true;
    }
    check_total_valid();
}

function check_telefoon(){
    var telefoon = $('#telefoon').val();
    if (telefoon.length<8) {
        //if it's bellow the minimum show characters_error text '
        $('.telefoon-box').html(
            '<div data-alert class="alert-box warning columns" style="background-color: rgba(211, 84, 0, 0.2) !important;">' +
            '<i class="fi-alert"></i> Telefoonnummer moet minimaal acht tekens lang zijn' +
            '</div>'
        );
        valid['telefoon']=false;
    }
    else{
        $('.telefoon-box').html(
            ''
        );
        valid['telefoon']=true;
    }
    check_total_valid();
}


function check_adres(){
    var adres = $('#adres').val();
    if (adres.length<8) {
        //if it's bellow the minimum show characters_error text '
        $('.adres-box').html(
            '<div data-alert class="alert-box warning columns" style="background-color: rgba(211, 84, 0, 0.2) !important;">' +
            '<i class="fi-alert"></i> Adres moet minimaal acht tekens lang zijn' +
            '</div>'
        );
        valid['adres']=false;
    }
    else{
        $('.adres-box').html(
            ''
        );
        valid['adres']=true;
    }
    check_total_valid();
}

function check_postcode(){
    var postcode = $('#postcode').val();
    if (postcode.length<6) {
        //if it's bellow the minimum show characters_error text '
        $('.postcode-box').html(
            '<div data-alert class="alert-box warning columns" style="background-color: rgba(211, 84, 0, 0.2) !important;">' +
            '<i class="fi-alert"></i> Postcode moet minimaal zes tekens lang zijn' +
            '</div>'
        );
        valid['postcode']=false;
    }
    else{
        $('.postcode-box').html(
            ''
        );
        valid['postcode']=true;
    }
    check_total_valid();
}

function check_plaats(){
    var plaats = $('#plaats').val();
    if (plaats.length<2) {
        //if it's bellow the minimum show characters_error text '
        $('.plaats-box').html(
            '<div data-alert class="alert-box warning columns" style="background-color: rgba(211, 84, 0, 0.2) !important;">' +
            '<i class="fi-alert"></i> Plaats moet minimaal twee tekens lang zijn' +
            '</div>'
        );
        valid['plaats']=false;
    }
    else{
        $('.plaats-box').html(
            ''
        );
        valid['plaats']=true;
    }
    check_total_valid();
}

function check_land(){
    var land = $('#land').val();
    if (land.length<2) {
        //if it's bellow the minimum show characters_error text '
        $('.land-box').html(
            '<div data-alert class="alert-box warning columns" style="background-color: rgba(211, 84, 0, 0.2) !important;">' +
            '<i class="fi-alert"></i> Land moet minimaal twee tekens lang zijn' +
            '</div>'
        );
        valid['land']=false;
    }
    else{
        $('.land-box').html(
            ''
        );
        valid['land']=true;
    }
    check_total_valid();
}


function check_vraag(){
    var vraag = $('#vraag').val();
    var vraag = parseInt(vraag);
    if (vraag.value>0 && vraag.value<6) {
        //if it's bellow the minimum show characters_error text '
        $('.vraag-box').html(
            '<div data-alert class="alert-box warning columns" style="background-color: rgba(211, 84, 0, 0.2) !important;">' +
            '<i class="fi-alert"></i> Vraag niet valide' +
            '</div>'
        );
        valid['vraag']=false;
    }
    else{
        $('.vraag-box').html(
            ''
        );
        valid['vraag']=true;
    }
    check_total_valid();
}

function check_antwoord(){
    var antwoord = $('#antwoord').val();
    if (antwoord.length<1) {
        //if it's bellow the minimum show characters_error text '
        $('.antwoord-box').html(
            '<div data-alert class="alert-box warning columns" style="background-color: rgba(211, 84, 0, 0.2) !important;">' +
            '<i class="fi-alert"></i> Plaats moet minimaal één teken lang zijn' +
            '</div>'
        );
        valid['antwoord']=false;
    }
    else{
        $('.antwoord-box').html(
            ''
        );
        valid['antwoord']=true;
    }
    check_total_valid();
}

function check_total_valid(){
    var total = 0
    for(antwoord in valid){
        if(valid[antwoord]==true){
            total++;
        }
    }
    console.log(total);
    if(total>11){
        $('#submitregister').prop('disabled', false);
    }
    else{
        $('#submitregister').prop('disabled', true);
    }
}

