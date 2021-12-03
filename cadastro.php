<?php

// Header
include_once 'includes/header.php';
include_once 'includes/mesage.php';
?>




<div class="row">
    <div class="col s12 m6 push-m3">
        <h3 class="light"> Novo Usuario </h3>

        <form action="BD/create.php" method="POST">
            <div class="input-field col s12">
                <input type="text" name="usuario" id="usuario">
                <label for="usuario">Usuario</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="email" id="email">
                <label for="email">Email</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="senha" id="senha">
                <label for="senha">Senha</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="id_assinatura" id="id_assinatura">
                <label for="id_assinatura">Stream Preferida</label>
            </div>

            <button type="submit" name="btn-cadastrar" class="btn blue"> Cadastrar </button>
            <a href="index.php" class="btn grey"> Voltar </a>
        </form>


    </div>
</div>

<?php
include_once 'includes/footer.php';
?>