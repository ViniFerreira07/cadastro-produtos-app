# 📦 Mini ERP - Laravel

Este projeto trata do desenvolvimento de um **sistema Mini ERP**, desenvolvido com o framework **Laravel**. O objetivo do sistema é gerenciar o fluxo de pedidos, produtos, estoque, clientes, cupons e variações de forma eficiente e automatizada.

---

## 🚀 Tecnologias

- PHP 8.x
- Laravel 10.x
- MySQL
- Bootstrap (front-end)
- Blade Templates
- JavaScript
- Webhooks
- Mail (SMTP)

---

## 🗃️ Tabelas Principais

- **Pedidos**
- **Produtos**
- **Estoque**
- **Clientes**
- **Variações**
- **Cupons**

---

## 🔄 Fluxo do Sistema

1. **Cadastro de Produto**  
   O processo se inicia com o cadastro de um novo produto.

2. **Adição ao Carrinho**  
   O produto pode ser adicionado ao carrinho, com ou sem aplicação de cupom de desconto.

3. **Finalização da Compra**  
   Após adicionar os itens ao carrinho, o usuário pode:
   - Cadastrar um novo cliente;
   - Ou selecionar um cliente existente.

4. **Cadastro de Variações (opcional)**  
   É possível cadastrar variações do produto (ex: tamanho, cor).  
   Validação: a soma da quantidade em estoque das variações **não pode exceder** o estoque total do produto.

5. **Geração e Atualização de Estoque**  
   Cada novo produto cadastrado gera automaticamente um controle de estoque.

6. **Finalização do Pedido**  
   Ao finalizar a compra:
   - Um novo registro é salvo na tabela **Pedidos**;
   - O estoque é atualizado conforme a quantidade adquirida;
   - Um **e-mail de confirmação** é enviado para o cliente cadastrado.

---

## 📧 Envio de E-mails

Ao finalizar um pedido, o sistema dispara automaticamente um e-mail de confirmação para o cliente com os detalhes da compra.

---

## 📡 Webhook de Atualização de Pedido

A aplicação expõe o seguinte endpoint para atualização externa do status do pedido:

```http
POST /atualizar-pedido/{id}/{status}

