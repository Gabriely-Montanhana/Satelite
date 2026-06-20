<?php

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/produtos_repository.php';

// Carrega os produtos do banco e valida os dados
function carregarProdutosDaAplicacao()
{
    $config = require dirname(__DIR__) . '/config/database.php';
    $pdo = criarConexaoPdo($config);
    $linhas = buscarProdutosDoBanco($pdo);
    $produtos = montarArrayProdutos($linhas);

    if (!validarProdutos($produtos)) {
        throw new Exception('Não foi possível carregar os produtos.');
    }

    return $produtos;
}

// Adiciona frete em cada produto
function processarProdutos($produtos)
{
    $processados = array();
    $i = 0;

    while ($i < count($produtos)) {
        $produto = $produtos[$i];
        $peso = estimarPesoKg($produto['codigo']);

        $produto['frete'] = calcularFrete($produto['preco'], $peso);

        $processados[] = $produto;
        $i++;
    }

    return $processados;
}
