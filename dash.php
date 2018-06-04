<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <title> Vorcc </title>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

    </head>
    <body>
        <?php
        include('php/conexao.php');

        if(!isset($_SESSION['nome'])){
            header("Location: home.php");
        }

        $query = $conn->prepare("SELECT nm_empresa FROM tb_empresa WHERE cd_empresa = :emp");
        $query->bindValue(":emp", $_SESSION['id_empresa']);
        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $nm_empresa = $row['nm_empresa'];
        }

        ?>
        <nav id="menu">
            <span id="logo"> <?php echo $nm_empresa ?> </span>

            <div id="menu-nav">
                <a href="perfil.php" class="nav-item"> <?php echo $_SESSION['nome']; ?> </a>
                <a href="php/logout.php" id="button"> Quitar </a>
            </div>
        </nav>

        <main id="content">
            <div id="words-wrapper">
                <p class="vorcc-word" id="a"><span>V</span>isualizador de</p>
                <p class="vorcc-word" id="b"><span>Orç</span>amentos e</p>
                <p class="vorcc-word" id="c"><span>C</span>otações</p>
            </div>
        </main>
    </body>
</html>
