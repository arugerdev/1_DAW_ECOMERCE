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
                        <label class="form-label" for="product-name">Nombre del producto: </label>
                        <input class="form-control" type="text" id="product-name" placeholder="Nombre del producto" require="">
                    </section>
                    <section class="mb-3">
                        <label class="form-label" for="product-price">Precio del producto: </label>
                        <input class="form-control" type="currency" data-type='currency' id="product-price" placeholder="0,00€" value="0" require="">
                    </section>
                    <section class="mb-3">
                        <label class="form-label" for="product-stock">Stock del producto: </label>
                        <input class="form-control" type="number" id="product-stock" placeholder="0 productos" value="0" require="">
                    </section>
                    <section class="mb-3">
                        <label class="form-label" for="product-description-short">Descripción corta: </label>
                        <textarea class="form-control" id="product-description-short" cols="100" rows="2" placeholder="Descripcion corta..."></textarea>
                    </section>
                    <section class="mb-3">
                        <label class="form-label" for="product-description">Descripción: </label>
                        <textarea class="form-control" id="product-description" cols="100" rows="10" placeholder="Descripcion"></textarea>
                    </section>
                    <section class="mb-3">
                        <label class="form-label" for="product-category">Categoria: </label>
                        <select class="form-control" id="product-category" placeholder="Descripcion">
                            <option value="0">Sin categoria</option>
                        </select>
                    </section>
                    <section class="mb-3">
                        <label class="form-label" for="product-category">En oferta: </label>
                        <div style="display: flex; flex-direction:row; gap:8px; justify-content:start; place-items:center;">

                            <input type="checkbox" id="on-sale" value="0"></input>
                            <input id="on-sale-discound" type="number" class="p-0 m-0" style="max-width: 60px;" value="0" min="0" max="100" step="0.05">
                            <p class="p-0 m-0">%</p>
                        </div>
                    </section>
                    <section class="mb-3">
                        <label class="form-label">Imágenes del producto</label>
                        <input type="file" id="product_images" multiple accept="image/*">
                        <section class="currentUploadedImages">

                        </section>
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

    .preview-image {
        transition: transform 0.2s;
    }

    .preview-image:hover {
        transform: scale(1.05);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .image-container {
        transition: opacity 0.3s;
    }

    .image-container.removing {
        opacity: 0.5;
    }
</style>

<script defer>
    let uploadedImages = [];

    $('.btn-cancel, .btn-close').on('click', () => {
        cancelUpload();
        $('#modal-product-creator').modal('hide');
    });

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
            contentType: false,
            success: (data) => {
                data = JSON.parse(data);
                data.forEach((src, index) => {
                    const imageId = 'img_' + Date.now() + '_' + index;
                    const imageObj = {
                        id: imageId,
                        path: src,
                        filename: src.split('/').pop()
                    };

                    uploadedImages.push(imageObj);

                    $('.currentUploadedImages').append(
                        `<div class="image-container" style="position: relative; display: inline-block; margin: 5px;">
                            <img id="${imageId}" 
                                 src="${"/uploads" + src.split('/uploads')[1]}" 
                                 style="max-width: 64px; max-height:64px; object-fit:contain; aspect-ratio:1/1; cursor: pointer;" 
                                 class="preview-image"
                                 data-path="${src}" />
                            <button type="button" 
                                    class="btn-remove-image btn-danger" 
                                    style="position: absolute; top: -5px; right: -5px; background: red; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; font-size: 12px; cursor: pointer;"
                                    data-id="${imageId}">×</button>
                        </div>`
                    );
                });

                $(this).val('');
            },
            error: function() {
                alert('Error al subir las imágenes');
            }
        });
    });

    $(document).on('click', '.btn-remove-image', function(e) {
        e.stopPropagation();

        const imageId = $(this).data('id');
        removeSingleImage(imageId);

        uploadedImages = uploadedImages.filter(img => img.id !== imageId);
    });

    $(document).on('click', '.preview-image', function() {
        const imageId = $(this).attr('id');
        removeSingleImage(imageId);

        uploadedImages = uploadedImages.filter(img => img.id !== imageId);
    });

    $(".create_product_form").on('submit', () => {
        const name = $("#product-name").val();
        const price = Number($("#product-price").val().replace(/[^0-9.-]+/g, ""));
        const stock = $("#product-stock").val();
        const short_description = $("#product-description-short").val();
        const description = $("#product-description").val();
        const category = $("#product-category").val();
        const on_sale = $("#on-sale").is(":checked");
        const sale_discound = $("#on-sale-discound").val();

        console.log(`"${name}", ${price}, ${stock}, "${short_description}", "${description}", ${category}, ${on_sale ? 1:0}, ${sale_discound}`)

        insertData(
            "products",
            "name, price, stock, short_description, description, category, on_sale, sale_discound",
            `"${name}", ${price}, ${stock}, "${short_description}", "${description}", ${category}, ${on_sale ? 1:0}, ${sale_discound}`,
            "",
            (data) => {
                $.post('../templates/admin/utils/finalize_product_images.php', {
                    product_id: data.newId,
                    token: tempToken
                }, () => {
                    uploadedImages = [];
                    location.reload();
                });
            }
        );
    });

    function cancelUpload() {
        if (uploadedImages.length > 0) {
            $.ajax({
                url: '../templates/admin/utils/delete_temp_images.php',
                type: 'POST',
                data: {
                    token: tempToken,
                    action: 'delete_all'
                },
                success: function(response) {
                    console.log('Todas las imágenes temporales eliminadas');
                    uploadedImages = [];
                    $('.currentUploadedImages').empty();
                },
                error: function() {
                    console.error('Error al eliminar las imágenes');
                }
            });
        }
    }

    function removeSingleImage(imageId) {
        const imageToDelete = uploadedImages.find(img => img.id === imageId);

        if (imageToDelete) {
            $.ajax({
                url: '../templates/admin/utils/delete_temp_images.php',
                type: 'POST',
                data: {
                    token: tempToken,
                    action: 'delete_single',
                    filename: imageToDelete.filename
                },
                success: function(response) {
                    console.log('Imagen eliminada:', imageId);

                    $(`#${imageId}`).parent().remove();
                },
                error: function() {
                    console.error('Error al eliminar la imagen');
                }
            });
        }
    }
</script>