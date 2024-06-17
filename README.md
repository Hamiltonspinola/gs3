# Sistema de Vendas

Este projeto é um sistema de vendas que permite buscar produtos, adicioná-los a uma lista de venda e salvar as vendas no banco de dados. O projeto foi desenvolvido utilizando HTML, CSS, JavaScript (jQuery), e PHP para o backend.

## Considerações

O sistema foi implementado de forma simples, porém escalável. Foi aplicado conceitos de orientação objeto, clean code, e MVC.
Contudo, acredito que é possível avaliar a legibilidade do código e arquitetura proposta.

## Funcionalidades

1. **Buscar Produtos**: Os produtos podem ser buscados pelo nome ou referência utilizando um campo de busca. Quando o campo de busca está vazio, todos os produtos são listados.
2. **Adicionar Produto à Venda**: Produtos podem ser adicionados à lista de venda através de um botão.
3. **Remover Produto da Venda**: Produtos podem ser removidos da lista de venda.
4. **Calcular Total da Venda**: O valor total da venda é calculado automaticamente conforme os produtos são adicionados ou removidos.
5. **Salvar Venda**: A venda é salva no banco de dados, incluindo os detalhes dos produtos.

## Como Executar o Projeto

1.  Clone o repositório para sua máquina local.
2.  Configure o banco de dados conforme as instruções acima.
3.  Garanta que o servidor esteja configurado para interpretar PHP.
4.  Dentro da pasta do projeto execute "composer update -W"
5.  **Adaptar a implementação do método find() do Datalayer**
    - Acessar: /vendor/coffeecode/datalayer/src/DataLayer.php
    - Encontre o método find()
    - Subistitua por:
      public function find(?string $terms = null, ?string $params = null, string $columns = "*", array $extraAttr = ['join' => false, 'clausure' => ''], array $customQuery = ['active' => false, 'query' => '']): DataLayer
      {
        if ($customQuery['active']) {
            $this->statement = "SELECT {$columns} FROM {$this->entity} {$customQuery['query']}";
            parse_str($params ?? "", $this->params);
            return $this;
        }
        if ($extraAttr['join']) {
            $this->statement = "SELECT {$columns} FROM {$this->entity} {$extraAttr['clausure']} WHERE {$terms}";
            parse_str($params ?? "", $this->params);
            return $this;
        }
        if ($terms) {
        $this->statement = "SELECT {$columns} FROM {$this->entity} WHERE {$terms}";
        parse_str($params ?? "", $this->params);
        return $this;
        }
        $this->statement = "SELECT {$columns} FROM {$this->entity}";
        return $this;

     }
4.  Abra o projeto no navegador.
5.  Utilize o campo de busca para procurar produtos e adicioná-los à lista de vendas.
6.  Clique em "Salvar Venda" para registrar a venda no banco de dados.

## Requisitos

- Servidor web (Apache, Nginx, etc.)
- PHP 7.4+
- Banco de Dados MySQL

## Contato

Para dúvidas ou mais informações, estou disponível em:

1. Whatsapp: (71) 996911996
1. Email: hamiltonmoraes64@gmail.om

## Estrutura do Banco de Dados

```sql
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reference` (`reference`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `product`;
INSERT INTO `product` (`id`, `name`, `reference`, `price`) VALUES
	(1, 'Leite em pó', 'REFLP150620241443', 7.99),
	(2, 'Nescau', 'REFN150620241443REFLP150620241444', 17.99),
	(3, 'Produto 1', 'REF001', 10),
	(4, 'Produto 2', 'REF002', 20),
	(5, 'Produto 3', 'REF003', 30),
	(6, 'Produto 4', 'REF004', 40),
	(7, 'Produto 5', 'REF005', 50),
	(8, 'Produto 6', 'REF006', 60),
	(9, 'Produto 7', 'REF007', 70),
	(10, 'Produto 8', 'REF008', 80),
	(11, 'Produto 9', 'REF009', 90),
	(12, 'Produto 10', 'REF0010', 100),
	(13, 'Produto 11', 'REF0011', 110);

CREATE TABLE IF NOT EXISTS `product_historic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `start_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK___product` (`product_id`),
  CONSTRAINT `FK___product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `product_historic`;

CREATE TABLE IF NOT EXISTS `product_sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`),
  KEY `FK__sale__product_sale` (`sale_id`),
  KEY `FK___product_product_sale` (`product_id`),
  CONSTRAINT `FK___product_product_sale` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK__sale__product_sale` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `product_sale`;

CREATE TABLE IF NOT EXISTS `product_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__product` (`product_id`),
  KEY `FK__supplier` (`supplier_id`),
  CONSTRAINT `FK__product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela gs3.product_supplier: ~10 rows (aproximadamente)
DELETE FROM `product_supplier`;
INSERT INTO `product_supplier` (`id`, `product_id`, `supplier_id`) VALUES
	(1, 1, 1),
	(2, 2, 2),
	(3, 3, 3),
	(4, 5, 4),
	(5, 6, 1),
	(6, 7, 2),
	(7, 8, 3),
	(8, 9, 4),
	(9, 10, 1),
	(10, 11, 2);

CREATE TABLE IF NOT EXISTS `sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery` date NOT NULL,
  `address` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `sale`;

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `supplier`;
INSERT INTO `supplier` (`id`, `name`) VALUES
	(1, 'Nestlé'),
	(2, 'Sadia'),
	(3, 'Perdigão'),
	(4, 'Colgate');