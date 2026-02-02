<div class="modal fade" data-backdrop="static" id="modal-product-creator" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Añadir nuevo producto</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="create_product_form">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">General</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="product-name">Nombre del producto</label>
                                        <input type="text" id="product-name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="product-price">Precio del producto</label>
                                        <input type="currency" data-type="currency" placeholder="0,00<?php echo SHOP_DATA->currency_symbol ?>" id="product-price" class="form-control">
                                        <label id="product-w-tax-price">0.00<?php echo SHOP_DATA->currency_symbol ?> con 21% IVA</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="product-stock">Stock del producto</label>
                                        <input type="number" placeholder="20" value="0" min="0" step="1" id="product-stock" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="product-category">Categoria</label>
                                        <select id="product-category" class="form-control custom-select">
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Info</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="product-description-short">Descripción corta del producto</label>
                                        <textarea id="product-description-short" class="form-control" rows="2"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="product-description">Descripción del producto</label>
                                        <textarea id="product-description" class="form-control" rows="10"></textarea>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Ofertas</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="on-sale">En Oferta</label>
                                        <input type="checkbox" id="on-sale">
                                    </div>
                                    <div class="form-group">
                                        <label for="on-sale-discound">% de oferta</label>
                                        <input type="number" step="0.05" min="0" max="100" value="0" id="on-sale-discound" class="form-control">
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Imagenes</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <!-- <input class="dropzone w-100 h-100" type="file" id="product_images" multiple accept="image/*"> -->

                                        <label class="dropzone-file-upload" for="product_images">
                                            <i class="fa-solid fa-images icon fs-1"></i>
                                            <div class="text">
                                                <span>Haz clic para subir imagen<small>/es</small></span>
                                            </div>
                                            <input type="file" id="product_images" multiple accept="image/*" style="display:none;">
                                        </label>
                                        <section class="currentUploadedImages">

                                        </section>


                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
            </div>
            </form>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn-cancel btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="create_product_form" id="create_product_bnt" class="btn btn-success">Añadir producto</button>
            </div>
        </div>
    </div>
</div>

<style>
    #create_product_form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    #create_product_form .form_input_group {
        display: flex;
        flex-direction: row;
        gap: 12px;
    }

    #create_product_form input {
        display: flex;
        padding: 12px 4px;
    }

    #create_product_form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    #create_product_form .form_input_group {
        display: flex;
        flex-direction: row;
        gap: 12px;
    }

    #create_product_form input {
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
    /* ===================== STATE ===================== */

    const imageState = {
        list: [],
        reset() {
            this.list = [];
        },
        add(img) {
            this.list.push(img);
        },
        remove(id) {
            this.list = this.list.filter(i => i.id !== id);
        },
        paths() {
            return this.list.map(i => i.path);
        },
        find(id) {
            return this.list.find(i => i.id === id);
        }
    };


    selectData("*", "categories", "", (res) => {
        const data = res.data;
        data.forEach((category) => {
            $('#product-category').append(
                `<option value="${category.id}">${category.name}</option>`
            );
        });
    });

    $('#modal-product-creator').off().on('show.bs.modal', function() {
        $('#product-price').on('blur', function(e) {
            if (!parseFloat($('#product-price').val())) $('#product-price').val(0)

            formatCurrency($('#product-price'), 'blur', '<?php echo SHOP_DATA->currency_symbol ?>')
            console.log(`${calculateTax(parseFloat($('#product-price').val().replaceAll(',','')), <?php echo SHOP_DATA->tax_percent ?>)}<?php echo SHOP_DATA->currency_symbol ?> con ${<?php echo SHOP_DATA->tax_percent ?>}% IVA`)
            $('#product-w-tax-price').html(`${calculateTax(parseFloat($('#product-price').val().replaceAll(',','')), <?php echo SHOP_DATA->tax_percent ?>)}<?php echo SHOP_DATA->currency_symbol ?> con ${<?php echo SHOP_DATA->tax_percent ?>}% IVA`);
        });

        let tempToken = 'tmp_' + Math.random().toString(36).substring(2);

        imageState.reset();

        /* ===================== RENDER ===================== */
        function renderImage(container, img) {
            const el = $(`
        <div class="creator-image-container" data-id="${img.id}"
             style="position:relative;display:inline-block;margin:5px;">
            <img src="${"/uploads" + img.path.split('/uploads')[1]}"
                 class="preview-image"
                 style="max-width:64px;max-height:64px;object-fit:contain;">
            <button type="button"
                    class="btn-danger creator-btn-remove-image"
                    style="position:absolute;top:-5px;right:-5px;
                           border:none;border-radius:50%;
                           width:20px;height:20px;
                           font-size:12px;">×</button>
        </div>
    `);

            el.find('.creator-btn-remove-image').off().on('click', () => removeImage(img.id, el));
            container.append(el);
        }

        /* ===================== IMAGE ACTIONS ===================== */
        function removeImage(id, el) {
            const img = imageState.find(id);
            if (!img) return;

            deleteTempImage(tempToken, img.filename, () => {
                el.addClass('removing');
                setTimeout(() => el.remove(), 200);
                imageState.remove(id);
            });
        }

        /* ===================== MODAL INIT ===================== */

        $('.currentUploadedImages').empty();


        /* ===================== FILE UPLOAD ===================== */
        $('#product_images').off().on('change', function() {
            const files = this.files;
            if (!files.length) return;

            uploadTempImage({
                files,
                token: tempToken
            }, res => {
                res.files.forEach((src, i) => {
                    const img = {
                        id: 'new_' + Date.now() + '_' + i,
                        path: src,
                        filename: src.split('/').pop(),
                        original: false
                    };
                    imageState.add(img);
                    renderImage($('.currentUploadedImages'), img);
                });
                $(this).val('');
            });
        });

        /* ===================== SAVE ===================== */
        $('#create_product_form').off().on('submit', function() {
            productId = $('#modal-product-creator').data('product-id');

            const data = {
                name: $('#product-name').val(),
                price: Number($('#product-price').val().replace(/[^0-9.-]+/g, "")),
                stock: $('#product-stock').val(),
                short_description: $('#product-description-short').val(),
                description: $('#product-description').val(),
                category: $('#product-category').val(),
                on_sale: $('#on-sale').is(':checked') ? 1 : 0,
                sale_discound: $('#on-sale-discound').val() ?? 0
            };
            insertData(
                "products",

                "name,price,w_tax_price,stock,short_description,description,category,on_sale,sale_discound",
                `
                    "${data.name}",
                     ${data.price},
                     ${calculateTax(parseFloat(data.price), <?php echo SHOP_DATA->tax_percent ?>)},
                     ${data.stock},
                    "${data.short_description}",
                    "${data.description}",
                     ${data.category},
                     ${data.on_sale},
                     ${data.sale_discound}
                     `,
                '',
                (data) => {
                    finalizeProductImages(data.newId, tempToken, imageState.paths(), () => {
                        location.reload();
                    });
                }
            );
        });

        /* ===================== CANCEL ===================== */
        $('.btn-cancel, .btn-close').on('click', () => {

            $('#modal-product-creator').modal('hide');
        });

        $('#modal-product-creator').on('hide.bs.modal', function() {
            clearTemp(() => {
                imageState.reset();
            });

        })
    });
</script>