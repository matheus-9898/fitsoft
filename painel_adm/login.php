<?php 

    if(stripos($_SERVER['PHP_SELF'],'login.php') != false){
        str_replace('/login.php','',$_SERVER['PHP_SELF']);
        header('Location:'.str_replace('/login.php','',$_SERVER['PHP_SELF']));
        die();
    }

    if(isset($_POST['acao'])){

        $sql = mysql::conexaoBD()->prepare('SELECT * FROM usuarios_adm WHERE email=? AND senha=?');

        $sql->execute(array($_POST['email'],$_POST['senha']));
        
        $info = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($sql->rowCount() == 1){
            $_SESSION['login'] = true;
            $_SESSION['nome'] = $info[0]['nome'];
            $_SESSION['email'] = $info[0]['email'];
            $_SESSION['id'] = $info[0]['id'];
            $_SESSION['foto'] = $info[0]['foto'];
            header('Location:'.PATH_PAINEL);
        }else{
            echo "<script> alert('Usuário ou senha incorretos.') </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="../imagens/favicon.png" type="image/png">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div id="contFormLogin">
        <img src="../imagens/logo-g.png" alt="Logo">
        <form action="" method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="submit" name="acao" value="Acessar">
        </form>
    </div>
</body>
</html>