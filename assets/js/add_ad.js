let addAdForm = document.getElementById('addAdForm');
let addAd = document.getElementById('addAd');
let editAd = document.getElementById('editAd');
let adPicture = document.getElementById('adPicture');
let category = document.getElementById('category');
let subCategory = document.getElementById('subCategory');
let addFormWrap = document.getElementById('addFormWrap');
let showFormWrap = document.getElementById('showFormWrap');
let productList = document.getElementById('productList');
let imagePrew = document.getElementById('imagePrew');
let adId = document.getElementById('adId');
let jsProdInput = document.querySelectorAll('.jsProdInput');
let formErrors = document.querySelectorAll('.jsAdFormErrors');
let adFormSpiner = document.getElementById('adId');
let show = false;
let adSubmit = false;
let listIndex;
const axios = require('axios');
import { deleteAdds } from "./delete_ad.js";

if (addAdForm) {

    //////////////ADD AD////////////////
    showFormWrap.addEventListener('click', (e) => {
        toggleForm()

    });

    function toggleForm() {

        if (!show) {
            show = true;
            addFormWrap.style.maxHeight = addFormWrap.firstElementChild.clientHeight + 'px';
            showFormWrap.innerText = "Sakri Formu";
        } else {
            show = false;
            addFormWrap.style.maxHeight = '0px';
            showFormWrap.innerText = "Dodaj Oglas";
            addAd.classList.remove('d-none');
            editAd.classList.add('d-none');
            imagePrew.classList.add('d-none');
            adFormSpiner.classList.remove('d-none');
            addAdForm.reset();
            getCategory();

        }
    }

    jsProdInput.forEach((item, index) => {
        item.addEventListener("focusout", () => {
            if (item.value === "") {
                item.previousElementSibling.classList.remove('focus');
                item.nextElementSibling.classList.remove('focus');
            }
        });
    })

    jsProdInput.forEach((item, index) => {
        item.addEventListener("focus", () => {
            formErrors[index].classList.add('d-none');
            item.previousElementSibling.classList.remove('error');
            item.nextElementSibling.classList.remove('error');
            item.previousElementSibling.classList.add('focus');
            item.nextElementSibling.classList.add('focus');

        });
    });

    function validation() {
        let error = false;
        jsProdInput.forEach((item, index) => {
            if (item.name === 'name' && item.value === '') {
                item.previousElementSibling.classList.add('error');
                item.nextElementSibling.classList.add('error');
                formErrors[index].classList.remove('d-none');
                error = true;
            } else if (item.name === 'price' && item.value === '') {
                item.previousElementSibling.classList.add('error');
                item.nextElementSibling.classList.add('error');
                formErrors[index].classList.remove('d-none');
                error = true;

            } else if (item.name === 'category' && item.value === '') {

                item.previousElementSibling.classList.add('error');
                item.nextElementSibling.classList.add('error');
                formErrors[index].classList.remove('d-none');
                error = true;

            } else if (item.name === 'sub_category' && item.value === '') {

                item.previousElementSibling.classList.add('error');
                item.nextElementSibling.classList.add('error');
                formErrors[index].classList.remove('d-none');
                error = true;
            } else if (item.name === 'picture' && item.value === '') {

                item.previousElementSibling.classList.add('error');
                item.nextElementSibling.classList.add('error');
                formErrors[index].classList.remove('d-none');
                error = true;
            }
        })
        return error;
    }

    function validationResponse(data) {

        jsProdInput.forEach((item, index) => {
            if (item.name === 'name' && data.name) {
                item.previousElementSibling.classList.add('error');
                item.nextElementSibling.classList.add('error');
                formErrors[index].classList.remove('d-none');

            } else if (item.name === 'picture' && data.image) {

                formErrors[index].classList.remove('d-none');


            } else if (item.name === 'price' && data.price) {

                item.previousElementSibling.classList.add('error');
                item.nextElementSibling.classList.add('error');
                formErrors[index].classList.remove('d-none');

            }
        })
    }

    addAd.addEventListener('click', (e) => {

        e.preventDefault();
        let formData = new FormData(addAdForm);

        if (!validation() && !adSubmit) {

            adSubmit = true;

            adFormSpiner.classList.remove('d-none');

            axios.post('/?rest_route=/add_ad/ad/', formData)
                .then((response) => {

                    if (!response.data.error) {

                        productList.insertAdjacentHTML('afterbegin', itemHtml(response.data));

                        addAdForm.reset();
                        addFormWrap.style.maxHeight = '0px';
                        showFormWrap.innerText = "Dodaj Oglas";

                        toster.classList.add('open');
                        tosterMsg.innerText = 'Oglas uspešno dodat!';


                        setTimeout(() => {
                            toster.classList.remove('open');
                            tosterMsg.innerText = '';
                        }, 3000);



                    } else {
                        validationResponse(response.data);
                    }
                    adFormSpiner.classList.add('d-none');
                    deleteAdds();
                    editItem();
                    adSubmit = false;
                })
                .catch((error) => {
                    adSubmit = false;
                });


        } else {
            validation();
        }

    });

    function itemHtml(item) {
        return `<div class="product__item jsProductItem">
                                <div class="product__icon-wrap">
                                      <span class="jsEditOpen"  data-id="${item.id}">
                                          <i class="far fa-edit"></i>
                                        </span>
                                    <span id="delete" class="jsDeleteOpen" data-id="${item.id}">
                                        <i class="fas fa-trash"></i></span>
                                </div>
                                <div class="product__body">
                                    <a href="${item.link}">
                                        <figure>
                                            <img src="${item.img}"
                                                  " alt="">
                                        </figure>
                                    </a>
                                </div>
                                <div class="product__footer">
                                    <a href="${item.link}">
                                        <h3>
                                            ${item.name}
                                        </h3>
                                    </a>
                                    <div class="price">
                                       ${item.price} din</div>
                                </div>
                            </div>`;
    }

    adPicture.addEventListener('change', (e) => {
        let file = e.target.files[0];
        let reader = new FileReader();
        reader.addEventListener('load', (e) => {
            imagePrew.src = reader.result;
            imagePrew.classList.remove('d-none');
        }, false)
        reader.readAsDataURL(file)


    });



    category.addEventListener('change', () => {
        getCategory();
    })

    function getCategory() {

        axios.get(`/?rest_route=/get_cat/ad/${category.value}`)
            .then((response) => {
                subCategory.parentElement.classList.remove('d-none');
                categoryHtml(response.data)
            });
    }

    getCategory();

    function categoryHtml(categories) {
        let html = ''

        categories.forEach((item) => {

            html += `<option value="${item.term_id}">
                    ${item.name}
                    </option>`;
        });

        subCategory.innerHTML = html;

    }



    //////////////EDIT AD////////////////

    function editItem() {

        let edit = document.querySelectorAll('.jsEditOpen');

        edit.forEach((item, index) => {

            item.addEventListener('click', () => {
                let id = item.getAttribute('data-id');

                axios.get(`/?rest_route=/get_ad/ad/${id}`)
                    .then((response) => {
                        adId.value = id;
                        listIndex = index;
                        setForm(response.data)


                    });

            });
        });

        function setForm($data) {
            show = true;
            addAdForm.elements['name'].value = decodeURI($data['name']);
            addAdForm.elements['price'].value = $data['price'];
            addAdForm.elements['condition'].value = $data['condition'];
            addAdForm.elements['description'].value = $data['description'];
            addAdForm.elements['name'].value = $data['name'];
            addAdForm.elements['category'].value = $data['category']['term_id'];
            categoryHtml($data['sub_categories'])
            addAdForm.elements['sub_category'].value = $data['sub_category']['term_id'];;
            adPicture.previousElementSibling.src = $data['img'];
            addAd.classList.add('d-none');
            editAd.classList.remove('d-none');
            show = false;
            imagePrew.classList.remove('d-none');
            jsProdInput.forEach((item, index) => {
                formErrors[index].classList.add('d-none');
                item.previousElementSibling.classList.remove('error');
                item.nextElementSibling.classList.remove('error');
                item.previousElementSibling.classList.add('focus');
                item.nextElementSibling.classList.add('focus');


            });
            toggleForm();


        }

        function editListItem(data) {
            let item = productList.children[listIndex];
            let body = item.children[1];
            let footer = item.children[2];
            let bodyHTML = `<a href="$data.link}">
                                <figure>
                                    <img src="${data.img}"
                                          " alt="">
                                </figure>
                            </a>`;
            let footerHTML = `<a href="${data.link}">
                                <h3>
                                    ${data.name}
                                </h3>
                            </a>
                            <div class="price">
                          ${data.price} din</div>`;

            body.innerHTML = bodyHTML;
            footer.innerHTML = footerHTML;

        }

        editAd.addEventListener('click', (e) => {

            e.preventDefault();
            let formData = new FormData(addAdForm);
         //  if (!validation() && !adSubmit) {

                adSubmit = true;

                adFormSpiner.classList.remove('d-none');

                adFormSpiner.classList.remove('d-none');

                axios.post('/?rest_route=/edit_ad/ad/', formData)
                    .then((response) => {

                        if (!response.data.error) {

                            editListItem(response.data);
                            toggleForm();
                            toster.classList.add('open');
                            tosterMsg.innerText = 'Oglas uspešno editovan!';


                            setTimeout(() => {
                                toster.classList.remove('open');
                                tosterMsg.innerText = '';
                            }, 3000);

                        } else {
                            validationResponse(response.data);
                        }
                        adFormSpiner.classList.add('d-none');
                         adSubmit = false;
                    })
                    .catch((error)=>{
                        adSubmit = false;
                    })
           // } else {
              //  validation();
           // }

        });
    }

    editItem();
}