<?php
//Conexão
require_once 'BD/db_connect.php';

// Header
require_once 'includes/mesage.php';
include_once 'includes/header.php';


// LOGIN
if (isset($_POST['btn-entrar'])) {
    $erros = array();
    $usuario = mysqli_escape_string($connect, $_POST['usuario']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);

    if (empty($usuario) or empty($senha)) {
        $erros[] = "<li> O campo usuario/senha precisa ser preenchido </li>";
    } else {
        $sql = "SELECT usuario FROM cliente WHERE usuario = '$usuario' ";
        $resultado = mysqli_query($connect, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            // $senha = md5($senha);
            $sql = "SELECT * FROM cliente WHERE usuario = '$usuario' AND senha = '$senha' ";
            $resultado = mysqli_query($connect, $sql);

            if (mysqli_num_rows($resultado) == 1) {
                $dados = mysqli_fetch_array($resultado); // Vai converter o $resultado em um array e atribuir a variavel $dados
                mysqli_close($connect);
                $_SESSION['logado'] = true;
                $_SESSION['id_cliente'] = $dados['id_cliente'];
                header('Location: home.php');
            } else {
                $erros[] = "<li> Usuário e senha não conferem </li>";
            }
        } else {
            $erros[] = "<li> Usuários inexistente </li>";
        }
    }
}
?>


<!--CSS do Index-->
<link rel="stylesheet" type="text/css" href="css/index.css">

<!--Tela de Login e criar conta-->
<div class="card-panel #292929 grey darken-3">

    <div class="row">
        <div class="col s12 m6 push-m3">
            <img class="materialboxed" width="650" src="images/goflix_logo.png">

            <?php
            if (!empty($erros)) {
                foreach ($erros as $erro) {
                    echo $erro;
                }
            }
            ?>

            <hr>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="white-text">
                Usuario: <input type="text" name="usuario"><br>
                Senha: <input type="password" name="senha"><br>
                <button type="submit" name="btn-entrar" class="col s12 waves-effect waves-light btn-large #0d47a1 blue darken-3">Entrar</button>

                <br><br><br><br>
                <h5>Caso não tenha cadastro <a href="cadastro.php" name="btn-cadastrar">Clique Aqui</a></h5>
            </form>

        </div>
    </div>

</div>


<?php include_once 'includes/footer.php'; ?>