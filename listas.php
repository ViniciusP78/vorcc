<?php 
    include('php/conexao.php');

    if(!isset($_SESSION['nm_usuario'])){
        header("Location: login.php");
    }

    $query = $conn->prepare("SELECT nm_empresa, vl_pin FROM tb_empresa WHERE cd_empresa = :emp");
    $query->bindValue(":emp", $_SESSION['id_empresa']);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $nm_empresa = $row['nm_empresa'];
        $pin = $row['vl_pin'];
    }

?>
<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <title> Vorcc </title>
        <link rel="stylesheet" type="text/css" href="css/dashboard.css">
        <link rel="stylesheet" href="fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome-all.min.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:500" rel="stylesheet">
    </head>
    <body>
        <?php include('menu.php'); ?>

        <main id="content">
            <header id="content-menu">
                <!-- O PHP EXIBE TEXTOS DIFERENTES DE PARA O CASO DE O USUÁRIO SER UM FORNECEDOR !-->
                <h1> <?php if($_SESSION['bool_fornecedor'] == 0) {echo 'Suas listas';} else{echo 'Todas as listas';} ?></h1>
                <a href="#" class="content-menu-item"> <i class="fas fa-eye"></i> Ver listas </a>
                <?php 
                    if($_SESSION['bool_fornecedor'] == 0){
                        echo '<a href="criarlista.php" class="content-menu-item"> <i class="far fa-plus-square"></i>Adicionar lista </a>';
                    }
                ?>
            </header>
            <table cellspacing="0">
                <tr><td class="table-title">Nome</td><td class="table-title">Itens</td><td class="table-title">Respostas</td></tr>
                <?php
                    $file = ($_SESSION['bool_fornecedor'] == 0) ? 'php/exibir_listas_comprador.php' : 'php/exibir_listas_todas.php';
                    include($file);
                ?>
            </table>
            <br>
        </main>
    </body>
</html>
