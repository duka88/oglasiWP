let loginOpen = document.getElementById('login');
let loginModal = document.getElementById('loginModal');
let loginModalClose = document.getElementById('loginModalClose');
let borderBlack = document.querySelectorAll('.border-black');
let inputs = document.querySelectorAll('.jsInput');
let bodyOverlay = document.getElementById('bodyOverlay');
let loginForm = document.getElementById('loginForm');
let registerForm = document.getElementById('registerForm');
let activLogin = document.getElementById('activLogin');
let activRegister = document.getElementById('activRegister');
let logInSubmit = document.getElementById('logiInSubmit');
let logInFormVal = document.getElementById('logInFormVal');
let registerFormVal = document.getElementById('registerFormVal');
let registerFormSubmit = document.getElementById('registerFormSubmit');
let buttons = document.getElementById('buttons');
let formSpiner = document.getElementById('formSpiner');
let contactMessage = document.getElementById('contactMessage');
const axios = require('axios');


if (loginOpen) {

    loginOpen.addEventListener('click', () => {
        loginModal.classList.add('open');
        bodyOverlay.classList.add('popup-overlay');
    });

    loginModalClose.addEventListener('click', () => {
        loginModal.classList.remove('open');
        bodyOverlay.classList.remove('popup-overlay');

        inputs.forEach((item, index) => {
            item.value = "";
            item.previousElementSibling.classList.remove('focus');
            item.nextElementSibling.classList.remove('focus');
        })
    });

    activLogin.addEventListener('click', () => {
        registerForm.classList.add('d-none');
        loginForm.classList.remove('d-none');
    });

    activRegister.addEventListener('click', () => {
        registerForm.classList.remove('d-none');
        loginForm.classList.add('d-none');
    });

    inputs.forEach((item, index) => {
        item.addEventListener("focus", () => {         
            item.previousElementSibling.classList.remove('error')
            item.nextElementSibling.classList.remove('error')
            item.previousElementSibling.classList.add('focus')
            item.nextElementSibling.classList.add('focus')
        });
    })


    inputs.forEach((item, index) => {
        item.addEventListener("focusout", () => {
            if (item.value === "") {
                item.previousElementSibling.classList.remove('focus')
                item.nextElementSibling.classList.remove('focus')
            }
        });
    })




    logInSubmit.addEventListener('click', (e) => {
        e.preventDefault();


        let email = logInFormVal.elements['email'].value;
        let password = logInFormVal.elements['password'].value;

      if (!validation()) {

        buttons.classList.add('d-none');
        formSpiner.classList.remove('d-none');


        axios.post('/?rest_route=/login_in/ad/', {
                'email': email,
                'password': password

            })
            .then((response) => {

                if(response.data['status'] === 'error'){
                	console.log(response.data['message'])
                }else{
                	window.location.reload();
                }
                         
            })
            .catch((error) => {
               console.log(error)
            })
         }

    });

    registerFormSubmit.addEventListener('click', (e) => {
        e.preventDefault();
       

        let name = registerFormVal.elements['name'].value;
        let email = registerFormVal.elements['email'].value;
        let password = registerFormVal.elements['password'].value;

     // if (!validation()) {

        buttons.classList.add('d-none');
        formSpiner.classList.remove('d-none');


        axios.post('/?rest_route=/register/ad/', {
        	    'name' : name,
                'email': email,
                'password': password

            })
            .then((response) => {

                if(response.data['status'] === 'error'){
                	console.log(response.data['message'])
                }else{
                	window.location.reload();
                }
                         
            })
            .catch((error) => {
               console.log(error)
            })
      //   }

    });

    function validation() {
        let error = false;
        inputs.forEach((item, index) => {
            if (item.name === 'name' && item.value === '') {

                item.previousElementSibling.classList.add('error')
                item.nextElementSibling.classList.add('error')
                error = true;
            } else if (item.name === 'email') {
                if (item.value === '') {

                    item.previousElementSibling.classList.add('error')
                    item.nextElementSibling.classList.add('error')
                    error = true;
                } else if (!validateEmail(item.value)) {

                    item.previousElementSibling.classList.add('error')
                    item.nextElementSibling.classList.add('error')
                    error = true;
                }

            } else if (item.name === 'text' && item.value === '') {

                item.previousElementSibling.classList.add('error')
                item.nextElementSibling.classList.add('error')
                error = true;
            }
        })
        return error;
    }

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }




    function resetForm() {
        inputs.forEach((item, index) => {
            item.value = '';

            item.previousElementSibling.classList.remove('error')
            item.nextElementSibling.classList.remove('error')
            item.previousElementSibling.classList.remove('focus')
            item.nextElementSibling.classList.remove('focus')

        })
    }

}