<?php
session_start();
    require_once 'cabecalho.php'; 
    
?>
    <section>
        <h1>Adicionar Produto</h1>
        
        <div class="container-form-adicionar">
            <form method="post" id="form-adicionar" action="controle/adicionar_produto.php">
                <labe>
                    <input type="text" name="nome" placeholder="Nome..." />
                </labe>
                <labe>
                    <input type="text" name="preco" placeholder="Preço..." />
                </labe>
                <label>
                    <select name="cor">
                        <option value="0">Selecione</option>
                        <option value="1">Azul</option>
                        <option value="2">Vermelho</option>
                        <option value="3">Amarelho</option>
                    </select>
                </label>
                <labe>
                    <input type="text" name="desconto" placeholder="Desconto..." />
                </labe>

                <button id="btn-adiconar">Salvar</button>
                <a class="btn-voltar" href="index.php">Voltar</a>
            </form>

            <?php if ( isset($_SESSION['msg_vazio']) ): ?>
                <div id="msg-adicionar"><?= $_SESSION['msg_vazio']; ?></div>
            <?php endif; ?>
        </div>
    </section>
    
<?php require_once 'rodape.php'; ?>