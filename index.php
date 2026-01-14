<?php

    if(!empty($_POST['usuario']) && !empty($_POST['senha'])){
        // data source name
        $dsn = 'mysql:host=localhost;dbname=php_pdo'; 
        $usuario = 'root';
        $senha = '';

        try{
            $conexao = new PDO($dsn, $usuario, $senha);
    
            $query = '
                CREATE TABLE IF NOT EXISTS TB_USUARIOS(
                    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    NOME VARCHAR(50) NOT NULL,
                    EMAIL VARCHAR(100) NOT NULL,
                    SENHA VARCHAR(32) NOT NULL
                )
            ';
    
            // $retorno = $conexao->exec($query);
            // echo $retorno;
    
            $query = '
                INSERT INTO TB_USUARIOS(
                    NOME, EMAIL, SENHA
                ) VALUES (
                    "IAN RODRIGUES", "IANRODDRS@GMAIL.COM", "123456"
                ), (
                    "ISABELLA AMORAS", "ISABELAAMORAS1@GMAIL.COM", "456789"
                ), (
                    "ANTONIO PEREIRA", "ANTONIOLEVI@GMAIL.COM", "1357975"
                )
            ';
    
            // $retorno = $conexao->exec($query);
            // echo $retorno;
    
            $query = '
                SELECT * FROM TB_USUARIOS
            ';
    
            // $stmt = $conexao->query($query);
    
            // $lista = $stmt->fetchAll(PDO::FETCH_BOTH);
            // $lista = $stmt->fetchAll(PDO::FETCH_NUM);
            // $lista = $stmt->fetchAll(PDO::FETCH_OBJ);
            // $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // print_r($lista);
            // echo '<hr>';
            // echo $lista[0]->NOME;
    
            // $obj = $stmt->fetch(PDO::FETCH_OBJ);
            // echo $obj->NOME;
    
            // foreach($lista as $key => $value){
            //     print_r ($value);
            // }
    
            // foreach($stmt as $key => $value){
            //     print_r ($value);
            // }

            $query = "
                SELECT * FROM TB_USUARIOS
                WHERE
                EMAIL = :usuario
                AND SENHA = :senha
            ";
            
            // $stmt = $conexao->query($query);
            // $user = $stmt->fetch();

            // print_r ($user);

            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':usuario', $_POST['usuario']);
            $stmt->bindValue(':senha', $_POST['senha'], PDO::PARAM_INT);

            $stmt->execute();

            $user = $stmt->fetch();

            print_r($user);

    
    
    
    
            
        } catch(PDOException $e){
            echo 'Erro: ' . $e->getCode() . ' Mensagem: ' . $e->getMessage();
            // registrar erro
        }
    }



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>

<form method="post" action="index.php">
    <input type="text" name="usuario" placeholder="usuário">
    <br>
    <input type="password" name="senha" placeholder="senha">
    <br>
    <button type="submit">entrar</button>
</form>
    
</body>
</html>