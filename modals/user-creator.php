<div class="modal fade" data-backdrop="static" id="modal-user-creator" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crear nuevo usuario</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" class="create_user_form" id="create_user_form">

                    <section class="mb-3">
                        <label class="form-label" for="user-username">Nombre del usuario: </label>
                        <input class="form-control" type="text" id="user-username" placeholder="Nombre del usuario" require="">
                    </section>
                    <section class="mb-3">
                        <label class="form-label" for="user-password">Contraseña del usuario: </label>
                        <input class="form-control" type="password" data-type='password' id="user-password" placeholder="******" require="">
                    </section>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn-cancel btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="create_user_form" class="btn btn-success">Crear usuario</button>
            </div>
        </div>
    </div>
</div>

<style>
    .create_user_form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .create_user_form .form_input_group {
        display: flex;
        flex-direction: row;
        gap: 12px;
    }

    .create_user_form input {
        display: flex;
        padding: 12px 4px;
    }

    .create_user_form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .create_user_form .form_input_group {
        display: flex;
        flex-direction: row;
        gap: 12px;
    }

    .create_user_form input {
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
    $('.btn-cancel, .btn-close').on('click', () => {
        $('#modal-user-creator').modal('hide');
    });

    $(".create_user_form").on('submit', () => {
        const username = $("#user-username").val()
        const password = $("#user-password").val()

        createUser(username, password,
            (data) => {
                location.reload();
            }
        );
    });
</script>