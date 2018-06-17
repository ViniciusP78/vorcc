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
                <h1> Suas listas </h1>
                <a href="#" class="content-menu-item"> <i class="fas fa-eye"></i> Ver listas </a>
                <a href="#" class="content-menu-item"> <i class="far fa-plus-square"></i>Adicionar lista </a>
            </header>
            <table cellspacing="0">
                <tr><td class="table-title">Nome</td><td class="table-title">Itens</td><td class="table-title">Respostas</td></tr>
                <tr><td class="table-cell-dark">Laticíneos</td><td class="table-cell-dark">7</td><td class="table-cell-dark">0</td></tr>
                <tr><td class="table-cell">Roupas tamanho G</td><td class="table-cell">11</td><td class="table-cell">0</td></tr>
                <tr><td class="table-cell-dark">Brinquedos</td><td class="table-cell-dark">24</td><td class="table-cell-dark">0</td></tr>
            </table>
            <br>
        </main>
    </body>
</html>
