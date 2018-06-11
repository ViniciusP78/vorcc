<?php include('php/conexao.php'); ?>
<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <title> Vorcc </title>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
        <link rel="stylesheet" href="fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome-all.min.css">
    </head>
    <body>
        <form method="post" class="login-container">
            <div id="title">Vorcc</div>
            <div id="form-container">
                <div class="input-icon-wrapper">
                    <i class="fas fa-address-book"></i>
                    <input type="text" placeholder="Login" name="login" class="form-input" autocomplete="off" required><div class="input-mask"></div><br>
                </div>
                <div class="input-icon-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Senha" name="senha" class="form-input" required><div class="input-mask"></div><br>
                </div>
                <input type="submit" value="Entrar" name="submit">
            </div>
        </form>

        <?php
            if(isset($_SESSION['nome'])){
                header("Location: dash.php");
            }
            if(isset($_POST['login'])){
                $query = $conn->prepare("SELECT * FROM dono WHERE nm_senha = :senha AND nm_login = :login");
                $query->bindValue(':senha', md5($_POST['senha']));
                $query->bindValue(':login', $_POST['login']);
                $query->execute();

                if($query->rowCount() == 1){
                    while($row = $query->fetch(PDO::FETCH_ASSOC)){
                        $_SESSION['id_empresa'] = $row['id_empresa'];
                        $_SESSION['cd_usuario'] = $row['cd_usuario'];
                        $_SESSION['nome'] = $row['nm_usuario'];
                        header("Location: dash.php");
                    }
                }else{
                    echo '??';
                }
            }
        ?>

        </div>
    </body>
</html>
