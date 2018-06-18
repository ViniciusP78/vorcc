<?php
    $query = $conn->prepare("SELECT * FROM tb_lista");
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $cd_lista = $row['cd_lista'];
        $nm_lista = $row['nm_lista'];

        /* Faz a contagem do número de itens na lista */
        $count_query = $conn->prepare("SELECT COUNT(id_lista) AS `total`FROM tb_lista
                                JOIN tb_lista_item ON tb_lista.cd_lista = tb_lista_item.id_lista
                                WHERE cd_lista = :cd_lista");
        $count_query->bindValue(':cd_lista', $cd_lista);
        $count_query->execute();

        while($row = $count_query->fetch(PDO::FETCH_ASSOC)){
            $num_itens = $row['total']; // ESSE É O TOTAL DE ITENS NA LISTA
        }

        /* Faz a contagem do número de respostas na lista */
        $count_query = $conn->prepare("SELECT COUNT(id_lista) AS `total` FROM tb_lista
                                JOIN tb_cotacao ON tb_lista.cd_lista = tb_cotacao.id_lista
                                WHERE cd_lista = :cd_lista");
        $count_query->bindValue(':cd_lista', $cd_lista);
        $count_query->execute();

        while($row = $count_query->fetch(PDO::FETCH_ASSOC)){
            $num_repostas = $row['total']; // ESSE É O TOTAL DE COTAÇÕES PARA LISTA
        }
        echo '<tr><td class="table-cell-dark"><a href="criar_orcamento.php?id='.$cd_lista.'">'.$nm_lista.'</a></td><td class="table-cell-dark">'.$num_itens.'</td><td class="table-cell-dark">'.$num_repostas.'</td></tr>';
    }
?>