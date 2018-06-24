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
    <body style="overflow:hidden;">
        <?php
        session_start();
        if(isset($_SESSION['nome'])){
            header("Location: dash.php");
        }
        ?>
        <nav id="menu">
            <span id="logo"> Vorcc </span>

            <div id="menu-nav">
                <a href="cadastro.php" class="nav-item"> Criar conta </a>
                <a href="login.php" id="button"> Entrar </a>
            </div>
        </nav>

        <main id="content">
            <div id="words-wrapper">
                <p class="vorcc-word" id="a"><span>V</span>isualizador de</p>
                <p class="vorcc-word" id="b"><span>Orç</span>amentos e</p>
                <p class="vorcc-word" id="c"><span>C</span>otações</p>
            </div>
            <img src="imgs/vorcc.png"/ style="position:absolute;width:1100px;height:auto;right:-50px;z-index:-1">
        </main>
    </body>
</html>
