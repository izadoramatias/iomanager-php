// abre o popup
let newTransactionButton = document.querySelector('#newTransaction');
let newTransactionPopUp = document.querySelector('.newTransaction__popup');

let cleanTransactionsButton = document.querySelector('#cleanTransactions');
let cleanTransactionsPopUp = document.querySelector('.confirm__clean__transactions');
let contentClass = document.querySelector('.content');

// abre os popups de nova transação e limpar transações
newTransactionButton.addEventListener('click', (e) => {

    contentClass.classList.add('popup-open');
    newTransactionPopUp.classList.add('popup-open')
});

cleanTransactionsButton.addEventListener('click', (e) => {

    contentClass.classList.add('popup-open');
    cleanTransactionsPopUp.classList.add('popup-open');
})

// fecha os popups de nova transação e limpar transações
let buttonClosePopup = document.querySelector('.newTransaction__popup .close__popup');
buttonClosePopup.addEventListener('click', (e) => {
    contentClass.classList.remove('popup-open');
    newTransactionPopUp.classList.remove('popup-open');
})

function buttonIsClickedOnlyOnce() {
    const button = document.querySelector('.newTransaction__popup form button');
    button.addEventListener('click', (e) => {
        e.preventDefault()
    });

    button.addEventListener('submit', (e) => {
        e.stopPropagation()
    })
}

