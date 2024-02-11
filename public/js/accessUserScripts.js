function samandar() {
    $('#user-access')
        .find("input[type=checkbox], input[type=radio]")
        .prop("checked", "")
        .end();
    $('#user-access').modal('hide');
}
$(document).on('show.bs.modal','#user-access', function () {
    $("#userimagee").value = "";
    $("input#image-data").cropit('destroy');
    $("input#usercropedimage").cropit('destroy');
    $('#user-access')
        .find("input[type=checkbox], input[type=radio]")
        .prop("checked", "")
        .end();
});
$(document).on('hidden.bs.modal','#user-access', function () {
    $("#userimagee").value = "";
    $("input#image-data").cropit('destroy');
    $("input#usercropedimage").cropit('destroy');
    $('#user-access')
        .find("input[type=checkbox], input[type=radio]")
        .prop("checked", "")
        .end();
});