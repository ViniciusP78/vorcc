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
        <?php include('menu.php'); ?>

        <main id="content">
          <header id="content-menu">
              <!-- O PHP EXIBE TEXTOS DIFERENTES DE PARA O CASO DE O USUÁRIO SER UM FORNECEDOR !-->
              <h1> <?php if($_SESSION['bool_fornecedor'] == 0) {echo 'Suas listas';} else{echo 'Todas as listas';} ?></h1>
              <a href="listas.php" class="content-menu-item"> <i class="fas fa-eye"></i> Ver listas </a>
              <?php
                  if($_SESSION['bool_fornecedor'] == 0){
                      echo '<a href="criarlista.php" class="content-menu-item"><i class="far fa-plus-square"></i>Adicionar lista </a>';

                  }
              ?>
          </header>
    			<?php
    				if(isset($_GET['id'])) {
    					$id = $_GET['id'];
    					$query = $conn->prepare("SELECT nm_lista, id_empresa FROM tb_lista WHERE cd_lista = :id");
    					$query->bindValue(":id", $id);
    					$query->execute();

    					while($row = $query->fetch(PDO::FETCH_ASSOC)){
    						echo '<h2>'.$row['nm_lista']."</h2><br>";
    						$emp = $row['id_empresa'];
    					}

    					$query = $conn->prepare("SELECT `cd_lista_item`,`nm_lista_item`, `nm_lista_item_qtd` FROM `tb_lista_item` WHERE id_lista = :id");
    					$query->bindValue(":id", $id);
    					$query->execute();

              echo '<table><tr><td class="table-title">Item</td><td class="table-title">Quantidade</td></tr>';
    					while($row = $query->fetch(PDO::FETCH_ASSOC)){
    						echo '<tr><td class="table-cell">'.$row['nm_lista_item'].'</td><td class="table-cell">'.$row['nm_lista_item_qtd'].'</td></tr>';
    					}
              echo '</table>';
    				} else {
    					header("Location: dash.php");
    				}
    			?>

        <a href="php/apagar_lista.php?id=<?php echo $_GET['id']; ?>" class="form-submit" id="delete-btn">Apagar lista</a>
        </main>
    </body>
</html>
