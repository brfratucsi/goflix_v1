<?php
//Conexão
require_once 'BD/db_connect.php';

// Header
include_once 'includes/header.php';

//Mensagem
session_start();

//Verificação
if (!isset($_SESSION['logado'])) {
    header('Location: index.php');
}


// Dados
$id = $_SESSION['id_cliente'];
$sql = "SELECT * FROM cliente WHERE id_cliente = '$id' ";
$resultado =  mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);


// Pesquisa ao banco de dados
$produtos = "SELECT f.id_filme, f.nome, f.genero, f.ator, a.stream_assinatura
from filme as f left outer join assinatura as a 
on a.id_assinatura = f.id_assinatura ";
if (isset($_GET["produto"])) {
    $nome_produto = $_GET["produto"];
    $produtos .= "WHERE f.nome LIKE '%{$nome_produto}%' ";
}
$resultado_pesquisa = mysqli_query($connect, $produtos);
if (!$resultado_pesquisa) {
    die("Falha na consulta ao banco");
}

?>


<div class="card-panel teal grey darken-3">
    <nav>
        <div class="nav-wrapper">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="get">
                <div class="input-field">
                    <input id="search" type="search" name="produto" required>
                    <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                    <i class="material-icons">close</i>
                </div>
            </form>
        </div>
    </nav>


    <div class="row">
        <div class="col s12 m6 push-m3">
            <h1>Olá <?php echo $dados['usuario']; ?> </h1>
            <a href="perfil.php" class="btn light-blue">Perfil</a>
            <a href="BD/logout.php" class="btn red">Sair</a>
        </div>
    </div>


    <div class="row">
        <div class="col s12 m5 push-m3">
            <h3 class="light"> GoFlix </h3>
            <table class="striped white-text">
                <thead>
                    <tr>
                        <th>Filme:</th>
                        <th>Genero:</th>
                        <th>Ator:</th>
                        <th>Stream:</th>
                        <th>Adicionar Favoritos:</th>
                    </tr>
                </thead>
                <tbody>

                    <?php while ($pesquisa = mysqli_fetch_array($resultado_pesquisa)) : ?>

                        <tr class="#1565c0 blue darken-3">
                            <td><?php echo $pesquisa['nome']; ?></td>
                            <td><?php echo $pesquisa['genero']; ?></td>
                            <td><?php echo $pesquisa['ator']; ?></td>
                            <td><?php echo $pesquisa['stream_assinatura']; ?></td>
                            <td>
                                <form action="BD/add.php" method="POST">
                                    <input type="hidden" name="id_filme" value="<?php echo $pesquisa['id_filme'] ?>">
                                    <button name="add_fav" type="submit" class="material-icons btn-floating orange">star</button>
                                </form>
                            </td>
                        </tr>

                    <?php endwhile; ?>


                    <?php mysqli_close($connect); ?>
                </tbody>
            </table>


        </div>
    </div>

</div>

<?php include_once 'includes/footer.php'; ?>