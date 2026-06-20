CREATE DATABASE IF NOT EXISTS tornearia_satelite
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE tornearia_satelite;

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL,
    descricao VARCHAR(255) NOT NULL
);

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(20) NOT NULL UNIQUE,
    nome VARCHAR(120) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    descricao TEXT NOT NULL,
    categoria_id INT NOT NULL,
    destaque TINYINT(1) NOT NULL DEFAULT 0,
    imagem VARCHAR(120) NOT NULL DEFAULT '',
    CONSTRAINT fk_produtos_categoria
        FOREIGN KEY (categoria_id) REFERENCES categorias (id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

CREATE TABLE materiais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL UNIQUE
);

-- Tabela associativa N:N entre produtos e materiais
CREATE TABLE produto_material (
    produto_id INT NOT NULL,
    material_id INT NOT NULL,
    PRIMARY KEY (produto_id, material_id),
    CONSTRAINT fk_pm_produto
        FOREIGN KEY (produto_id) REFERENCES produtos (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT fk_pm_material
        FOREIGN KEY (material_id) REFERENCES materiais (id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

INSERT INTO categorias (nome, descricao) VALUES
('Roscas Extrusoras', 'Roscas usinadas para extrusoras de plastico'),
('Canhões Extrusoras', 'Canhões usinados para linhas de extrusão'),
('Conjuntos Rosca e Canhão', 'Conjuntos completos de rosca e canhão para extrusoras'),
('Cabeçotes', 'Cabeçotes usinados para extrusoras de plastico'),
('Roscas Injetoras', 'Roscas usinadas para injetoras de plastico'),
('Outros', 'Produtos diversos para extrusão e injeção de plastico');

INSERT INTO materiais (nome) VALUES
('Aco 4140'),
('Aco Inox 420'),
('Aco D2'),
('Nitracao superficial'),
('Revestimento cromo duro');

INSERT INTO produtos (codigo, nome, preco, descricao, categoria_id, destaque, imagem) VALUES
('SAT-001', 'Rosca extrusora Ø75mm', 19800.00, 'Rosca usinada para extrusora compacta de Ø75mm.', 1, 0, 'sat-001.jpg'),
('SAT-002', 'Rosca extrusora Ø65mm', 17840.00, 'Rosca extrusora usinada para extrusora de Ø65mm.', 1, 1, 'sat-002.jpeg'),
('SAT-003', 'Rosca extrusora Ø50mm', 12850.00, 'Rosca extrusora para maquina de Ø50mm.', 1, 0, 'sat-003.jpeg'),
('SAT-004', 'Canhão extrusora Ø40mm', 17600.00, 'Canhão usinado para extrusora de Ø40mm com acabamento interno.', 2, 0, 'sat-004.jpeg'),
('SAT-005', 'Conjunto rosca e canhão extrusora Ø75mm', 45580.00, 'Conjunto completo de rosca e canhão usinados para extrusora de Ø75mm.', 3, 0, 'sat-005.jpeg'),
('SAT-006', 'Conjunto rosca e canhão extrusora Ø60mm', 39780.00, 'Conjunto de rosca e canhão extrusora usinados para maquina de Ø90mm.', 3, 1, 'sat-006.jpeg'),
('SAT-007', 'Rosca injetora Ø70mm', 17940.00, 'Rosca injetora usinada para injetora de Ø70mm.', 5, 0, 'sat-007.jpeg'),
('SAT-008', 'Cabeçote Convencional', 35500.00, 'Cabeçote convencional tipo leque para extrusora de filme.', 4, 0, 'sat-008.jpeg'),
('SAT-009', 'Anel de Ar para Extrusora de filme', 18500.00, 'Anel de ar usado em extrusoras de filme.', 6, 0, 'sat-009.jpeg');

INSERT INTO produto_material (produto_id, material_id) VALUES
(1, 1),
(1, 4),
(2, 1),
(2, 4),
(3, 1),
(3, 5),
(4, 1),
(4, 4),
(5, 1),
(5, 4),
(5, 5),
(6, 1),
(6, 4),
(6, 5),
(7, 1),
(7, 4),
(7, 5),
(8, 2),
(8, 4),
(8, 5),
(9, 1),
(9, 4),
(9, 5);