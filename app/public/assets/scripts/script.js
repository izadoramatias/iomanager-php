let newTransactionButton = document.querySelector('#newTransaction');
let newTransactionPopUp = document.querySelector('.newTransaction__popup');
let contentClass = document.querySelector('.content');

newTransactionButton.addEventListener('click', (e) => {

    contentClass.classList.add('popup-open');
    newTransactionPopUp.classList.add('popup-open')

});
