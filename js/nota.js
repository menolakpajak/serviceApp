var qts = document.querySelectorAll(".qts");
var desc = document.querySelectorAll(".desc");
var buy = document.querySelectorAll(".buy");
var margin = document.querySelectorAll(".margin");
var sell = document.querySelectorAll(".sell");

function calInvoice() {
    var qts = document.querySelectorAll(".qts");
    var buy = document.querySelectorAll(".buy");
    var margin = document.querySelectorAll(".margin");
    var sell = document.querySelectorAll(".sell");
    var profit = document.querySelector("#profit");
    var subtotal = document.querySelector("#subtotal");
    var dpp = document.querySelector("#dpp");
    var ppn = document.querySelector("#ppn");
    var dp = document.querySelector("#deposit");
    var discount = document.querySelector("#discount");
    var total = document.querySelector("#total");
    var spend = document.querySelector("#spend");

    var item = qts.length;

    var fsubtotal = 0;
    var fprofit = 0;
    for (i = 0; i < item; i++) {
        var fqts = makeNum(qts[i].value);
        var fbuy = makeNum(buy[i].value);
        var fmargin = makeNum(margin[i].value);
        if (fbuy != 0 || fqts == 0) {
            var fsell = fqts * fbuy;
            fsell = (fsell / 100) * (100 + fmargin);
            if (fmargin <= 0) {
                fsell = makeNum(sell[i].value);
            }
        } else {
            fsell = makeNum(sell[i].value);
        }
        fprofit += fqts * fbuy;
        fsubtotal += fsell;
        sell[i].value = Math.round(fsell).toLocaleString();
    }

    fprofit = fsubtotal - fprofit - makeNum(discount.value);
    var fdpp = (fsubtotal * 100) / 111;
    var fppn = (fdpp * 11) / 100;
    var ftotal = fsubtotal - makeNum(dp.value) - makeNum(discount.value);
    subtotal.value = Math.round(fsubtotal).toLocaleString();
    total.value = Math.round(ftotal).toLocaleString();
    dpp.value = Math.round(fdpp).toLocaleString();
    ppn.value = Math.round(fppn).toLocaleString();
    profit.value = Math.round(fprofit).toLocaleString();
    spend.value = profit.value;
}

function numSeperate(event) {
    // Ambil nilai input
    let inputValue = event.target.value;

    // Hapus semua karakter non-angka
    inputValue = inputValue.replace(/\D/g, "");

    // Format nilai dengan pemisah ribuan
    const formattedValue = Number(inputValue).toLocaleString();

    // Update nilai input dengan nilai yang diformat
    event.target.value = formattedValue;
}

function makeNum(huruf) {
    // Hapus semua karakter non-angka
    var angka = huruf.replace(/\D/g, "");

    // merubah string ke Number
    angka = Number(angka);
    return angka;
}

function add() {
    var add = document.querySelector("#item");

    // Dapatkan URL query string
    var queryString = window.location.search;

    // Parse query string menjadi objek
    var params = new URLSearchParams(queryString);

    // Dapatkan nilai variabel $_GET berdasarkan namanya
    var nilaiVarGet = params.get("spk");

    // Cek apakah variabel $_GET ada dan memiliki nilai
    if (nilaiVarGet !== null) {
        location.href = `?spk=${nilaiVarGet}&add=${add.value}`;
    } else {
        location.href = `?add=${add.value}`;
    }
}

function addEdit() {
    var add = document.querySelector("#item").value;

    // Dapatkan URL query string
    var queryString = window.location.search;

    // Parse query string menjadi objek
    var params = new URLSearchParams(queryString);

    // Dapatkan nilai variabel $_GET berdasarkan namanya
    var id = params.get("id");

    var edit = document.getElementById("edit");
    var ajax = new XMLHttpRequest();
    //cek kesiapan ajax
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            edit.innerHTML = ajax.responseText;
        }
    };

    // jalankan ajaxnya
    ajax.open("GET", `../ajax/editFormInvoice.php?id=${id}&add=${add}`, "true");
    ajax.send();
}

//menambahkan unit pada surat jalan
function addUnit() {
    var add = document.querySelector("#item");
    location.href = `?add=${add.value}`;
}

// fungsi menampilkan profit
function profitShow(profit) {
    // console.log(profit);
    var show = document.querySelector(".profitShow");
    if (show.innerText == "*****") {
        show.innerText = profit;
    } else {
        show.innerText = "*****";
    }
}

//fungsi menampilkan quotation
function quo(id) {
    let formData = new FormData();
    formData.append("id", id);
    formData.append("submit", true);

    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var ok = JSON.parse(ajax.responseText);
            // return console.log(ok);
            if (ok.length > 0) {
                var link = "";
                for (i = 0; i < ok.length; i++) {
                    var date = ok[i]["date"];
                    link += `<a class="btn btn-warning mt-1" href="../quotation/?kode=${id}&index=${i}" target="_blank"><i class="fa fa-file" aria-hidden="true"> </i> ${date}</a>`;
                }
            }

            Swal.fire({
                title: "Quotation",
                html: link,
                icon: "info",
                showCancelButton: false,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK",
            });
        }
    };
    ajax.open("POST", `../ajax/quotation.php`, "true");
    ajax.send(formData);

    return;
}

//fungsi reset
function resetValue() {
    var nota = document.getElementById("reset-nota");
    nota.style.display = "none";
    // console.log(nota);
}

// Action on sharing page
//ACTION SHARING EDIT OR DELETE FUNCTION
function actionSharing(event, action, id = 0, profit, sharing) {
    event.preventDefault();

    let formData = new FormData();

    formData.append("id", id);
    formData.append("profit", profit);
    formData.append("sharing", sharing);
    formData.append("submit", true);

    var ajax = new XMLHttpRequest();
    // Menambahkan elemen loading spinner ke dalam pesan SweetAlert
    var swalWithLoading = Swal.mixin({
        title: "Proccesing ⏳",
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
            if (ok == "edit ok") {
                swalWithLoading.close();

                Swal.fire({
                    icon: "success",
                    title: "DATA BERHASIL DI EDIT",
                    confirmButtonText: "OK",
                    text: "Data telah berubah !",
                }).then(() => {
                    window.location.reload();
                });
            } else if (ok == "delete ok") {
                Swal.fire({
                    icon: "success",
                    title: "DATA BERHASIL DI HAPUS",
                    confirmButtonText: "OK",
                    text: "Data telah Terhapus !",
                }).then(() => {
                    window.location.reload();
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

    if (action == "delete") {
        ajax.open("POST", `../action/deleteSharing.php`, "true");
    } else {
        ajax.open("POST", `../action/editSharing.php`, "true");
    }
    ajax.send(formData);
}

//TOMBOL ACTION DI SHARING PAGE
function action(id, profit, sharing) {
    // console.log(id);
    Swal.fire({
        title: "ACTION !",
        html: `<button onclick="editAction(${id},'${profit}','${sharing}')" class="btn btn-info">Edit</button></td>
        <button onclick="deleteSharing(${id})" class="btn btn-danger">Delete</button></td>`,
        icon: "warning",
        showCancelButton: false,
        showConfirmButton: false,
    });
}
//EDIT FUNCTION DI SHARING PAGE
function editAction(id, profit, sharing) {
    Swal.fire({
        title: "EDITING !",
        html: `<form>
                <input id="actionProfit" type="text" class="form-control swal2-input" placeholder="Profit" autocomplete="off" required onkeyup="numSeperate(event)" value="${profit}">
                <input id="actionSharing" type="text" class="form-control swal2-input" placeholder="Sharing" autocomplete="off" required onkeyup="numSeperate(event)" value=${sharing}>
        </form>`,
        icon: "warning",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "EDIT",
    }).then((result) => {
        if (result.isConfirmed) {
            let editProfit = document.getElementById("actionProfit").value;
            let editSharing = document.getElementById("actionSharing").value;
            if (profit == "" || sharing == "") {
                Swal.fire({
                    icon: "error",
                    title: "INVALID",
                    confirmButtonText: "Ulangi",
                    confirmButtonColor: "#f54949",
                    text: "Profit dan Sharing tidak boleh kosong !",
                });
                return;
            }
            actionSharing(event, "edit", id, editProfit, editSharing);
            return;
        }
    });
}

// DELETE SHARING
function deleteSharing(id) {
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
            actionSharing(event, "delete", id, "", "");
        }
    });
}
