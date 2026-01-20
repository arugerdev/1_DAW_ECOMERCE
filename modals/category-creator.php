<div class="modal fade" data-backdrop="static" id="modal-category-creator" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crear nueva categoria</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" class="create_category_form" id="create_category_form">

                    <div class="col">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Nueva categoria</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category-name">Nombre</label>
                                    <input type="text" id="category-name" class="form-control">
                                </div>

                            </div>

                        </div>

                    </div>

            </div>
            </form>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn-cancel btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="create_category_form" class="btn btn-success">Crear Categoria</button>
            </div>
        </div>
    </div>
</div>

<style>
    .create_category_form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .create_category_form .form_input_group {
        display: flex;
        flex-direction: row;
        gap: 12px;
    }

    .create_category_form input {
        display: flex;
        padding: 12px 4px;
    }

    .create_category_form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .create_category_form .form_input_group {
        display: flex;
        flex-direction: row;
        gap: 12px;
    }

    .create_category_form input {
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
        $('#modal-category-creator').modal('hide');
    });


    $(".create_category_form").on('submit', () => {
        const name = $("#category-name").val();

        insertData(
            "categories", "name", `"${name}"`, "",
            (data) => {

                location.reload();
            }
        );
    });
</script>