<div class="modal fade" data-backdrop="static" id="modal-product-editor" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar producto</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" class="edit_product_form" id="edit_product_form">

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
                                        <label editor-for="product-name">Nombre del producto</label>
                                        <input type="text" id="editor-product-name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="editor-product-price">Precio del producto</label>
                                        <input type="currency" data-type="currency" placeholder="0,00€" id="editor-product-price" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="editor-product-stock">Stock del producto</label>
                                        <input type="number" placeholder="20" value="0" min="0" step="1" id="editor-product-stock" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="editor-product-category">Categoria</label>
                                        <select id="editor-product-category" class="form-control custom-select">
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
                                        <label for="editor-product-description-short">Descripción corta del producto</label>
                                        <textarea id="editor-product-description-short" class="form-control" rows="2"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="editor-product-description">Descripción del producto</label>
                                        <textarea id="editor-product-description" class="form-control" rows="10"></textarea>
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
                                        <input type="checkbox" id="editor-on-sale">
                                    </div>
                                    <div class="form-group">
                                        <label for="editor-on-sale-discount">% de oferta</label>
                                        <input type="number" step="0.05" min="0" max="100" value="0" id="editor-on-sale-discount" class="form-control">
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

                                        <label class="dropzone-file-upload" for="editor_product_images">
                                            <i class="fa-solid fa-images icon fs-1"></i>
                                            <div class="text">
                                                <span>Haz clic para subir imagen<small>/es</small></span>
                                            </div>
                                            <input type="file" id="editor_product_images" multiple accept="image/*" style="display:none;">
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
                <button type="button" class="btn-cancel btn btn-default" data-dismiss="modal">Cancelar cambios</button>
                <button type="submit" form="edit_product_form" id="edit_product_btn" class="btn btn-success">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<style>
    .dropzone-file-upload {
        height: 200px;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: space-between;
        gap: 20px;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        border: 2px dashed #cacaca;
        background-color: rgba(255, 255, 255, 1);
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0px 48px 35px -48px rgba(0, 0, 0, 0.1);
    }

    .dropzone-file-upload .icon {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dropzone-file-upload .icon svg {
        height: 80px;
        fill: rgba(75, 85, 99, 1);
    }

    .dropzone-file-upload .text {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dropzone-file-upload .text span {
        font-weight: 400;
        color: rgba(75, 85, 99, 1);
    }

    .dropzone-file-upload input {
        display: none;
    }

    .edit_product_form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .edit_product_form .form_input_group {
        display: flex;
        flex-direction: row;
        gap: 12px;
    }

    .edit_product_form input {
        display: flex;
        padding: 12px 4px;
    }

    .edit_product_form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .edit_product_form .form_input_group {
        display: flex;
        flex-direction: row;
        gap: 12px;
    }

    .edit_product_form input {
        display: flex;
        padding: 12px 4px;
    }

    .editor-preview-image {
        transition: transform 0.2s;
    }

    .editor-preview-image:hover {
        transform: scale(1.05);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .edit-image-container {
        transition: opacity 0.3s;
    }

    .edit-image-container.removing {
        opacity: 0.5;
    }
</style>

<script defer>
    /* ===================== STATE ===================== */

    const edit_imageState = {
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
            $('#editor-product-category').append(
                `<option value="${category.id}">${category.name}</option>`
            );
        });
    });
    $('#modal-product-editor').off().on('show.bs.modal', function() {
        let tempToken = 'tmp_' + Math.random().toString(36).substring(2);
        let productId = null;
        productId = $(this).data('product-id');

        console.log(productId)

        edit_imageState.reset();

        /* ===================== RENDER ===================== */
        function renderImage(container, img) {
            const el = $(`
        <div class="edit-image-container" data-id="${img.id}"
             style="position:relative;display:inline-block;margin:5px;">
            <img src="${"/uploads" + img.path.split('/uploads')[1]}"
                 class="editor-preview-image"
                 style="max-width:64px;max-height:64px;object-fit:contain;">
            <button type="button"
                    class="btn-danger edit-btn-remove-image"
                    style="position:absolute;top:-5px;right:-5px;
                           border:none;border-radius:50%;
                           width:20px;height:20px;
                           font-size:12px;">×</button>
        </div>
    `);

            el.find('.edit-btn-remove-image').off().on('click', () => removeImage(img.id, el));
            container.append(el);
        }

        /* ===================== IMAGE ACTIONS ===================== */
        function removeImage(id, el) {
            const img = edit_imageState.find(id);
            if (!img) return;

            deleteTempImage(tempToken, img.filename, () => {
                el.addClass('removing');
                setTimeout(() => el.remove(), 200);
                edit_imageState.remove(id);
            });
        }

        /* ===================== MODAL INIT ===================== */

        $('.currentUploadedImages').empty();

        /* ---- Load product data ---- */
        selectData("*", "products", `WHERE id=${productId}`, res => {
            const p = res.data[0];
            $('#editor-product-name').val(p.name);
            $('#editor-product-price').val(p.price + "€");
            $('#editor-product-stock').val(p.stock);
            $('#editor-product-description-short').val(p.short_description);
            $('#editor-product-description').val(p.description);
            $('#editor-product-category').val(p.category);
            $('#editor-on-sale').prop('checked', p.on_sale == 1);
            $('#editor-on-sale-discount').val(p.sale_discound);
        });

        /* ---- Move images to temp ---- */
        moveImagesToTemp(productId, tempToken, res => {
            res.files.forEach((src, i) => {
                const img = {
                    id: 'orig_' + i,
                    path: src,
                    filename: src.split('/').pop(),
                    original: true
                };
                edit_imageState.add(img);
                renderImage($('.currentUploadedImages'), img);
            });
        });

        /* ===================== FILE UPLOAD ===================== */
        $('#editor_product_images').off().on('change', function() {
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
                    edit_imageState.add(img);
                    renderImage($('.currentUploadedImages'), img);
                });
                $(this).val('');
            });
        });

        /* ===================== SAVE ===================== */
        $('.edit_product_form').off().on('submit', function() {
            productId = $('#modal-product-editor').data('product-id');

            const data = {
                name: $('#editor-product-name').val(),
                price: Number($('#editor-product-price').val().replace(/[^0-9.-]+/g, "")),
                stock: $('#editor-product-stock').val(),
                short_description: $('#editor-product-description-short').val(),
                description: $('#editor-product-description').val(),
                category: $('#editor-product-category').val(),
                on_sale: $('#editor-on-sale').is(':checked') ? 1 : 0,
                sale_discound: $('#editor-on-sale-discount').val()
            };

            updateData(
                "products",
                `
                    name="${data.name}",
                    price=${data.price},
                    stock=${data.stock},
                    short_description="${data.short_description}",
                    description="${data.description}",
                    category=${data.category},
                    on_sale=${data.on_sale},
                    sale_discound=${data.sale_discound}
                `,
                `WHERE id=${productId}`,
                () => {
                    finalizeProductImages(productId, tempToken, edit_imageState.paths(), () => {
                        location.reload();
                    });
                }
            );
        });

        /* ===================== CANCEL ===================== */
        $('.btn-cancel, .btn-close').on('click', () => {

            $('#modal-product-editor').modal('hide');
        });

        $('#modal-product-editor').on('hide.bs.modal', function() {
            // Limpiar eventos para evitar que al cambiar de producto se siga escuchando el input del evento del producto editado anteriormente

            finalizeProductImages(productId, tempToken, edit_imageState.list.filter((el) => el.original).map(i => i.path), () => {
                clearTemp(() => {
                    edit_imageState.reset();
                });
            });

        })
    });
</script>