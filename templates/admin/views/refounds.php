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
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-bars"></i>
                        </a>

                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="refounds-table" class="table table-striped table-valign-middle">

                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<script defer>
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
                            }
                        },
                        {
                            targets: 5,
                            render: function(data, type, row) {
                                const id = row[0]

                                return getRowActions(id, 
                                null // `editRefound(${id})` 
                                , `deleteRefound(${id})`);
                            }
                        }
                        // {
                        //     targets: [2],
                        //     render: function(data, type, row) {
                        //         return (data === '0' || data === '0.00') ? '0' : $.fn.dataTable.render.number('.', ',', 2, '', '€').display(data)
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

    // function editRefound(row) {
    //     $('#modal-refound-editor').data('id', row)
    //     $('#modal-refound-editor').modal('show')
    // }
</script>