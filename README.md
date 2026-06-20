# Satelite Tornearia

Site de catalogo de produtos para uma tornearia, desenvolvido em PHP com MySQL e Bootstrap.

## Criterios atendidos

### Modelagem e banco de dados
- DER em [`docs/DER.md`](docs/DER.md)
- 4 tabelas: `categorias`, `produtos`, `materiais`, `produto_material`
- Chaves primarias e estrangeiras
- Relacao N:N entre produtos e materiais

### Redes e sistemas operacionais
- Porta **8080** (`deploy/apache-satelite.conf`)
- DNS local `satelite.local` ([`docs/INFRAESTRUTURA.md`](docs/INFRAESTRUTURA.md))
- Banco com IP fixo `192.168.56.20`
- App e banco em maquinas separadas (topologia documentada)
- Listagem de diretorios desabilitada (`public/.htaccess`)

### Desenvolvimento web moderno
- Layout PHP com templates em `templates/`
- Bootstrap 5: navbar, cards, accordion, tabela, alertas, formulario
- Conexao PDO com MySQL
- Dados lidos do banco e exibidos na tela
- Estruturas `if`, `while` e `foreach`

### Logica de programacao
- Produtos organizados em **um unico array** (`montarArrayProdutos`)
- Funcoes customizadas: `calcularFrete`, `aplicarDesconto`, `buscarProdutoPorCodigo`, `filtrarPorPrecoMinimo`
- Entrada por parametros e retorno com `return` (sem globals)
- Busca por codigo e filtro por preco minimo
- Validacao com `validarProdutos` antes do processamento

## Estrutura do projeto

```
satelite/
├── config/database.php
├── database/schema.sql
├── deploy/apache-satelite.conf
├── docs/
├── includes/
├── public/
│   ├── index.php
│   └── assets/
└── templates/
```

## Como rodar

1. Importe `database/schema.sql` no MySQL.
2. Configure credenciais em `config/database.php` ou variaveis `DB_*`.
3. Inicie o servidor:

```powershell
cd public
php -S localhost:8080
```

4. Acesse `http://localhost:8080`.

Para ambiente de entrega com duas VMs, siga [`docs/INFRAESTRUTURA.md`](docs/INFRAESTRUTURA.md).

## Funcionalidades do site

- **Home** com apresentacao da empresa e produtos em destaque
- **Produtos** com catalogo completo: rosca extrusora, canhao extrusora, matriz extrusora e conjuntos de rosca e canhao
- Busca por codigo ou nome
- Filtro por preco minimo
- Calculo de frete e desconto promocional opcional
- Visualizacao em cards e tabela
