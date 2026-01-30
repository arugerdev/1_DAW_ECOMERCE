<div class="content-header p-4">
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

<div class="content p-4">
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

                        <div class="form-group d-flex flex-column">
                            <label>Descripción</label>
                            <small class="text-info">You can use HTML for styling</small>
                            <small class="text-danger">Do not use: ' ' for strings (Singles quoted) use " " instead</small>
                            <textarea id="shop-description" class="form-control" rows="8"></textarea>
                        </div>

                    </div>
                </div>
            </div>

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

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-palette mr-1"></i>
                            Imagenes
                        </h3>
                    </div>

                    <div class="card-body d-lg-flex flex-row gap-2 justify-content-lg-between">
                        <div class="form-group d-flex flex-column justify-center">
                            <label class="dropzone-file-upload" for="logo_input">
                                LOGO
                                <i class="fa-solid fa-images icon fs-1"></i>
                                <div class="text">
                                    <span>Haz clic para subir imagen</span>
                                </div>
                                <input type="file" id="logo_input" multiple accept="image/*" style="display:none;">
                            </label>
                            <img src="" id="logo-preview" style="object-fit: contain;" height="128" alt="">
                        </div>

                        <div class="form-group d-flex flex-column justify-center">
                            <label class="dropzone-file-upload" for="logo_brand_input">
                                Logo Extirado
                                <i class="fa-solid fa-images icon fs-1"></i>
                                <div class="text">
                                    <span>Haz clic para subir imagen</span>
                                </div>
                                <input type="file" id="logo_brand_input" multiple accept="image/*" style="display:none;">
                            </label>
                            <img src="" id="logo-brand-preview" style="object-fit: contain;" height="128" alt="">
                        </div>
                        <div class="form-group d-flex flex-column justify-center">
                            <label class="dropzone-file-upload" for="banner_input">
                                Cabecera
                                <i class="fa-solid fa-images icon fs-1"></i>
                                <div class="text">
                                    <span>Haz clic para subir imagen</span>
                                </div>
                                <input type="file" id="banner_input" multiple accept="image/*" style="display:none;">
                            </label>
                            <img src="" id="banner-preview" style="object-fit: contain;" height="128" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <!-- COLORES -->

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
    $('#shop-description').on('blur', (e) => {
        const parsedString = e.target.value.replaceAll("'", '"');
        e.target.value = parsedString

    })

    function loadShopData() {


        getShopImage((res) => {
            $('#logo-preview')
                .attr('src', '/uploads/img/shop/' + res.images.filter((p) => p.includes('logo.'))[0])
                .removeClass('d-none');
            $('#logo-brand-preview')
                .attr('src', '/uploads/img/shop/' + res.images.filter((p) => p.includes('logo-brand.'))[0])
                .removeClass('d-none');
            $('#banner-preview')
                .attr('src', '/uploads/img/shop/' + res.images.filter((p) => p.includes('banner.'))[0])
                .removeClass('d-none');
        })

        selectData(
            "*",
            "customShop",
            "LIMIT 1",
            (res) => {
                if (!res.success || res.data.length === 0) return;

                const shop = res.data[0];

                $('#shop-name').val(shop.name);
                $('#shop-slogan').val(shop.slogan);
                $('#shop-description').val(shop.description);

                $('#primary-color').val(shop.primary_color);
                $('#secondary-color').val(shop.secondary_color);
                $('#accent-color').val(shop.accent_color);
                $('#background-color').val(shop.background_color);
                $('#text-color').val(shop.text_color);
            }
        );
    }

    function uploadShopImage(file, type, img) {
        const token = 'shop'; // fijo
        const formData = new FormData();

        formData.append('action', 'uploadShopImage');
        formData.append('type', type);
        formData.append('image', file);

        fetch('../../utils/images_utils.php', {
            method: 'POST',
            body: formData
        }).then(r => r.json()).then(res => {
            if (!res.success) return alert('Error subiendo imagen');

            img.src = res.url + '?t=' + Date.now();
            img.classList.remove('d-none');

        });
    }


    $(document).ready(function() {

        loadShopData();

        $('#logo_input').on('change', (e) => {
            uploadShopImage(e.target.files[0], 'logo', $('#logo-preview')[0]);
        })
        $('#logo_brand_input').on('change', (e) => {
            uploadShopImage(e.target.files[0], 'logo-brand', $('#logo-brand-preview')[0]);
        })
        $('#banner_input').on('change', (e) => {
            uploadShopImage(e.target.files[0], 'banner', $('#banner-preview')[0]);
        })

        $('#save-shop').on('click', function() {

            const values = `
            name='${$('#shop-name').val()}',
            slogan='${$('#shop-slogan').val()}',
            description='${$('#shop-description').val()}',
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