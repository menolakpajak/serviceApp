var info1 = document.getElementById('info1')
var info2 = document.getElementById('info2')
var info3 = document.getElementById('info3')
var info4 = document.getElementById('info4')
var info5 = document.getElementById('info5')
var info6 = document.getElementById('info6')
var info7 = document.getElementById('info7')
var info8 = document.getElementById('info8')




function popUp(text){
    Swal.fire({
        icon: 'info',
        text: text,
        confirmButtonText: "OK",
    })
}


info1.addEventListener('click', function(){
    var x = document.getElementById('check_kamera_info').value
            if(x != '------'){
            popUp(x);
        }
})
info2.addEventListener('click', function(){
    var x = document.getElementById('check_lensa_info').value
            if(x != '------'){
                popUp(x);
            }
})
info3.addEventListener('click', function(){
    var x = document.getElementById('check_battery_info').value
            if(x != '------'){
                popUp(x);
            }
})
info4.addEventListener('click', function(){
    var x = document.getElementById('check_memory_info').value
            if(x != '------'){
                popUp(x);
            }
})
info5.addEventListener('click', function(){
    var x = document.getElementById('check_strap_info').value
            if(x != '------'){
                popUp(x);
            }
})
info6.addEventListener('click', function(){
    var x = document.getElementById('check_bodycap_info').value
            if(x != '------'){
                popUp(x);
            }
})
info7.addEventListener('click', function(){
    var x = document.getElementById('check_lenscap_info').value
            if(x != '------'){
                popUp(x);
            }
})
info8.addEventListener('click', function(){
    var x = document.getElementById('check_filter_info').value
            if(x != '------'){
                popUp(x);
            }
})
