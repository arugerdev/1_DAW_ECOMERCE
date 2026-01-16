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

                    <section class="mb-3">
                        <label class="form-label" for="product_name">Nombre del producto: </label>
                        <input class="form-control" type="text" id="product_name" placeholder="Nombre del producto" require="">
                    </section>
                    <section class="mb-3">
                        <label class="form-label" for="product_price">Precio del producto: </label>
                        <input class="form-control" type="currency" data-type='currency' id="product_price" placeholder="0,00€" value="0" require="">
                    </section>
                    <section class="mb-3">
                        <label class="form-label" for="product_stock">Stock del producto: </label>
                        <input class="form-control" type="number" id="product_stock" placeholder="0 productos" value="0" require="">
                    </section>
                    <section class="mb-3">
                        <label class="form-label" for="product_description_short">Descripción corta: </label>
                        <textarea class="form-control" id="product_description_short" cols="100" rows="5" placeholder="Descripcion corta..."></textarea>
                    </section>
                    <section class="mb-3">
                        <label class="form-label" for="product_description">Descripción: </label>
                        <textarea class="form-control" id="product_description" cols="100" rows="20" placeholder="Descripcion"></textarea>
                    </section>
                    <section class="mb-3">
                        <label class="form-label" for="product_category">Categoria: </label>
                        <select class="form-control" id="product_category" placeholder="Descripcion">
                            <option value="0">Sin categoria</option>
                        </select>
                    </section>

                    <section class="mb-3">
                        <label class="form-label">Imágenes del producto</label>
                        <input type="file" id="product_images" multiple accept="image/*">
                    </section>


                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn-cancel btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="create_product_form" class="btn btn-success">Añadir producto</button>
            </div>
        </div>
    </div>
</div>

<style>
    .create_product_form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .create_product_form .form_input_group {
        display: flex;
        flex-direction: row;
        gap: 12px;
    }

    .create_product_form input {
        display: flex;
        padding: 12px 4px;
    }
</style>

<script defer>
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

    $("#product_images").on('change', function() {
        const files = this.files;
        if (!files.length) return;

        const fd = new FormData();
        fd.append('token', tempToken);

        for (const file of files) {
            fd.append('images[]', file);
        }

        $.ajax({
            url: '../templates/admin/utils/upload_temp_img.php',
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false
        });
    });


    $(".create_product_form").on('submit', () => {

        const name = $("#product_name").val()
        const price = Number($("#product_price").val().replace(/[^0-9.-]+/g, ""));
        const stock = $("#product_stock").val()
        const short_description = $("#product_description_short").val()
        const description = $("#product_description").val()
        const category = $("#product_category").val()

        insertData(
            "products",
            "name, price, stock,shortDescription, description, category",
            `"${name}", ${price}, ${stock}, "${short_description}", "${description}", ${category}`,
            "",
            (data) => {

                $.post('../templates/admin/utils/finalize_product_images.php', {
                    product_id: data.newId,
                    token: tempToken
                }, () => location.reload());

                // location.reload();
            })

    })
</script>