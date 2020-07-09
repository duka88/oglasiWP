let loginOpen = document.getElementById('login');
let loginModal = document.getElementById('loginModal');
let loginModalClose = document.getElementById('loginModalClose');
let borderBlack = document.querySelectorAll('.border-black');
let inputs = document.querySelectorAll('.jsInput');
let inputsReg = document.querySelectorAll('.jsInputReg');
let bodyOverlay = document.getElementById('bodyOverlay');
let loginForm = document.getElementById('loginForm');
let registerForm = document.getElementById('registerForm');
let activLogin = document.getElementById('activLogin');
let activRegister = document.getElementById('activRegister');
let logInSubmit = document.getElementById('logiInSubmit');
let logInFormVal = document.getElementById('logInFormVal');
let registerFormVal = document.getElementById('registerFormVal');
let registerFormSubmit = document.getElementById('registerFormSubmit');
let contactMesLog = document.getElementById('contactMesLog');
let contactMesReg = document.getElementById('contactMesReg');
let buttons = document.getElementById('buttons');
let formSpiner = document.getElementById('formSpiner');
let contactMessage = document.getElementById('contactMessage');
let formErrors = document.querySelectorAll('.jsFormErrors');
const axios = require('axios');

if (loginOpen) {

    loginOpen.addEventListener('click', () => {
        loginModal.classList.add('open');
        bodyOverlay.classList.add('popup-overlay');
    });

    loginModalClose.addEventListener('click', () => {
        loginModal.classList.remove('open');
        bodyOverlay.classList.remove('popup-overlay');
        contactMesLog.classList.add('d-none');
        contactMesReg.classList.add('d-none');
        buttons.classList.remove('d-none');
        formSpiner.classList.add('d-none');

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

    inputsReg.forEach((item, index) => {
        item.addEventListener("focus", () => {
            formErrors[index].classList.add('d-none');
            item.previousElementSibling.classList.remove('error')
            item.nextElementSibling.classList.remove('error')
            item.previousElementSibling.classList.add('focus')
            item.nextElementSibling.classList.add('focus')
            

        });
    })

    inputsReg.forEach((item, index) => {
        item.addEventListener("focusout", () => {
            if (item.value === "") {
                item.previousElementSibling.classList.remove('focus')
                item.nextElementSibling.classList.remove('focus')
            }
        });
    })


    logInSubmit.addEventListener('click', (e) => {
        e.preventDefault();


        let email = logInFormVal.elements['name'].value;
        let password = logInFormVal.elements['password'].value;

   

        buttons.classList.add('d-none');
        formSpiner.classList.remove('d-none');


        axios.post('/?rest_route=/login_in/ad/', {
                'email': email,
                'password': password

            })
            .then((response) => {

                if (response.data['status'] === 'error') {
                    contactMesLog.classList.remove('d-none');
                    buttons.classList.remove('d-none');
                    formSpiner.classList.add('d-none');
                } else {
                    window.location.reload();
                }

            })
         

    });

    registerFormSubmit.addEventListener('click', (e) => {
        e.preventDefault();

        let formData = new FormData(registerFormVal);


        if (!validation()) {

        buttons.classList.add('d-none');
        formSpiner.classList.remove('d-none');


        axios.post('/?rest_route=/register/ad/', formData)
            .then((response) => {

                if (response.data['error']) {
                    validationResponse(response.data)
                } else {
                    window.location.reload();
                    buttons.classList.remove('d-none');
                    formSpiner.classList.add('d-none');
                }

            })
            .catch((error) => {
                console.log(error)
            })
       }

    });

    function validationResponse(data) {

        inputsReg.forEach((item, index) => {
            if (item.name === 'name' && data.name) {
                item.previousElementSibling.classList.add('error');
                item.nextElementSibling.classList.add('error');
                formErrors[index].innerText = data.name;
                formErrors[index].classList.remove('d-none');

            } else if (item.name === 'email' && data.email) {

                item.previousElementSibling.classList.add('error');
                item.nextElementSibling.classList.add('error');
                formErrors[index].innerText = data.email;
                formErrors[index].classList.remove('d-none');


            } else if (item.name === 'city' && data.city) {

                item.previousElementSibling.classList.add('error');
                item.nextElementSibling.classList.add('error');
                formErrors[index].innerText = data.city;
                formErrors[index].classList.remove('d-none');

            } else if (item.name === 'password' && data.password) {

                item.previousElementSibling.classList.add('error');
                item.nextElementSibling.classList.add('error');
                formErrors[index].innerText = data.password;
                formErrors[index].classList.remove('d-none');

            }
        })

    }

    function validation() {
        let error = false;
        inputsReg.forEach((item, index) => {
            if (item.name === 'name' && item.value === '') {
                item.previousElementSibling.classList.add('error');
                item.nextElementSibling.classList.add('error');
                formErrors[index].classList.remove('d-none');
                error = true;
            } else if (item.name === 'email') {
                if (item.value === '') {

                    item.previousElementSibling.classList.add('error');
                    item.nextElementSibling.classList.add('error');
                    formErrors[index].classList.remove('d-none');
                    error = true;
                } else if (!validateEmail(item.value)) {
                    item.previousElementSibling.classList.add('error');
                    item.nextElementSibling.classList.add('error');
                    formErrors[index].innerText = "Mejl nije validan!";
                    formErrors[index].classList.remove('d-none');
                    error = true;
                }

            } else if (item.name === 'city' && item.value === '') {

                item.previousElementSibling.classList.add('error');
                item.nextElementSibling.classList.add('error');
                formErrors[index].classList.remove('d-none');
                error = true;
            } else if (item.name === 'password' && item.value === '') {

                item.previousElementSibling.classList.add('error');
                item.nextElementSibling.classList.add('error');
                formErrors[index].classList.remove('d-none');
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