<?php include "./modals/refound-editor.php"; ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Devoluciones</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/">Inicio</a></li>
                    <li class="breadcrumb-item active">Devoluciones</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <section class="refounds_editor">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Todas las devoluciones</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm btn-download-refounds">
                            <i class="fas fa-download"></i>
                        </a>

                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="refounds-table" class="table table-valign-middle">

                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<script defer>
    function downloadRefoundsCSV() {
        // Mostrar indicador de carga
        const btn = $('.btn-download-refounds');
        const originalHTML = btn.html();
        btn.html('<i class="fas fa-spinner fa-spin"></i>');
        btn.prop('disabled', true);

        // Configurar los parámetros para la consulta específica de productos
        const params = new URLSearchParams({
            action: 'downloadCSV',
            table: 'refounds',
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
                a.download = `devoluciones_${new Date().toISOString().slice(0,19).replace(/:/g,'-')}.csv`;
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
    $('.btn-download-refounds').on('click', function(e) {
        e.preventDefault();
        downloadRefoundsCSV();
    });


    $(document).ready(function() {
        selectData("*", "refounds", "", (res) => {
            const data = res.data

            if (data.length > 0) {

                $('#refounds-table').DataTable({
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
                            targets: [0, 4],
                            visible: false,
                            searchable: false
                        },
                        {
                            targets: 1,
                            render: function(data, type, row) {
                                return `<a href="/admin/orders?edit=${data}">${data}</a>`
                            },
                            width: '80px'
                        },
                        {
                            targets: 3,

                            render: function(data, type, row) {
                                return getCheckBox(data)
                            },
                            width: '100px'
                        },
                        {
                            targets: 5,
                            render: function(data, type, row) {
                                const id = row[0]

                                return getRowActions(id,
                                    `editRefound(${id})`, `deleteRefound(${id})`);
                            }
                        }
                        // {
                        //     targets: [2],
                        //     render: function(data, type, row) {
                        //         return (data === '0' || data === '0.00') ? '0' : $.fn.dataTable.render.number('.', ',', 2, '', '<?php echo SHOP_DATA->currency_symbol ?>').display(data)
                        //     }
                        // },
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


    function deleteRefound(row) {
        deleteData('refounds', 'id', row, '', location.reload())
    }

    function editRefound(row) {
        $('#modal-refound-editor').data('id', row)
        $('#modal-refound-editor').modal('show')
    }
</script>