// abre o popup


const allCookies = document.cookie.split(';');
// allCookies.forEach(function (element) {
//     const separated = element.split('=');
//     if (separated[0] !== ' screenmode') {
//         document.cookie = 'screenmode=dark__mode';
//         return;
//     }
// })
// // console.log(document.cookie.split(';'));

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

const popup = document.querySelector('.container .newTransaction__popup');
const popupFormInput = document.querySelectorAll('.newTransaction__popup form input');
const popupTitle = document.querySelector('.newTransaction__popup p.popup__title');
const popupInputRadioLabel = document.querySelectorAll('.newTransaction__popup .transaction__type label');

const modeIcon = document.querySelector('.screen__mode img');

screenModeButton.addEventListener('click', (e) => {
    screenModeButton.classList.toggle('dark__mode');
    if (document.cookie.indexOf('screenmode') < 0 && screenModeButton.classList.contains('dark__mode')) {
        document.cookie = "screenmode=light__mode";
        document.location = '';

    } else {
        document.cookie = "screenmode=dark__mode";
        headerNav.classList.add('dark__mode');
        main.classList.add('dark__mode');
        inputData.classList.add('dark__mode');
        outputData.classList.add('dark__mode');
        transactionsList.forEach(function (element) {
            element.classList.add('dark__mode');
        });
        logo.classList.add('dark__mode');

        popup.classList.add('dark__mode');
        popupFormInput.forEach(function (element) {
            element.classList.add('dark__mode')
        });
        popupTitle.classList.add('dark__mode');
        popupInputRadioLabel.forEach(function (element) {
            element.classList.add('dark__mode');
        })

        modeIcon.classList.add('dark__mode');
        if (modeIcon.classList.contains('dark__mode')){
            modeIcon.setAttribute('src', './assets/icons/sun-bold.svg');
        } else {
            modeIcon.setAttribute('src', './assets/icons/moon-bold.svg');
        }
    }



})




