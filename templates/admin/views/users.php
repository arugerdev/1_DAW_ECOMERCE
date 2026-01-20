<?php include "./modals/user-creator.php"; ?>



<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Usuarios</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/">Inicio</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
                </ol>
            </div>
        </div>
    </div>
</div>



<div class="content">
    <div class="container-fluid">
        <section class="users_editor">


            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Todos los Usuarios</h3>
                    <div class="card-tools">

                        <button class="btn-modal-user-creator btn btn-sm btn-outline-success" data-toggle="modal">
                            <i class="fas fa-plus "></i>

                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="users-table" class="table table-striped table-valign-middle">

                    </table>
                </div>
            </div>


        </section>
    </div>
</div>




<script defer>
    $('.btn-modal-user-creator').on('click', () => {
        $('#modal-user-creator').modal('show')
    })

    $(document).ready(function() {
        selectData("id, username", "users", "", (res) => {
            const data = res.data

            if (data.length > 0) {

                $('#users-table').DataTable({
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
                            targets: 0,
                            visible: false,
                            searchable: false
                        },

                        {
                            targets: 2,
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
            return `<button class="${row}-remover btn-danger" onClick="deleteData('users','id',${row},'',location.reload())">Eliminar</button>`;
        }

    })
</script>