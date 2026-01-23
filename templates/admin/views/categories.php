<?php include "./modals/category-creator.php"; ?>
<?php include "./modals/category-editor.php"; ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Categorias</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/">Inicio</a></li>
                    <li class="breadcrumb-item active">Categorias</li>
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
                    <h3 class="card-title">Todas las categorias</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-bars"></i>
                        </a>
                        <button class="btn-modal-category-creator btn btn-sm btn-outline-success" data-toggle="modal">
                            <i class="fas fa-plus "></i>
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="categories-table" class="table table-striped table-valign-middle">

                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<script defer>
    $('.btn-modal-category-creator').on('click', () => {
        $('#modal-category-creator').modal('show')
    })
    $(document).ready(function() {
        selectData("*", "categories", "", (res) => {
            const data = res.data
            if (data.length > 0) {

                $('#categories-table').DataTable({
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
                            targets: [0, 2],
                            visible: false,
                            searchable: false
                        },
                        {
                            targets: 3,
                            render: function(data, type, row) {
                                const id = row[0]
                                // No borrar "Sin categoria"
                                if (id == 1) return ''

                                return getRowActions(id, `editCategory(${id})`, `deleteCategory(${id})`);

                            }
                        },
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

    function deleteCategory(row) {
        deleteData('categories', 'id', row, '', location.reload())
    }

    function editCategory(row) {
        $('#modal-category-editor').data('product-id', row);
        $('#modal-category-editor').modal('show');
    }
</script>