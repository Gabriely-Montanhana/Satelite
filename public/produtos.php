<?php

require_once dirname(__DIR__) . '/includes/app.php';

$tituloPagina = 'Tornearia Satélite | Produtos';
$paginaAtual = 'produtos';
$erro = null;
$produtosExibidos = array();
$totalProdutos = 0;

$termoBusca = '';
if (isset($_GET['busca'])) {
    $termoBusca = trim($_GET['busca']);
}

$precoMinimo = 0;
if (isset($_GET['preco_min']) && $_GET['preco_min'] != '') {
    $precoMinimo = (float) $_GET['preco_min'];
}

try {
    $produtos = carregarProdutosDaAplicacao();
    $produtosExibidos = $produtos;

    if ($termoBusca != '') {
        $produtoEncontrado = buscarProdutoPorCodigo($produtos, $termoBusca);

        if ($produtoEncontrado != null) {
            $produtosExibidos = array($produtoEncontrado);
        } else {
            $produtosExibidos = filtrarPorTermo($produtos, $termoBusca);
        }
    } elseif ($precoMinimo > 0) {
        $produtosExibidos = filtrarPorPrecoMinimo($produtos, $precoMinimo);
    }

    $produtosExibidos = processarProdutos($produtosExibidos);
    $totalProdutos = count($produtosExibidos);
} catch (Exception $e) {
    $erro = $e->getMessage();
}

require dirname(__DIR__) . '/templates/header.php';
?>

<section class="page-header rounded-3 p-4 p-md-5 mb-4">
    <h1 class="display-6 fw-bold mb-2">Catálogo de produtos</h1>
    <p class="lead mb-0">
        Roscas extrusoras, canhões extrusoras e conjuntos de rosca e canhão.
    </p>
</section>

<?php if ($erro != null): ?>
    <div class="alert alert-danger" role="alert">
        Não foi possível carregar os produtos: <?= htmlspecialchars($erro) ?>
    </div>
<?php else: ?>
    <div class="accordion mb-4" id="filtrosAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#painelFiltros">
                    Buscar e filtrar produtos
                </button>
            </h2>
            <div id="painelFiltros" class="accordion-collapse collapse show" data-bs-parent="#filtrosAccordion">
                <div class="accordion-body">
                    <form class="row g-3" method="get" action="produtos.php">
                        <div class="col-md-4">
                            <label for="busca" class="form-label">Código ou nome</label>
                            <input
                                type="text"
                                class="form-control"
                                id="busca"
                                name="busca"
                                placeholder="Ex: SAT-002 ou rosca extrusora"
                                value="<?= htmlspecialchars($termoBusca) ?>"
                            >
                        </div>
                        <div class="col-md-4">
                            <label for="preco_min" class="form-label">Preço mínimo (R$)</label>
                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                class="form-control"
                                id="preco_min"
                                name="preco_min"
                                value="<?= $precoMinimo > 0 ? htmlspecialchars((string) $precoMinimo) : '' ?>"
                            >
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-satelite">Filtrar</button>
                            <a href="produtos.php" class="btn btn-outline-satelite">Limpar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if ($totalProdutos == 0): ?>
        <div class="alert alert-warning" role="alert">
            Nenhum produto encontrado para os filtros informados.
        </div>
    <?php else: ?>
        <p class="text-muted mb-3">
            <?= $totalProdutos ?> produto(s) encontrado(s).
        </p>

        <div class="row g-4 mb-5">
            <?php foreach ($produtosExibidos as $produto): ?>
                <?php exibirCardProduto($produto); ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php require dirname(__DIR__) . '/templates/footer.php'; ?>
