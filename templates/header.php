<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($tituloPagina ?? 'Satelite Tornearia', ENT_QUOTES, 'UTF-8') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/img/logo.png">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-satelite mb-4">
        <div class="container">
            <img src="assets/img/logo.png" alt="Logo da Tornearia Satélite">
            <a class="navbar-brand fw-bold navbar-brand-satelite" href="index.php">Tornearia Satélite</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= ($paginaAtual ?? '') === 'home' ? 'active' : '' ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($paginaAtual ?? '') === 'produtos' ? 'active' : '' ?>" href="produtos.php">Produtos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container pb-5">