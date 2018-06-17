<?php 
	$file = ($_SESSION['bool_fornecedor'] == 0) ? 'lista_comprador.php' : 'orcamentos.php';
?>
<nav id="menu">
	<div id="menu-logo"><?php echo $nm_empresa ?>
	    <br>
	    <span style="font-size:13px;"><?php if($_SESSION['nr_acesso'] >= 1) echo 'Pin: '.$pin; ?></span>
	</div>
	<a class="menu-item" href="funcionarios.php"><i class="fas fa-users"></i><span>Funcionários</span></a>
	<a class="menu-item" href="<?php echo $file; ?>"><i class="fas fa-list"></i><span>Listas</span></a>
	<a class="menu-item" href="php/logout.php"><i class="fas fa-times-circle"></i><span>Sair</span></a>
</nav>