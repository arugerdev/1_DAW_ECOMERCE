<?php include "./modals/order-editor.php"; ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pedidos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/">Inicio</a></li>
                    <li class="breadcrumb-item active">Pedidos</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <section class="orders_editor">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Todos los pedidos</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-bars"></i>
                        </a>

                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="orders-table" class="table table-striped table-valign-middle">

                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<script defer>
    $(document).ready(function() {
        selectData("c.email, c.phone_number, o.*", "orders o LEFT JOIN customers c ON o.customer_id = c.id", "", (res) => {
            const data = res.data

            console.log(data)
            if (data.length > 0) {

                $('#orders-table').DataTable({
                    columns: Object.keys(data[0]).map((key) => {
                        return {
                            title: capitalizeFirstLetter(key)
                        }
                    }).concat({
                        title: "Acciones"
                    }),
                    data: data.map((row) => {
                        return Object.values(row).concat("")
                    }),
                    columnDefs: [{
                            targets: [2, 10, 4],
                            visible: false,
                            searchable: false
                        },
                        {
                            targets: [5],
                            render: function(data, type, row) {
                                return (data === '0' || data === '0.00') ? '0' : $.fn.dataTable.render.number('.', ',', 2, '', '€').display(data)
                            }
                        },
                        {
                            targets: [9],
                            render: function(data, type, row) {
                                return getCheckBox(data, null);
                            }
                        },
                        {
                            targets: 11,
                            render: function(data, type, row) {
                                const id = row[0]

                                return getRowActions(id, `editOrder(${id})`, `deleteOrder(${id})`);

                            }
                        },
                        {
                            targets: 6, // status
                            render: (data) => {
                                const colors = {
                                    pending: 'warning',
                                    paid: 'info',
                                    sent: 'primary',
                                    completed: 'success',
                                    cancelled: 'danger'
                                }
                                return `<span class="badge badge-${colors[data] || 'secondary'}">${data}</span>`
                            }
                        }
                    ],
                    ordering: true,
                    searchable: true,
                    paging: true,
                    pageLength: 50,
                    lengthChange: false,

                });

            }
        });
    })

    function deleteOrder(row) {
        deleteData('orders', 'id', row, '', location.reload())
    }

    function editOrder(row) {
        $('#modal-order-editor').data('id', row)
        $('#modal-order-editor').modal('show')
    }
</script>