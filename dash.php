<?php 
    include('php/conexao.php');

    if(!isset($_SESSION['nome'])){
        header("Location: login.php");
    }

    $query = $conn->prepare("SELECT nm_empresa FROM tb_empresa WHERE cd_empresa = :emp");
    $query->bindValue(":emp", $_SESSION['id_empresa']);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $nm_empresa = $row['nm_empresa'];
    }
?>
<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <title> Vorcc </title>
        <link rel="stylesheet" type="text/css" href="css/dashboard.css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Grand+Hotel" rel="stylesheet">
    </head>
    <body>
        <nav id="menu">
            <div id="menu-logo"> <?php echo $nm_empresa ?> </div>
        </nav>

        <main id="content">
            a
        </main>
    </body>
</html>
