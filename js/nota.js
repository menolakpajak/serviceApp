

var qts = document.querySelectorAll('.qts');
var desc = document.querySelectorAll('.desc');
var buy = document.querySelectorAll('.buy');
var margin = document.querySelectorAll('.margin');
var sell = document.querySelectorAll('.sell');

function calInvoice(){
    var qts = document.querySelectorAll('.qts');
    var desc = document.querySelectorAll('.desc');
    var buy = document.querySelectorAll('.buy');
    var margin = document.querySelectorAll('.margin');
    var sell = document.querySelectorAll('.sell');
    var profit = document.querySelector('#profit');
    var subtotal = document.querySelector('#subtotal');
    var dpp = document.querySelector('#dpp');
    var ppn = document.querySelector('#ppn');
    var dp = document.querySelector('#deposit');
    var total = document.querySelector('#total');

    var item = qts.length;

    var fsubtotal = 0;
    var fprofit = 0;
    for(i = 0; i<item;i++ ){
        var fqts = makeNum(qts[i].value)
        var fbuy = makeNum(buy[i].value)
        var fmargin = makeNum(margin[i].value)
            if(fbuy != 0 || fqts == 0 ){
                var fsell = (fqts*fbuy)
                fsell = fsell /100 * (100 + fmargin)
                if(fmargin <= 0){
                     fsell = makeNum(sell[i].value);
                }
            }else{
                fsell = makeNum(sell[i].value);
            }
        fprofit += fqts*fbuy;
        fsubtotal += fsell
        sell[i].value = Math.round(fsell).toLocaleString()
    }

    fprofit = fsubtotal - fprofit
    var fdpp = fsubtotal * 100/111;
    var fppn = fdpp * 11/100;
    var ftotal = fsubtotal - makeNum(dp.value)
    subtotal.value = Math.round(fsubtotal).toLocaleString()
    total.value = Math.round(ftotal).toLocaleString()
    dpp.value = Math.round(fdpp).toLocaleString()
    ppn.value = Math.round(fppn).toLocaleString()
    profit.value = Math.round(fprofit).toLocaleString()
}

function numSeperate(event){

        // Ambil nilai input
        let inputValue = event.target.value;
        
  
        // Hapus semua karakter non-angka
        inputValue = inputValue.replace(/\D/g, '');
  
        // Format nilai dengan pemisah ribuan
        const formattedValue = Number(inputValue).toLocaleString();

        // Update nilai input dengan nilai yang diformat
        event.target.value = formattedValue;

}

function makeNum(huruf){

    // Hapus semua karakter non-angka
    var angka = huruf.replace(/\D/g, '');

    // merubah string ke Number
    angka = Number(angka);
    return angka;
}

function add(){
    var add = document.querySelector('#item');
    
    // Dapatkan URL query string
    var queryString = window.location.search;

    // Parse query string menjadi objek
    var params = new URLSearchParams(queryString);

    // Dapatkan nilai variabel $_GET berdasarkan namanya
    var nilaiVarGet = params.get('spk');

    // Cek apakah variabel $_GET ada dan memiliki nilai
    if (nilaiVarGet !== null) {
        location.href = `?spk=${nilaiVarGet}&add=${add.value}`;
    } else {
        location.href = `?add=${add.value}`;
    }
}

function addEdit(){
    var add = document.querySelector('#item').value;
    
    // Dapatkan URL query string
    var queryString = window.location.search;

    // Parse query string menjadi objek
    var params = new URLSearchParams(queryString);

    // Dapatkan nilai variabel $_GET berdasarkan namanya
    var id = params.get('id');

        var edit = document.getElementById('edit');
        var ajax = new XMLHttpRequest()
        //cek kesiapan ajax
        ajax.onreadystatechange = function(){
            if( ajax.readyState == 4 && ajax.status == 200){
                edit.innerHTML = ajax.responseText ;
            }
        }
        
                // jalankan ajaxnya
        ajax.open('GET', `../ajax/editFormInvoice.php?id=${id}&add=${add}` , 'true') ;
        ajax.send() ;


}

//menambahkan unit pada surat jalan
function addUnit(){
    var add = document.querySelector('#item');
    location.href = `?add=${add.value}`;
}