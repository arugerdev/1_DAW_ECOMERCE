<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Customizacion de la tienda</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Customizacion</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-store mr-1"></i>
                            Información general
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label>Nombre de la tienda</label>
                            <input type="text" id="shop-name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Slogan</label>
                            <input type="text" id="shop-slogan" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea id="shop-description" class="form-control" rows="4"></textarea>
                        </div>

                        <div class="form-group">
                            <label>URL Logo</label>
                            <input type="text" id="shop-logo" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>URL Logo oscuro</label>
                            <input type="text" id="shop-logo-dark" class="form-control">
                        </div>

                    </div>
                </div>
            </div>

            <!-- COLORES -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-palette mr-1"></i>
                            Colores
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label>Color primario</label>
                            <input type="color" id="primary-color" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Color secundario</label>
                            <input type="color" id="secondary-color" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Color acento</label>
                            <input type="color" id="accent-color" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Color fondo</label>
                            <input type="color" id="background-color" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Color texto</label>
                            <input type="color" id="text-color" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- BOTÓN GUARDAR -->
        <div class="row">
            <div class="col">
                <button id="save-shop" class="btn btn-success btn-lg">
                    <i class="fas fa-save mr-2"></i>
                    Guardar cambios
                </button>
                <span id="shop-save-status" class="ml-3 text-muted"></span>
            </div>
        </div>

    </div>
</div>

<script>
    function loadShopData() {
        selectData(
            "*",
            "customShop",
            "LIMIT 1",
            (res) => {
                if (!res.success || res.data.length === 0) return;

                const shop = res.data[0];
                console.log(shop)

                $('#shop-name').val(shop.name);
                $('#shop-slogan').val(shop.slogan);
                $('#shop-description').val(shop.description);

                $('#shop-logo').val(shop.logo_url);
                $('#shop-logo-dark').val(shop.logo_dark_url);

                $('#primary-color').val(shop.primary_color);
                $('#secondary-color').val(shop.secondary_color);
                $('#accent-color').val(shop.accent_color);
                $('#background-color').val(shop.background_color);
                $('#text-color').val(shop.text_color);
            }
        );
    }

    $(document).ready(function() {

        loadShopData();



        $('#save-shop').on('click', function() {

            const values = `
            name='${$('#shop-name').val()}',
            slogan='${$('#shop-slogan').val()}',
            description='${$('#shop-description').val()}',
            logo_url='${$('#shop-logo').val()}',
            logo_dark_url='${$('#shop-logo-dark').val()}',
            primary_color='${$('#primary-color').val()}',
            secondary_color='${$('#secondary-color').val()}',
            accent_color='${$('#accent-color').val()}',
            background_color='${$('#background-color').val()}',
            text_color='${$('#text-color').val()}'
        `;

            updateData(
                "customShop",
                values,
                "WHERE id = 1",
                (res) => {
                    if (res.success) {
                        $('#shop-save-status')
                            .text('Cambios guardados correctamente')
                            .removeClass('text-danger')
                            .addClass('text-success');
                    } else {
                        $('#shop-save-status')
                            .text('Error al guardar')
                            .removeClass('text-success')
                            .addClass('text-danger');
                    }
                }
            );
        });

    });
</script>