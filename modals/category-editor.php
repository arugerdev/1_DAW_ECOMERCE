<div class="modal fade" data-backdrop="static" id="modal-category-editor" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crear nueva categoria</h4>
                <button type="button" class="btn-close" id="editor-close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" class="edit_category_form" id="edit_category_form">

                    <div class="col">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Cambiar nombre</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="editor-category-name">Nombre</label>
                                    <input type="text" id="editor-category-name" class="form-control">
                                </div>

                            </div>

                        </div>

                    </div>

            </div>
            </form>

            <div class="modal-footer justify-content-between">
                <button type="button" id="editor-close" class="btn-cancel btn btn-default" data-dismiss="modal">Cancelar Cambios</button>
                <button type="submit" form="edit_category_form" class="btn btn-success">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<style>
    .edit_category_form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .edit_category_form .form_input_group {
        display: flex;
        flex-direction: row;
        gap: 12px;
    }

    .edit_category_form input {
        display: flex;
        padding: 12px 4px;
    }

    .edit_category_form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .edit_category_form .form_input_group {
        display: flex;
        flex-direction: row;
        gap: 12px;
    }

    .edit_category_form input {
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
    $('#modal-category-editor').on('show.bs.modal', () => {

        $('*[id*=editor-close]').on('click', () => {
            $('#modal-category-editor').modal('hide');
        });

        const id = $('#modal-category-editor').data('product-id')

        selectData("name", "categories", `WHERE id = ${id}`, (res) => {
            console.log(res.data[0].name)
            $("#editor-category-name").val(res.data[0].name)
        })

        $(".edit_category_form").on('submit', () => {
            const name = $("#editor-category-name").val();

            updateData(
                "categories", `name = "${name}"`, `WHERE id = ${id}`,
                (data) => {

                    location.reload();
                }
            );
        });
    })
</script>