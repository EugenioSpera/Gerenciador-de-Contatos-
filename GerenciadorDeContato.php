<?php

class GerenciadorDeContato {
    private $contatos = [];
    private $arquivo = 'contatos.json'; // Nome do arquivo para salvar os contatos

    public function __construct() {
        $this->carregarContatos();
    }

    public function adicionarContato($nome, $email, $telefone) {
        $contato = new Contato($nome, $email, $telefone);
        $this->contatos[] = $contato;
        $this->salvarContatos();
    }

    public function getContatos() {
        return $this->contatos;
    }

    public function deletarContato($indice) {
        if (isset($this->contatos[$indice])) {
            array_splice($this->contatos, $indice, 1);
            $this->salvarContatos();
        }
    }

    public function atualizarContato($indice, $nome, $email, $telefone) {
        if (isset($this->contatos[$indice])) {
            $this->contatos[$indice]->setNome($nome);
            $this->contatos[$indice]->setEmail($email);
            $this->contatos[$indice]->setTelefone($telefone);
            $this->salvarContatos();
        }
    }

    public function buscarContato($termo) {
        $resultados = [];
        foreach ($this->contatos as $contato) {
            if (stripos($contato->getNome(), $termo) !== false ||
                stripos($contato->getEmail(), $termo) !== false ||
                stripos($contato->getTelefone(), $termo) !== false) {
                $resultados[] = $contato;
            }
        }
        return $resultados;
    }

    public function contarContatos() {
        return count($this->contatos);
    }

    private function salvarContatos() {
        $dados = [];
        foreach ($this->contatos as $contato) {
            $dados[] = [
                'nome' => $contato->getNome(),
                'email' => $contato->getEmail(),
                'telefone' => $contato->getTelefone()
            ];
        }
        file_put_contents($this->arquivo, json_encode($dados, JSON_PRETTY_PRINT));
    }

    private function carregarContatos() {
        if (file_exists($this->arquivo)) {
            $dados = json_decode(file_get_contents($this->arquivo), true);
            if ($dados) {
                foreach ($dados as $item) {
                    $this->contatos[] = new Contato($item['nome'], $item['email'], $item['telefone']);
                }
            }
        }
    }
}
?>
