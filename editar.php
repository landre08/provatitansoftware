<?php
session_start();
    require_once 'cabecalho.php'; 

    require_once 'modelo/Produto.php';

    $produto = new \Produto();
    $produto= $produto->obterProduto($_GET['idprod']);
    
?>
    <section>
        <h1>Editar Produto</h1>
        
        <div class="container-form-adicionar">
            <form method="post" id="form-adicionar" action="controle/editar_produto.php">
                <input type="hidden" name="idprod" value="<?= $produto['idprod'] ?>" />
                <input type="hidden" name="mudar" value="<?= ($produto['cor'] != "0")? 'n':'s' ?>" />
                <labe>
                    <input type="text" name="nome" placeholder="Nome..." value="<?= $produto['nome'] ?>" />
                </labe>
                <labe>
                    <input type="text" name="preco" placeholder="Preço..." value="<?= $produto['preco'] ?>" />
                </labe>
                <label>
                    <select name="cor" <?= ($produto['cor'] != "0")? 'disabled':null ?>>
                        <option value="0">Selecione</option>
                        <option value="1" <?= ($produto['cor'] == "1")? 'selected':null ?>>Azul</option>
                        <option value="2" <?= ($produto['cor'] == "2")? 'selected':null ?>>Vermelho</option>
                        <option value="3" <?= ($produto['cor'] == "3")? 'selected':null ?>>Amarelho</option>
                    </select>
                </label>
                <labe>
                    <input type="text" name="desconto" <?= ($produto['cor'] != "0")? 'disabled':null ?> placeholder="Desconto..." value="<?= $produto['desconto'] ?>" />
                </labe>

                <button id="btn-adiconar">Editar</button>
                <a class="btn-voltar" href="index.php">Voltar</a>
            </form>

            <?php if ( isset($_SESSION['msg_vazio']) ): ?>
                <div id="msg-adicionar"><?= $_SESSION['msg_vazio']; ?></div>
            <?php endif; ?>
        </div>
    </section>
    
<?php require_once 'rodape.php'; ?>