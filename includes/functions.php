<?php
// Verifica se a lista de produtos esta correta
function validarProdutos($produtos)
{
    if (count($produtos) == 0) {
        return false;
    }

    foreach ($produtos as $produto) {
        if (!isset($produto['codigo']) || !isset($produto['nome']) || !isset($produto['preco'])) {
            return false;
        }

        if ($produto['preco'] < 0) {
            return false;
        }

        if (trim($produto['codigo']) == '') {
            return false;
        }
    }

    return true;
}

// Transforma as linhas do banco em um unico array de produtos
function montarArrayProdutos($linhas)
{
    $produtos = array();

    foreach ($linhas as $linha) {
        $produtos[] = array(
            'id' => (int) $linha['id'],
            'codigo' => $linha['codigo'],
            'nome' => $linha['nome'],
            'preco' => (float) $linha['preco'],
            'descricao' => $linha['descricao'],
            'categoria' => $linha['categoria_nome'],
            'materiais' => $linha['materiais'],
            'destaque' => ($linha['destaque'] == 1),
            'imagem' => $linha['imagem'],
        );
    }

    return $produtos;
}

// Procura um produto pelo codigo (ex: SAT-002)
function buscarProdutoPorCodigo($produtos, $codigo)
{
    $codigo = strtoupper(trim($codigo));

    foreach ($produtos as $produto) {
        if (strtoupper($produto['codigo']) == $codigo) {
            return $produto;
        }
    }

    return null;
}

// Mostra apenas produtos com preco maior ou igual ao informado
function filtrarPorPrecoMinimo($produtos, $precoMinimo)
{
    $filtrados = array();

    foreach ($produtos as $produto) {
        if ($produto['preco'] >= $precoMinimo) {
            $filtrados[] = $produto;
        }
    }

    return $filtrados;
}

// Busca produtos pelo nome ou categoria
function filtrarPorTermo($produtos, $termo)
{
    $termo = strtolower(trim($termo));

    if ($termo == '') {
        return $produtos;
    }

    $filtrados = array();

    foreach ($produtos as $produto) {
        $nome = strtolower($produto['nome']);
        $categoria = strtolower($produto['categoria']);

        if (strpos($nome, $termo) !== false || strpos($categoria, $termo) !== false) {
            $filtrados[] = $produto;
        }
    }

    return $filtrados;
}

// Pega os produtos marcados como destaque para a home
function selecionarProdutosDestaque($produtos, $limite = 3)
{
    $destaques = array();

    foreach ($produtos as $produto) {
        if ($produto['destaque'] == true) {
            $destaques[] = $produto;
        }
    }

    if (count($destaques) == 0) {
        return array_slice($produtos, 0, $limite);
    }

    return array_slice($destaques, 0, $limite);
}

// Calcula o valor do frete
function calcularFrete($preco, $pesoKg)
{
    if ($preco <= 0 || $pesoKg <= 0) {
        return 0;
    }

    $taxaBase = 18;
    $taxaPorKg = 4.5;
    $seguro = $preco * 0.02;

    return round($taxaBase + ($pesoKg * $taxaPorKg) + $seguro, 2);
}

// Mostra o card de um produto na tela
function exibirCardProduto($produto)
{
    require dirname(__DIR__) . '/templates/produto_card.php';
}

// Retorna classes CSS da foto do produto
function obterClasseImagemProduto($produto)
{
    $classe = 'produto-imagem';
    $codigosFotoInteira = array('SAT-004', 'SAT-008', 'SAT-009');

    if (isset($produto['codigo']) && in_array(strtoupper($produto['codigo']), $codigosFotoInteira)) {
        $classe = $classe . ' produto-imagem-inteira';
    }

    return $classe;
}

// Retorna o caminho da foto do produto para usar no HTML
function obterUrlImagemProduto($produto)
{
    $pastaWeb = 'assets/img/produtos/';
    $semFoto = $pastaWeb . 'sem-foto.svg';
    $pastaFisica = dirname(__DIR__) . '/public/' . $pastaWeb;

    if (!isset($produto['imagem']) || trim($produto['imagem']) == '') {
        return $semFoto;
    }

    $nomeArquivo = trim($produto['imagem']);
    $caminhoFisico = $pastaFisica . $nomeArquivo;

    if (file_exists($caminhoFisico)) {
        return $pastaWeb . $nomeArquivo;
    }

    return $semFoto;
}

// Estima o peso do produto usando o tamanho do codigo
function estimarPesoKg($codigo)
{
    $peso = 1.0;
    $i = 0;
    $tamanho = strlen($codigo);

    while ($i < $tamanho) {
        $peso = $peso + 0.1;
        $i++;
    }

    return round($peso, 1);
}
