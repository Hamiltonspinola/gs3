<?php $this->layout('template/index', ['title' => 'Venda']); ?>

<h1 class="title">Painel de vendas</h1>
<div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                Vendas realizadas
            </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <?php if (!isset($sales) || count($sales) <= 0) { ?>
                    <div class="alert alert-danger" role="alert">
                        Não há venda registrada.
                    </div>
                <?php } else { ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Data da entrega</th>
                                <th>Data da venda</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($sales as $sale) { ?>
                                <tr>
                                    <td><?= $sale->name ?></td>
                                    <td><?= $sale->price ?></td>
                                    <td><?= $sale->delivery ?></td>
                                    <td><?= date("d/m/Y", strtotime($sale->created_at)) ?></td>
                                </tr>
                        <?php }
                        } ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
<h1 class="title">Realizar venda</h1>
<form id="formVenda">
    <div class="row align-items-center">
        <div class="mb-3">
            <label for="dataVenda" class="form-label">Data da Venda</label>
            <input type="date" class="form-control" id="dataVenda" name="dataVenda" required>
        </div>
        <div class="mb-3 col-12 col-md-6">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" class="form-control" id="cep" name="cep" required>
        </div>
        <div class="mb-3 col-12 col-md-6">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" required>
        </div>
        <div class="mb-3 col-12 col-md-4">
            <label for="bairro" class="form-label">Bairro</label>
            <input type="text" class="form-control" id="bairro" name="bairro" required>
        </div>
        <div class="mb-3 col-12 col-md-4">
            <label for="cidade" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade" required>
        </div>
        <div class="mb-3 col-12 col-md-4">
            <label for="uf" class="form-label">UF</label>
            <input type="text" class="form-control" id="uf" name="uf" required>
        </div>
        <h2>Produtos</h2>
        <div class="mb-3">
            <input type="text" id="searchProduct" class="form-control" placeholder="Buscar produto por nome ou referência">
        </div>
        <table class="table table-bordered" id="tabelaProducts">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Fornecedor</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <h2>Venda</h2>
        <table class="table table-bordered" id="tabelaVenda">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Total</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <div class="mb-3">
            <label for="valorTotal" class="form-label">Valor Total</label>
            <input type="text" class="form-control" id="valorTotal" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Salvar Venda</button>
    </div>
</form>