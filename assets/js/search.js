 let searchInput = document.getElementById('search');
 let searchWrap = document.getElementById('searchResults');
 let searchSpiner = document.getElementById('searchSpiner');
 let checking = 0;
 const axios = require('axios');


 searchInput.addEventListener("focus", () => {

     searchInput.nextElementSibling.classList.add('focus')
 });

 searchInput.addEventListener("focusout", () => {

     searchInput.nextElementSibling.classList.remove('focus')
 });

 searchInput.addEventListener('keyup', (e) => {    
     searchSpiner.classList.remove('d-none');
     getSearch(searchInput.value);
 });

 document.body.addEventListener('click', (e)=>{
   
    if(e.targert !== searchWrap || e.targert !== searchInput){
        searchWrap.classList.add('d-none');
        searchInput.value = '';
    }
 });

 function getSearch(value){

     if (checking) {

         clearTimeout(checking);

     }

     let html = '';

     checking = setTimeout(function() {

         if (value !== '') {

             axios.get(`/?rest_route=/get/ad_search/${value}`)
                 .then((response) => {
                      console.log()
                     if (response.data.posts.length === 0) {

                         searchWrap.innerHTML = '<h4>Nema Rezultata</h4>';	                       
                     } else {

                         response.data.posts.forEach((item) => {

                             html += `<a href="${item.url}">${item.title}</a>`;

                         })
                         searchWrap.innerHTML = html;
                     }
                     searchWrap.classList.remove('d-none');
                     searchSpiner.classList.add('d-none');

                 })


             checking = false;
         } else {
             searchWrap.classList.add('d-none');
             searchSpiner.classList.add('d-none');
             searchWrap.innerHTML = '';
         }
     }, 400);

 };