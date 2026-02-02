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
                        <a href="#" class="btn btn-tool btn-sm btn-download-products">
                            <i class="fas fa-download"></i>
                        </a>
                        <button class="btn-modal-product-creator btn btn-sm btn-outline-success" data-toggle="modal">
                            <i class="fas fa-plus "></i>
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive pl-0 pr-2">
                    <table id="products-table" class="table table-valign-middle m-0 p-0">

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

    function downloadProductsCSV() {
       
        const btn = $('.btn-download-products');
        const originalHTML = btn.html();
        btn.html('<i class="fas fa-spinner fa-spin"></i>');
        btn.prop('disabled', true);

       
        const params = new URLSearchParams({
            action: 'downloadCSV',
            table: 'products p LEFT JOIN categories c ON p.category = c.id',
            select: 'p.id, p.is_visible AS Visible, p.name AS Nombre, p.short_description AS "Descripción Corta", p.description AS Descripción, p.price AS Precio, p.stock AS Stock, p.on_sale AS Oferta, p.sale_discound AS "Descuento Oferta", c.name AS Categoría, p.create_at AS "Fecha Creación"',
            extra: 'ORDER BY p.id DESC'
        });

       
        const downloadUrl = '/utils/db_utils.php?' + params.toString();

       
        fetch(downloadUrl)
            .then(response => {
                if (response.ok) {
                    return response.blob();
                }
                throw new Error('Error en la descarga');
            })
            .then(blob => {
               
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `productos_${new Date().toISOString().slice(0,19).replace(/:/g,'-')}.csv`;
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
               
                btn.html(originalHTML);
                btn.prop('disabled', false);
            });
    }

   
    $('.btn-download-products').on('click', function(e) {
        e.preventDefault();
        downloadProductsCSV();
    });

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
                            targets: [0, 10],
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
                                return (data === '0' || data === '0.00') ? '0' : $.fn.dataTable.render.number('.', ',', 2, '', '<?php echo SHOP_DATA->currency_symbol ?>').display(data)
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

        const editId = getQueryParam('edit')

        if (editId) {
           
            setTimeout(() => {
                editProduct(parseInt(editId))
            }, 0)

            $('#modal-product-editor').on('hidden.bs.modal', () => {
                const url = new URL(window.location)
                url.searchParams.delete('edit')
                window.history.replaceState({}, '', url)
            })

        }

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