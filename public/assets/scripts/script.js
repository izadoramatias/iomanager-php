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

// previne duplo clique ao adicionar uma nova transação
function buttonIsClickedOnlyOnce() {

    const descriptionInput = document.querySelector("#description").value;
    const priceInput = document.querySelector("#price").value;
    const categoryInput = document.querySelector("#category").value;
    const dateInput = document.querySelector("#date").value;
    const inputRadio = document.querySelector("#input").checked;
    const outputRadio = document.querySelector("#output").checked;

    if ((descriptionInput !== '') && (priceInput !== '') && (categoryInput !== '') && (dateInput !== '') && (inputRadio || outputRadio)) {
        const button = document.querySelector('.newTransaction__popup form button');
        button.addEventListener('click', (e) => {
            e.preventDefault()
        });

        button.addEventListener('submit', (e) => {
            e.stopPropagation()
        })
    }
}

// toggle dark/light mode
const screenModeButton = document.querySelector(".screen__mode");
const headerNav = document.querySelector('.content nav');
const main = document.querySelector('.content main');
const inputData = document.querySelector('.content nav .input__data');
const outputData = document.querySelector('.content nav .output__data');
const transactionsList = document.querySelectorAll('main section');
const logo = document.querySelector('nav header .logo')
const modeIcon = document.querySelector('.screen__mode img');

const popup = document.querySelector('.container .newTransaction__popup');
const popupFormInput = document.querySelectorAll('.newTransaction__popup form input');
const popupTitle = document.querySelector('.newTransaction__popup p.popup__title');
const popupInputRadioLabel = document.querySelectorAll('.newTransaction__popup .transaction__type label');

screenModeButton.addEventListener('click', (e) => {
    screenModeButton.classList.toggle('dark__mode');
    headerNav.classList.toggle('dark__mode');
    main.classList.toggle('dark__mode');
    inputData.classList.toggle('dark__mode');
    outputData.classList.toggle('dark__mode');
    transactionsList.forEach(function (element) {
        element.classList.toggle('dark__mode');
    });
    logo.classList.toggle('dark__mode');

    popup.classList.toggle('dark__mode');
    popupFormInput.forEach(function (element) {
        element.classList.toggle('dark__mode')
    });
    popupTitle.classList.toggle('dark__mode');
    popupInputRadioLabel.forEach(function (element) {
        element.classList.toggle('dark__mode');
    })

    modeIcon.classList.toggle('dark__mode');
    if (modeIcon.classList.contains('dark__mode')){
        modeIcon.setAttribute('src', './assets/icons/moon-bold.svg');
    } else {
        modeIcon.setAttribute('src', './assets/icons/sun-bold.svg');
    }



})




