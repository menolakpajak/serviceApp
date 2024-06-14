// EDIT NEW

function editNew() {
    var edit = document.getElementById("edit");
    var id = document.getElementById("id");
    var ajax = new XMLHttpRequest();
    //cek kesiapan ajax
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            edit.innerHTML = ajax.responseText;
        }
    };

    // jalankan ajaxnya
    ajax.open("GET", "../ajax/editForm.php?id=" + id.value, "true");
    ajax.send();
}

// EDIT PROSES
function editProses() {
    var edit = document.getElementById("edit");
    var id = document.getElementById("id");
    var ajax = new XMLHttpRequest();
    //cek kesiapan ajax
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            edit.innerHTML = ajax.responseText;
        }
    };

    // jalankan ajaxnya
    ajax.open("GET", "../ajax/editFormProses.php?id=" + id.value, "true");
    ajax.send();
}

// UPDATE PROSES

function nextUpdate() {
    var edit = document.getElementById("edit");
    var id = document.getElementById("id");
    var ajax = new XMLHttpRequest();

    //cek kesiapan ajax
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            edit.innerHTML = ajax.responseText;
        }
    };

    // jalankan ajaxnya
    ajax.open("GET", "../ajax/update.php?id=" + id.value, "true");
    ajax.send();
}

// EDIT DONE

function editDone() {
    var edit = document.getElementById("edit");
    var id = document.getElementById("id");
    var ajax = new XMLHttpRequest();
    //cek kesiapan ajax
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            edit.innerHTML = ajax.responseText;
        }
    };

    // jalankan ajaxnya
    ajax.open("GET", "../ajax/editFormDone.php?id=" + id.value, "true");
    ajax.send();
}

// EDIT ABORT

function editAbort() {
    var edit = document.getElementById("edit");
    var id = document.getElementById("id");
    var ajax = new XMLHttpRequest();
    //cek kesiapan ajax
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            edit.innerHTML = ajax.responseText;
        }
    };

    // jalankan ajaxnya
    ajax.open("GET", "../ajax/editFormAbort.php?id=" + id.value, "true");
    ajax.send();
}

//EDIT SERVICE CENTER

function editSC() {
    var edit = document.getElementById("edit");
    var id = document.getElementById("id");
    var ajax = new XMLHttpRequest();
    //cek kesiapan ajax
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            edit.innerHTML = ajax.responseText;
        }
    };

    // jalankan ajaxnya
    ajax.open("GET", "../ajax/editFormServiceCenter.php?id=" + id.value, "true");
    ajax.send();
}

// EDIT INVOICE
function editINV(id) {
    var edit = document.getElementById("edit");
    var ajax = new XMLHttpRequest();
    //cek kesiapan ajax
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            edit.innerHTML = ajax.responseText;
        }
    };

    // jalankan ajaxnya
    ajax.open("GET", "../ajax/editFormInvoice.php?id=" + id, "true");
    ajax.send();
}

//cek invoice
function cekInvoice(id, spk) {
    let formData = new FormData();
    formData.append("kode", id);
    formData.append("spk", spk);
    formData.append("submit", true);

    var ajax = new XMLHttpRequest();
    // Menambahkan elemen loading spinner ke dalam pesan SweetAlert
    var swalWithLoading = Swal.mixin({
        title: "CHECKING 🔍",
        text: "Please wait...",
        allowOutsideClick: false,
        showCancelButton: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        },
        didClose: () => {
            Swal.close();
        },
    });

    // Menampilkan loading spinner sebelum mengirim request
    swalWithLoading.fire();

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var ok = ajax.responseText;
            swalWithLoading.close();
            if (ok == "ok") {
                location.href = `../detail-invoice/?id=${id}`;
            } else {
                Swal.fire({
                    icon: "error",
                    title: "FAIL",
                    confirmButtonText: "Back",
                    confirmButtonColor: "#f54949",
                    text: "Invoice tidak ditemukan !",
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            }
        }
    };

    ajax.open("POST", `../ajax/cekInvoice.php`, "true");
    ajax.send(formData);
}
