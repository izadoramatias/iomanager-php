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

        <!-- phosphor icons script -->
        <script src="https://unpkg.com/phosphor-icons"></script>

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
                        <div class="action__buttons">
                            <div class="new__transaction">
                                <button id="newTransaction">
                                    Nova transação
                                </button>
                            </div>
                            <div class="clean__transactions">
                                <button id="cleanTransactions">
                                    Limpar transações
                                </button>
                            </div>
                        </div>

                    </header>
                    <div class="io__data">
                        <section class="input__data">
                            <header>
                                <p>
                                    <span class="io__description">Entradas</span>
                                    <span class="io__icon">
                                        <i class="ph-arrow-circle-up"></i>
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
                                        <i class="ph-arrow-circle-down"></i>
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
                                        <i class="ph-currency-dollar"></i>
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
                                    <p class="<?= $type ? 'price__input' : 'price__output'; ?>" >R$ <?php echo number_format($price, 2, ',', '.'); ?></p>
                                    <p class="category"><?php echo $category; ?></p>
                                    <p class="date"><?php echo str_replace('-', '/', $date); ?></p>
                                </section>
                            <?php endforeach;
                        } else {
                            echo 'Nenhuma transação cadastrada   ):';
                        } ?>

                </main>
            </div>

            <div class="newTransaction__popup">
                <div class="header__popup">
                    <p class="popup__title">Nova Transação</p>
                    <span>
                        <i class="ph-x-bold close__popup"></i>
                    </span>
                </div>


                <form method="post" action="/new-transaction">
                    <input type="text" name="description" id="description" placeholder="Descrição" required>
                    <input step="any" type="number" name="price" id="price" placeholder="Preço" required>
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

            <div class="confirm__clean__transactions">
                <header>
                    <h1>Tem certeza que deseja remover todas as transações?</h1>
                    <p class="alert__message">Essa ação não poderá ser desfeita!</p>
                </header>

                <div class="action__buttons">
                    <button class="confirm">
                        <a href="/clean-transactions">Sim, limpar!</a>
                    </button>
                    <button class="cancel">
                        <a href="/home">Cancelar</a>
                    </button>
                </div>
            </div>

        </div>

        <script src="./assets/scripts/script.js"></script>

    </body>
</html>