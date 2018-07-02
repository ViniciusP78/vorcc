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
    </head>
    <body>
        <?php include('menu.php'); ?>

        <main id="content">

        <?php
          if(isset($_POST['submit'])){
            echo $_POST['counter'].'<br>';

            $query = $conn->prepare("INSERT INTO tb_lista VALUES (null, :nm_lista, :usuario, :emp)");
            $query->bindValue(":nm_lista", $_POST['lista']);
            $query->bindValue(":usuario", $_SESSION['cd_usuario']);
            $query->bindValue(":emp", $_SESSION['id_empresa']);
            $query->execute();

            $query = $conn->prepare("SELECT LAST_INSERT_ID();");
            $query->execute();
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $id_lista = $row['LAST_INSERT_ID()'];
                echo $id_lista;
            }

            for($i = 1; $i <= $_POST['counter'];$i++) {
              if( $_POST['item'.$i] != null && $_POST['qtditem'.$i] != null ){
                $query = $conn->prepare("INSERT INTO tb_lista_item VALUES (null, :lista_item, null, :qtd, :lista)");
                $query->bindValue(":lista_item", $_POST['item'.$i]);
                $query->bindValue(":qtd", $_POST['qtditem'.$i]);
                $query->bindValue(":lista", $id_lista);
                $query->execute();
                echo "Enviado<br>";
              } else{
                echo "Campo Nulo<br>";
              }
            }
            header("Location: listas.php");
          }
        ?>


        </main>
    </body>
</html>
