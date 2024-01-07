var msgTimer = setInterval(refreshMsg,1000); 

function refreshMsg() {
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("GET","message.php?<?php echo $_SERVER['QUERY_STRING']; ?>",true);
    xhr.onload =()=>{ 
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                $("#msg").html(xhr.response);
            }
        }
    }
    xhr.send();

}