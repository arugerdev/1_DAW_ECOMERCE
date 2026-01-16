<div class="modal fade" data-backdrop="static" id="modal-product-creator" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Añadir nuevo producto</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" class="create_product_form" id="create_product_form">
                    <section class="form_input_group">
                        <label for="product_name">Nombre del producto: </label>
                        <input type="text" id="product_name" placeholder="Nombre del producto" require="">
                    </section>
                    <section class="form_input_group">
                        <label for="product_price">Precio del producto: </label>
                        <input type="currency" data-type='currency' id="product_price" placeholder="0,00€" value="0" require="">
                    </section>
                    <section class="form_input_group">
                        <label for="product_stock">Stock del producto: </label>
                        <input type="number" id="product_stock" placeholder="0 productos" value="0" require="">
                    </section>
                    <section class="form_input_group">
                        <label for="product_description">Descripción: </label>
                        <textarea id="product_description" cols="100" rows="10" placeholder="Descripcion"></textarea>
                    </section>
                    <section class="form_input_group">
                        <label for="product_category">Categoria: </label>
                        <select id="product_category" placeholder="Descripcion">
                            <option value="0">Sin categoria</option>
                        </select>
                    </section>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn-cancel btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="create_product_form" class="btn btn-success">Añadir producto</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script defer>
    //Close modal on click cancel or a close button
    $('.btn-cancel, .btn-close').on('click', () => {
        $('#modal-product-creator').modal('hide')
    })

    $("input[data-type='currency']").on({
        keyup: function() {
            formatCurrency($(this));
        },
        blur: function() {
            formatCurrency($(this), "blur");
        }
    });

    $(".create_product_form").on('submit', () => {

        const name = $("#product_name").val()
        const price = Number($("#product_price").val().replace(/[^0-9.-]+/g, ""));
        const stock = $("#product_stock").val()
        const description = $("#product_description").val()
        const category = $("#product_category").val()

        insertData("products", "name, price, stock, description, category", `'${name}', ${price}, ${stock}, '${description}', ${category}`, "", (data) => {
            location.reload();
        })

    })
</script>