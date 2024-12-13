<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    
    $inputData = json_decode(file_get_contents('php://input'), true);
    $id = $_GET['id']; 
    $nome = $inputData['nome'];
    $email = $inputData['email'];
    $telefone = $inputData['telefone'];
    $cpf = $inputData['cpf'];
    $endereco = $inputData['endereco'];
    $cidade = $inputData['cidade'];
    $estado = $inputData['estado'];
    $sql = "UPDATE dados_originais SET nome = ?, email = ?, telefone = ?, cpf = ?, endereco = ?, cidade = ?, estado = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $nome, $email, $telefone, $cpf, $endereco, $cidade, $estado, $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }

    $stmt->close();
}

$conn->close();
?>
