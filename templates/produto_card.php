<?php
// $produto e passado pela funcao exibirCardProduto()
if (!isset($produto) || !is_array($produto)) {
    return;
}
?>
<div class="col-md-6 col-lg-4">
    <div class="card h-100">
        <img
            src="<?= htmlspecialchars(obterUrlImagemProduto($produto)) ?>"
            alt="Foto de <?= htmlspecialchars($produto['nome']) ?>"
            class="produto-imagem"
        >
        <div class="card-body d-flex flex-column">
            <span class="badge badge-satelite mb-2 align-self-start">
                <?= htmlspecialchars($produto['categoria']) ?>
            </span>
            <h5 class="card-title"><?= htmlspecialchars($produto['nome']) ?></h5>
            <p class="text-muted mb-1">
                Codigo: <?= htmlspecialchars($produto['codigo']) ?>
            </p>
            <p class="card-text flex-grow-1">
                <?= htmlspecialchars($produto['descricao']) ?>
            </p>
            <p class="small text-muted mb-2">
                <?php
                $materiais = $produto['materiais'];
                if ($materiais == '') {
                    $materiais = 'Nao informado';
                }
                ?>
                Materiais: <?= htmlspecialchars($materiais) ?>
            </p>
            <div class="mt-auto">
                <p class="h5 preco-destaque mb-1">
                    R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                </p>
                <?php if ($produto['preco_com_desconto'] < $produto['preco']): ?>
                    <p class="small desconto-verde mb-1">
                        Com desconto: R$ <?= number_format($produto['preco_com_desconto'], 2, ',', '.') ?>
                    </p>
                <?php endif; ?>
                <p class="small text-muted mb-0">
                    Frete estimado: R$ <?= number_format($produto['frete'], 2, ',', '.') ?>
                </p>
            </div>
        </div>
    </div>
</div>
