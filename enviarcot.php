<?php
    include('php/conexao.php');

    if(!isset($_SESSION['nm_usuario'])){
        header("Location: login.php");
    }

    $query = $conn->prepare("SELECT nm_empresa, vl_pin, bool_fornecedor FROM tb_empresa WHERE cd_empresa = :emp");
    $query->bindValue(":emp", $_SESSION['id_empresa']);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $nm_empresa = $row['nm_empresa'];
        $pin = $row['vl_pin'];
        $fornecedor = $row["bool_fornecedor"];
    }
    if($fornecedor == 0) {
      header("Location: dash.php");
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
              if(isset($_POST['submit'])) {

                $count = $_POST['counter'];


                $query = $conn->prepare("INSERT INTO tb_cotacao VALUES (null, :usuario, :emp, :lista)");
                $query->bindValue(":usuario", $_SESSION['cd_usuario']);
                $query->bindValue(":emp", $_SESSION['id_empresa']);
                $query->bindValue(":lista",$_POST['idlista']);
                $query->execute();

                $query = $conn->prepare("SELECT LAST_INSERT_ID();");
                $query->execute();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $id_cot = $row['LAST_INSERT_ID()'];
                }

                for($i = 1; $i <= $count -1; $i++){
                  $cd_item = $_POST['cd_item'.$i];
                  $valor = $_POST['valor'.$i];

                  $query = $conn->prepare("INSERT INTO tb_cotacao_item VALUES (null, :idcot, :iditem, :valor)");
                  $query->bindValue(":idcot", $id_cot);
                  $query->bindValue(":iditem", $cd_item);
                  $query->bindValue(":valor", $valor);
                  $query->execute();
                  echo '<h1 style="color:#2C8437">SUCESSO !</h1>';
                }
              }
          ?>

        </main>
    </body>
</html>
