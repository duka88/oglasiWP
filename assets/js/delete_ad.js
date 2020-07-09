
 export function  deleteAdds() {
        const axios = require('axios');
        let deletePopup = document.getElementById('deletePopup');
        let deleteId = document.getElementById('deleteId');
        let deleteBtn = document.getElementById('deleteBtn');
        let cancelBtn = document.getElementById('cancelBtn');
        let deleteOpen = document.querySelectorAll('.jsDeleteOpen');
        let jsProductItem = document.querySelectorAll('.jsProductItem ');
        let deletedItem;

        if (deleteOpen.length > 0) {

            deleteOpen.forEach((item, index) => {

                item.addEventListener('click', () => {
                    deletedItem = jsProductItem[index];
                    deleteId.value = item.getAttribute('data-id');
                    deletePopup.classList.add('open');
                    bodyOverlay.classList.add('popup-overlay');
                });
            });

            cancelBtn.addEventListener('click', () => {
                deleteId.value = "";
                deletePopup.classList.remove('open');
                bodyOverlay.classList.remove('popup-overlay');
            });

            deleteBtn.addEventListener('click', () => {

                axios.post(`/?rest_route=/delete_ad/ad/${deleteId.value}`)
                    .then((response) => {
                        deletedItem.parentNode.removeChild(deletedItem);
                        deleteId.value = "";
                        deletePopup.classList.remove('open');
                        bodyOverlay.classList.remove('popup-overlay');
                        toster.classList.add('open');
                        tosterMsg.innerText = 'Oglas uspešno obrisan!';

                        setTimeout(() => {
                            toster.classList.remove('open');
                            tosterMsg.innerText = '';
                        }, 3000);


                    });
            })

        }
    }

deleteAdds();