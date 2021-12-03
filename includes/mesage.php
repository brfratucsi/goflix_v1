<?php
//Sessão
session_start();
if (isset($_SESSION['mensagem'])) { ?>

    <script>
        // Mensagem
        window.onload = function() { // Onload serve pra carregar a função depois que toda a pagina for carregada.
            M.toast({
                html: '<?php echo $_SESSION['mensagem']; ?>'
            })
        };
    </script>

<?php
}
session_unset();
?>