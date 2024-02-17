function setupModalHandlers(modalId) {
    var $modal = $(modalId);
    $modal.on('show.bs.modal', function () {
        $('.modal-content', this).addClass('modal-body-visible');
    }).on('hide.bs.modal', function () {
        $('.modal-content', this).removeClass('modal-body-visible');
    });
}
// Call the function for each modal ID
setupModalHandlers('#student-update');
setupModalHandlers('#changeimage');
setupModalHandlers('#changingpass');
setupModalHandlers('#user-access');
setupModalHandlers('#myModal');
setupModalHandlers('#modal-updatecontent');
setupModalHandlers('#modal-newcontent');
setupModalHandlers('#addcontentimages');

document.querySelector(".dropdown-menu").style.fontSize = "24px";
let dropDownItems = document.querySelectorAll(".dropdown-item");
dropDownItems.forEach(item=>{
    item.style.padding = "6px 24px";
});

function modal(){
    $('#doloading').modal('show');
}
function hidmodal() {
    $('#doloading').modal('hide');
}