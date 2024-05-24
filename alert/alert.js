//input new user form

function InputNewUser(){
    Swal.fire({
        title: "Password Default",
        icon: "question",
        html: '<input id="pwd" type="text" class="form-control swal2-input" placeholder="Jika Kosong : (#admin1234)" >',
        showCloseButton: false,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: "OK",
        confirmButtonAriaLabel: "OK",
        cancelButtonText: "Cancel",
        cancelButtonAriaLabel: "Cancel",
    })
}