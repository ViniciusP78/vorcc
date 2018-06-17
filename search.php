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
        <nav id="menu">
            <div id="menu-logo"><?php echo $nm_empresa ?>
                <br>
                <span style="font-size:13px;"><?php if($_SESSION['nr_acesso'] >= 1) echo 'Pin: ',$pin; ?></span>
            </div>
            <a class="menu-item" href="funcionarios.php"><i class="fas fa-users"></i><span>Funcionários</span></a>
            <a class="menu-item" href="search.php"><i class="fas fa-list"></i><span>Procurar Listas</span></a>
            <a class="menu-item" href="cotacoes.php"><i class="fas fa-box-open"></i><span>Cotações</span></a>
            <a class="menu-item" href="php/logout.php"><i class="fas fa-times-circle"></i><span>Sair</span></a>
        </nav>

        <main id="content">
          <form method="get">
            <input type="text" name="search" placeholder="Pesquise aqui">
            <input type="submit" value="enviar"><br>
            Lista: <input type="radio" name="filtro" value="0" checked> <br> Produto: <input type="radio" name="filtro" value="1" disabled>(em contstrução!)<br>
          </form>

          <?php
            if(isset($_GET['search'])) {
              if($_GET['filtro'] == 0) {

                $query = $conn->prepare("SELECT cd_lista, nm_lista, nm_empresa FROM `tb_lista`,tb_empresa WHERE nm_lista like :search and cd_empresa = id_empresa");
                $query->bindValue(":search","%".$_GET['search']."%");
                $query->execute();

                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $cd_lista = $row["cd_lista"];
                    $nm_lista = $row["nm_lista"];
                    $nm_empresa = $row["nm_empresa"];
                    echo "<a href='visualizar.php?id=$cd_lista'>$nm_lista da empresa $nm_empresa</a><br>";
                }

              } else {

              }
            }
          ?>


        </main>
    </body>
</html>
