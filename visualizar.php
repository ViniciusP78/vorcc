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
            <a class="menu-item" href="funcionarios.php"><i class="fas fa-users"></i><span>Funcionários</span></a>
            <a class="menu-item" href="search.php"><i class="fas fa-list"></i><span>Procurar Listas</span></a>
            <a class="menu-item" href="cotacoes.php"><i class="fas fa-box-open"></i><span>Cotações</span></a>
            <a class="menu-item" href="php/logout.php"><i class="fas fa-times-circle"></i><span>Sair</span></a>
        </nav>

        <main id="content" style="display:block">
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
						echo $row['nm_lista']."<br>";
						$emp = $row['id_empresa'];
					}

					$query = $conn->prepare("SELECT `cd_lista_item`,`nm_lista_item`, `nm_lista_item_qtd` FROM `tb_lista_item` WHERE id_lista = :id");
					$query->bindValue(":id", $id);
					$query->execute();

					$i = 0;
					echo '<form method="post" action="enviarcot.php">';
					while($row = $query->fetch(PDO::FETCH_ASSOC)){
						$i++;
						echo $row['nm_lista_item']."   qtd:".$row['nm_lista_item_qtd']."<br>";

					}

				} else {
					header("Location: dash.php");
				}
			?>

      <?php
        $query = $conn->prepare("SELECT nm_lista, id_empresa FROM tb_lista WHERE cd_lista = :id");
        $query->bindValue(":id", $id);
        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
          echo $row['nm_lista']."<br>";
          $emp = $row['id_empresa'];
        }
      ?>

        </main>
    </body>
</html>
