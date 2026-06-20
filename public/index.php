<?php

require_once dirname(__DIR__) . '/includes/app.php';

$tituloPagina = 'Satelite Tornearia | Home';
$paginaAtual = 'home';
$erro = null;
$produtosDestaque = array();

try {
    $produtos = carregarProdutosDaAplicacao();
    $destaques = selecionarProdutosDestaque($produtos, 4);
    $produtosDestaque = processarProdutos($destaques);
} catch (Exception $e) {
    $erro = $e->getMessage();
}

require dirname(__DIR__) . '/templates/header.php';
require dirname(__DIR__) . '/templates/empresa_sobre.php';
?>

<?php if ($erro != null): ?>
    <div class="alert alert-danger" role="alert">
        Nao foi possivel carregar os produtos em destaque: <?= htmlspecialchars($erro) ?>
    </div>
<?php else: ?>
    <section>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h3 fw-bold mb-1 section-title">Produtos em destaque</h2>
                <p class="text-muted mb-0">Alguns dos itens mais solicitados pela nossa clientela.</p>
            </div>
            <a href="produtos.php" class="btn btn-outline-satelite d-none d-md-inline-block">Ver catalogo completo</a>
        </div>

        <div class="row g-4 mb-4">
            <?php foreach ($produtosDestaque as $produto): ?>
                <?php exibirCardProduto($produto); ?>
            <?php endforeach; ?>
        </div>

        <div class="text-center d-md-none">
            <a href="produtos.php" class="btn tn-outline-satelite">Ver catalogo completo</a>
        </div>
    </section>
<?php endif; ?>

<?php require dirname(__DIR__) . '/templates/footer.php'; ?>
