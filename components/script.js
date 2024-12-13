function editarDados(id) {
    var nome = document.getElementById('nome-' + id).innerText;
    var email = document.getElementById('email-' + id).innerText;
    var telefone = document.getElementById('telefone-' + id).innerText;

    fetch('/dados/' + id, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            nome: nome,
            email: email,
            telefone: telefone
        })
    })
    .then(response => response.json())
    .then(data => {
        alert("Dados atualizados com sucesso!");
    })
    .catch(error => {
        console.error("Erro ao atualizar:", error);
    });
}
