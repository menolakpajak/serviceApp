

                // FUNGSI RETUR
var status = document.getElementById('status').value

if (status == "benar"){
    Swal.fire({
        icon: 'success',
        title: 'DATA BERHASIL DIRETUR',
    })
    .then(okay => {
        window.location.href = "dataPenjualan.php"
    })
}

if (status == "salah"){
    Swal.fire({
        icon: 'error',
        title: 'DATA GAGAL DIRETUR',
        text: 'pastikan agar kode barang dalam nota sama dengan kode dalam data barang !',
    })
    .then(okay => {
        window.location.href = "dataPenjualan.php"
    })
}

if (status == "barang"){
    var info = document.getElementById('info').value
    Swal.fire({
        icon: 'error',
        title: 'DATA GAGAL DIRETUR',
        text: 'kode barang = '+ info + ' Tidak TERDAFTAR, Sudah TERHAPUS atau telah DIUBAH',
    })
    .then(okay => {
        window.location.href = "dataPenjualan.php"
    })
}







                       








