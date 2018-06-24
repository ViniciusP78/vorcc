<?php
	include('conexao.php');

	$query = $conn->prepare("DELETE FROM tb_lista_item WHERE id_lista = :id");
	$query->bindValue(':id', $_GET['id']);
	$query->execute();

	$query = $conn->prepare("DELETE FROM tb_lista WHERE cd_lista = :id");
	$query->bindValue(':id', $_GET['id']);
	$query->execute();

	$query = $conn->prepare("SELECT cd_cotacao FROM tb_cotacao WHERE id_lista = :id");
	$query->bindValue(':id', $_GET['id']);
	$query->execute();

	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
		$query = $conn->prepare("DELETE FROM tb_cotacao_item WHERE id_cotacao = :id");
		$query->bindValue(':id', $row['cd_cotacao']);
		$query->execute();
	}

	$query = $conn->prepare("DELETE FROM tb_cotacao WHERE i_lista = :id");
	$query->bindValue(':id', $_GET['id']);
	$query->execute();