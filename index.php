<?php include 'Banco.php'; ?>
<meta charset="utf-8">

<form method="post">
    <label>
        Produto: <br>
        <input type="text" name="produto"/><br/>
    </label>
    <label>
        Quantidade: <br>
        <input type="text" name="quantidade"/><br/>
    </label>
    <label>
        Valor Unitário: <br>
        <input type="text" name="valorUnitario"/><br/>
    </label>
    <input type="submit" value="Enviar"/>
</form>
<?php
if (isset($_POST['produto']) && !empty($_POST['produto']) &&
        isset($_POST['quantidade']) && !empty($_POST['quantidade']) &&
        isset($_POST['valorUnitario']) && !empty($_POST['valorUnitario'])) {
    $dados = array("produto" => $_POST['produto'], "quantidade" => $_POST['quantidade'], "valor_unitario" => $_POST['valorUnitario']);
    $conexao = new Banco();
    $conexao->salvar("produtos", $dados);
    echo "<h1>CADASTRADO COM SUCESSO</h1>";
    header("Location: index.php");
}
?>
<hr/>
<h1>Lista de produtos Cadastrados</h1>
<hr/>
<?php
$conexao = new Banco();
$conexao->seleciona();
foreach ($conexao->getDados() as $value) {
    echo '<br/>Produto: ' . $value['produto'];
    echo '<br/>Quantidade: ' . $value['quantidade'];
    echo '<br/> Valor Unitário: ' . $value['valor_unitario'];
    echo '<br/>';
    echo '<br/>';
}
echo "<hr/>";
echo "Valor Total: " . $conexao->getValorTotal();
?>


