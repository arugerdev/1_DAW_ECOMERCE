<div class="modal fade" data-backdrop="static" id="modal-user-editor" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar usuario</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" class="edit_user_form" id="edit_user_form">

                    <section class="mb-3">
                        <label class="form-label" for="editor-user-username">Nombre del usuario: </label>
                        <input class="form-control" type="text" id="editor-user-username" placeholder="Nombre del usuario" require="">
                    </section>
                    <section class="mb-3">
                        <label class="form-label" for="editor-user-password">Contraseña del usuario: </label>
                        <input class="form-control" type="password" data-type='password' id="editor-user-password" placeholder="******" require="">
                    </section>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn-cancel btn btn-default" data-dismiss="modal">Cancelar cambios</button>
                <button type="submit" form="edit_user_form" class="btn btn-success">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<style>
    .edit_user_form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .edit_user_form .form_input_group {
        display: flex;
        flex-direction: row;
        gap: 12px;
    }

    .edit_user_form input {
        display: flex;
        padding: 12px 4px;
    }

    .edit_user_form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .edit_user_form .form_input_group {
        display: flex;
        flex-direction: row;
        gap: 12px;
    }

    .edit_user_form input {
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
    $('#modal-user-editor').on('show.bs.modal', () => {

        userId = $('#modal-user-editor').data('user-id');
        selectData('*', 'users', `WHERE id = ${userId}`, (res) => {
            const data = res.data[0]
            console.log(data)
            $('#editor-user-username').val(data.username)
        })

        $(".edit_user_form").off().on('submit', () => {
            const username = $("#editor-user-username").val()
            const password = $("#editor-user-password").val()

            editUser(userId, username, password,
                (data) => {
                    if (data.success) {

                        location.reload();
                    }
                }
            );
        });

        $('.btn-cancel, .btn-close').on('click', () => {
            $('#modal-user-editor').modal('hide');
        });
    })
</script>