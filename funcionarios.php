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
            <h1>Funcionários</h1>
            <table cellspacing="0">
            <tr><td class="table-title">Nome</td><td class="table-title">CPF</td><td class="table-title">Nível de acesso</td></tr>
            <?php
                $query = $conn->prepare("SELECT * FROM tb_usuario WHERE id_empresa = :emp");
                $query->bindValue(":emp", $_SESSION['id_empresa']);
                $query->execute();

                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $acesso = ($row['nr_acesso'] == 0) ? 'Comum' : 'Administrador';

                    echo '<tr><td class="table-cell-dark">'.$row['nm_usuario'].'</td><td class="table-cell-dark">'.$row['nr_cpf'].'</td><td class="table-cell-dark">'.$acesso.'</td></tr>';
                }
            ?>
            </table>
        </main>
    </body>
</html>
