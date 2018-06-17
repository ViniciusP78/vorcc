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

          <form method="post" action="enviarlista.php">
            <div id="container">
              <input type="text" name="lista" placeholder="lista"><br><br>
                <input type="hidden" name="counter" id="counter" value="5">
              <input type="text" name="item1" placeholder="item1"><input type="number" name="qtditem1" placeholder="qtd" style="width:40px"><br>
              <input type="text" name="item2" placeholder="item2"><input type="number" name="qtditem2" placeholder="qtd" style="width:40px"><br>
              <input type="text" name="item3" placeholder="item3"><input type="number" name="qtditem3" placeholder="qtd" style="width:40px"><br>
              <input type="text" name="item4" placeholder="item4"><input type="number" name="qtditem4" placeholder="qtd" style="width:40px"><br>
              <input type="text" name="item5" placeholder="item5"><input type="number" name="qtditem5" placeholder="qtd" style="width:40px"><br>
            </div>
              <button type="button" onclick="add()">+</button><br>
              <input type="submit" name="submit" value="enviado">
          </form>

          <script>

            var i = 6;

            function add(){
              var container = document.getElementById("container");
              var input = document.createElement("input");
                input.type = "text";
                input.name = "item" + i;
                input.placeholder = "Item" + i;
              container.appendChild(input);
              var qtd = document.createElement("input");
                qtd.type = "number";
                qtd.name = "qtditem" + i;
                qtd.placeholder = "qtd";
                qtd.style.width = "40px";
              container.appendChild(qtd);

              container.appendChild(document.createElement("br"));
              document.getElementById("counter").value = i;
              i++;
            }
          </script>


        </main>
    </body>
</html>
