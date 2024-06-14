var container = document.getElementById("container");
var pilih1 = document.getElementById("select1");
var pilih2 = document.getElementById("select2");
var periode = document.getElementById("periode");
var cancel = document.getElementById("cancel");
var ok = document.getElementById("ok");
var order = "no_spk DESC";
// AJAX........>>>

// cari dasboard

if (document.getElementById("keyword") != null) {
    var keyword = document.getElementById("keyword");

    pilih1.addEventListener("click", function () {
        var keyword = document.getElementById("keyword");
        var icon1 = document.getElementById("icon1");
        var opsi1 = document.getElementById("opsi1");
        if (pilih1.classList["value"] == "naik") {
            var order = "nama DESC";
            opsi1.innerText = " Nama Z - A";
            pilih1.classList["value"] = "turun";
            icon1.classList["value"] = "fa fa-sort-alpha-desc";
        } else {
            pilih1.classList["value"] = "naik";
            var order = "nama";
            opsi1.innerText = " Nama A - Z";
            icon1.classList["value"] = "fa fa-sort-alpha-asc";
        }
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariDashboard.php?keyword=" + keyword.value + "&order=" + order, "true");
        ajax.send();
    });

    pilih2.addEventListener("click", function () {
        var keyword = document.getElementById("keyword");
        var icon2 = document.getElementById("icon2");
        var opsi2 = document.getElementById("opsi2");
        if (pilih2.classList["value"] == "naik") {
            var order = "date DESC";
            pilih2.classList["value"] = "turun";
            icon2.classList["value"] = "fa fa-sort-numeric-desc";
            opsi2.innerText = " Terlama ";
        } else {
            pilih2.classList["value"] = "naik";
            var order = "date";
            icon2.classList["value"] = "fa fa-sort-numeric-asc";
            opsi2.innerText = " Terbaru ";
        }
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariDashboard.php?keyword=" + keyword.value + "&order=" + order, "true");
        ajax.send();
    });

    keyword.addEventListener("keyup", function () {
        var keyword = document.getElementById("keyword");
        var order = "date";
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariDashboard.php?keyword=" + keyword.value + "&order=" + order, "true");
        ajax.send();
    });

    // ....SORT BY PERIODE....

    periode.addEventListener("click", function () {
        var bg = document.getElementById("bg");
        var table = document.getElementById("date-table");

        bg.style.display = "flex";
        table.classList["value"] = "zoomin";
    });

    cancel.addEventListener("click", function () {
        var bg = document.getElementById("bg");
        var table = document.getElementById("date-table");

        setTimeout(function () {
            bg.style.display = "none";
        }, 900);
        table.classList["value"] = "zoomout";
    });

    ok.addEventListener("click", function () {
        var bg = document.getElementById("bg");
        var table = document.getElementById("date-table");

        var from = document.getElementById("from");
        var to = document.getElementById("to");
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariDashboardPeriode.php?from=" + from.value + "&to=" + to.value, "true");
        ajax.send();

        setTimeout(function () {
            bg.style.display = "none";
        }, 900);
        table.classList["value"] = "zoomout";
    });
}

//cari new

if (document.getElementById("keyword-new") != null) {
    var keyword = document.getElementById("keyword-new");

    pilih1.addEventListener("click", function () {
        var keyword = document.getElementById("keyword-new");
        var icon1 = document.getElementById("icon1");
        var opsi1 = document.getElementById("opsi1");
        if (pilih1.classList["value"] == "naik") {
            var order = "nama DESC";
            opsi1.innerText = " Nama Z - A";
            pilih1.classList["value"] = "turun";
            icon1.classList["value"] = "fa fa-sort-alpha-desc";
        } else {
            pilih1.classList["value"] = "naik";
            var order = "nama";
            opsi1.innerText = " Nama A - Z";
            icon1.classList["value"] = "fa fa-sort-alpha-asc";
        }
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariNew.php?keyword=" + keyword.value + "&order=" + order, "true");
        ajax.send();
    });

    pilih2.addEventListener("click", function () {
        var keyword = document.getElementById("keyword-new");
        var icon2 = document.getElementById("icon2");
        var opsi2 = document.getElementById("opsi2");
        if (pilih2.classList["value"] == "naik") {
            var order = "date DESC";
            pilih2.classList["value"] = "turun";
            icon2.classList["value"] = "fa fa-sort-numeric-desc";
            opsi2.innerText = " Terlama ";
        } else {
            pilih2.classList["value"] = "naik";
            var order = "date";
            icon2.classList["value"] = "fa fa-sort-numeric-asc";
            opsi2.innerText = " Terbaru ";
        }
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariNew.php?keyword=" + keyword.value + "&order=" + order, "true");
        ajax.send();
    });

    keyword.addEventListener("keyup", function () {
        var keyword = document.getElementById("keyword-new");
        var order = "date";
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariNew.php?keyword=" + keyword.value + "&order=" + order, "true");
        ajax.send();
    });

    // ....SORT BY PERIODE....

    periode.addEventListener("click", function () {
        var bg = document.getElementById("bg");
        var table = document.getElementById("date-table");

        bg.style.display = "flex";
        table.classList["value"] = "zoomin";
    });

    cancel.addEventListener("click", function () {
        var bg = document.getElementById("bg");
        var table = document.getElementById("date-table");

        setTimeout(function () {
            bg.style.display = "none";
        }, 900);
        table.classList["value"] = "zoomout";
    });

    ok.addEventListener("click", function () {
        var bg = document.getElementById("bg");
        var table = document.getElementById("date-table");

        var from = document.getElementById("from");
        var to = document.getElementById("to");
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariNewPeriode.php?from=" + from.value + "&to=" + to.value, "true");
        ajax.send();

        setTimeout(function () {
            bg.style.display = "none";
        }, 900);
        table.classList["value"] = "zoomout";
    });
}

// cari proses

if (document.getElementById("keyword-proses") != null) {
    var keyword = document.getElementById("keyword-proses");

    pilih1.addEventListener("click", function () {
        var keyword = document.getElementById("keyword-proses");
        var icon1 = document.getElementById("icon1");
        var opsi1 = document.getElementById("opsi1");
        if (pilih1.classList["value"] == "naik") {
            var order = "nama DESC";
            opsi1.innerText = " Nama Z - A";
            pilih1.classList["value"] = "turun";
            icon1.classList["value"] = "fa fa-sort-alpha-desc";
        } else {
            pilih1.classList["value"] = "naik";
            var order = "nama";
            opsi1.innerText = " Nama A - Z";
            icon1.classList["value"] = "fa fa-sort-alpha-asc";
        }
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariProses.php?keyword=" + keyword.value + "&order=" + order, "true");
        ajax.send();
    });

    pilih2.addEventListener("click", function () {
        var keyword = document.getElementById("keyword-proses");
        var icon2 = document.getElementById("icon2");
        var opsi2 = document.getElementById("opsi2");
        if (pilih2.classList["value"] == "naik") {
            var order = "date DESC";
            pilih2.classList["value"] = "turun";
            icon2.classList["value"] = "fa fa-sort-numeric-desc";
            opsi2.innerText = " Terlama ";
        } else {
            pilih2.classList["value"] = "naik";
            var order = "date";
            icon2.classList["value"] = "fa fa-sort-numeric-asc";
            opsi2.innerText = " Terbaru ";
        }
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariProses.php?keyword=" + keyword.value + "&order=" + order, "true");
        ajax.send();
    });

    keyword.addEventListener("keyup", function () {
        var keyword = document.getElementById("keyword-proses");
        var order = "date";
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariProses.php?keyword=" + keyword.value + "&order=" + order, "true");
        ajax.send();
    });

    // ....SORT BY PERIODE....

    periode.addEventListener("click", function () {
        var bg = document.getElementById("bg");
        var table = document.getElementById("date-table");

        bg.style.display = "flex";
        table.classList["value"] = "zoomin";
    });

    cancel.addEventListener("click", function () {
        var bg = document.getElementById("bg");
        var table = document.getElementById("date-table");

        setTimeout(function () {
            bg.style.display = "none";
        }, 900);
        table.classList["value"] = "zoomout";
    });

    ok.addEventListener("click", function () {
        var bg = document.getElementById("bg");
        var table = document.getElementById("date-table");

        var from = document.getElementById("from");
        var to = document.getElementById("to");
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariProsesPeriode.php?from=" + from.value + "&to=" + to.value, "true");
        ajax.send();

        setTimeout(function () {
            bg.style.display = "none";
        }, 900);
        table.classList["value"] = "zoomout";
    });
}

//sort proses
function sortProses(sort) {
    var ajax = new XMLHttpRequest();

    //cek kesiapan ajax
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            container.innerHTML = ajax.responseText;
        }
    };

    // jalankan ajaxnya
    ajax.open("GET", `../ajax/cariProses.php?${sort}=true`, "true");
    ajax.send();
}
//cari done

if (document.getElementById("keyword-done") != null) {
    var keyword = document.getElementById("keyword-done");

    pilih1.addEventListener("click", function () {
        var keyword = document.getElementById("keyword-done");
        var icon1 = document.getElementById("icon1");
        var opsi1 = document.getElementById("opsi1");
        if (pilih1.classList["value"] == "naik") {
            var order = "nama DESC";
            opsi1.innerText = " Nama Z - A";
            pilih1.classList["value"] = "turun";
            icon1.classList["value"] = "fa fa-sort-alpha-desc";
        } else {
            pilih1.classList["value"] = "naik";
            var order = "nama";
            opsi1.innerText = " Nama A - Z";
            icon1.classList["value"] = "fa fa-sort-alpha-asc";
        }
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariDone.php?keyword=" + keyword.value + "&order=" + order, "true");
        ajax.send();
    });

    pilih2.addEventListener("click", function () {
        var keyword = document.getElementById("keyword-done");
        var icon2 = document.getElementById("icon2");
        var opsi2 = document.getElementById("opsi2");
        if (pilih2.classList["value"] == "naik") {
            var order = "date DESC";
            pilih2.classList["value"] = "turun";
            icon2.classList["value"] = "fa fa-sort-numeric-desc";
            opsi2.innerText = " Terlama ";
        } else {
            pilih2.classList["value"] = "naik";
            var order = "date";
            icon2.classList["value"] = "fa fa-sort-numeric-asc";
            opsi2.innerText = " Terbaru ";
        }
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariDone.php?keyword=" + keyword.value + "&order=" + order, "true");
        ajax.send();
    });

    keyword.addEventListener("keyup", function () {
        var keyword = document.getElementById("keyword-done");
        var order = "date";
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariDone.php?keyword=" + keyword.value + "&order=" + order, "true");
        ajax.send();
    });

    // ....SORT BY PERIODE....

    periode.addEventListener("click", function () {
        var bg = document.getElementById("bg");
        var table = document.getElementById("date-table");

        bg.style.display = "flex";
        table.classList["value"] = "zoomin";
    });

    cancel.addEventListener("click", function () {
        var bg = document.getElementById("bg");
        var table = document.getElementById("date-table");

        setTimeout(function () {
            bg.style.display = "none";
        }, 900);
        table.classList["value"] = "zoomout";
    });

    ok.addEventListener("click", function () {
        var bg = document.getElementById("bg");
        var table = document.getElementById("date-table");

        var from = document.getElementById("from");
        var to = document.getElementById("to");
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariDonePeriode.php?from=" + from.value + "&to=" + to.value, "true");
        ajax.send();

        setTimeout(function () {
            bg.style.display = "none";
        }, 900);
        table.classList["value"] = "zoomout";
    });
}

//cari abort

if (document.getElementById("keyword-abort") != null) {
    var keyword = document.getElementById("keyword-abort");

    pilih1.addEventListener("click", function () {
        var keyword = document.getElementById("keyword-abort");
        var icon1 = document.getElementById("icon1");
        var opsi1 = document.getElementById("opsi1");
        if (pilih1.classList["value"] == "naik") {
            var order = "nama DESC";
            opsi1.innerText = " Nama Z - A";
            pilih1.classList["value"] = "turun";
            icon1.classList["value"] = "fa fa-sort-alpha-desc";
        } else {
            pilih1.classList["value"] = "naik";
            var order = "nama";
            opsi1.innerText = " Nama A - Z";
            icon1.classList["value"] = "fa fa-sort-alpha-asc";
        }
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariAbort.php?keyword=" + keyword.value + "&order=" + order, "true");
        ajax.send();
    });

    pilih2.addEventListener("click", function () {
        var keyword = document.getElementById("keyword-abort");
        var icon2 = document.getElementById("icon2");
        var opsi2 = document.getElementById("opsi2");
        if (pilih2.classList["value"] == "naik") {
            var order = "date DESC";
            pilih2.classList["value"] = "turun";
            icon2.classList["value"] = "fa fa-sort-numeric-desc";
            opsi2.innerText = " Terlama ";
        } else {
            pilih2.classList["value"] = "naik";
            var order = "date";
            icon2.classList["value"] = "fa fa-sort-numeric-asc";
            opsi2.innerText = " Terbaru ";
        }
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariAbort.php?keyword=" + keyword.value + "&order=" + order, "true");
        ajax.send();
    });

    keyword.addEventListener("keyup", function () {
        var keyword = document.getElementById("keyword-abort");
        var order = "date";
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariAbort.php?keyword=" + keyword.value + "&order=" + order, "true");
        ajax.send();
    });

    // ....SORT BY PERIODE....

    periode.addEventListener("click", function () {
        var bg = document.getElementById("bg");
        var table = document.getElementById("date-table");

        bg.style.display = "flex";
        table.classList["value"] = "zoomin";
    });

    cancel.addEventListener("click", function () {
        var bg = document.getElementById("bg");
        var table = document.getElementById("date-table");

        setTimeout(function () {
            bg.style.display = "none";
        }, 900);
        table.classList["value"] = "zoomout";
    });

    ok.addEventListener("click", function () {
        var bg = document.getElementById("bg");
        var table = document.getElementById("date-table");

        var from = document.getElementById("from");
        var to = document.getElementById("to");
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariAbortPeriode.php?from=" + from.value + "&to=" + to.value, "true");
        ajax.send();

        setTimeout(function () {
            bg.style.display = "none";
        }, 900);
        table.classList["value"] = "zoomout";
    });
}

//cari pickup

if (document.getElementById("keyword-pickup") != null) {
    var keyword = document.getElementById("keyword-pickup");

    pilih1.addEventListener("click", function () {
        var keyword = document.getElementById("keyword-pickup");
        var icon1 = document.getElementById("icon1");
        var opsi1 = document.getElementById("opsi1");
        if (pilih1.classList["value"] == "naik") {
            var order = "nama DESC";
            opsi1.innerText = " Nama Z - A";
            pilih1.classList["value"] = "turun";
            icon1.classList["value"] = "fa fa-sort-alpha-desc";
        } else {
            pilih1.classList["value"] = "naik";
            var order = "nama";
            opsi1.innerText = " Nama A - Z";
            icon1.classList["value"] = "fa fa-sort-alpha-asc";
        }
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariPickup.php?keyword=" + keyword.value + "&order=" + order, "true");
        ajax.send();
    });

    pilih2.addEventListener("click", function () {
        var keyword = document.getElementById("keyword-pickup");
        var icon2 = document.getElementById("icon2");
        var opsi2 = document.getElementById("opsi2");
        if (pilih2.classList["value"] == "naik") {
            var order = "date_pickup DESC";
            pilih2.classList["value"] = "turun";
            icon2.classList["value"] = "fa fa-sort-numeric-desc";
            opsi2.innerText = " Terlama ";
        } else {
            pilih2.classList["value"] = "naik";
            var order = "date_pickup";
            icon2.classList["value"] = "fa fa-sort-numeric-asc";
            opsi2.innerText = " Terbaru ";
        }
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariPickup.php?keyword=" + keyword.value + "&order=" + order, "true");
        ajax.send();
    });

    keyword.addEventListener("keydown", function (event) {
        var keyword = document.getElementById("keyword-pickup");
        if (event.key === "Enter" || event.keyCode === 13) {
            var order = "date";
            var ajax = new XMLHttpRequest();
            // Menambahkan elemen loading spinner ke dalam pesan SweetAlert
            var swalWithLoading = Swal.mixin({
                title: "SEARCHING 🔍",
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

            //cek kesiapan ajax
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    container.innerHTML = ajax.responseText;
                    swalWithLoading.close();
                }
            };

            // jalankan ajaxnya
            ajax.open("GET", "../ajax/cariPickup.php?keyword=" + keyword.value + "&order=" + order, "true");
            ajax.send();
        }
    });

    // ....SORT BY PERIODE....

    periode.addEventListener("click", function () {
        var bg = document.getElementById("bg");
        var table = document.getElementById("date-table");

        bg.style.display = "flex";
        table.classList["value"] = "zoomin";
    });

    cancel.addEventListener("click", function () {
        var bg = document.getElementById("bg");
        var table = document.getElementById("date-table");

        setTimeout(function () {
            bg.style.display = "none";
        }, 900);
        table.classList["value"] = "zoomout";
    });

    ok.addEventListener("click", function () {
        var bg = document.getElementById("bg");
        var table = document.getElementById("date-table");

        var from = document.getElementById("from");
        var to = document.getElementById("to");
        var ajax = new XMLHttpRequest();

        //cek kesiapan ajax
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                container.innerHTML = ajax.responseText;
            }
        };

        // jalankan ajaxnya
        ajax.open("GET", "../ajax/cariPickupPeriode.php?from=" + from.value + "&to=" + to.value, "true");
        ajax.send();

        setTimeout(function () {
            bg.style.display = "none";
        }, 900);
        table.classList["value"] = "zoomout";
    });
}

//cari pickup maunya pakai yang ini !!
function cariPickup(event) {
    event.preventDefault();
    var search = document.querySelector("#keyword-pickup").value;

    if (search == "") {
        Swal.fire({
            icon: "error",
            title: "FORBIDEN",
            confirmButtonText: "Ulangi",
            confirmButtonColor: "#f54949",
            text: "Input Tidak boleh kosong !",
        });
        return;
    }

    let formData = new FormData();
    formData.append("keyword", search);
    formData.append("submit", true);

    var ajax = new XMLHttpRequest();
    // Menambahkan elemen loading spinner ke dalam pesan SweetAlert
    var swalWithLoading = Swal.mixin({
        title: "SEARCHING 🔍",
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
            // console.log(ok);
            container.innerHTML = ok;
        }
    };

    ajax.open("POST", `../ajax/cariInvoice.php`, "true");
    ajax.send(formData);
}

//cari invoice
function cariInvoice(event) {
    event.preventDefault();
    var search = document.querySelector("#keyword-nota").value;

    let formData = new FormData();
    formData.append("keyword", search);

    if (document.getElementById("bulan") != null) {
        var bulan = document.getElementById("bulan").value;
        formData.append("bulan", bulan);
    }
    if (document.getElementById("tahun") != null) {
        var tahun = document.getElementById("tahun").value;
        formData.append("tahun", tahun);
    }
    formData.append("submit", true);

    var ajax = new XMLHttpRequest();
    // Menambahkan elemen loading spinner ke dalam pesan SweetAlert
    var swalWithLoading = Swal.mixin({
        title: "SEARCHING 🔍",
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
            // console.log(ok);
            container.innerHTML = ok;
        }
    };

    ajax.open("POST", `../ajax/cariInvoice.php`, "true");
    ajax.send(formData);
}

// cari invoive sesuai bulan
function cariInvoiceBulan(id) {
    Swal.fire({
        title: "SORTING !",
        html: `<form onsubmit="cariInvoice(event)">
        <select name="bulan" id="bulan" class="form-control swal2-select" required>
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>
        <input id="tahun" type="text" class="form-control swal2-input" placeholder="Tahun" autocomplete="off" required maxlength="4">
        </form>`,
        icon: "warning",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Search",
    }).then((result) => {
        if (result.isConfirmed) {
            if (document.getElementById("bulan").value == "" || document.getElementById("tahun").value == "") {
                Swal.fire({
                    icon: "error",
                    title: "INVALID",
                    confirmButtonText: "Ulangi",
                    confirmButtonColor: "#f54949",
                    text: "Bulan dan tahun tidak boleh kosong !",
                });
                return;
            }
            cariInvoice(event);
            return;
        }
    });
}
