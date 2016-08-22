<?php

class Banco {

    private $pdo;
    private $valorTotal;
    private $dados;

    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:dbname=mercado_x;host=localhost', 'root', '');
        } catch (PDOException $e) {
            echo "Falho: " . $e->getMessage();
        }
    }

    /**
     * Está Classe vai percorre o array de getDados() e salvar armazena o valor total de cada produto;
     */
    public function getValorTotal() {
        $this->valorTotal = 0;
        foreach ($this->getDados() as $value) {
            $this->valorTotal += $value['quantidade'] * $value['valor_unitario'];
        }
        return $this->valorTotal;
    }

    public function getDados() {
        return $this->dados;
    }

    /**
     * seleciona() este método vai consulta no banco todos os produtos e armazena na variavel dados que por sua vez vai virar um array
     */
    public function seleciona() {
        $sql = "SELECT * FROM produtos";
        $sql = $this->pdo->query($sql);
        if ($sql->rowCount() > 0) {
            $this->dados = $sql->fetchAll();
        }
    }

    /**
     * seleciona() este método vai gravar no banco de dados o produto cadastrado
     */
    public function salvar($tabela, $dados) {

        $sql = "INSERT INTO " . $tabela . " SET ";
        $arrayCol = array();
        $arrayValue = array();
        foreach ($dados as $chave => $value) {
            $arrayCol[] = $chave . " = ?";
            $arrayValue[] = $dados[$chave];
        }
        $sql.=implode(", ", $arrayCol);
        $sql = $this->pdo->prepare($sql);
        $sql->execute($arrayValue);
    }

}

?>