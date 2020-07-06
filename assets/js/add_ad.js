let addAdForm  = document.getElementById('addAdForm');
let addAd = document.getElementById('addAd');
let adPicture = document.getElementById('adPicture');
const axios = require('axios');

if(addAdForm){

    

   addAd.addEventListener('click', (e)=>{
     
     e.preventDefault();
     let formData = new FormData(addAdForm);
     
     axios.post('/?rest_route=/add_ad/ad/', formData)
     .then((response)=>{
            console.log(response)
     });

   })
   
   adPicture.addEventListener('change', (e)=>{
        let file = e.target.files[0];
        let reader = new FileReader();
        reader.addEventListener('load', (e) => {
            adPicture.previousElementSibling.src = reader.result
        }, false)
        reader.readAsDataURL(file)

       
   });

   
}