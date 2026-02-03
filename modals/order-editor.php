<div class="modal fade" id="modal-order-editor" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Editar pedido</h4>
                <button id="editor-close" type="button" class="btn-close" data-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="edit_order_form">

                    <div class="form-group">
                        <label>Número de pedido</label>
                        <input type="text" id="editor-order-number" class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label>Estado</label>
                        <select id="editor-order-status" class="form-control">
                            <option value="pending">Pendiente</option>
                            <option value="paid">Pagado</option>
                            <option value="sent">Enviado</option>
                            <option value="completed">Completado</option>
                            <option value="cancelled">Cancelado</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Método de envío</label>
                        <select id="editor-shipping-method" class="form-control">
                            <option value="standard">Estandar</option>
                            <option value="express">Express (Rapido)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Método de pago</label>
                        <select id="editor-payment-method" class="form-control">
                            <option value="card">Tarjeta</option>
                            <option value="transfer">Transferencia Bancaria</option>
                            <option value="paypal">Paypal</option>
                            <option value="e">Efectivo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="editor-order-received">
                            Pedido recibido
                        </label>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-default" id="editor-close" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-success" form="edit_order_form">Guardar</button>
            </div>

        </div>
    </div>
</div>



<script defer>
    function getOrderData(id, callback) {
        selectData("*", "orders", `WHERE id = ${id}`, (res) => {
            callback(res.data[0])
        })
    }

    $('#modal-order-editor').on('show.bs.modal', () => {

        $('*[id*=editor-close]').on('click', () => {
            $('#modal-order-editor').modal('hide');
        });

        const id = $('#modal-order-editor').data('id')

        getOrderData(id, (order) => {
            $('#editor-order-number').val(order.order_number)
            $('#editor-order-status').val(order.status)
            $('#editor-shipping-method').val(order.shipping_method)
            $('#editor-payment-method').val(order.payment_method)
            $('#editor-order-received').prop('checked', order.received == 1)
        })


        $('#edit_order_form').on('submit', (e) => {
            e.preventDefault()

            const status = $('#editor-order-status').val()
            const shipping = $('#editor-shipping-method').val()
            const payment = $('#editor-payment-method').val()
            const received = $('#editor-order-received').is(':checked') ? 1 : 0

            updateData(
                "orders",
                `
          status = "${status}",
          shipping_method = "${shipping}",
          payment_method = "${payment}",
          received = ${received}
        `,
                `WHERE id = ${id}`,
                () => location.reload()
            )
        })

    })
</script>