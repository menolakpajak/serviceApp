// GENERATE RANDOM STRING
function generateRandomString(length) {
    const characters = "0123456789";
    const separator = "-";
    let randomString = "";

    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * characters.length);
        randomString += characters.charAt(randomIndex);
    }

    // Menambahkan strip setelah 3 digit pertama
    randomStringSlash = randomString.slice(0, 3) + separator + randomString.slice(3);

    return [randomString, randomStringSlash];
}
// REMOVE SPECIAL CHAR
function removeSpecialCharacters(inputString) {
    // Menggunakan ekspresi reguler untuk menyaring karakter yang bukan huruf atau angka
    return inputString.replace(/[^a-zA-Z0-9]/g, "");
}

//KOMFIRMASI awal input data ke NEW
function confirmInput(event) {
    event.preventDefault();

    Swal.fire({
        title: "KIRIM ?",
        text: "Apakah Data yang Anda input sudah benar ?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Input",
    }).then((result) => {
        if (result.isConfirmed) {
            var input = document.querySelector(".inputBtn");
            // input.style.display = "none";

            var date = document.querySelector("#date").value;
            var no_spk = document.querySelector("#no_spk").value;
            var nama = document.querySelector("#nama").value;
            var wa = document.querySelector("#wa").value;
            var no_tlp = document.querySelector("#no_tlp").value;
            var alamat = document.querySelector("#alamat").value;
            var tipe_unit = document.querySelector("#tipe_unit").value;
            var unit = document.querySelector("#unit").value;
            var serial_number = document.querySelector("#serial_number").value;
            var counter = document.querySelector("#counter").value;
            var pin = document.querySelector("#pin").value;
            var note = document.querySelector("#note").value;
            var error = document.querySelector("#error").value;
            var check_kamera = document.querySelector("#check_kamera");
            var check_lensa = document.querySelector("#check_lensa");
            var check_battery = document.querySelector("#check_battery");
            var check_memory = document.querySelector("#check_memory");
            var check_strap = document.querySelector("#check_strap");
            var check_bodycap = document.querySelector("#check_bodycap");
            var check_lenscap = document.querySelector("#check_lenscap");
            var check_filter = document.querySelector("#check_filter");
            if (check_kamera.checked) {
                check_kamera = "on";
            } else {
                check_kamera = "";
            }
            if (check_lensa.checked) {
                check_lensa = "on";
            } else {
                check_lensa = "";
            }
            if (check_battery.checked) {
                check_battery = "on";
            } else {
                check_battery = "";
            }
            if (check_memory.checked) {
                check_memory = "on";
            } else {
                check_memory = "";
            }
            if (check_strap.checked) {
                check_strap = "on";
            } else {
                check_strap = "";
            }
            if (check_bodycap.checked) {
                check_bodycap = "on";
            } else {
                check_bodycap = "";
            }
            if (check_lenscap.checked) {
                check_lenscap = "on";
            } else {
                check_lenscap = "";
            }
            if (check_filter.checked) {
                check_filter = "on";
            } else {
                check_filter = "";
            }

            var check_kamera_info = document.querySelector("#check_kamera_info").value;
            var check_lensa_info = document.querySelector("#check_lensa_info").value;
            var check_battery_info = document.querySelector("#check_battery_info").value;
            var check_memory_info = document.querySelector("#check_memory_info").value;
            var check_strap_info = document.querySelector("#check_strap_info").value;
            var check_bodycap_info = document.querySelector("#check_bodycap_info").value;
            var check_lenscap_info = document.querySelector("#check_lenscap_info").value;
            var check_filter_info = document.querySelector("#check_filter_info").value;
            var other = document.querySelector("#other").value;

            let formData = new FormData();
            formData.append("date", date);
            formData.append("no_spk", no_spk);
            formData.append("nama", nama);
            formData.append("wa", wa);
            formData.append("no_tlp", no_tlp);
            formData.append("alamat", alamat);
            formData.append("tipe_unit", tipe_unit);
            formData.append("unit", unit);
            formData.append("serial_number", serial_number);
            formData.append("counter", counter);
            formData.append("pin", pin);
            formData.append("note", note);
            formData.append("error", error);
            formData.append("check_kamera", check_kamera);
            formData.append("check_lensa", check_lensa);
            formData.append("check_battery", check_battery);
            formData.append("check_memory", check_memory);
            formData.append("check_strap", check_strap);
            formData.append("check_bodycap", check_bodycap);
            formData.append("check_lenscap", check_lenscap);
            formData.append("check_filter", check_filter);
            formData.append("check_kamera_info", check_kamera_info);
            formData.append("check_lensa_info", check_lensa_info);
            formData.append("check_battery_info", check_battery_info);
            formData.append("check_memory_info", check_memory_info);
            formData.append("check_strap_info", check_strap_info);
            formData.append("check_bodycap_info", check_bodycap_info);
            formData.append("check_lenscap_info", check_lenscap_info);
            formData.append("check_filter_info", check_filter_info);
            formData.append("other", other);
            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            // Menambahkan elemen loading spinner ke dalam pesan SweetAlert
            var swalWithLoading = Swal.mixin({
                title: "UPLOADING ⏳",
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
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        swalWithLoading.close();
                        Swal.fire({
                            icon: "success",
                            title: "DATA BERHASIL DI INPUT",
                            confirmButtonText: "OK",
                            text: "Data dapat dilihat di new order !",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../order-new/");
                            }
                            window.location.href = "../order-new/";
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "DATA GAGAL DI INPUT",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/input.php`, "true");
            ajax.send(formData);
        }
    });
}

// KONFIRMASI DARI NEW KE PROSES

function proses(id) {
    var token = generateRandomString(6);
    Swal.fire({
        title: "AKAN MEMPROSES INI ?",
        html: `<p><strong class="color-blue">NEW</strong> to <strong class="color-orange">ON PROSES</strong></p>
        <h3 class="color-blue strong">${token[1]}</h3>
        <input id="validation" type="text" class="form-control swal2-input" placeholder="Inputkan Token di atas!" autocomplete="off">`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "PROSES",
    }).then((result) => {
        if (result.isConfirmed) {
            var validation = document.querySelector("#validation").value;
            validation = removeSpecialCharacters(validation);

            if (validation != token[0]) {
                Swal.fire({
                    icon: "error",
                    title: "DATA GAGAL DI PROSES",
                    confirmButtonText: "Ulangi",
                    confirmButtonColor: "#f54949",
                    text: "Token Salah !",
                });
                return;
            }

            let formData = new FormData();
            formData.append("no_spk", id);
            formData.append("submit", true);
            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // alert(ok)
                    // return;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "DATA BERHASIL DI PROSES",
                            text: "Kini status data menjadi ON PROSES",
                            confirmButtonText: "OK",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../detail-proses/?id=" + id);
                            }
                            window.location.href = "../detail-proses/?id=" + id;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "DATA GAGAL DI PROSES",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/proses.php`, "true");
            ajax.send(formData);
        }
    });
}

// KONFIRMASI DARI PROSES KE DONE

function done(id) {
    var token = generateRandomString(6);
    Swal.fire({
        title: "AKAN MEMPROSES INI ?",
        html: `<p><strong class="color-orange">ON PROSESS</strong> to <strong class="color-green">DONE</strong></p>
        <h3 class="color-blue strong">${token[1]}</h3>
        <input id="validation" type="text" class="form-control swal2-input" placeholder="Inputkan Token di atas!" autocomplete="off">`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "PROSES",
    }).then((result) => {
        if (result.isConfirmed) {
            var validation = document.querySelector("#validation").value;
            validation = removeSpecialCharacters(validation);

            if (validation != token[0]) {
                Swal.fire({
                    icon: "error",
                    title: "DATA GAGAL DI PROSES",
                    confirmButtonText: "Ulangi",
                    confirmButtonColor: "#f54949",
                    text: "Token Salah !",
                });
                return;
            }

            let formData = new FormData();
            formData.append("no_spk", id);
            formData.append("submit", true);
            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // alert(ok)
                    // return;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "DATA BERHASIL DI PROSES",
                            text: "Kini status data menjadi DONE",
                            confirmButtonText: "OK",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../detail-done/?id=" + id);
                            }
                            window.location.href = "../detail-done/?id=" + id;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "DATA GAGAL DI PROSES",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/done.php`, "true");
            ajax.send(formData);
        }
    });
}

// KONFIRMASI DARI PROSES KE ABORT
function abort(id) {
    var token = generateRandomString(6);
    Swal.fire({
        title: "AKAN MEMPROSES INI ?",
        html: `<p><strong class="color-orange">ON PROSESS</strong> to <strong class="color-red">ABORT</strong></p>
        <h3 class="color-blue strong">${token[1]}</h3>
        <input id="validation" type="text" class="form-control swal2-input" placeholder="Inputkan Token di atas!" autocomplete="off">`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "PROSES",
    }).then((result) => {
        if (result.isConfirmed) {
            var validation = document.querySelector("#validation").value;
            validation = removeSpecialCharacters(validation);

            if (validation != token[0]) {
                Swal.fire({
                    icon: "error",
                    title: "DATA GAGAL DI PROSES",
                    confirmButtonText: "Ulangi",
                    confirmButtonColor: "#f54949",
                    text: "Token Salah !",
                });
                return;
            }

            let formData = new FormData();
            formData.append("no_spk", id);
            formData.append("submit", true);
            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // alert(ok)
                    // return;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "DATA BERHASIL DI PROSES",
                            text: "Kini status data menjadi ABORT",
                            confirmButtonText: "OK",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../detail-abort/?id=" + id);
                            }
                            window.location.href = "../detail-abort/?id=" + id;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "DATA GAGAL DI PROSES",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/abort.php`, "true");
            ajax.send(formData);
        }
    });
}
// KONFIRMASI DONE / ABORT KE PICKUP

function pickup(id, status) {
    var token = generateRandomString(6);
    if (status == "done") {
        var html = `<p><strong class="color-green">DONE</strong> to <strong class="color-purple">PICKUP</strong></p>
        <h3 class="color-blue strong">${token[1]}</h3>
        <label for="datePickup">Paid Date :</label>
        <input id="datePickup" type="datetime-local" class="form-control swal2-input" placeholder="Pickup Date">
        <input id="validation" type="text" class="form-control swal2-input" placeholder="Inputkan Token di atas!" autocomplete="off">`;
    }
    if (status == "abort") {
        var html = `<p><strong class="color-red">ABORT</strong> to <strong class="color-purple">PICKUP</strong></p>
        <h3 class="color-blue strong">${token[1]}</h3>
        <label for="datePickup">Paid Date :</label>
        <input id="datePickup" type="datetime-local" class="form-control swal2-input" placeholder="Pickup Date">
        <input id="validation" type="text" class="form-control swal2-input" placeholder="Inputkan Token di atas!" autocomplete="off">`;
    }

    Swal.fire({
        title: "AKAN MEMPROSES INI ?",
        html: html,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "PROSES",
    }).then((result) => {
        if (result.isConfirmed) {
            var validation = document.querySelector("#validation").value;
            validation = removeSpecialCharacters(validation);
            var date = document.querySelector("#datePickup").value;

            if (validation != token[0]) {
                Swal.fire({
                    icon: "error",
                    title: "DATA GAGAL DI PROSES",
                    confirmButtonText: "Ulangi",
                    confirmButtonColor: "#f54949",
                    text: "Token Salah !",
                });
                return;
            }

            let formData = new FormData();
            formData.append("no_spk", id);
            formData.append("date", date);
            formData.append("submit", true);
            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "DATA BERHASIL DI PROSES",
                            text: "Sesi untuk DATA ini akan ditutup.",
                            confirmButtonText: "OK",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../detail-pickup/?id=" + id);
                            }
                            window.location.href = "../detail-pickup/?id=" + id;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "DATA GAGAL DI PROSES",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/pickup.php`, "true");
            ajax.send(formData);
        }
    });
}

// KONFIRMASI BACK TO PROSESS
function backProses(id) {
    var token = generateRandomString(6);
    Swal.fire({
        title: "AKAN MEMPROSES INI ?",
        html: `<p><strong>Commit Back</strong> to <strong class="color-orange">PROSES</strong></p>
        <h3 class="color-blue strong">${token[1]}</h3>
        <input id="validation" type="text" class="form-control swal2-input" placeholder="Inputkan Token di atas!" autocomplete="off">`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ffb83b",
        cancelButtonColor: "#d33",
        confirmButtonText: "BACK to PROSES",
    }).then((result) => {
        if (result.isConfirmed) {
            var validation = document.querySelector("#validation").value;
            validation = removeSpecialCharacters(validation);

            if (validation != token[0]) {
                Swal.fire({
                    icon: "error",
                    title: "DATA GAGAL DI PROSES",
                    confirmButtonText: "Ulangi",
                    confirmButtonColor: "#f54949",
                    text: "Token Salah !",
                });
                return;
            }

            let formData = new FormData();
            formData.append("no_spk", id);
            formData.append("submit", true);
            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "DATA BERHASIL DI PROSES",
                            text: "Kini status data menjadi PROSES",
                            confirmButtonText: "OK",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../detail-proses/?id=" + id);
                            }
                            window.location.href = "../detail-proses/?id=" + id;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "DATA GAGAL DI PROSES",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/backProses.php`, "true");
            ajax.send(formData);
        }
    });
}

// KONFIRMASI DELETE

// DELETE TABEL DATA
function deleteData(status, id) {
    var token = generateRandomString(6);

    Swal.fire({
        title: "HAPUS DATA INI ?",
        html: `<p class="color-red">⚠️ Data yang terhapus tidak dapat dipulihkan</p>
        <h3 class="color-blue strong">${token[1]}</h3>
        <input id="validation" type="text" class="form-control swal2-input" placeholder="Inputkan Token di atas!" autocomplete="off">`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#222",
        confirmButtonText: "DELETE",
    }).then((result) => {
        if (result.isConfirmed) {
            var validation = document.querySelector("#validation").value;
            validation = removeSpecialCharacters(validation);

            if (validation != token[0]) {
                Swal.fire({
                    icon: "error",
                    title: "DATA GAGAL DI HAPUS",
                    confirmButtonText: "Ulangi",
                    confirmButtonColor: "#f54949",
                    text: "Token Salah !",
                });
                return;
            }

            let formData = new FormData();
            formData.append("no_spk", id);
            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // console.log(ok);
                    // return;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "DATA BERHASIL DI HAPUS",
                            confirmButtonText: "OK",
                            text: "Perubahan dapat dilihat di page Sebelumnya !",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, `../order-${status}/`);
                            }
                            window.location.href = `../order-${status}/`;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "DATA GAGAL DI HAPUS",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/delete.php`, "true");
            ajax.send(formData);
        }
    });
}

// HARD DELETE TABEL DATA
function hardDelete(status, id) {
    var token = generateRandomString(6);

    Swal.fire({
        title: "HAPUS DATA INI ?",
        html: `<p class="color-red">⚠️ Data yang terhapus tidak dapat dipulihkan</p>
        <h3 class="color-blue strong">${token[1]}</h3>
        <input id="validation" type="text" class="form-control swal2-input" placeholder="Inputkan Token di atas!" autocomplete="off">`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#222",
        confirmButtonText: "DELETE",
    }).then((result) => {
        if (result.isConfirmed) {
            var validation = document.querySelector("#validation").value;
            validation = removeSpecialCharacters(validation);

            if (validation != token[0]) {
                Swal.fire({
                    icon: "error",
                    title: "DATA GAGAL DI HAPUS",
                    confirmButtonText: "Ulangi",
                    confirmButtonColor: "#f54949",
                    text: "Token Salah !",
                });
                return;
            }

            let formData = new FormData();
            formData.append("no_spk", id);
            formData.append("deleted", true);
            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // console.log(ok);
                    // return;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "DATA BERHASIL DI HAPUS",
                            confirmButtonText: "OK",
                            text: "Perubahan dapat dilihat di page Sebelumnya !",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, `../order-${status}/`);
                            }
                            window.location.href = `../order-${status}/`;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "DATA GAGAL DI HAPUS",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/delete.php`, "true");
            ajax.send(formData);
        }
    });
}

// KONFIRMASI EDIT DATA

// EDIT NEW

function confirmEditNew(event) {
    event.preventDefault();

    Swal.fire({
        title: "EDIT ?",
        text: "Apakah Data yang Anda input sudah benar ?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Edit",
    }).then((result) => {
        if (result.isConfirmed) {
            var date = document.querySelector("#date").value;
            var no_spk = document.querySelector("#no_spk").value;
            var nama = document.querySelector("#nama").value;
            var wa = document.querySelector("#wa").value;
            var no_tlp = document.querySelector("#no_tlp").value;
            var alamat = document.querySelector("#alamat").value;
            var tipe_unit = document.querySelector("#tipe_unit").value;
            var unit = document.querySelector("#unit").value;
            var serial_number = document.querySelector("#serial_number").value;
            var counter = document.querySelector("#counter").value;
            var pin = document.querySelector("#pin").value;
            var note = document.querySelector("#note").value;
            var error = document.querySelector("#error").value;
            var check_kamera = document.querySelector("#check_kamera");
            var check_lensa = document.querySelector("#check_lensa");
            var check_battery = document.querySelector("#check_battery");
            var check_memory = document.querySelector("#check_memory");
            var check_strap = document.querySelector("#check_strap");
            var check_bodycap = document.querySelector("#check_bodycap");
            var check_lenscap = document.querySelector("#check_lenscap");
            var check_filter = document.querySelector("#check_filter");
            if (check_kamera.checked) {
                check_kamera = "on";
            } else {
                check_kamera = "";
            }
            if (check_lensa.checked) {
                check_lensa = "on";
            } else {
                check_lensa = "";
            }
            if (check_battery.checked) {
                check_battery = "on";
            } else {
                check_battery = "";
            }
            if (check_memory.checked) {
                check_memory = "on";
            } else {
                check_memory = "";
            }
            if (check_strap.checked) {
                check_strap = "on";
            } else {
                check_strap = "";
            }
            if (check_bodycap.checked) {
                check_bodycap = "on";
            } else {
                check_bodycap = "";
            }
            if (check_lenscap.checked) {
                check_lenscap = "on";
            } else {
                check_lenscap = "";
            }
            if (check_filter.checked) {
                check_filter = "on";
            } else {
                check_filter = "";
            }

            var check_kamera_info = document.querySelector("#check_kamera_info").value;
            var check_lensa_info = document.querySelector("#check_lensa_info").value;
            var check_battery_info = document.querySelector("#check_battery_info").value;
            var check_memory_info = document.querySelector("#check_memory_info").value;
            var check_strap_info = document.querySelector("#check_strap_info").value;
            var check_bodycap_info = document.querySelector("#check_bodycap_info").value;
            var check_lenscap_info = document.querySelector("#check_lenscap_info").value;
            var check_filter_info = document.querySelector("#check_filter_info").value;
            var other = document.querySelector("#other").value;

            let formData = new FormData();
            formData.append("date", date);
            formData.append("no_spk", no_spk);
            formData.append("nama", nama);
            formData.append("wa", wa);
            formData.append("no_tlp", no_tlp);
            formData.append("alamat", alamat);
            formData.append("tipe_unit", tipe_unit);
            formData.append("unit", unit);
            formData.append("serial_number", serial_number);
            formData.append("counter", counter);
            formData.append("pin", pin);
            formData.append("note", note);
            formData.append("error", error);
            formData.append("check_kamera", check_kamera);
            formData.append("check_lensa", check_lensa);
            formData.append("check_battery", check_battery);
            formData.append("check_memory", check_memory);
            formData.append("check_strap", check_strap);
            formData.append("check_bodycap", check_bodycap);
            formData.append("check_lenscap", check_lenscap);
            formData.append("check_filter", check_filter);
            formData.append("check_kamera_info", check_kamera_info);
            formData.append("check_lensa_info", check_lensa_info);
            formData.append("check_battery_info", check_battery_info);
            formData.append("check_memory_info", check_memory_info);
            formData.append("check_strap_info", check_strap_info);
            formData.append("check_bodycap_info", check_bodycap_info);
            formData.append("check_lenscap_info", check_lenscap_info);
            formData.append("check_filter_info", check_filter_info);
            formData.append("other", other);
            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // console.log(ok)
                    // return;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "DATA BERHASIL DI EDIT",
                            confirmButtonText: "OK",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../detail-new/?id=" + no_spk);
                            }
                            window.location.href = "../detail-new/?id=" + no_spk;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "DATA GAGAL DI EDIT",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/editNew.php`, "true");
            ajax.send(formData);
        }
    });
}

// EDIT PROSES

function confirmEditProses(event) {
    event.preventDefault();

    Swal.fire({
        title: "EDIT ?",
        text: "Apakah Data yang Anda input sudah benar ?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Edit",
    }).then((result) => {
        if (result.isConfirmed) {
            var date = document.querySelector("#date").value;
            var no_spk = document.querySelector("#no_spk").value;
            var nama = document.querySelector("#nama").value;
            var wa = document.querySelector("#wa").value;
            var no_tlp = document.querySelector("#no_tlp").value;
            var alamat = document.querySelector("#alamat").value;
            var tipe_unit = document.querySelector("#tipe_unit").value;
            var unit = document.querySelector("#unit").value;
            var serial_number = document.querySelector("#serial_number").value;
            var counter = document.querySelector("#counter").value;
            var pin = document.querySelector("#pin").value;
            var note = document.querySelector("#note").value;
            var error = document.querySelector("#error").value;
            var service_at = document.querySelector("#service_at").value;
            var date_proses = document.querySelector("#date_proses").value;
            if (document.querySelector("#date_update") == null) {
                var date_update = "";
            } else {
                var date_update = document.querySelector("#date_update").value;
            }

            var pengecekan = document.querySelector("#pengecekan").value;
            var biaya = document.querySelector("#biaya").value;
            var acc = document.querySelector("#acc");

            if (acc.checked) {
                acc = "on";
            } else {
                acc = "";
            }

            var check_kamera = document.querySelector("#check_kamera");
            var check_lensa = document.querySelector("#check_lensa");
            var check_battery = document.querySelector("#check_battery");
            var check_memory = document.querySelector("#check_memory");
            var check_strap = document.querySelector("#check_strap");
            var check_bodycap = document.querySelector("#check_bodycap");
            var check_lenscap = document.querySelector("#check_lenscap");
            var check_filter = document.querySelector("#check_filter");
            if (check_kamera.checked) {
                check_kamera = "on";
            } else {
                check_kamera = "";
            }
            if (check_lensa.checked) {
                check_lensa = "on";
            } else {
                check_lensa = "";
            }
            if (check_battery.checked) {
                check_battery = "on";
            } else {
                check_battery = "";
            }
            if (check_memory.checked) {
                check_memory = "on";
            } else {
                check_memory = "";
            }
            if (check_strap.checked) {
                check_strap = "on";
            } else {
                check_strap = "";
            }
            if (check_bodycap.checked) {
                check_bodycap = "on";
            } else {
                check_bodycap = "";
            }
            if (check_lenscap.checked) {
                check_lenscap = "on";
            } else {
                check_lenscap = "";
            }
            if (check_filter.checked) {
                check_filter = "on";
            } else {
                check_filter = "";
            }

            var check_kamera_info = document.querySelector("#check_kamera_info").value;
            var check_lensa_info = document.querySelector("#check_lensa_info").value;
            var check_battery_info = document.querySelector("#check_battery_info").value;
            var check_memory_info = document.querySelector("#check_memory_info").value;
            var check_strap_info = document.querySelector("#check_strap_info").value;
            var check_bodycap_info = document.querySelector("#check_bodycap_info").value;
            var check_lenscap_info = document.querySelector("#check_lenscap_info").value;
            var check_filter_info = document.querySelector("#check_filter_info").value;
            var other = document.querySelector("#other").value;

            let formData = new FormData();
            formData.append("date", date);
            formData.append("no_spk", no_spk);
            formData.append("nama", nama);
            formData.append("wa", wa);
            formData.append("no_tlp", no_tlp);
            formData.append("alamat", alamat);
            formData.append("tipe_unit", tipe_unit);
            formData.append("unit", unit);
            formData.append("serial_number", serial_number);
            formData.append("counter", counter);
            formData.append("pin", pin);
            formData.append("note", note);
            formData.append("error", error);
            formData.append("service_at", service_at);
            formData.append("date_proses", date_proses);
            formData.append("date_update", date_update);
            formData.append("result", pengecekan);
            formData.append("cost", biaya);
            formData.append("acc", acc);

            formData.append("check_kamera", check_kamera);
            formData.append("check_lensa", check_lensa);
            formData.append("check_battery", check_battery);
            formData.append("check_memory", check_memory);
            formData.append("check_strap", check_strap);
            formData.append("check_bodycap", check_bodycap);
            formData.append("check_lenscap", check_lenscap);
            formData.append("check_filter", check_filter);
            formData.append("check_kamera_info", check_kamera_info);
            formData.append("check_lensa_info", check_lensa_info);
            formData.append("check_battery_info", check_battery_info);
            formData.append("check_memory_info", check_memory_info);
            formData.append("check_strap_info", check_strap_info);
            formData.append("check_bodycap_info", check_bodycap_info);
            formData.append("check_lenscap_info", check_lenscap_info);
            formData.append("check_filter_info", check_filter_info);
            formData.append("other", other);
            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;

                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "DATA BERHASIL DI EDIT",
                            confirmButtonText: "OK",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../detail-new/?id=" + no_spk);
                            }
                            window.location.href = "../detail-new/?id=" + no_spk;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "DATA GAGAL DI EDIT",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/editProses.php`, "true");
            ajax.send(formData);
        }
    });
}

// UPDATE PROSES
function update(event) {
    event.preventDefault();

    Swal.fire({
        title: "UPDATE ?",
        text: "Apakah Data yang Anda input sudah benar ?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Update",
    }).then((result) => {
        if (result.isConfirmed) {
            var no_spk = document.querySelector("#id").value;
            var result = document.querySelector("#pengecekan").value;
            var cost = document.querySelector("#biaya").value;
            var service_at = document.querySelector("#service_at").value;
            var acc = document.querySelector("#acc");

            if (acc.checked) {
                acc = "on";
            } else {
                acc = "";
            }

            let formData = new FormData();
            formData.append("no_spk", no_spk);
            formData.append("result", result);
            formData.append("cost", cost);
            formData.append("service_at", service_at);
            formData.append("acc", acc);
            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // alert(ok)
                    // return;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "DATA BERHASIL DI UPDATE",
                            confirmButtonText: "OK",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../detail-new/?id=" + no_spk);
                            }
                            window.location.href = "../detail-proses/?id=" + no_spk;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "DATA GAGAL DI UPDATE",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/update.php`, "true");
            ajax.send(formData);
        }
    });
}

// EDIT DONE
function confirmEditDone(event) {
    event.preventDefault();

    Swal.fire({
        title: "EDIT ?",
        text: "Apakah Data yang Anda input sudah benar ?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Edit",
    }).then((result) => {
        if (result.isConfirmed) {
            var date = document.querySelector("#date").value;
            var no_spk = document.querySelector("#no_spk").value;
            var nama = document.querySelector("#nama").value;
            var wa = document.querySelector("#wa").value;
            var no_tlp = document.querySelector("#no_tlp").value;
            var alamat = document.querySelector("#alamat").value;
            var tipe_unit = document.querySelector("#tipe_unit").value;
            var unit = document.querySelector("#unit").value;
            var serial_number = document.querySelector("#serial_number").value;
            var counter = document.querySelector("#counter").value;
            var pin = document.querySelector("#pin").value;
            var note = document.querySelector("#note").value;
            var error = document.querySelector("#error").value;
            var service_at = document.querySelector("#service_at").value;
            var date_proses = document.querySelector("#date_proses").value;
            var date_update = document.querySelector("#date_update").value;
            var date_finish = document.querySelector("#date_finish").value;
            var pengecekan = document.querySelector("#pengecekan").value;
            var biaya = document.querySelector("#biaya").value;
            var acc = document.querySelector("#acc");

            if (acc.checked) {
                acc = "on";
            } else {
                acc = "";
            }

            var check_kamera = document.querySelector("#check_kamera");
            var check_lensa = document.querySelector("#check_lensa");
            var check_battery = document.querySelector("#check_battery");
            var check_memory = document.querySelector("#check_memory");
            var check_strap = document.querySelector("#check_strap");
            var check_bodycap = document.querySelector("#check_bodycap");
            var check_lenscap = document.querySelector("#check_lenscap");
            var check_filter = document.querySelector("#check_filter");
            if (check_kamera.checked) {
                check_kamera = "on";
            } else {
                check_kamera = "";
            }
            if (check_lensa.checked) {
                check_lensa = "on";
            } else {
                check_lensa = "";
            }
            if (check_battery.checked) {
                check_battery = "on";
            } else {
                check_battery = "";
            }
            if (check_memory.checked) {
                check_memory = "on";
            } else {
                check_memory = "";
            }
            if (check_strap.checked) {
                check_strap = "on";
            } else {
                check_strap = "";
            }
            if (check_bodycap.checked) {
                check_bodycap = "on";
            } else {
                check_bodycap = "";
            }
            if (check_lenscap.checked) {
                check_lenscap = "on";
            } else {
                check_lenscap = "";
            }
            if (check_filter.checked) {
                check_filter = "on";
            } else {
                check_filter = "";
            }

            var check_kamera_info = document.querySelector("#check_kamera_info").value;
            var check_lensa_info = document.querySelector("#check_lensa_info").value;
            var check_battery_info = document.querySelector("#check_battery_info").value;
            var check_memory_info = document.querySelector("#check_memory_info").value;
            var check_strap_info = document.querySelector("#check_strap_info").value;
            var check_bodycap_info = document.querySelector("#check_bodycap_info").value;
            var check_lenscap_info = document.querySelector("#check_lenscap_info").value;
            var check_filter_info = document.querySelector("#check_filter_info").value;
            var other = document.querySelector("#other").value;

            let formData = new FormData();
            formData.append("date", date);
            formData.append("no_spk", no_spk);
            formData.append("nama", nama);
            formData.append("wa", wa);
            formData.append("no_tlp", no_tlp);
            formData.append("alamat", alamat);
            formData.append("tipe_unit", tipe_unit);
            formData.append("unit", unit);
            formData.append("serial_number", serial_number);
            formData.append("counter", counter);
            formData.append("pin", pin);
            formData.append("note", note);
            formData.append("error", error);
            formData.append("service_at", service_at);
            formData.append("date_proses", date_proses);
            formData.append("date_update", date_update);
            formData.append("date_finish", date_finish);
            formData.append("result", pengecekan);
            formData.append("cost", biaya);
            formData.append("acc", acc);

            formData.append("check_kamera", check_kamera);
            formData.append("check_lensa", check_lensa);
            formData.append("check_battery", check_battery);
            formData.append("check_memory", check_memory);
            formData.append("check_strap", check_strap);
            formData.append("check_bodycap", check_bodycap);
            formData.append("check_lenscap", check_lenscap);
            formData.append("check_filter", check_filter);
            formData.append("check_kamera_info", check_kamera_info);
            formData.append("check_lensa_info", check_lensa_info);
            formData.append("check_battery_info", check_battery_info);
            formData.append("check_memory_info", check_memory_info);
            formData.append("check_strap_info", check_strap_info);
            formData.append("check_bodycap_info", check_bodycap_info);
            formData.append("check_lenscap_info", check_lenscap_info);
            formData.append("check_filter_info", check_filter_info);
            formData.append("other", other);
            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // console.log(ok);
                    // return;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "DATA BERHASIL DI EDIT",
                            confirmButtonText: "OK",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../detail-new/?id=" + no_spk);
                            }
                            window.location.href = "../detail-new/?id=" + no_spk;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "DATA GAGAL DI EDIT",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/editDone.php`, "true");
            ajax.send(formData);
        }
    });
}

// EDIT ABORT
function confirmEditAbort(event) {
    event.preventDefault();

    Swal.fire({
        title: "EDIT ?",
        text: "Apakah Data yang Anda input sudah benar ?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Edit",
    }).then((result) => {
        if (result.isConfirmed) {
            var date = document.querySelector("#date").value;
            var no_spk = document.querySelector("#no_spk").value;
            var nama = document.querySelector("#nama").value;
            var wa = document.querySelector("#wa").value;
            var no_tlp = document.querySelector("#no_tlp").value;
            var alamat = document.querySelector("#alamat").value;
            var tipe_unit = document.querySelector("#tipe_unit").value;
            var unit = document.querySelector("#unit").value;
            var serial_number = document.querySelector("#serial_number").value;
            var counter = document.querySelector("#counter").value;
            var pin = document.querySelector("#pin").value;
            var note = document.querySelector("#note").value;
            var error = document.querySelector("#error").value;
            var service_at = document.querySelector("#service_at").value;
            var date_proses = document.querySelector("#date_proses").value;
            var date_update = document.querySelector("#date_update").value;
            var date_finish = document.querySelector("#date_finish").value;
            var pengecekan = document.querySelector("#pengecekan").value;
            var biaya = document.querySelector("#biaya").value;
            var acc = document.querySelector("#acc");

            if (acc.checked) {
                acc = "on";
            } else {
                acc = "";
            }

            var check_kamera = document.querySelector("#check_kamera");
            var check_lensa = document.querySelector("#check_lensa");
            var check_battery = document.querySelector("#check_battery");
            var check_memory = document.querySelector("#check_memory");
            var check_strap = document.querySelector("#check_strap");
            var check_bodycap = document.querySelector("#check_bodycap");
            var check_lenscap = document.querySelector("#check_lenscap");
            var check_filter = document.querySelector("#check_filter");
            if (check_kamera.checked) {
                check_kamera = "on";
            } else {
                check_kamera = "";
            }
            if (check_lensa.checked) {
                check_lensa = "on";
            } else {
                check_lensa = "";
            }
            if (check_battery.checked) {
                check_battery = "on";
            } else {
                check_battery = "";
            }
            if (check_memory.checked) {
                check_memory = "on";
            } else {
                check_memory = "";
            }
            if (check_strap.checked) {
                check_strap = "on";
            } else {
                check_strap = "";
            }
            if (check_bodycap.checked) {
                check_bodycap = "on";
            } else {
                check_bodycap = "";
            }
            if (check_lenscap.checked) {
                check_lenscap = "on";
            } else {
                check_lenscap = "";
            }
            if (check_filter.checked) {
                check_filter = "on";
            } else {
                check_filter = "";
            }

            var check_kamera_info = document.querySelector("#check_kamera_info").value;
            var check_lensa_info = document.querySelector("#check_lensa_info").value;
            var check_battery_info = document.querySelector("#check_battery_info").value;
            var check_memory_info = document.querySelector("#check_memory_info").value;
            var check_strap_info = document.querySelector("#check_strap_info").value;
            var check_bodycap_info = document.querySelector("#check_bodycap_info").value;
            var check_lenscap_info = document.querySelector("#check_lenscap_info").value;
            var check_filter_info = document.querySelector("#check_filter_info").value;
            var other = document.querySelector("#other").value;

            let formData = new FormData();
            formData.append("date", date);
            formData.append("no_spk", no_spk);
            formData.append("nama", nama);
            formData.append("wa", wa);
            formData.append("no_tlp", no_tlp);
            formData.append("alamat", alamat);
            formData.append("tipe_unit", tipe_unit);
            formData.append("unit", unit);
            formData.append("serial_number", serial_number);
            formData.append("counter", counter);
            formData.append("pin", pin);
            formData.append("note", note);
            formData.append("error", error);
            formData.append("service_at", service_at);
            formData.append("date_proses", date_proses);
            formData.append("date_update", date_update);
            formData.append("date_finish", date_finish);
            formData.append("result", pengecekan);
            formData.append("cost", biaya);
            formData.append("acc", acc);

            formData.append("check_kamera", check_kamera);
            formData.append("check_lensa", check_lensa);
            formData.append("check_battery", check_battery);
            formData.append("check_memory", check_memory);
            formData.append("check_strap", check_strap);
            formData.append("check_bodycap", check_bodycap);
            formData.append("check_lenscap", check_lenscap);
            formData.append("check_filter", check_filter);
            formData.append("check_kamera_info", check_kamera_info);
            formData.append("check_lensa_info", check_lensa_info);
            formData.append("check_battery_info", check_battery_info);
            formData.append("check_memory_info", check_memory_info);
            formData.append("check_strap_info", check_strap_info);
            formData.append("check_bodycap_info", check_bodycap_info);
            formData.append("check_lenscap_info", check_lenscap_info);
            formData.append("check_filter_info", check_filter_info);
            formData.append("other", other);
            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // console.log(ok);
                    // return;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "DATA BERHASIL DI EDIT",
                            confirmButtonText: "OK",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../detail-new/?id=" + no_spk);
                            }
                            window.location.href = "../detail-new/?id=" + no_spk;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "DATA GAGAL DI EDIT",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/editAbort.php`, "true");
            ajax.send(formData);
        }
    });
}

// KONFIRMASI ADMIN

// iNPUT SERVICE CENTER
function inputServiceCenter(event) {
    event.preventDefault();

    Swal.fire({
        title: "KIRIM ?",
        text: "Apakah Data yang Anda input sudah benar ?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Input",
    }).then((result) => {
        if (result.isConfirmed) {
            var date = document.querySelector("#date").value;
            var kode = document.querySelector("#kode").value;
            var nama = document.querySelector("#nama").value;
            var up_to = document.querySelector("#up").value;
            var no_tlp = document.querySelector("#no_tlp").value;
            var alamat = document.querySelector("#alamat").value;
            var unit = document.querySelector("#unit").value;
            var legal_name = document.querySelector("#legal_name").value;
            var rek_number = document.querySelector("#rek_number").value;
            var note = document.querySelector("#note").value;

            let formData = new FormData();
            formData.append("date", date);
            formData.append("kode", kode);
            formData.append("nama", nama);
            formData.append("up_to", up_to);
            formData.append("no_tlp", no_tlp);
            formData.append("alamat", alamat);
            formData.append("unit", unit);
            formData.append("legal_name", legal_name);
            formData.append("rek_number", rek_number);
            formData.append("note", note);
            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "DATA BERHASIL DI INPUT",
                            confirmButtonText: "OK",
                            text: "Data dapat dilihat di page Service Center !",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../order-new/");
                            }
                            window.location.href = "../order-service-center/";
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "DATA GAGAL DI INPUT",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/inputServiceCenter.php`, "true");
            ajax.send(formData);
        }
    });
}

// EDIT SERVICE CENTER
function editServiceCenter(event) {
    event.preventDefault();

    Swal.fire({
        title: "KIRIM ?",
        text: "Apakah Data yang Anda input sudah benar ?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Input",
    }).then((result) => {
        if (result.isConfirmed) {
            var kode = document.querySelector("#kode").value;
            var nama = document.querySelector("#nama").value;
            var up_to = document.querySelector("#up").value;
            var no_tlp = document.querySelector("#no_tlp").value;
            var alamat = document.querySelector("#alamat").value;
            var unit = document.querySelector("#unit").value;
            var legal_name = document.querySelector("#legal_name").value;
            var rek_number = document.querySelector("#rek_number").value;
            var note = document.querySelector("#note").value;

            let formData = new FormData();
            formData.append("kode", kode);
            formData.append("nama", nama);
            formData.append("up_to", up_to);
            formData.append("no_tlp", no_tlp);
            formData.append("alamat", alamat);
            formData.append("unit", unit);
            formData.append("legal_name", legal_name);
            formData.append("rek_number", rek_number);
            formData.append("note", note);
            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // alert(ok);
                    // return;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "DATA BERHASIL DI EDIT",
                            confirmButtonText: "OK",
                            text: "Data dapat dilihat di page Service Center !",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../order-service-center/");
                            }
                            window.location.href = "../order-service-center/";
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "DATA GAGAL DI EDIT",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/editServiceCenter.php`, "true");
            ajax.send(formData);
        }
    });
}

// DELETE SERVICE CENTER
function deleteServiceCenter(id) {
    var token = generateRandomString(6);

    Swal.fire({
        title: "HAPUS DATA INI ?",
        html: `<p class="color-red">⚠️ Data yang terhapus tidak dapat dipulihkan</p>
        <h3 class="color-blue strong">${token[1]}</h3>
        <input id="validation" type="text" class="form-control swal2-input" placeholder="Inputkan Token di atas!" autocomplete="off">`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#222",
        confirmButtonText: "DELETE",
    }).then((result) => {
        if (result.isConfirmed) {
            var validation = document.querySelector("#validation").value;
            validation = removeSpecialCharacters(validation);

            if (validation != token[0]) {
                Swal.fire({
                    icon: "error",
                    title: "DATA GAGAL DI HAPUS",
                    confirmButtonText: "Ulangi",
                    confirmButtonColor: "#f54949",
                    text: "Token Salah !",
                });
                return;
            }

            let formData = new FormData();
            formData.append("kode", id);
            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // alert(ok);
                    // return;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "DATA BERHASIL DI HAPUS",
                            confirmButtonText: "OK",
                            text: "Perubahan dapat dilihat di page Service Center !",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../order-service-center/");
                            }
                            window.location.href = "../order-service-center/";
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "DATA GAGAL DI HAPUS",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/deleteServiceCenter.php`, "true");
            ajax.send(formData);
        }
    });
}

// USER FUNCTION>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

//input new user form
function InputNewUser() {
    Swal.fire({
        title: "New User",
        icon: "question",
        html: `<input id="kode" type="text" class="form-control swal2-input" placeholder="Kode User">
        <select name="akses" id="akses" class="form-control swal2-select">
            <option value="" selected disabled>User Akses</option>
	        <option value="admin">Admin</option>
            <option value="audit">Audit</option>
            <option value="cs">Costumer Service</option>
            </select>
        <select name="counter" id="counter" class="form-control swal2-select">
            <option value="" selected disabled>Counter</option>
	        <option value="pusat">Pusat</option>
            <option value="batubulan">Batubulan</option>
            <option value="canggu">Canggu</option>
        </select>
        <input id="userName" type="text" class="form-control swal2-input" placeholder="Username">
        <select name="role" id="role" class="form-control swal2-select">
            <option value="" selected disabled>Role</option>
            <option value="teknisi">Teknisi</option>
            <option value="admin service">Admin Service</option>
            <option value="auditor">Auditor</option>
            <option value="costumer service">Costumer Service</option>
        </select>
        <input id="password" type="text" class="form-control swal2-input" placeholder="Pwd Default: 0000" disabled>`,
        showCloseButton: false,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: "OK",
        confirmButtonAriaLabel: "OK",
        cancelButtonText: "Cancel",
        cancelButtonAriaLabel: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            var kode = document.querySelector("#kode").value;
            var akses = document.querySelector("#akses").value;
            var counter = document.querySelector("#counter").value;
            var role = document.querySelector("#role").value;
            var userName = document.querySelector("#userName").value;

            let formData = new FormData();
            formData.append("kode", kode);
            formData.append("akses", akses);
            formData.append("counter", counter);
            formData.append("role", role);
            formData.append("username", userName);
            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // console.log(ok);
                    // return;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "DATA BERHASIL DI INPUT",
                            confirmButtonText: "OK",
                            text: "User Baru Telah Ditambahkan",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../order-user/");
                            }
                            window.location.href = "../order-user/";
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "DATA GAGAL DI INPUT",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/inputNewUser.php`, "true");
            ajax.send(formData);
        }
    });
}

// delete user
function deleteUser(id) {
    var token = generateRandomString(6);

    Swal.fire({
        title: "HAPUS DATA INI ?",
        html: `<p class="color-red">⚠️ Data yang terhapus tidak dapat dipulihkan</p>
        <h3 class="color-blue strong">${token[1]}</h3>
        <input id="validation" type="text" class="form-control swal2-input" placeholder="Inputkan Token di atas!" autocomplete="off">`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#222",
        confirmButtonText: "DELETE",
    }).then((result) => {
        if (result.isConfirmed) {
            var validation = document.querySelector("#validation").value;
            validation = removeSpecialCharacters(validation);

            if (validation != token[0]) {
                Swal.fire({
                    icon: "error",
                    title: "DATA GAGAL DI HAPUS",
                    confirmButtonText: "Ulangi",
                    confirmButtonColor: "#f54949",
                    text: "Token Salah !",
                });
                return;
            }

            let formData = new FormData();
            formData.append("kode", id);
            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // alert(ok);
                    // return;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "USER BERHASIL DI HAPUS",
                            confirmButtonText: "OK",
                            text: "Perubahan dapat dilihat di page Service Center !",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../order-user/");
                            }
                            window.location.href = "../order-user/";
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "USER GAGAL DI HAPUS",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/deleteUser.php`, "true");
            ajax.send(formData);
        }
    });
}

//edit user form
function editUser(id, kode, akses, counter, username, role) {
    Swal.fire({
        title: "Edit User",
        icon: "question",
        html: `<input id="kode" type="text" class="form-control swal2-input" placeholder="Kode User" value="${kode}">
        <select name="akses" id="akses" class="form-control swal2-select">
            <option value="${akses}" selected>default: ${akses}</option>
	        <option value="admin">Admin</option>
            <option value="audit">Audit</option>
            <option value="cs">Costumer Service</option>
        </select>
        <select name="counter" id="counter" class="form-control swal2-select">
            <option value="${counter}" selected>default: ${counter}</option>
	        <option value="wtrg">Wtrg</option>
            <option value="udayana">Udayana</option>
            <option value="canggu">Canggu</option>
        </select>
        <input id="userName" type="text" class="form-control swal2-input" placeholder="Username" value="${username}">
        <select name="role" id="role" class="form-control swal2-select">
            <option value="${role}" selected>default: ${role}</option>
            <option value="teknisi">Teknisi</option>
            <option value="admin service">Admin Service</option>
            <option value="auditor">Auditor</option>
            <option value="costumer service">Costumer Service</option>
        </select>
        <input id="password" type="password" class="form-control swal2-input" value="000000" disabled>`,
        showCloseButton: false,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: "OK",
        confirmButtonAriaLabel: "OK",
        cancelButtonText: "Cancel",
        cancelButtonAriaLabel: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            var kode = document.querySelector("#kode").value;
            var akses = document.querySelector("#akses").value;
            var counter = document.querySelector("#counter").value;
            var role = document.querySelector("#role").value;
            var userName = document.querySelector("#userName").value;

            let formData = new FormData();
            formData.append("id", id);
            formData.append("kode", kode);
            formData.append("akses", akses);
            formData.append("counter", counter);
            formData.append("role", role);
            formData.append("username", userName);
            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // console.log(ok);
                    // return;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "DATA BERHASIL DI EDIT",
                            confirmButtonText: "OK",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../order-user/");
                            }
                            window.location.href = "../order-user/";
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "DATA GAGAL DI EDIT",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/editUser.php`, "true");
            ajax.send(formData);
        }
    });
}

function resetUserPwd(id) {
    var token = generateRandomString(6);

    Swal.fire({
        title: "WARNING",
        html: `<p class="color-red">⚠️ Reset Password ?</p>
        <h3 class="color-blue strong">${token[1]}</h3>
        <input id="validation" type="text" class="form-control swal2-input" placeholder="Inputkan Token di atas!" autocomplete="off">`,
        icon: "warning",
        showCancelButton: true,
        cancelButtonColor: "#222",
        confirmButtonText: "RESET",
    }).then((result) => {
        if (result.isConfirmed) {
            var validation = document.querySelector("#validation").value;
            validation = removeSpecialCharacters(validation);

            if (validation != token[0]) {
                Swal.fire({
                    icon: "error",
                    title: "PASSWORD GAGAL DI RESET",
                    confirmButtonText: "Ulangi",
                    confirmButtonColor: "#f54949",
                    text: "Token Salah !",
                });
                return;
            }

            let formData = new FormData();
            formData.append("kode", id);
            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // alert(ok);
                    // return;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "RESET BERHASIL",
                            confirmButtonText: "OK",
                            text: "password default sekarang adalah : 0000",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../order-user/");
                            }
                            window.location.href = "../order-user/";
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "GAGAL MERESET",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/resetUserPwd.php`, "true");
            ajax.send(formData);
        }
    });
}

//NOTA FUNCTION

//input nota
function inputNota(event) {
    event.preventDefault();

    Swal.fire({
        title: "SAVE ?",
        text: "Apakah Invoice yang Anda input sudah benar ?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Save",
    }).then((result) => {
        if (result.isConfirmed) {
            var date = document.querySelector("#date").value;
            var qts = document.querySelectorAll(".qts");
            var kode = document.querySelectorAll(".kode");
            var desc = document.querySelectorAll(".desc");
            var buy = document.querySelectorAll(".buy");
            var margin = document.querySelectorAll(".margin");
            var sell = document.querySelectorAll(".sell");
            var profit = document.querySelector("#profit").value;
            var subtotal = document.querySelector("#subtotal").value;
            var dpp = document.querySelector("#dpp").value;
            var ppn = document.querySelector("#ppn").value;
            var deposit = document.querySelector("#deposit").value;
            var total = document.querySelector("#total").value;
            var note = document.querySelector("#note").value;
            var saveas = document.querySelector("#saveas").value;

            var qtss = [];
            var kodes = [];
            var descs = [];
            var buys = [];
            var margins = [];
            var sells = [];

            for (i = 0; i < qts.length; i++) {
                if (desc[i].value != "" && sell[i].value != 0) {
                    qtss.push(qts[i].value);
                    kodes.push(kode[i].value);
                    descs.push(desc[i].value);
                    buys.push(buy[i].value);
                    margins.push(margin[i].value);
                    sells.push(sell[i].value);
                }
            }
            var send_qts = JSON.stringify(qtss);
            var send_kode = JSON.stringify(kodes);
            var send_desc = JSON.stringify(descs);
            var send_buy = JSON.stringify(buys);
            var send_margin = JSON.stringify(margins);
            var send_sell = JSON.stringify(sells);

            let formData = new FormData();

            formData.append("date", date);
            formData.append("qts", send_qts);
            formData.append("kode", send_kode);
            formData.append("desc", send_desc);
            formData.append("buy", send_buy);
            formData.append("margin", send_margin);
            formData.append("sell", send_sell);
            formData.append("profit", profit);
            formData.append("subtotal", subtotal);
            formData.append("dpp", dpp);
            formData.append("ppn", ppn);
            formData.append("deposit", deposit);
            formData.append("total", total);
            formData.append("note", note);
            formData.append("saveas", saveas);

            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // return console.log(ok);
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "INVOICE BERHASIL DI SAVE",
                            confirmButtonText: "OK",
                            text: "Data dapat dilihat di order Nota !",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../order-invoice/");
                            }
                            window.location.href = "../order-invoice/";
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "INVOICE GAGAL DI SAVE",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/input-nota.php`, "true");
            ajax.send(formData);
        }
    });
}

//input nota FOR
function inputNotaFor(event) {
    event.preventDefault();

    Swal.fire({
        title: "SAVE ?",
        text: "Apakah Invoice yang Anda input sudah benar ?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Save",
    }).then((result) => {
        if (result.isConfirmed) {
            var date = document.querySelector("#date").value;
            var link = document.querySelector("#link").value;
            var qts = document.querySelectorAll(".qts");
            var kode = document.querySelectorAll(".kode");
            var desc = document.querySelectorAll(".desc");
            var buy = document.querySelectorAll(".buy");
            var margin = document.querySelectorAll(".margin");
            var sell = document.querySelectorAll(".sell");
            var profit = document.querySelector("#profit").value;
            var subtotal = document.querySelector("#subtotal").value;
            var dpp = document.querySelector("#dpp").value;
            var ppn = document.querySelector("#ppn").value;
            var deposit = document.querySelector("#deposit").value;
            var discount = document.querySelector("#discount").value;
            var total = document.querySelector("#total").value;
            var cancel = document.querySelector("#cancel").value;
            var spend = document.querySelector("#spend").value;
            var note = document.querySelector("#note").value;
            var saveas = document.querySelector("#saveas").value;
            var rekening = document.querySelector("#rekening").value;

            var qtss = [];
            var kodes = [];
            var descs = [];
            var buys = [];
            var margins = [];
            var sells = [];

            for (i = 0; i < qts.length; i++) {
                if (desc[i].value != "" && sell[i].value != 0) {
                    qtss.push(qts[i].value);
                    kodes.push(kode[i].value);
                    descs.push(desc[i].value);
                    buys.push(buy[i].value);
                    margins.push(margin[i].value);
                    sells.push(sell[i].value);
                }
            }
            var send_qts = JSON.stringify(qtss);
            var send_kode = JSON.stringify(kodes);
            var send_desc = JSON.stringify(descs);
            var send_buy = JSON.stringify(buys);
            var send_margin = JSON.stringify(margins);
            var send_sell = JSON.stringify(sells);

            let formData = new FormData();

            formData.append("for", true);
            formData.append("date", date);
            formData.append("link", link);
            formData.append("qts", send_qts);
            formData.append("kode", send_kode);
            formData.append("desc", send_desc);
            formData.append("buy", send_buy);
            formData.append("margin", send_margin);
            formData.append("sell", send_sell);
            formData.append("profit", profit);
            formData.append("subtotal", subtotal);
            formData.append("dpp", dpp);
            formData.append("ppn", ppn);
            formData.append("deposit", deposit);
            formData.append("discount", discount);
            formData.append("total", total);
            formData.append("cancel", cancel);
            formData.append("spend", spend);
            formData.append("note", note);
            formData.append("saveas", saveas);
            formData.append("rekening", rekening);

            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // return console.log(ok);
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "NOTA BERHASIL DI SAVE",
                            confirmButtonText: "OK",
                            text: "Data dapat dilihat di Detail Proses !",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, `../detail-proses/?id=${link}`);
                            }
                            window.location.href = `../detail-proses/?id=${link}`;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "NOTA GAGAL DI SAVE",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/input-nota.php`, "true");
            ajax.send(formData);
        }
    });
}

//edit nota
function editNota(event) {
    event.preventDefault();

    Swal.fire({
        title: "UPDATE ?",
        text: "Apakah Invoice yang Anda input sudah benar ?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Update",
    }).then((result) => {
        if (result.isConfirmed) {
            var id = document.querySelector("#id").value;
            var date = document.querySelector("#date").value;
            var qts = document.querySelectorAll(".qts");
            var kode = document.querySelectorAll(".kode");
            var desc = document.querySelectorAll(".desc");
            var buy = document.querySelectorAll(".buy");
            var margin = document.querySelectorAll(".margin");
            var sell = document.querySelectorAll(".sell");
            var profit = document.querySelector("#profit").value;
            var subtotal = document.querySelector("#subtotal").value;
            var dpp = document.querySelector("#dpp").value;
            var ppn = document.querySelector("#ppn").value;
            var deposit = document.querySelector("#deposit").value;
            var discount = document.querySelector("#discount").value;
            var total = document.querySelector("#total").value;
            var cancel = document.querySelector("#cancel").value;
            var spend = document.querySelector("#spend").value;
            var note = document.querySelector("#note").value;
            var rekening = document.querySelector("#rekening").value;

            var qtss = [];
            var kodes = [];
            var descs = [];
            var buys = [];
            var margins = [];
            var sells = [];

            for (i = 0; i < qts.length; i++) {
                if (desc[i].value != "" && sell[i].value != 0) {
                    qtss.push(qts[i].value);
                    kodes.push(kode[i].value);
                    descs.push(desc[i].value);
                    buys.push(buy[i].value);
                    margins.push(margin[i].value);
                    sells.push(sell[i].value);
                }
            }
            var send_qts = JSON.stringify(qtss);
            var send_kode = JSON.stringify(kodes);
            var send_desc = JSON.stringify(descs);
            var send_buy = JSON.stringify(buys);
            var send_margin = JSON.stringify(margins);
            var send_sell = JSON.stringify(sells);

            let formData = new FormData();

            formData.append("id", id);
            formData.append("date", date);
            formData.append("qts", send_qts);
            formData.append("kode", send_kode);
            formData.append("desc", send_desc);
            formData.append("buy", send_buy);
            formData.append("margin", send_margin);
            formData.append("sell", send_sell);
            formData.append("profit", profit);
            formData.append("subtotal", subtotal);
            formData.append("dpp", dpp);
            formData.append("ppn", ppn);
            formData.append("deposit", deposit);
            formData.append("discount", discount);
            formData.append("total", total);
            formData.append("cancel", cancel);
            formData.append("spend", spend);
            formData.append("note", note);
            formData.append("rekening", rekening);

            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // return console.log(ok);
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "NOTA BERHASIL DI UPDATE",
                            confirmButtonText: "OK",
                            text: "Data dapat dilihat di Detail Invoice !",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, `../detail-invoice/?id=${id}`);
                            }
                            window.location.href = `../detail-invoice/?id=${id}`;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "NOTA GAGAL DI UPDATE",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/edit-nota.php`, "true");
            ajax.send(formData);
        }
    });
}

//set to invoice
function setInvoice(id) {
    var token = generateRandomString(6);
    Swal.fire({
        title: "AKAN MEMPROSES INI ?",
        html: `<p>Setelah status benjadi <strong class="color-blue">INVOICE </strong>maka data tidak akan bisa diubah kembali !</p>
        <h3 class="color-blue strong">${token[1]}</h3>
        <input id="validation" type="text" class="form-control swal2-input" placeholder="Inputkan Token di atas!" autocomplete="off">`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "PROSES",
    }).then((result) => {
        if (result.isConfirmed) {
            var validation = document.querySelector("#validation").value;
            validation = removeSpecialCharacters(validation);

            if (validation != token[0]) {
                Swal.fire({
                    icon: "error",
                    title: "DATA GAGAL DI PROSES",
                    confirmButtonText: "Ulangi",
                    confirmButtonColor: "#f54949",
                    text: "Token Salah !",
                });
                return;
            }

            let formData = new FormData();
            formData.append("id", id);
            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // return console.log(ok);
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "INVOICE BERHASIL DI UPDATE",
                            confirmButtonText: "OK",
                            text: "Data dapat dilihat di Detail Invoice !",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, `../detail-invoice/?id=${id}`);
                            }
                            window.location.href = `../detail-invoice/?id=${id}`;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "INVOICE GAGAL DI UPDATE",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/set-invoice.php`, "true");
            ajax.send(formData);
        }
    });
}

//set to paid
function setPaid(id) {
    var token = generateRandomString(6);
    Swal.fire({
        title: "PAID PROCESS ?",
        html: `<p>Lakukan proses ini jika costumer sudah membayar !</p>
        <label for="datePaid">Paid Date :</label>
        <input id="datePaid" type="datetime-local" class="form-control swal2-input" placeholder="Paid Date">
        <h4 class="color-blue strong">${token[1]}</h4>
        <input id="validation" type="text" class="form-control swal2-input" placeholder="Inputkan Token di atas!" autocomplete="off">`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "PROSES",
    }).then((result) => {
        if (result.isConfirmed) {
            var validation = document.querySelector("#validation").value;
            var date = document.querySelector("#datePaid").value;
            validation = removeSpecialCharacters(validation);

            if (validation != token[0]) {
                Swal.fire({
                    icon: "error",
                    title: "DATA GAGAL DI PROSES",
                    confirmButtonText: "Ulangi",
                    confirmButtonColor: "#f54949",
                    text: "Token Salah !",
                });
                return;
            }

            let formData = new FormData();
            formData.append("id", id);
            formData.append("date", date);
            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    if (ok == "ok") {
                        document.getElementsByTagName("form")[0].innerHTML = "";
                        Swal.fire({
                            icon: "success",
                            title: "INVOICE BERHASIL DI UPDATE",
                            confirmButtonText: "OK",
                            text: "Data dapat dilihat di Detail Invoice !",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, `../detail-invoice/?id=${id}`);
                            }
                            window.location.href = `../detail-invoice/?id=${id}`;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "INVOICE GAGAL DI UPDATE",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/set-paid.php`, "true");
            ajax.send(formData);
        }
    });
}

//delete invoice
function deleteINV(id) {
    var token = generateRandomString(6);

    Swal.fire({
        title: "HAPUS INVOICE INI ?",
        html: `<p class="color-red">⚠️ INVOICE yang terhapus tidak dapat dipulihkan</p>
        <h3 class="color-blue strong">${token[1]}</h3>
        <input id="validation" type="text" class="form-control swal2-input" placeholder="Inputkan Token di atas!" autocomplete="off">`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#222",
        confirmButtonText: "DELETE",
    }).then((result) => {
        if (result.isConfirmed) {
            var validation = document.querySelector("#validation").value;
            validation = removeSpecialCharacters(validation);

            if (validation != token[0]) {
                Swal.fire({
                    icon: "error",
                    title: "DATA GAGAL DI HAPUS",
                    confirmButtonText: "Ulangi",
                    confirmButtonColor: "#f54949",
                    text: "Token Salah !",
                });
                return;
            }

            let formData = new FormData();
            formData.append("kode", id);
            formData.append("submit", true);

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // alert(ok);
                    // return;
                    if (ok == "ok") {
                        Swal.fire({
                            icon: "success",
                            title: "INVOICE BERHASIL DI HAPUS",
                            confirmButtonText: "OK",
                            text: "Perubahan dapat dilihat di page INVOICE !",
                        }).then(() => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, "../order-invoice/");
                            }
                            window.location.href = "../order-invoice/";
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "INVOICE GAGAL DI HAPUS",
                            confirmButtonText: "Ulangi",
                            confirmButtonColor: "#f54949",
                            text: ok,
                        });
                    }
                }
            };
            ajax.open("POST", `../action/deleteInvoice.php`, "true");
            ajax.send(formData);
        }
    });
}

// CHAT BOT
function sendBot(no, msg, kind) {
    let formData = new FormData();
    formData.append("no", no);
    formData.append("msg", msg);
    formData.append("kind", kind);
    formData.append("submit", true);

    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var ok = ajax.responseText;
            Swal.fire({
                icon: "info",
                title: "SEND WITH BOT",
                confirmButtonText: "OK",
                text: ok,
            });
        }
    };
    ajax.open("POST", `../ajax/sendWa.php`, "true");
    ajax.send(formData);
}

//SPEND PAID SELECTED
function paySelected(id) {
    var token = generateRandomString(6);
    var selectedIds = [];
    document.querySelectorAll(".orderCheckBox:checked").forEach((checkbox) => {
        selectedIds.push(checkbox.value);
    });

    if (selectedIds.length == 0) {
        // JIKA CHECKLIST KOSONG
        Swal.fire({
            icon: "error",
            title: "GAGAL",
            confirmButtonText: "Ulangi",
            confirmButtonColor: "#f54949",
            text: "Pilih minimal satu order untuk diperbarui.",
        });
        return;
    }

    Swal.fire({
        title: "PROSES KE PAID ?",
        html: `<p class="color-red">⚠️ DATA yang tercentang statusnya akan berubah ke PAID</p>
<h3 class="color-blue strong">${token[1]}</h3>
<input id="validation" type="text" class="form-control swal2-input" placeholder="Inputkan Token di atas!" autocomplete="off">`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#222",
        confirmButtonText: "PAY",
    }).then((result) => {
        if (result.isConfirmed) {
            var validation = document.querySelector("#validation").value;
            validation = removeSpecialCharacters(validation);

            if (validation != token[0]) {
                Swal.fire({
                    icon: "error",
                    title: "DATA GAGAL DIPROSES",
                    confirmButtonText: "Ulangi",
                    confirmButtonColor: "#f54949",
                    text: "Token Salah !",
                });
                return;
            }

            if (selectedIds.length > 0) {
                // AJAX >>>
                let formData = new FormData();
                formData.append("kode", selectedIds);
                formData.append("submit", true);

                var ajax = new XMLHttpRequest();
                ajax.onreadystatechange = function () {
                    if (ajax.readyState == 4 && ajax.status == 200) {
                        var ok = ajax.responseText;
                        // alert(ok);
                        // return;
                        if (ok == "ok") {
                            Swal.fire({
                                icon: "success",
                                title: "INVOICE BERHASIL DI UPDATE",
                                confirmButtonText: "OK",
                                text: "Perubahan dapat dilihat di page PAID !",
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            console.log(ok);
                            return;
                            Swal.fire({
                                icon: "error",
                                title: "INVOICE GAGAL DI UPDATE",
                                confirmButtonText: "Ulangi",
                                confirmButtonColor: "#f54949",
                                text: ok,
                            });
                        }
                    }
                };
                ajax.open("POST", `../action/paySelected.php`, "true");
                ajax.send(formData);
                // AJAX END>>>
            }
        }
    });
}
