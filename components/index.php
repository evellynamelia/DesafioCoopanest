<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $complemento = $_POST['complemento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $sql = "INSERT INTO dados_originais (nome, email, telefone, cpf, endereco, complemento, cidade, estado) 
            VALUES ('$nome', '$email', '$telefone', '$cpf', '$endereco', '$complemento', '$cidade', '$estado')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Dados enviados com sucesso!');</script>";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #333;
            padding: 20px;
            color: white;
            position: fixed;
            height: 100%;
            top: 0;
            left: 0;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 0;
            margin: 10px 0;
            font-size: 18px;
        }

        .sidebar a:hover {
            background-color: #4CAF50;
            padding-left: 10px;
        }

        .content {
            margin-left: 250px;
            /* Espaço para a sidebar */
            width: calc(100% - 250px);
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .input-group input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }


        .register-link {
            text-align: center;
            margin-top: 15px;
        }

        .register-link a {
            color: #4CAF50;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <a href="index.php">Cadastro de Usuário</a>
        <a href="dados.php">Usuários Cadastrados</a>
    </div>

    <div class="content">
        <h2>Cadastro de Usuário</h2>
        <form method="POST" action="index.php">
            <div class="input-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="input-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" required>
            </div>
            <div class="input-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="telefone">Telefone</label>
                <input type="text" id="telefone" name="telefone" required>
            </div>
            <div class="input-group">
                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco" required>
            </div>
            <div class="input-group">
                <label for="complemento">Complemento</label>
                <input type="text" id="complemento" name="complemento" required>
            </div>
            <div class="input-group">
                <label for="cidade">Cidade</label>
                <input type="text" id="cidade" name="cidade" required>
            </div>
            <div class="input-group">
                <label for="estado">Estado</label>
                <input type="text" id="estado" name="estado" required>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>

</html>

<?php $conn->close(); ?>