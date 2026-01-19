<?php include "./modals/product-creator.php"; ?>

<script>
    function updateVisible(id, value) {
        updateData('products', `is_visible = ${value}`, `WHERE id = ${id}`)
    }
</script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Productos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/">Inicio</a></li>
                    <li class="breadcrumb-item active">Productos</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <section class="products_editor">


            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Todos los productos</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-bars"></i>
                        </a>
                        <button class="btn-modal-product-creator btn btn-sm btn-outline-success" data-toggle="modal">
                            <i class="fas fa-plus "></i>

                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive pl-0 pr-2">
                    <table id="products-table" class="table table-striped table-valign-middle m-0 p-0">

                    </table>
                </div>
            </div>


        </section>
    </div>
</div>




<script defer>
    let tempToken = null;

    $('.btn-modal-product-creator').on('click', () => {
        $('#modal-product-creator').modal('show')
    })

    $('#modal-product-creator').on('show.bs.modal', () => {

        tempToken = uuidv4();
    });

    $(document).ready(function() {
        selectData("*", "products", "", (recibed) => {
            const data = recibed.data

            if (data.length > 0) {

                const productTable = $('#products-table').DataTable({
                    columns: Object.keys(data[0]).map((key) => {
                        return {
                            title: capitalizeFirstLetter(key)
                        }
                    }).concat({
                        title: "Actions"
                    }),
                    data: data.map((row) => {
                        return Object.values(row).concat("")
                    }),
                    columnDefs: [{
                            targets: 0,
                            visible: false,
                            searchable: false
                        },
                        {
                            targets: 1,
                            render: function(data, type, row) {
                                return getCheckBox(row);

                            }
                        },
                        {
                            targets: [4,5],
                            render: function(data, type, row) {
                                return `<p class="elipsis">${data}</p>`;

                            }
                        },
                        {
                            targets: 3,
                            render: function(data, type, row) {
                                return (data === '0' || data === '0.00') ? '0' : $.fn.dataTable.render.number('.', ',', 2, '', '€').display(data)
                            }
                        },
                        {
                            targets: 10,
                            render: function(data, type, row) {
                                const id = row[0]

                                return getRowActions(id);

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

        function getRowActions(row) {
            return `<button class="${row}-editer btn-primary">Editar</button><button class="${row}-remover btn-danger" onClick="deleteData('products','id',${row},'',location.reload())">Eliminar</button>`;
        }

        function getCheckBox(row) {
            return `<input style="margin-left:32px" type='checkbox' value='${row[0]}' onChange="updateVisible(this.value, this.checked)" ${row[1] == 1 ? 'checked' : ''}>`
        }
    })
</script>