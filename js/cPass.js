if (document.getElementById("password") != null) {
    var pass = document.getElementById("password");

    pass.addEventListener("click", password);
}
function password() {
    Swal.fire({
        icon: "question",
        title: "UBAH PASSWORD",
        text: "Masukkan password lama anda:",
        input: "password",
        showCancelButton: true,
        confirmButtonText: "NEXT",
    }).then((result) => {
        if (result.value) {
            // var password = encodeURI(result.value);
            var ajax = new XMLHttpRequest();
            var user = document.getElementById("username").innerText;
            //cek kesiapan ajax
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var ok = ajax.responseText;
                    // console.log(ok)
                    if (ok == "password ok") {
                        // jika password benar
                        Swal.fire({
                            icon: "question",
                            title: "PASSWORD BARU",
                            text: "Masukan password baru anda:",
                            input: "password",
                            confirmButtonColor: "#ffb53e",
                            showCancelButton: true,
                            confirmButtonText: "NEXT",
                        }).then((result) => {
                            if (result.value) {
                                // input password baru
                                var passwordSatu = result.value;
                                Swal.fire({
                                    icon: "question",
                                    title: "PASSWORD VERIFY",
                                    text: "Masukan password baru anda lagi:",
                                    input: "password",
                                    confirmButtonColor: "#f71212",
                                    showCancelButton: true,
                                    confirmButtonText: "NEXT",
                                }).then((result) => {
                                    if (result.value) {
                                        // verify password baru
                                        passwordDua = result.value;
                                        if (passwordSatu == passwordDua) {
                                            // cek kesamaan password baru
                                            var ajax = new XMLHttpRequest();
                                            var user = document.getElementById("username").innerText;
                                            //cek kesiapan ajax
                                            ajax.onreadystatechange = function () {
                                                if (ajax.readyState == 4 && ajax.status == 200) {
                                                    var ok = ajax.responseText;
                                                    if (ok == "sukses") {
                                                        //jika ganti password sukses
                                                        Swal.fire({
                                                            icon: "success",
                                                            title: "PASSWORD DIUBAH",
                                                            text: "Pergantian password berhasil dilakukan",
                                                        });
                                                    } else if (ok == "password sama") {
                                                        Swal.fire({
                                                            icon: "warning",
                                                            title: "TIDAK ADA PERUBAHAN",
                                                            text: "Password baru anda sama dengan password lama",
                                                        });
                                                    } else {
                                                        //jika ganti password gagal
                                                        Swal.fire({
                                                            icon: "error",
                                                            title: "PASSWORD GAGAL DIUBAH",
                                                            text: "Password anda tidak berubah !",
                                                        });
                                                    }
                                                }
                                            };

                                            // jalankan ajaxnya
                                            ajax.open("POST", `../ajax/change_password.php`, "true");
                                            ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                            ajax.send(`user=${user}&verify=${passwordSatu}`);
                                        } else {
                                            // jika password tidak sama
                                            Swal.fire({
                                                icon: "error",
                                                title: "PROSES GAGAL",
                                                text: "Password yang anda masukan tidak cocok !",
                                            });
                                        }
                                    }
                                });
                            }
                        });
                    } else if (ok == "password fail") {
                        // jika password salah
                        Swal.fire({
                            icon: "error",
                            title: "PROSES GAGAL",
                            text: "Password lama anda SALAH !",
                        });
                    }
                }
            };

            // jalankan ajaxnya

            ajax.open("POST", `../ajax/change_password.php`, "true");
            ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajax.send(`username=${user}&password=${result.value}`);
        } else {
            // jika tidak mengimputkan apapun diawal
            Swal.fire({
                icon: "warning",
                title: "TIDAK ADA PERUBAHAN",
                text: "anda tidak menginputkan apapun !",
            });
            // .then(okay => {
            //     window.location.href = ""
            // })
        }
    });
}

// UPDATE VERSION
function updateVersion (versi){
    Swal.fire({
        icon: 'question',
        title: "UPDATE VERSION",
        text: "Versi saat ini : "+ versi,
        input: 'text' ,
        showCancelButton: true ,
        confirmButtonText: 'UPDATE'
    }).then((result) => {
        if (result.isConfirmed) {
            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    ok = ajax.responseText;
                    if (ok == "ok") {
                        Swal.fire({
                            icon: "success",
                            title: "DONE",
                            text: "Update Version berhasil dilakukan",
                        });
                    }else{
                        Swal.fire({
                        icon: "error",
                        title: "FAILED",
                        text: ok,
                    });
                    }
                }
            }
            ajax.open("POST", `../ajax/update_version.php`, "true");
            ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajax.send(`versi=${result.value}`);
        }

    })


//end
}
