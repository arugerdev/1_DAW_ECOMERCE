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
                        <a href="#" class="btn btn-tool btn-sm btn-download-categories">
                            <i class="fas fa-download"></i>
                        </a>

                        <button class="btn-modal-category-creator btn btn-sm btn-outline-success" data-toggle="modal">
                            <i class="fas fa-plus "></i>
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="categories-table" class="table table table-valign-middle">

                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<script defer>
    function downloadCategoriesCSV() {

        const btn = $('.btn-download-categories');
        const originalHTML = btn.html();
        btn.html('<i class="fas fa-spinner fa-spin"></i>');
        btn.prop('disabled', true);


        const params = new URLSearchParams({
            action: 'downloadCSV',
            table: 'categories',
            select: '*',
            extra: 'ORDER BY id DESC'
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
                a.download = `categorias_${new Date().toISOString().slice(0,19).replace(/:/g,'-')}.csv`;
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


    $('.btn-download-categories').on('click', function(e) {
        e.preventDefault();
        downloadCategoriesCSV();
    });


    $('.btn-modal-category-creator').on('click', () => {
        $('#modal-category-creator').modal('show')
    })
    $(document).ready(function() {
        selectData("*", "categories", "", (res) => {
            const data = res.data
            if (data.length > 0) {

                $('#categories-table').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/2.3.7/i18n/es-ES.json',
                    },
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