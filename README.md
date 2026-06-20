# Tornearia Satélite

Site de catálogo de produtos para uma tornearia, desenvolvido em **PHP**, **MySQL** e **Bootstrap 5**.

## Sobre o projeto

Aplicação web que exibe produtos usinados (roscas, canhões, conjuntos, cabeçotes e outros) com dados lidos do banco de dados. O layout usa tema escuro com destaque em verde.

## Funcionalidades

- **Home** — apresentação da empresa e produtos em destaque
- **Produtos** — catálogo completo com cards
- **Fotos** — imagem por produto (com placeholder quando não houver arquivo)
- **Busca** — por código (ex: `SAT-002`) ou por nome/categoria
- **Filtro** — por preço mínimo
- **Frete estimado** — calculado por função PHP
- **Materiais** — relação N:N entre produtos e materiais no banco

## Banco de dados

### Tabelas

| Tabela | Descrição |
|--------|-----------|
| `categorias` | Tipos de produto |
| `produtos` | Catálogo (código, nome, preço, foto, destaque) |
| `materiais` | Materiais usados na fabricação |
| `produto_material` | Relação N:N entre produtos e materiais |

### Categorias cadastradas

1. Roscas Extrusoras  
2. Canhões Extrusoras  
3. Conjuntos Rosca e Canhão  
4. Cabeçotes  
5. Roscas Injetoras  
6. Outros  

### Produtos em destaque (home)

Produtos com `destaque = 1` no banco. Atualmente:

- SAT-002 — Rosca extrusora 65mm  
- SAT-006 — Conjunto rosca e canhão extrusora 60mm  
- SAT-007 — Rosca injetora 70mm  

Para alterar:

```sql
UPDATE produtos SET destaque = 1 WHERE codigo = 'SAT-003';
UPDATE produtos SET destaque = 0 WHERE codigo = 'SAT-002';
```

## Estrutura do projeto

```
satelite/
├── config/
│   └── database.php        
├── database/
│   ├── schema.sql          
├── includes/
│   ├── app.php
│   ├── functions.php
│   └── produtos_repository.php
├── public/
│   ├── index.php
│   ├── produtos.php
│   ├── assets/css/style.css
│   └── assets/img/produtos/  
└── templates/
    ├── header.php
    ├── footer.php
    ├── empresa_sobre.php
    └── produto_card.php
```

## Como rodar

### 1. Banco de dados

Importe o schema no MySQL (phpMyAdmin ou terminal):

```bash
mysql -u root -p < database/schema.sql
```

### 2. Configurar conexão

Crie o arquivo `config/database.php` com os dados do seu MySQL:

```php
<?php

return [
    'host' => '127.0.0.1',
    'port' => 3306,
    'database' => 'tornearia_satelite',
    'charset' => 'utf8mb4',
    'username' => 'root',
    'password' => 'sua_senha',
];
```

> **Importante:** `config/database.php` está no `.gitignore` e **não deve ser enviado ao GitHub** (contém senha).

### 3. Fotos dos produtos

Coloque as imagens em `public/assets/img/produtos/` com o mesmo nome do campo `imagem` no banco:

| Código | Arquivo |
|--------|---------|
| SAT-001 | `sat-001.jpg` |
| SAT-002 | `sat-002.jpeg` |
| SAT-003 | `sat-003.jpeg` |
| ... | ... |

Se a foto não existir, o site exibe `sem-foto.svg`.

Acesse: `http://localhost:8080`

## VirtualBox (banco em VM separada)

Se o MySQL estiver em uma máquina virtual:

1. Ajuste o `host` em `config/database.php` para o IP da VM (ex: `192.168.56.102`)
2. Após alterar `schema.sql`, sincronize na VM:

```powershell
cmd /c "mysql --default-character-set=utf8mb4 -h IP_DA_VM -u usuario -p tornearia_satelite < database\sync_virtualbox.sql"
cmd /c "mysql --default-character-set=utf8mb4 -h IP_DA_VM -u usuario -p tornearia_satelite < database\sync_virtualbox_utf8.sql"
```

> O arquivo `schema.sql` **não atualiza sozinho** a VM. É preciso rodar o SQL manualmente ou usar os scripts de sync.

## Lógica PHP (critérios acadêmicos)

- Produtos em **um único array** (`montarArrayProdutos`)
- Estruturas **`if`**, **`while`** e **`foreach`**
- Funções com **`return`**: `calcularFrete`, `buscarProdutoPorCodigo`, `filtrarPorPrecoMinimo`, `exibirCardProduto`
- Conexão **PDO** com MySQL
- Validação com `validarProdutos` antes de exibir os dados

## GitHub

Pode subir o projeto como repositório **público** ou **privado**.

**Não envie ao GitHub:**

- `config/database.php` (senhas)
- Arquivos `.env`

**Pode enviar:**

- Código PHP, CSS, templates
- `database/schema.sql`
- Imagens de produtos (se quiser)
