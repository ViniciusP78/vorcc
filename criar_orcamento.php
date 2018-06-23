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
                        echo '<a href="criarlista.php" class="content-menu-item"><i class="far fa-plus-square"></i>Adicionar lista </a>';
                        echo '<a href="verorcamentos.php" class="content-menu-item"><i class="far fa-plus-square"></i>Ver orçamentos</a>';
                    }
                ?>
            </header>
            <form action="enviarcot.php" method="post">
                <div id="container">
                    <h2>Carnes</h2>
                    <table cellspacing="0">
						<tr><td class="table-title">Nome</td><td class="table-title">Quantidade</td><td class="table-title">Preço un.</td><td class="table-title">Preço total</td></tr>
                        <?php
                            if(isset($_GET['id'])) {
                                $id = $_GET['id'];
                                echo '<input type="hidden" name="idlista" value="'.$id.'">';
                                $query = $conn->prepare("SELECT *
                                                        FROM tb_lista
                                                        JOIN tb_lista_item ON tb_lista_item.id_lista = tb_lista.cd_lista
                                                        WHERE tb_lista.cd_lista = :id");
                                $query->bindValue(":id", $id);
                                $query->execute();

                                $counter = 1;
                                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                                    echo '<tr><td class="table-cell">'.$row['nm_lista_item'].'</td><td class="table-cell">'.$row['nm_lista_item_qtd'].'</td><td class="table-cell">R$<input type="number" placeholder="Valor unitário" class="valor" name="valor'.$counter.'" pattern="[0-9]" step="0.01"></td><td class="table-cell">R$<span id="orcTotal"><input type="hidden" name="cd_item'.$counter.'" value="'.$row['cd_lista_item'].'"</span></td>';
                                    $counter++;
                                }
                                echo '<input type="hidden" name="counter" value="'.$counter.'">';
                            }
                        ?>

                        <tr class="table-result"><td>Valor total</td><td colspan="3" class="table-result-cell">
                          
                        </td></tr>
                    </table>
                </div>
                <br>
                <input type="submit" name="submit" value="Enviar orçamento" class="form-submit">
                </form>
            </form>
        </main>
    </body>
</html>
