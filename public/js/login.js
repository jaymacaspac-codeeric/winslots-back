$('.alogin').submit(function(e) {
    console.log("submit");
    var uname = $('.alogin input[name=username]');
    var pw = $('.alogin input[name=password]');

    // if (uname.val() == "") {
    //     $('.alogin input[name=username]').addClass('form-control-danger');
    //     login_alert("Please enter your username.");
    //     uname.focus();
    //     return;
    // }
    // if (pw.val() == "") {
    //     login_alert("Please enter your password.");
    //     pw.focus();
    //     return;
    // }
})