$(function () {
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#defaultimage').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#userimage").change(function () {
        readURL(this);
    });
});
$(function () {
    $('.image-editor').cropit();
    $('form').submit(function () {
        var imageData = $('.image-editor').cropit('export');
        $('.hidden-image-data').val(imageData);
        var formValue = $(this).serialize();
        $('#result-data').text(formValue);
    });
});