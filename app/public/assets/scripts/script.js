// abre o popup
let newTransactionButton = document.querySelector('#newTransaction');
let newTransactionPopUp = document.querySelector('.newTransaction__popup');
let contentClass = document.querySelector('.content');

newTransactionButton.addEventListener('click', (e) => {

    contentClass.classList.add('popup-open');
    newTransactionPopUp.classList.add('popup-open')

});

// fecha o popup
let buttonClosePopup = document.querySelector('.newTransaction__popup .close__popup');
buttonClosePopup.addEventListener('click', (e) => {
    contentClass.classList.remove('popup-open');
    newTransactionPopUp.classList.remove('popup-open');
})

