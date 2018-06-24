<?php
    try{
        /* SELECT DISTINCT ? */
        $query = $conn->prepare("SELECT nm_empresa, nm_lista, cd_cotacao, cd_lista
                                FROM tb_cotacao
                                JOIN tb_empresa ON tb_cotacao.id_empresa = tb_empresa.cd_empresa
                                JOIN tb_lista ON tb_cotacao.id_lista = tb_lista.cd_lista
                                WHERE tb_lista.id_empresa = :emp");
        $query->bindValue(":emp", $_SESSION['id_empresa']);
        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            /* SELECIONANDO A SOMA DAS COTAÇÕES UNITÁRIAS */
            $query2 = $conn->prepare("SELECT SUM(vl_cotacao)
                                    FROM tb_cotacao_item
                                    WHERE id_cotacao = :cd_cotacao
                                    ");
            $query2->bindValue(":cd_cotacao", $row['cd_cotacao']);
            $query2->execute();

            while($row2 = $query2->fetch()){
                $total = $row2[0]; /*INDEX 0 É A SOMA*/
            }
            echo '<tr><td class="table-cell-dark"><a href="ver_orcamento.php?cotacao='.$row['cd_cotacao'].'">'.$row['nm_empresa'].'</a></td><td class="table-cell-dark">'.$row['nm_lista'].'</td><td class="table-cell-dark">R$'.$total.'</td></tr>';
        }
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
?>