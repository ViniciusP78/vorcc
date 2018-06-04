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
        <?php include('php/conexao.php'); ?>

        <div class="sess" style="position:absolute">
            <?php
                if(isset($_SESSION['nome'])){
                    echo $_SESSION['nome'].'<br>'.$_SESSION['cd_usuario'].'<br>'.$_SESSION['id_empresa'];
                }
            ?>
        </div>

        <?php
            if(isset($_SESSION['nome'])){
                header("Location: dash.php");
            }
        ?>

        <?php
        function generateRandomString($length = 32) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&*+';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        ?>
        <form method="post" class="login-container" action="">
            Sou: Comprador<input type="radio" name="bool_fornecedor" value="0"> Fornecedor<input type="radio" name="bool_fornecedor" value="1">
            <input type="text" placeholder="Nome Real" name="nome"><br>
            <input type="number" placeholder="CPF (somente números)" name="cpf"><br>
            <input type="text" placeholder="Login" name="login"><br>
            <input type="password" placeholder="Senha" name="senha"><br>
            <input type="password" placeholder="Repita a Senha" name="senha2"><br>
            Já tem uma empresa cadastrada ? <br>
            Sim<input type="radio" name="empcads" value="0" onclick="switchs()">
            Não<input type="radio" name="empcads" value="1" onclick="switchs()">
            <div id="empresa">
                <input type="text" placeholder="Nome da empresa" name="nome_empresa"><br>
                <input type="number" placeholder="CNPJ (somente números)" name="cnpj"><br>
            </div>
            <div id="pin">
                <input type="text" placeholder="PIN da empresa" name="pin"><br>
            </div>
            <input type="submit" value="Entrar" name="submit">
        </form>

        <script>
            function switchs() {
                var radios = document.getElementsByName('empcads');
                var switchs;

                for (var i = 0, length = radios.length; i < length; i++)
                {
                    if (radios[i].checked)
                    {
                        // do whatever you want with the checked radio
                        switchs = radios[i].value;

                        break;
                    }
                }

                if (switchs == 0) {
                    document.getElementById('empresa').style.display = "none";
                    document.getElementById('pin').style.display = "block";

                } else {
                    document.getElementById('empresa').style.display = "block";
                    document.getElementById('pin').style.display = "none";
                }}
        </script>

        <?php

        if(isset($_POST['nome']) && isset($_POST['bool_fornecedor']) && isset($_POST['cpf']) && isset($_POST['login']) && isset($_POST['senha']) && isset($_POST['senha2']) && isset($_POST['empcads'])){
            echo '3';
            if($_POST['empcads'] == 1){
                echo '2';
                if(isset($_POST['nome_empresa']) && isset($_POST['cnpj'])){
                    echo '1';

                    $query = $conn->prepare("INSERT INTO tb_empresa VALUES(null, :nome, :cnpj, DEFAULT, :fornecedor, :pin)");
                    $query->bindValue(":nome", $_POST['nome_empresa']);
                    $query->bindValue(":cnpj", $_POST['cnpj']);
                    $query->bindValue(":fornecedor", $_POST['bool_fornecedor']);
                    $query->bindValue(":pin", generateRandomString());
                    $query->execute();

                    $query = $conn->prepare("SELECT cd_empresa FROM tb_empresa WHERE nr_cnpj = :cnpj");
                    $query->bindValue(":cnpj", $_POST['cnpj']);
                    $query->execute();

                    $cd_empresa = "";
                    while($row = $query->fetch(PDO::FETCH_ASSOC)){
                        $cd_empresa = $row['cd_empresa'];
                        echo 'roooow';
                    }

                    $query = $conn->prepare("INSERT INTO dono VALUES(null, :nome, :cpf, :login, :senha, :cd_empresa)");
                    $query->bindValue(":nome", $_POST['nome']);
                    $query->bindValue(":cpf", $_POST['cpf']);
                    $query->bindValue(":login", $_POST['login']);
                    $query->bindValue(":senha", md5($_POST['senha']));
                    $query->bindValue(":cd_empresa", $cd_empresa);
                    $query->execute();

                    /* SELECIONANDO O ID DA EMPRESA PRA FAZER O LOGIN E REDIRECIONAR PRA DASHBOARD */
                    $query = $conn->prepare("SELECT id_empresa, cd_usuario FROM dono WHERE nr_cpf = :cpf");
                    $query->bindValue(":cpf", $_POST['cpf']);
                    $query->execute();

                    while($row = $query->fetch(PDO::FETCH_ASSOC)){
                        $_SESSION['nome'] = $_POST['nome'];
                        $_SESSION['cd_usuario'] = $row['cd_usuario'];
                        $_SESSION['id_empresa'] = $row['id_empresa'];
                        header("Location: dash.php");

                    }
                    /*header("Location: home.php");*/
                }
            }
            else{
                echo "4";

                $query = $conn->prepare("SELECT * FROM tb_empresa WHERE vl_pin = :pin");
                $query->bindValue(":pin", $_POST['pin']);
                $query->execute();

                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $cd_empresa = $row['cd_empresa'];
                }

                if (!isset($cd_empresa)) {
                    echo "PIN inválido!";
                } else {
                    echo "5";
                $query = $conn->prepare("INSERT INTO dono VALUES(null, :nome, :cpf, :login, :senha, :cd_empresa)");
                $query->bindValue(":nome", $_POST['nome']);
                $query->bindValue(":cpf", $_POST['cpf']);
                $query->bindValue(":login", $_POST['login']);
                $query->bindValue(":senha", md5($_POST['senha']));
                $query->bindValue(":cd_empresa", $cd_empresa);
                $query->execute();

                /* SELECIONANDO O ID DA EMPRESA PRA FAZER O LOGIN E REDIRECIONAR PRA DASHBOARD */
                $query = $conn->prepare("SELECT id_empresa, cd_usuario FROM dono WHERE nr_cpf = :cpf");
                $query->bindValue(":cpf", $_POST['cpf']);
                $query->execute();

                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    echo "6";
                    $_SESSION['nome'] = $_POST['nome'];
                    $_SESSION['cd_usuario'] = $row['cd_usuario'];
                    $_SESSION['id_empresa'] = $row['id_empresa'];
                    echo $_SESSION['nome'].' '.$_SESSION['cd_usuario'].' '.$_SESSION['id_empresa'];
                }
            }
            }
        } else {echo "Escreva os campo Tudo!;";}
        ?>

        </div>
    </body>
</html>
