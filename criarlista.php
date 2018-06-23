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
            <header id="content-menu">
                <!-- O PHP EXIBE TEXTOS DIFERENTES DE PARA O CASO DE O USUÁRIO SER UM FORNECEDOR !-->
                <h1> <?php if($_SESSION['bool_fornecedor'] == 0) {echo 'Suas listas';} else{echo 'Todas as listas';} ?></h1>
                <a href="listas.php" class="content-menu-item"> <i class="fas fa-eye"></i> Ver listas </a>
                <?php 
                    if($_SESSION['bool_fornecedor'] == 0){
                        echo '<a href="criarlista.php" class="content-menu-item"> <i class="far fa-plus-square"></i>Adicionar lista </a>';
                    }
                ?>
            </header>
            <form method="post" action="enviarlista.php">
                <div id="container">
                    <input type="text" name="lista" placeholder="Nome da lista" id="form-title-input"><br><br>
                    <input type="hidden" name="counter" id="counter" value="1">
                    <input type="text" name="item1" placeholder="Item 1" class="form-input"><input type="number" name="qtditem1" placeholder="qtd" style="width:40px">
                </div>
                <br>
                <button type="button" class="form-add" onclick="add()"><i class="fas fa-plus-circle"></i>&nbspAdicionar item</button>
                <input type="submit" name="submit" value="Criar lista" class="form-submit">
            </form>

          <script>

            var i = 1;

            function add(){
                i++;  
                var container = document.getElementById("container");
                var input = document.createElement("input");
                  input.type = "text";
                  input.name = "item" + i;
                  input.placeholder = "Item " + i;
                  input.className = "form-input";
                  container.appendChild(document.createElement("br"));
                  container.appendChild(input);

                  var qtd = document.createElement("input");
                    qtd.type = "number";
                    qtd.name = "qtditem" + i;
                    qtd.placeholder = "qtd";
                    qtd.style.width = "40px";
                  container.appendChild(qtd);

                  document.getElementById("counter").value = i;
            }
          </script>


        </main>
    </body>
</html>
