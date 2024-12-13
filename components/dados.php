<?php
include('db.php');

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM dados_originais WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Usuário excluído com sucesso!');</script>";
    } else {
        echo "Erro ao excluir usuário: " . $conn->error;
    }
}

$sql = "SELECT * FROM dados_originais";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários Cadastrados</title>
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
            width: calc(100% - 250px);
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        button {
            padding: 6px 12px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #d32f2f;
        }

        .edit-btn {
            background-color: #4CAF50;
            cursor: pointer;
        }

        .edit-btn:hover {
            background-color: #45a049;
        }

        .save-btn {
            background-color: #2196F3;
            cursor: pointer;
        }

        .save-btn:hover {
            background-color: #1976D2;
        }

        .save-btn {
            display: none;
        }

        tr.editing td {
            background-color: #f9f9f9;
        }
        </style>
</head>

<body>
    <div class="sidebar">
        <a href="index.php">Cadastro de Usuário</a>
        <a href="dados.php">Usuários Cadastrados</a>
    </div>

    <div class="content">
        <h1>Usuários Cadastrados</h1>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>CPF</th>
                    <th>Endereço</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr id='row-" . $row['id'] . "'>";
                        echo "<td id='nome-" . $row['id'] . "'>" . $row['nome'] . "</td>";
                        echo "<td id='email-" . $row['id'] . "'>" . $row['email'] . "</td>";
                        echo "<td id='telefone-" . $row['id'] . "'>" . $row['telefone'] . "</td>";
                        echo "<td id='cpf-" . $row['id'] . "'>" . $row['cpf'] . "</td>";
                        echo "<td id='endereco-" . $row['id'] . "'>" . $row['endereco'] . "</td>";
                        echo "<td id='cidade-" . $row['id'] . "'>" . $row['cidade'] . "</td>";
                        echo "<td id='estado-" . $row['id'] . "'>" . $row['estado'] . "</td>";
                        echo "<td>
                                <button class='edit-btn' onclick='editarDados(" . $row['id'] . ")'>Editar</button>
                                <button class='save-btn' onclick='salvarDados(" . $row['id'] . ")'>Salvar</button>
                                <a href='dados.php?delete=" . $row['id'] . "'><button>Excluir</button></a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Nenhum dado encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function editarDados(id) {
            var row = document.getElementById("row-" + id);
            row.classList.add("editing");

            var cells = row.getElementsByTagName("td");
            for (var i = 0; i < cells.length - 1; i++) {
                cells[i].contentEditable = true;
            }

            row.querySelector(".save-btn").style.display = "inline-block";
            row.querySelector(".edit-btn").style.display = "none";
        }

        function salvarDados(id) {
            var nome = document.getElementById("nome-" + id).innerText;
            var email = document.getElementById("email-" + id).innerText;
            var telefone = document.getElementById("telefone-" + id).innerText;
            var cpf = document.getElementById("cpf-" + id).innerText;
            var endereco = document.getElementById("endereco-" + id).innerText;
            var cidade = document.getElementById("cidade-" + id).innerText;
            var estado = document.getElementById("estado-" + id).innerText;

            fetch('api.php?id=' + id, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    nome: nome,
                    email: email,
                    telefone: telefone,
                    cpf: cpf,
                    endereco: endereco,
                    cidade: cidade,
                    estado: estado
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert("Dados atualizados com sucesso!");
                    location.reload();
                } else {
                    alert("Erro ao salvar os dados.");
                }
            })
            .catch(error => {
                console.error("Erro ao atualizar:", error);
            });
        }
    </script>

</body>

</html>

<?php $conn->close(); ?>