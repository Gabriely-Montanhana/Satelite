<?php

// Cria a conexao com o banco de dados
function criarConexaoPdo($config)
{
    $dsn = 'mysql:host=' . $config['host']
        . ';port=' . $config['port']
        . ';dbname=' . $config['database']
        . ';charset=' . $config['charset'];

    $pdo = new PDO($dsn, $config['username'], $config['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}

// Busca todos os produtos no banco
function buscarProdutosDoBanco($pdo)
{
    $sql = "
        SELECT
            p.id,
            p.codigo,
            p.nome,
            p.preco,
            p.descricao,
            p.destaque,
            p.imagem,
            c.nome AS categoria_nome,
            GROUP_CONCAT(m.nome ORDER BY m.nome SEPARATOR ', ') AS materiais
        FROM produtos p
        INNER JOIN categorias c ON c.id = p.categoria_id
        LEFT JOIN produto_material pm ON pm.produto_id = p.id
        LEFT JOIN materiais m ON m.id = pm.material_id
        GROUP BY p.id
        ORDER BY p.nome ASC
    ";

    $resultado = $pdo->query($sql);

    return $resultado->fetchAll(PDO::FETCH_ASSOC);
}
