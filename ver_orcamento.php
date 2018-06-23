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

    /* SELECIONANDO O NOME DA LISTA*/
    $query = $conn->prepare("SELECT nm_lista, nm_empresa
                            FROM tb_cotacao 
                            JOIN tb_lista ON tb_cotacao.id_lista = tb_lista.cd_lista
                            JOIN tb_empresa ON tb_cotacao.id_empresa = tb_empresa.cd_empresa
                            WHERE cd_cotacao = :cd");
    $query->bindValue(":cd", $_GET['cotacao']);
    $query->execute();

    $nm_lista = "";
    $nm_fornecedor = "";
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $nm_lista = $row['nm_lista'];
        $nm_fornecedor = $row['nm_empresa'];
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
                        echo '<a href="ver_orcamentos.php" class="content-menu-item"><i class="fas fa-dollar-sign"></i>Ver orçamentos</a>';
                    }
                ?>
            </header>
                <div id="container">
                    <h2><?php echo $nm_lista.' (Orçamento de '.$nm_fornecedor.')'; ?></h2>
                    <table cellspacing="0">
						<tr><td class="table-title">Nome</td><td class="table-title">Quantidade</td><td class="table-title">Preço un.</td><td class="table-title">Preço total</td></tr>
                        <?php
                            if(isset($_GET['cotacao'])) {
                                $id = $_GET['cotacao'];
                                $query = $conn->prepare("SELECT nm_lista_item, nm_lista_item_qtd, vl_cotacao
                                                        FROM tb_cotacao_item
                                                        JOIN tb_lista_item ON tb_lista_item.cd_lista_item = tb_cotacao_item.id_lista_item
                                                        WHERE tb_cotacao_item.id_cotacao = :id");
                                $query->bindValue(":id", $id);
                                $query->execute();

                                $total = 0;
                                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                                    $total += ($row['vl_cotacao'] * $row['nm_lista_item_qtd']);
                                    echo '<tr><td class="table-cell">'.$row['nm_lista_item'].'</td><td class="table-cell">'.$row['nm_lista_item_qtd'].'</td><td class="table-cell">R$'.$row['vl_cotacao'].'</td><td class="table-cell">R$'.($row['vl_cotacao'] * $row['nm_lista_item_qtd']).'</td>';
                                }

                            }
                        ?>

                        <tr class="table-result"><td>Valor total</td><td colspan="3" class="table-result-cell">R$<?php echo $total; ?></td></tr>
                    </table>
                </div>
                <br>
        </main>
    </body>
</html>
