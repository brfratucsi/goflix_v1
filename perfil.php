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

$sql = "SELECT c.id_cliente, c.usuario, c.email, a.id_assinatura, a.stream_assinatura
from cliente as c left outer join assinatura as a 
on c.id_assinatura = a.id_assinatura
where c.id_cliente = '$id'; ";

$resultado =  mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);
?>



<!-- Dados do perfil -->
<div class="row">
    <div class="col s12 m6 push-m3">
        <h1> <?php echo $dados['usuario']; ?> </h1>

        <ul class="collapsible">
            <li>
                <div class="collapsible-header">
                    <i class="material-icons">person_pin</i>
                    <?php echo $dados['id_cliente']; ?>
                </div>
            </li>

            <li>
                <div class="collapsible-header">
                    <i class="material-icons">email</i>
                    <?php echo $dados['email']; ?>
                </div>
            </li>

            <li>
                <div class="collapsible-header">
                    <i class="material-icons">stars</i>
                    <?php echo $dados['stream_assinatura']; ?>
                </div>
            </li>
        </ul>

        <a href="home.php" class="btn light-blue">Home</a>
        <a href="BD/logout.php" class="btn red">Sair</a>
    </div>
</div>


<div class="row">
    <div class="col s12 m4 push-m4">
        <h3 class="light"> Seus Favoritos </h3>
        <table class="striped #1565c0 blue darken-3 white-text">
            <thead>
                <tr>
                    <th>Filme:</th>
                    <th>Stream:</th>
                    <th>Remover Favoritos:</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $sql_fav = "SELECT  fa.id_cliente, fa.id_favoritos, f.nome, a.stream_assinatura
                from assinatura a join filme f 
                on a.id_assinatura = f.id_assinatura 
                join favoritos fa
                on fa.id_filme = f.id_filme 
                where fa.id_cliente = '$id' order by f.nome;";

                $resultado_fav = mysqli_query($connect, $sql_fav);

                if (mysqli_num_rows($resultado_fav) > 0) {
                    while ($fav = mysqli_fetch_array($resultado_fav)) :
                ?>
                        <tr>
                            <td><?php echo $fav['nome']; ?></td>
                            <td><?php echo $fav['stream_assinatura']; ?></td>
                            <td>
                                <form action="BD/delete.php" method="POST">
                                    <input type="hidden" name="id_favoritos" value="<?php echo $fav['id_favoritos']; ?>">
                                    <button name="del_fav" type="submit" class="material-icons btn-floating red">remove_circle</button>
                                </form>
                            </td>

                        </tr>
                    <?php endwhile; ?>


                <?php
                    mysqli_close($connect);
                }
                ?>

            </tbody>
        </table>


    </div>
</div>

<?php include_once 'includes/footer.php'; ?>