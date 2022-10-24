<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IOManager</title>

    <link rel="shortcut icon" href="assets/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="style/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

</head>
<body>

    <div class="container">
        <div class="content">

            <nav>
                <header>
                    <div class="logo">
                            <a href="">
                            <img src="assets/logo.svg" alt="Logo IOManager">
                        </a>
                    </div>
                    <div class="new__transaction">
                        <button id="newTransaction">
                            Nova transação
                        </button>
                    </div>
                </header>
                <div class="io__data">
                    <section class="input__data">
                        <header>
                            <p>
                                <span class="io__description">Entradas</span>
                                <span class="io__icon">
                                <img src="assets/input-icon.svg" alt="Input money icon">
                            </span>
                            </p>
                        </header>
                        <div class="input__money">
                            <span>R$</span>
                            <span>16.400,00</span>
                        </div>
                    </section>
                    <section class="output__data">
                        <header>
                            <p>
                                <span class="io__description">Saídas</span>
                                <span class="io__icon">
                                <img src="assets/output-icon.svg" alt="Output money icon">
                            </span>
                            </p>
                        </header>
                        <div class="output__money">
                            <span>R$</span>
                            <span>1.259,00</span>
                        </div>
                    </section>
                    <section class="total__data">
                        <header>
                            <p>
                                <span class="io__description">Total</span>
                                <span class="io__icon">
                                <img src="assets/money-icon.svg" alt="Dollar icon">
                            </span>
                            </p>
                        </header>
                        <div class="total__money">
                            <span>R$</span>
                            <span>15.141,00</span>
                        </div>
                    </section>
                </div>
            </nav>

            <main>
                <section>
                    <p class="description">Desenvolvimento de site</p>
                    <p class="price__input">R$ 12.000,00</p>
                    <p class="category">Venda</p>
                    <p class="date">13/04/2022</p>
                </section>

            </main>

        </div>

        <div class="newTransaction__popup">
            <p class="popup__title">Nova Transação</p>

            <form method="post" action="../Controllers/TransactionController.php">
                <input type="text" name="description" id="description" placeholder="Descrição" required>
                <input type="number" name="price" id="price" placeholder="Preço" required>
                <input type="text" name="category" id="category" placeholder="Categoria" required>

                <button type="submit">Cadastrar</button>
            </form>
        </div>

    </div>

    <script src="script/scripts.js"></script>

</body>
</html>