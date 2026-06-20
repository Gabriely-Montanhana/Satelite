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
        throw new Exception('Nao foi possivel carregar os produtos.');
    }

    return $produtos;
}

// Adiciona frete e desconto em cada produto
function processarProdutos($produtos, $percentualDesconto = 0)
{
    $processados = array();
    $i = 0;

    while ($i < count($produtos)) {
        $produto = $produtos[$i];
        $peso = estimarPesoKg($produto['codigo']);

        $produto['frete'] = calcularFrete($produto['preco'], $peso);
        $produto['preco_com_desconto'] = aplicarDesconto($produto['preco'], $percentualDesconto);

        $processados[] = $produto;
        $i++;
    }

    return $processados;
}
