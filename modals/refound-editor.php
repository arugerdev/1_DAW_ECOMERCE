<div class="modal fade" id="modal-refound-editor" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Editar pedido</h4>
                <button id="editor-close" type="button" class="btn-close" data-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="edit_refound_form">

                    <div class="form-group">
                        <label>Número de pedido</label>
                        <input type="text" id="editor-refound-orderId" class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label>Fecha de devolucion</label>
                        <input type="text" id="editor-refound-date" class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="editor-refound-completed">
                            Completado
                        </label>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-default" id="editor-close" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-success" form="edit_refound_form">Guardar</button>
            </div>

        </div>
    </div>
</div>



<script defer>
    function getrefoundData(id, callback) {
        selectData("*", "refounds", `WHERE id = ${id}`, (res) => {
            callback(res.data[0])
        })
    }

    $('#modal-refound-editor').on('show.bs.modal', () => {

        $('*[id*=editor-close]').on('click', () => {
            $('#modal-refound-editor').modal('hide');
        });

        const id = $('#modal-refound-editor').data('id')

        getrefoundData(id, (refound) => {
            $('#editor-refound-orderId').val(refound.orderId)
            $('#editor-refound-date').val(refound.refound_date)
            $('#editor-refound-completed').prop('checked', refound.completed == 1)
        })


        $('#edit_refound_form').on('submit', (e) => {
            e.preventDefault()

            const completed = $('#editor-refound-completed').is(':checked') ? 1 : 0

            updateData(
                "refounds",
                `completed = "${completed}"`,
                `WHERE id = ${id}`,
                () => location.reload()
            )
        })

    })
</script>