var refreshUsers = setInterval(refreshList,1000); 
function refreshList() {
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("GET","usersList.php",true);
    xhr.onload =()=>{ 
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                $("#usersList").html(xhr.response);
            }
        }
    }
    xhr.send();
}