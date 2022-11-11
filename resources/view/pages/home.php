<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>IOManager</title>

        <link rel="shortcut icon" href="./assets/icons/favicon.svg" type="image/x-icon">
        <link rel="stylesheet" href="./assets/css/style.css">

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
                                <img src="./assets/icons/logo.svg" alt="Logo IOManager">
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
                                        <img src="./assets/icons/input-icon.svg" alt="Input money icon">
                                    </span>
                                </p>
                            </header>
                            <div class="input__money">
                                <span>R$</span>
                                <span><?= isset($entrada) ? $entrada : 0; ?></span>
                            </div>
                        </section>
                        <section class="output__data">
                            <header>
                                <p>
                                    <span class="io__description">Saídas</span>
                                    <span class="io__icon">
                                        <img src="./assets/icons/output-icon.svg" alt="Output money icon">
                                    </span>
                                </p>
                            </header>
                            <div class="output__money">
                                <span>R$</span>
                                <span><?= isset($saida) ? $saida : 0; ?></span>
                            </div>
                        </section>
                        <section class="total__data">
                            <header>
                                <p>
                                    <span class="io__description">Total</span>
                                    <span class="io__icon">
                                        <img src="./assets/icons/money-icon.svg" alt="Dollar icon">
                                    </span>
                                </p>
                            </header>
                            <div class="total__money">
                                <span>R$</span>
                                <span><?= isset($total) ? $total : 0; ?></span>
                            </div>
                        </section>
                    </div>
                </nav>

                <main>

                    <?php

                        if (!empty($transacoes)) {
                            foreach ($transacoes as $transacao): extract($transacao, EXTR_OVERWRITE)?>
                                <section>
                                    <p class="description"><?php echo $description; ?></p>
                                    <p class="price__input" >R$ <?php echo number_format($price, 2); ?></p>
                                    <p class="category"><?php echo $category; ?></p>
                                    <p class="date">13/04/2022</p>
                                </section>
                            <?php endforeach;
                        } else {
                            echo 'Nenhuma transação cadastrada   ):';
                        } ?>

                </main>
            </div>

            <div class="newTransaction__popup">
                <p class="popup__title">Nova Transação</p>
                <form method="post" action="/new-transaction">
                    <input type="text" name="description" id="description" placeholder="Descrição" required>
                    <input type="number" name="price" id="price" placeholder="Preço" required>
                    <input type="text" name="category" id="category" placeholder="Categoria" required>
                    <input type="date" name="date" id="date" placeholder="Data" required>

                    <div class="transaction__type">
                        <div role="radio" class="form-check">
                            <input value="true" class="form-check-input" type="radio" name="type" id="input">
                            <label class="form-check-label" for="input">Entrada</label>
                        </div>

                        <div role="radio" class="form-check">
                            <input value="false" class="form-check-input" type="radio" name="type" id="output">
                            <label class="form-check-label" for="output">Saída</label>
                        </div>
                    </div>

                    <button type="submit">Cadastrar</button>
                </form>
            </div>

        </div>

        <script src="./assets/scripts/script.js"></script>

    </body>
</html>