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
        <nav id="menu">
            <div id="menu-logo"><?php echo $nm_empresa ?>
                <br>
                <span style="font-size:13px;"><?php if($_SESSION['nr_acesso'] >= 1) echo 'Pin: ',$pin; ?></span>
            </div>
            <a class="menu-item" href="criarlista.php"><i class="fas fa-users"></i><span>Criar Lista</span></a>
            <br>
            <br>

            <?php
              $query = $conn->prepare("SELECT cd_lista, nm_lista FROM tb_lista WHERE id_empresa = :emp");
              $query->bindValue(":emp", $_SESSION['id_empresa']);
              $query->execute();
              while($row = $query->fetch(PDO::FETCH_ASSOC)){
                  $cd_lista = $row['cd_lista'];
                  $nm_lista = $row['nm_lista'];
                  echo "<a href='orcamentos.php?id=$cd_lista'>$nm_lista</a>";

              }
            ?>

            <br>
            <br>
            <br>
            <br>
            <a class="menu-item" href="dash.php"><i class="fas fa-box-open"></i><span>Voltar</span></a>
            <a class="menu-item" href="php/logout.php"><i class="fas fa-times-circle"></i><span>Sair</span></a>
        </nav>

        <main id="content">
          <?php
            if(isset($_GET['id'])) {
              $id = $_GET['id'];
              $query = $conn->prepare("SELECT nm_lista FROM tb_lista WHERE cd_lista = :list");
              $query->bindValue(":list", $id);
              $query->execute();
              while($row = $query->fetch(PDO::FETCH_ASSOC)){
                echo $row['nm_lista']."<br>";
              }

              $query = $conn->prepare("SELECT nm_lista_item, nm_lista_item_qtd FROM tb_lista_item WHERE id_lista = :list");
              $query->bindValue(":list", $id);
              $query->execute();
              while($row = $query->fetch(PDO::FETCH_ASSOC)){
                echo $row['nm_lista_item']."    ";
                echo $row['nm_lista_item_qtd']."<br>";
              }
            }

          ?>
        </main>
    </body>
</html>
