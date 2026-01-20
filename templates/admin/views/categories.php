<?php include "./modals/category-creator.php"; ?>

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
                            targets: 3,
                            render: function(data, type, row) {
                                return getRowActions(row);

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

            function getRowActions(row) {
                if (row[0] == 1) return "";

                return `
                <div class="btn-group" role="group">
                    <button class="${row[0]}-editer btn btn-sm btn-outline-primary edit-category-btn" 
                            data-toggle="tooltip" 
                            title="Editar">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="${row[0]}-remover btn btn-sm btn-outline-danger delete-category-btn" 
                                onClick="deleteData('categories','id',${row[0]},'',location.reload())"
                            data-toggle="tooltip" 
                            title="Eliminar">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                
                `;
            }
        });
    })
</script>