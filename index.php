<?php

require_once 'Contato.php';
require_once 'GerenciadorDeContato.php';

$gerenciadorDeContatos = new GerenciadorDeContato();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acao'])) {
        if ($_POST['acao'] === 'adicionar' && isset($_POST['nome'], $_POST['email'], $_POST['telefone'])) {
            $gerenciadorDeContatos->adicionarContato($_POST['nome'], $_POST['email'], $_POST['telefone']);
        } elseif ($_POST['acao'] === 'atualizar' && isset($_POST['indice'], $_POST['nome'], $_POST['email'], $_POST['telefone'])) {
            $gerenciadorDeContatos->atualizarContato($_POST['indice'], $_POST['nome'], $_POST['email'], $_POST['telefone']);
        } elseif ($_POST['acao'] === 'buscar' && isset($_POST['busca'])) {
            $contatos = $gerenciadorDeContatos->buscarContato($_POST['busca']);
        }
    }

    if (isset($_POST['deletar'])) {
        $gerenciadorDeContatos->deletarContato($_POST['deletar']);
    }
}

$contatos = $gerenciadorDeContatos->getContatos();
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Contatos</title>
</head>
<body>

<h1>Gerenciador de Contatos</h1>

<!-- Formulário para adicionar um novo contato -->
<form method="POST" action="">
    <input type="text" name="nome" placeholder="Nome" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="tel" name="telefone" placeholder="Telefone" required>
    <button type="submit" name="acao" value="adicionar">Adicionar Contato</button>
</form>

<!-- Formulário para buscar contatos -->
<form method="POST" action="">
    <input type="text" name="busca" placeholder="Buscar Contato">
    <button type="submit" name="acao" value="buscar">Buscar</button>
</form>

<!-- Lista de Contatos -->
<ul>
    <?php foreach ($contatos as $indice => $contato): ?>
        <li>
            <strong>Nome:</strong> <?= htmlspecialchars($contato->getNome()) ?><br>
            <strong>Email:</strong> <?= htmlspecialchars($contato->getEmail()) ?><br>
            <strong>Telefone:</strong> <?= htmlspecialchars($contato->getTelefone()) ?>
            <form method="POST" action="" style="display:inline;">
                <button type="submit" name="deletar" value="<?= $indice ?>">Excluir</button>
            </form>
            <form method="POST" action="" style="display:inline;">
                <input type="hidden" name="indice" value="<?= $indice ?>">
                <input type="text" name="nome" placeholder="Nome" value="<?= htmlspecialchars($contato->getNome()) ?>">
                <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($contato->getEmail()) ?>">
                <input type="tel" name="telefone" placeholder="Telefone" value="<?= htmlspecialchars($contato->getTelefone()) ?>">
                <button type="submit" name="acao" value="atualizar">Atualizar</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>
