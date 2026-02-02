<?php include "./modals/order-editor.php"; ?>
<?php include "./modals/order-details.php"; ?>

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
                        <a href="#" class="btn btn-tool btn-sm btn-download-orders">
                            <i class="fas fa-download"></i>
                        </a>

                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="orders-table" class="table table-valign-middle">

                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<script defer>
    function downloadOrdersCSV() {
        // Mostrar indicador de carga
        const btn = $('.btn-download-orders');
        const originalHTML = btn.html();
        btn.html('<i class="fas fa-spinner fa-spin"></i>');
        btn.prop('disabled', true);

        // Configurar los parámetros para la consulta específica de productos
        const params = new URLSearchParams({
            action: 'downloadCSV',
            table: 'orders',
            select: '*',
            extra: 'ORDER BY id DESC'
        });

        // Crear y activar la descarga
        const downloadUrl = '/utils/db_utils.php?' + params.toString();

        // Usar fetch para manejar la respuesta
        fetch(downloadUrl)
            .then(response => {
                if (response.ok) {
                    return response.blob();
                }
                throw new Error('Error en la descarga');
            })
            .then(blob => {
                // Crear un enlace temporal para descargar el archivo
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `pedidos_${new Date().toISOString().slice(0,19).replace(/:/g,'-')}.csv`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al descargar el CSV');
            })
            .finally(() => {
                // Restaurar el botón
                btn.html(originalHTML);
                btn.prop('disabled', false);
            });
    }

    // Modifica el evento click del botón
    $('.btn-download-orders').on('click', function(e) {
        e.preventDefault();
        downloadOrdersCSV();
    });


    $(document).ready(function() {
        selectData("c.email, c.phone_number, o.*", "orders o LEFT JOIN customers c ON o.customer_id = c.id", "", (res) => {
            const data = res.data

            if (data.length > 0) {

                let orders = $('#orders-table').DataTable({
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
                                return (data === '0' || data === '0.00') ? '0' : $.fn.dataTable.render.number('.', ',', 2, '', '<?php echo SHOP_DATA->currency_symbol ?>').display(data)
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
                                const id = row[2]

                                return getRowActions(id, `editOrder(${id})`, `deleteOrder(${id})`, `viewDetails(${id})`);

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

                const editId = getQueryParam('edit')

                if (editId) {
                    // Espera un tick para asegurar render completo
                    setTimeout(() => {
                        editOrder(parseInt(editId))
                    }, 0)

                    $('#modal-order-editor').on('hidden.bs.modal', () => {
                        const url = new URL(window.location)
                        url.searchParams.delete('edit')
                        window.history.replaceState({}, '', url)
                    })

                }

                const viewId = getQueryParam('view')

                if (viewId) {
                    // Espera un tick para asegurar render completo
                    setTimeout(() => {
                        viewDetails(parseInt(viewId))
                    }, 0)

                    $('#modal-order-details').on('hidden.bs.modal', () => {
                        const url = new URL(window.location)
                        url.searchParams.delete('view')
                        window.history.replaceState({}, '', url)
                    })

                }

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

    function viewDetails(row) {
        $('#modal-order-details').data('id', row)
        $('#modal-order-details').modal('show')
    }
</script>