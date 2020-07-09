let check = document.querySelectorAll('.jsCheck');
const axios = require('axios');
let mainCont = document.getElementById('productList');
let nameSort = document.getElementById('nameSort');
let priceSort = document.getElementById('priceSort');
let loadMore = document.getElementById('loadMore');
let citySelect = document.getElementById('citySelect');
let selectWrap = document.getElementById('jsSelect');
let optionsWrap = document.getElementById('optionsWrap');
let optionChildren = [...document.getElementById('optionsWrap').children];

let selected = [];
let name = 'ASC';
let price = null;
let page = 1;
let city = null;

if (check.length > 0) {


    check.forEach((item) => {
        item.addEventListener('click', () => {
            let id = item.getAttribute('data-id');

            if (selected.includes(id)) {
                let index = selected.indexOf(id);
                selected.splice(index, 1);
                item.firstElementChild.classList.add('d-none');

            } else {
                selected.push(id)
                item.firstElementChild.classList.remove('d-none');
            }
            page = 1;
            console.log(page)
            filter(selected, name, price, page, city);

        });
    });

    nameSort.addEventListener('click', () => {

        if (name === 'ASC') {
            name = 'DESC';
            price = null;
            nameSort.lastElementChild.classList.add('active');
            priceSort.lastElementChild.classList.remove('active');
            filter(selected, name, price, page, city);
        } else {
            name = 'ASC';
            price = null;
            nameSort.lastElementChild.classList.remove('active');
            priceSort.lastElementChild.classList.remove('active');
            filter(selected, name, price, page, city);
        }
    });

    priceSort.addEventListener('click', () => {

        if (price === 'ASC') {
            price = 'DESC';
            name = null;
            priceSort.lastElementChild.classList.add('active');
            nameSort.lastElementChild.classList.remove('active');
            filter(selected, name, price, page, city);
        } else {
            price = 'ASC';
            null;
            priceSort.lastElementChild.classList.remove('active');
            nameSort.lastElementChild.classList.remove('active');
            filter(selected, name, price, page, city);
        }
    });

    if (loadMore) {

        loadMore.addEventListener('click', () => {
            page++;
            filter(selected, name, price, page, city);

        });

    }


    function filter(cat, name, price, page, city) {

        axios.post(`/?rest_route=/filter/ad`, {
                cat: cat,
                name: name,
                price: price,
                page: page,
                city: city
            })
            .then((response) => {

                if (page > 1) {
                    mainCont.innerHTML += adListHtml(response.data.posts);
                } else {
                    mainCont.innerHTML = adListHtml(response.data.posts);
                }

                if (loadMore) {
                    if (response.data.pages === page) {
                        loadMore.classList.add('d-none');
                    } else {
                        loadMore.classList.remove('d-none');
                    }
                }

            });
    }

    function adListHtml(ads) {

        let html = '';

        ads.forEach((item) => {

            html += `<div class="product__item jsProductItem">                          
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
        });

        return html;


    }
    citySelect.addEventListener('click', () => {
        optionsWrap.classList.toggle('d-none');
    });

    optionChildren.forEach((item) => {
        item.addEventListener('click', () => {

            console.log(item.innerText)
            citySelect.firstElementChild.innerText = item.innerText;
            optionsWrap.classList.add('d-none');
            city = item.innerText
            filter(selected, name, price, page, city);

        });
    });

    document.body.addEventListener('click', (e) => {
        if (!selectWrap.contains(e.target)) {
            optionsWrap.classList.add('d-none');
        }
    })



}