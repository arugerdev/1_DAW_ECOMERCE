<?php include "./modals/product-creator.php"; ?>
<?php include "./modals/product-editor.php"; ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Productos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/">Inicio</a></li>
                    <li class="breadcrumb-item active">Productos</li>
                </ol>
            </div>
        </div>
    </div>
</div>

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

    function updateVisible(id, value) {
        updateData('products', `is_visible = ${value}`, `WHERE id = ${id}`)
    }

    $('.btn-modal-product-creator').on('click', () => {
        $('#modal-product-creator').modal('show')
    })

    $('#modal-product-creator').on('show.bs.modal', () => {

        tempToken = uuidv4();
    });
    $('#modal-product-editor').on('show.bs.modal', () => {

        tempToken = uuidv4();
    });

    $(document).ready(function() {
        selectData("p.id, p.is_visible AS visible, p.name AS nombre, p.short_description AS descripcion_corta, p.description AS descripcion, p.price AS precio, p.stock, p.on_sale AS oferta, p.sale_discound AS oferta_porcent, c.name AS categoria, p.create_at", "products p LEFT JOIN categories c ON p.   category = c.id", "", (recibed) => {
            const data = recibed.data

            if (data.length > 0) {

                const productTable = $('#products-table').DataTable({
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
                            targets: [0,10],
                            visible: false,
                            searchable: false
                        },
                        {
                            targets: 1,
                            render: function(data, type, row) {
                                return getCheckBox(data, `updateVisible(${row[0]}, this.checked)`);

                            }
                        },
                        {
                            targets: [3, 4],
                            render: function(data, type, row) {
                                return `<p class="elipsis">${data}</p>`;

                            }
                        },
                        {
                            targets: 5,
                            render: function(data, type, row) {
                                return (data === '0' || data === '0.00') ? '0' : $.fn.dataTable.render.number('.', ',', 2, '', '€').display(data)
                            }
                        },
                        {
                            targets: 7,
                            render: function(data, type, row) {
                                return getCheckBox(data, null);

                            }
                        },
                        {
                            targets: 8,
                            render: function(data, type, row) {
                                return data + '%';

                            }
                        },
                        {
                            targets: 11,
                            render: function(data, type, row) {
                                const id = row[0]

                                return getRowActions(id, `editProduct(${id})`, `deleteProduct(${id})`, );

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

    function deleteProduct(row) {
        deleteData('products', 'id', row, '', () => {
            deleteImages(row, (data) => {
                window.location.reload();
            })
        })
    }

    function editProduct(row) {
        $('#modal-product-editor').data('product-id', row);
        $('#modal-product-editor').modal('show');

    }
</script>