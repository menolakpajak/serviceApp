                    ///CEK USER IDLE..

var inactivityTime = function () {
    var time;
    window.onload = resetTimer;
    // DOM Events
    document.onmousemove = resetTimer;
    document.onkeydown = resetTimer;
    document.onmousemove = resetTimer;
    document.onmousedown = resetTimer; // touchscreen presses
    document.ontouchstart = resetTimer;
    document.onclick = resetTimer;     // touchpad clicks
    document.onkeydown = resetTimer;   // onkeypress is deprectaed
    document.addEventListener('scroll', resetTimer, true); // improved; see comments

    function logout() {
        var ajax = new XMLHttpRequest()
        ajax.onreadystatechange = function(){
            if( ajax.readyState == 4 && ajax.status == 200){
                console.log(`you're offline`);
            }
        }
                // jalankan ajaxnya
        ajax.open('GET', '../ajax/offline.php' , 'true') ;
        ajax.send() ;
    }

    function resetTimer() {
        clearTimeout(time);
        time = setTimeout(logout, 300000)
    }
};

window.addEventListener('load', inactivityTime())



//CEK USER
if(document.getElementById('sub-item-1') != null ){
    
    setInterval(userUpdate,5000);
    function userUpdate(){
        
        var ajax = new XMLHttpRequest()
        
        var user = document.getElementById('sub-item-1');
        //cek kesiapan ajax
        ajax.onreadystatechange = function(){
            if( ajax.readyState == 4 && ajax.status == 200){
                user.innerHTML = ajax.responseText ;
            }
        }
    
                // jalankan ajaxnya
        ajax.open('GET', '../ajax/user.php' , 'true') ;
        ajax.send() ;
                                
        }
    }

