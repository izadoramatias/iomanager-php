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
                    <div class="screen__mode">
                        <img src="./assets/icons/sun-bold.svg" alt="sun icon">
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
                    <div class="input__money" id="input__money">
                        <span>R$</span>
                        <span><?= $input; ?></span>
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
                    <div class="output__money" id="output__money">
                        <span>R$</span>
                        <span><?= $output; ?></span>
                    </div>
                </section>
                <section class="total__data <?= $positivity ? 'positive__credit' : 'negative__credit' ?>">
                    <header>
                        <p>
                            <span class="io__description">Total</span>
                            <span class="io__icon">
                                <i class="ph-currency-dollar"></i>
                            </span>
                        </p>
                    </header>
                    <div class="total__money" id="total__money">
                        <span>R$</span>
                        <span><?= $total; ?></span>
                    </div>
                </section>
            </div>
        </nav>
        <main>
            <?php if (isset($_SESSION['message_content'])): ?>
            <div class="alert alert-<?= $_SESSION['message_type']; ?>">
                <?= $_SESSION['message_content']; ?>
            </div>

            <?php
                        unset($_SESSION['message_content'], $_SESSION['message_type']);
                        endif;
                    ?>

            <?= $transactions; ?>
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
                    <input required value="1" class="form-check-input" type="radio" name="type" id="input">
                    <label class="form-check-label" for="input">Entrada</label>
                </div>

                <div role="radio" class="form-check">
                    <input required value="0" class="form-check-input" type="radio" name="type" id="output">
                    <label class="form-check-label" for="output">Saída</label>
                </div>
            </div>

            <button onclick="buttonIsClickedOnlyOnce()" type="submit">Cadastrar</button>
        </form>
    </div>

    <div class="confirm__clean__transactions">
        <header>
            <h1>Tem certeza que deseja remover todas as transações?</h1>
            <p class="alert__message">Essa ação não poderá ser desfeita!</p>
        </header>

        <div class="action__buttons">
            <a class="confirm" href="/clean-transactions">Sim, limpar!</a>
            <a class="cancel" href="/home">Cancelar</a>
        </div>
    </div>
</div>