<?php
// $produto é passado pela função exibirCardProduto()
if (!isset($produto) || !is_array($produto)) {
    return;
}
?>
<div class="col-md-6 col-lg-4">
    <div class="card h-100">
        <img
            src="<?= htmlspecialchars(obterUrlImagemProduto($produto)) ?>"
            alt="Foto de <?= htmlspecialchars($produto['nome']) ?>"
            class="<?= htmlspecialchars(obterClasseImagemProduto($produto)) ?>"
        >
        <div class="card-body d-flex flex-column">
            <span class="badge badge-satelite mb-2 align-self-start">
                <?= htmlspecialchars($produto['categoria']) ?>
            </span>
            <h5 class="card-title"><?= htmlspecialchars($produto['nome']) ?></h5>
            <p class="text-muted mb-1">
                Código: <?= htmlspecialchars($produto['codigo']) ?>
            </p>
            <p class="card-text flex-grow-1">
                <?= htmlspecialchars($produto['descricao']) ?>
            </p>
            <p class="small text-muted mb-2">
                <?php
                $materiais = $produto['materiais'];
                if ($materiais == '') {
                    $materiais = 'Não informado';
                }
                ?>
                Materiais: <?= htmlspecialchars($materiais) ?>
            </p>
            <div class="mt-auto">
                <p class="h5 preco-destaque mb-1">
                    R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                </p>
                <p class="small text-muted mb-0">
                    Frete estimado: R$ <?= number_format($produto['frete'], 2, ',', '.') ?>
                </p>
            </div>
        </div>
    </div>
</div>
