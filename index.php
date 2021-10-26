<?php 
session_start();
unset($_SESSION['msg_vazio']);

require_once 'cabecalho.php'; 
require_once 'modelo/Produto.php';

$produto = new \Produto();
$produtos= $produto->listar();

?>

    <section>
        <h1>CRUD de Produtos</h1>
        
        <main>
            <div class="container-main">
                <div>
                    <a href="adicionar.php" id="btn-adicionar">Adicionar</a>
                </div>
                <?php if (count($produtos) > 0): ?>
                <div>
                    <form id="form-pesq" method="post">
                        <label>
                            <input type="text" name="pesq_nome" placeholder="Digite nome do produto..." required />
                        </label>

                        <label>
                            <select name="pesq_cor">
                                <option value="0">Selecione</option>
                                <option value="1">Azul</option>
                                <option value="2">Vermelho</option>
                                <option value="3">Amarelho</option>
                            </select>
                        </label>

                        <label>
                            <input type="number" name="pesq_preco" placeholder="Digite preço do produto..." required />
                        </label>

                        <button id="btn_pesquisar">Pesquisar</button>
                    </form>
                </div>
                <div>
                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Desconto</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($produtos as $idp => $prod): ?>
                                <tr>
                                    <td><?= $prod['idprod'] ?></td>
                                    <td><?= $prod['nome'] ?></td>
                                    <td>R$ <?= number_format($prod['preco'], 2, ',', ' ') ?></td>
                                    <td>R$ <?= number_format($prod['desconto'], 2, ',', ' ') ?></td>
                                    <td>
                                        <a id="btn_editar" href="editar.php?idprod=<?= $prod['idprod'] ?>">Editar</a>
                                        <a id="btn_excluir" onclick="return confirm()" href="controle/excluir_produto.php?idprod=<?= $prod['idprod'] ?>">Excluir</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>
        </main>
    </section>

<?php require_once 'rodape.php'; ?>