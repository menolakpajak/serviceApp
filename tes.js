


if (document.getElementById('msg') != '' ){
    var msg = document.getElementById('msg');
    var text = document.getElementById('text');
    var ajax = new XMLHttpRequest()
    
        ajax.open('GET', 'https://api.callmebot.com/whatsapp.php?phone=+6282115903808&text='+ msg.value +'&apikey=388109', 'false') ;
        ajax.send() ;

        if( ajax.readyState == 4 && ajax.status == 200){
            alert ('Berhasil !');
        }
    
            
    }