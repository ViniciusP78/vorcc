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
          if(isset($_POST['submit'])){

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

          }
        ?>


        </main>
    </body>
</html>
