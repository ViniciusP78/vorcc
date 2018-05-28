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

    </head>
    <body>
        <form method="post" class="login-container">
            <div id="title">Vorcc</div>
            <div id="form-container">
                <input type="text" placeholder="Login" name="login" class="form-input" required><div class="input-mask"></div><br>
                <input type="password" placeholder="Senha" name="senha" class="form-input" required><div class="input-mask"></div><br>
                <input type="submit" value="Entrar" name="submit">
            </div>
        </form>

        <?php
            if(isset($_SESSION['nome'])){
                header("Location: home.php");
            }
            if(isset($_POST['login'])){
                $query = $conn->prepare("SELECT * FROM dono WHERE nm_senha = :senha AND nm_login = :login");
                $query->bindValue(':senha', md5($_POST['senha']));
                $query->bindValue(':login', $_POST['login']);
                $query->execute();

                if($query->rowCount() == 1){
                    while($row = $query->fetch(PDO::FETCH_ASSOC)){
                        $_SESSION['id_empresa'] = $row['id_empresa'];
                        $_SESSION['cd_dono'] = $row['cd_usuario'];
                        $_SESSION['nome'] = $row['nm_usuario'];
                        header("Location: home.php");
                    }
                }else{
                    echo '??';
                }
            }
        ?>

        </div>
    </body>
</html>
