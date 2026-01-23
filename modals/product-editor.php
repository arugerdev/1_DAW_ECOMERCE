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
    let uploadedImages = [];
    let originalImages = [];

    Dropzone.autoDiscover = false;

    $(document).ready(() => {
        selectData("*", "categories", "", (recibed) => {
            const data = recibed.data;

            data.forEach((category) => {
                $('#editor-product-category').append(
                    `<option value="${category.id}">${category.name}</option>`
                );
            });
        });

        function getProductData(id, callback) {
            if (!id) return;
            selectData("*", "products", `WHERE id=${id}`, (recibed) => {
                const data = recibed.data[0];
                callback(data);
            });
        }

        $('#modal-product-editor').on('show.bs.modal', () => {
            $('.currentUploadedImages').empty();

            const productId = $('#modal-product-editor').data('product-id');

            getProductData(productId, (data) => {
                $('#editor-product-name').val(data.name);
                $('#editor-product-price').val(data.price + "€");
                $('#editor-product-stock').val(data.stock);
                $('#editor-product-description-short').val(data.short_description);
                $('#editor-product-description').val(data.description);
                $('#editor-product-category').val(data.category);
                $('#editor-on-sale').prop('checked', data.on_sale == 1 ? true : false);
                $('#editor-on-sale-discount').val(data.sale_discound);

            });


            moveImagesToTemp(productId, tempToken, (data) => {
                data.files.forEach((src, index) => {
                    const imageId = index;
                    const imageObj = {
                        id: imageId,
                        path: src,
                        filename: src.split('/').pop()
                    };
                    originalImages.push(imageObj);

                    $('.currentUploadedImages').append(
                        `<div class="edit-image-container" style="position: relative; display: inline-block; margin: 5px;">
                                <img id="${imageId}" 
                                     src="${"/uploads" + src.split('/uploads')[1]}" 
                                     style="max-width: 64px; max-height:64px; object-fit:contain; aspect-ratio:1/1; cursor: pointer;" 
                                     class="edit-preview-image"
                                     data-path="${src}" />
                                <button type="button" 
                                        class="edit-btn-remove-image btn-danger" 
                                        style="position: absolute; top: -5px; right: -5px; background: red; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; font-size: 12px; cursor: pointer;"
                                        data-id="${imageId}">×</button>
                            </div>`
                    );
                });

            });

            $('.btn-cancel, .btn-close').on('click', () => {
                $('#modal-product-editor').modal('hide');
            });

            $('#modal-product-editor').on('hide.bs.modal', () => {
                finalizeProductImages(productId, tempToken, () => {
                    $('#modal-product-editor').modal('hide');
                }, originalImages.map(img => img.path));
                clearTemp(() => {});

                uploadedImages = [];
                originalImages = [];
                $('.currentUploadedImages').empty();
            });

            $("input[data-type='currency']").on({
                keyup: function() {
                    formatCurrency($(this));
                },
                blur: function() {
                    formatCurrency($(this), "blur");
                }
            });

            $("#editor_product_images").on('change', function() {
                const files = this.files;
                if (!files.length) return;

                uploadTempImage({
                    files,
                    token: tempToken
                }, (data) => {
                    data.files.forEach((src, index) => {
                        const imageId = 'img_' + Date.now() + '_' + index;
                        const imageObj = {
                            id: imageId,
                            path: src,
                            filename: src.split('/').pop()
                        };

                        uploadedImages.push(imageObj);

                        $('.currentUploadedImages').append(
                            `<div class="edit-image-container" style="position: relative; display: inline-block; margin: 5px;">
                                <img id="${imageId}" 
                                     src="${"/uploads" + src.split('/uploads')[1]}" 
                                     style="max-width: 64px; max-height:64px; object-fit:contain; aspect-ratio:1/1; cursor: pointer;" 
                                     class="edit-preview-image"
                                     data-path="${src}" />
                                <button type="button" 
                                        class="edit-btn-remove-image btn-danger" 
                                        style="position: absolute; top: -5px; right: -5px; background: red; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; font-size: 12px; cursor: pointer;"
                                        data-id="${imageId}">×</button>
                            </div>`
                        );
                    });
                    $(this).val('');
                });
            });

            const removeImg = (imageId, element) => {
                const allImages = [...originalImages, ...uploadedImages];

                deleteTempImage(tempToken, allImages.find(img => img.id === imageId).filename, () => {
                    element.parent('.edit-image-container').addClass('removing');
                    element.parent('.edit-image-container').remove();
                });

                uploadedImages = uploadedImages.filter(img => img.id !== imageId);
                originalImages = originalImages.filter(img => img.id !== imageId);
            }

            $(document).on('click', '.edit-btn-remove-image', function(e) {
                e.stopPropagation();
                const imageId = $(this).data('id');
                removeImg(imageId, $(this))
            });



            const upload = () => {
                const name = $("#editor-product-name").val();
                const price = Number($("#editor-product-price").val().replace(/[^0-9.-]+/g, ""));
                const stock = $("#editor-product-stock").val();
                const short_description = $("#editor-product-description-short").val();
                const description = $("#editor-product-description").val();
                const category = $("#editor-product-category").val();
                const on_sale = $("#editor-on-sale").is(":checked");
                const sale_discount = $("#editor-on-sale-discount").val();

                /*
                function updateData(table, values, extra = "", callback = () => { }) {
                    $.ajax({
                        url: "../../utils/db_utils.php",
                        type: "POST",
                        data: {
                            "action": "update",
                            "table": table,
                            "values": values,
                            "extra": extra
                        },
                        success: (data) => {
                            callback(JSON.parse(data))
                        }
                    });

                }
                */

                updateData(
                    "products",
                    `name = "${name}", price = ${price}, stock = ${stock}, short_description = "${short_description}", description = "${description}", category = ${category}, on_sale = ${on_sale ? 1 : 0}, sale_discound = ${sale_discount}`,
                    `WHERE id = ${productId}`,
                    (data) => {
                        finalizeProductImages(productId, tempToken, () => {
                            uploadedImages = [];
                            originalImages = [];
                            location.reload();
                        });
                    }
                );

            }

            $(".edit_product_form").on('submit', () => {
                upload()
            });

        });



        // function cancelUpload() {
        //     if (uploadedImages.length > 0) {

        //         deleteAllTempImages(tempToken, () => {
        //             uploadedImages = [];
        //             $('.currentUploadedImages').empty();
        //         });
        //     }
        // }

        // // On reload clear any temp images that might be left
        // $(document).ready(() => {
        //     clearTemp(() => {});
        // });
    });
</script>