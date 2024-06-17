$(document).ready(() => {
    const ENDPOINTS = { products: 'product/show', sales: 'sale/store' };
    const SELECTORS = { searchProduct: '#searchProduct', tableProducts: '#tabelaProducts tbody', tableSale: '#tabelaVenda tbody', formSale: '#formVenda', totalValue: '#valorTotal' };
    const ADDRESS_FIELDS = ['#dataVenda', '#endereco', '#bairro', '#cidade', '#uf', '#cep'];

    const searchProducts = query => $.post(ENDPOINTS.products, { value: query }, data => {
        const rows = data.success ? data.products.map(p => `
            <tr>
                <td class="product-id">${p.id}</td>
                <td>${p.product}</td>
                <td>${p.price}</td>
                <td>${p.supplier}</td>
                <td><button type="button" class="btn btn-primary addProduct">Adicionar</button></td>
            </tr>`).join('') : '<tr><td colspan="5">Nenhum produto encontrado</td></tr>';
        $(SELECTORS.tableProducts).html(rows);
    }, 'json');

    const loadProducts = () => searchProducts($(SELECTORS.searchProduct).val());

    const addProductToSale = row => {
        const id = row.find('.product-id').text(), nome = row.find('td:eq(1)').text(), preco = parseFloat(row.find('td:eq(2)').text());
        const newRow = `
            <tr>
                <td class="product-id">${id}</td>
                <td>${nome}</td>
                <td>${preco.toFixed(2)}</td>
                <td>1</td>
                <td>${preco.toFixed(2)}</td>
                <td><button type="button" class="btn btn-danger removeProduct">Remover</button></td>
            </tr>`;
        $(SELECTORS.tableSale).append(newRow);
        calculateTotal();
    };

    const calculateTotal = () => {
        const total = $(SELECTORS.tableSale).find('tr').toArray().reduce((sum, tr) => sum + parseFloat($(tr).find('td:eq(4)').text()), 0);
        $(SELECTORS.totalValue).val(total.toFixed(2));
    };

    const validateForm = () => ADDRESS_FIELDS.every(selector => $(selector).val().trim()) || (alert('Todos os campos do endereço e a data da venda são obrigatórios.'), false);

    const handleFormSubmit = e => {
        e.preventDefault();
        if (!validateForm()) return;

        const saleData = { 
            dataVenda: $(ADDRESS_FIELDS[0]).val(), 
            endereco: $(ADDRESS_FIELDS[1]).val(), 
            bairro: $(ADDRESS_FIELDS[2]).val(), 
            cidade: $(ADDRESS_FIELDS[3]).val(), 
            uf: $(ADDRESS_FIELDS[4]).val(), 
            cep: $(ADDRESS_FIELDS[5]).val(), 
            valorTotal: $(SELECTORS.totalValue).val(),
            produtos: $(SELECTORS.tableSale).find('tr').map((_, tr) => ({ id: $(tr).find('.product-id').text(), quantidade: 1, preco: parseFloat($(tr).find('td:eq(2)').text()) })).get()
        };

        $.post(ENDPOINTS.sales, saleData, response => {
            alert('Venda salva com sucesso!');
            window.location.reload(true);
        });
    };

    $(SELECTORS.searchProduct).on('keyup', loadProducts);
    $(document).on('click', '.addProduct', function() { addProductToSale($(this).closest('tr')); });
    $(document).on('click', '.removeProduct', function() { $(this).closest('tr').remove(); calculateTotal(); });
    $(SELECTORS.formSale).on('submit', handleFormSubmit);

    loadProducts();
});
