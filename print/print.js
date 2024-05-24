
function printDocument() {
    window.print();
}

JsBarcode("#barcode").init();


if(document.getElementById('signature-pad')){
    var canvas = document.getElementById('signature-pad');
    var signaturePad = new SignaturePad(canvas);
}
function saveSignature(id) {
    if(cekCanvas() != 'ok'){
        Swal.fire({
            icon: 'error',
            title: 'ERROR',
            confirmButtonText: "Retry",
            confirmButtonColor: "#f54949",
            text: 'Empty Signature !',
        })
        return;
    }

    html2canvas(canvas).then(function(canvasImg) {
    var imgData = canvasImg.toDataURL();
    // console.log(imgData);
    sendData(id,imgData);
    });
}
  
function clearSignature() {
    signaturePad.clear();
}
  
function cekCanvas() {
    var isCanvasEmpty = signaturePad.isEmpty();

    if (isCanvasEmpty) {
    return 'empty signature';
    }else{
        return 'ok';
    }
}


function sendData(id,data){
    Swal.fire({
        title: 'SAVE',
        text: 'Are you sure to save?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            
            let formData = new FormData();
            formData.append("no_spk", id);
            formData.append("signature", data);
            formData.append("submit", true);
            var ajax = new XMLHttpRequest();
                ajax.onreadystatechange = function () {
                    if (ajax.readyState == 4 && ajax.status == 200) {
                        var ok = ajax.responseText;
                        // console.log(ok)
                        // return;
                        if(ok == 'ok'){
                            document.getElementById('hormat kami').innerHTML = '';
                            Swal.fire({
                                icon: 'success',
                                title: 'SAVED',
                                text: 'Thank you',
                                confirmButtonText: "OK",
                            }).then(() => {
                                if (window.history.replaceState) {
                                    window.history.replaceState(null, null, location.reload());
                                }
                                location.reload();
                            })
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR',
                                confirmButtonText: "Ulangi",
                                confirmButtonColor: "#f54949",
                                text: ok,
                            })
                        }
                    }
                }
                ajax.open("POST", `../action/signature.php`, "true");
                ajax.send(formData);
        }
    })
}

// copy URL
function copyURI(evt) {
    evt.preventDefault();
    navigator.clipboard.writeText(evt.target.getAttribute('href')).then(() => {
          /* clipboard write Success */
          const toastCopy = document.querySelector('#toastCopy')
          let toastPlacement;
          toastPlacement = new bootstrap.Toast(toastCopy);
          toastPlacement.show();
    }, () => {
      /* clipboard write failed */
    });
  }

  // change language
  function language(e){
    let lang = e.value;
    let url = window.location.href;
    let invoiceFor = url.indexOf('invoice-for=true');
    if(invoiceFor !== -1){ // invoice for
        url = url.split('&');
        url = `${url[0]}&${url[1]}`
        if(lang == 'id'){
            location.href = url
        }
        if(lang == 'en'){
            location.href = url+'&en'
        }
        return;
    }
    
    url = url.split('&')[0]; // receipt
    if(lang == 'id'){
        location.href = url
    }
    if(lang == 'en'){
        location.href = url+'&en'
    }
  }

  