//  const form = document.querySelector(".wrapper form"),
//  continueBtn = form.querySelector("button");

//  form.onsubmit =(e)=>{
//      e.preventDefault();
//  }

//  continueBtn.onclick =()=>{
//      let xhr = new XMLHttpRequest(); //creating XML object
//      xhr.open("POST","cnx.php",true);
//      xhr.onload =()=>{ 
//         if(xhr.readyState === XMLHttpRequest.DONE){
//             if(xhr.status === 200){
//                 let data = xhr.response;
//                 console.log(data);
//             }
//         }
//      }
//      let formData = new FormData(form);//creating new formData object
//      xhr.send(formData);
//  }
