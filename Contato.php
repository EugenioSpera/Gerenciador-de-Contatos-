<?php 

class Contato {
    private $nome;
    private $email;
    private $telefone;

    public function __construct($nome, $email, $telefone) {
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;              
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setNome($nome): self {
        $this->nome = $nome;
        return $this;
    }

    public function setEmail($email): self {
        $this->email = $email;
        return $this;
    }

    public function setTelefone($telefone): self {
        $this->telefone = $telefone;
        return $this;
    }
}
?>
