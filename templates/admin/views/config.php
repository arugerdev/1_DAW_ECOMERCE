<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Configuración de la tienda</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Configuracion</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">

        <div class="row">

            <!-- CONTACTO -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-address-book mr-1"></i>
                            Contacto
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Email de contacto</label>
                            <input type="email" id="contact-email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="text" id="contact-phone" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>WhatsApp</label>
                            <input type="text" id="contact-whatsapp" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <!-- DIRECCIÓN -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            Dirección
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Dirección</label>
                            <input type="text" id="address" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Ciudad</label>
                            <input type="text" id="city" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Código postal</label>
                            <input type="text" id="postal-code" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>País</label>
                            <input type="text" id="country" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <!-- REDES -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-share-alt mr-1"></i>
                            Redes sociales
                        </h3>
                    </div>
                    <div class="card-body">
                        <input class="form-control mb-2" id="facebook-url" placeholder="Facebook">
                        <input class="form-control mb-2" id="instagram-url" placeholder="Instagram">
                        <input class="form-control mb-2" id="twitter-url" placeholder="Twitter / X">
                        <input class="form-control mb-2" id="tiktok-url" placeholder="TikTok">
                        <input class="form-control" id="youtube-url" placeholder="YouTube">
                    </div>
                </div>
            </div>

            <!-- SEO -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-search mr-1"></i>
                            SEO
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Meta título</label>
                            <input type="text" id="meta-title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Meta descripción</label>
                            <textarea id="meta-description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Palabras clave</label>
                            <input type="text" id="meta-keywords" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <!-- TEXTOS -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-font mr-1"></i>
                            Textos legales
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Texto del footer</label>
                            <input type="text" id="footer-text" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Copyright</label>
                            <input type="text" id="copyright-text" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <!-- AJUSTES -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-cogs mr-1"></i>
                            Ajustes generales
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Moneda</label>
                            <input type="text" id="currency" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Símbolo</label>
                            <input type="text" id="currency-symbol" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>IVA (%)</label>
                            <input type="number" step="0.01" id="tax-percent" class="form-control">
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="maintenance-mode">
                                <label class="custom-control-label" for="maintenance-mode">
                                    Modo mantenimiento
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- GUARDAR -->
        <div class="row">
            <div class="col">
                <button id="save-advanced" class="btn btn-success btn-lg">
                    <i class="fas fa-save mr-2"></i>
                    Guardar cambios
                </button>
                <span id="save-status" class="ml-3 text-muted"></span>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {

        loadAdvancedSettings();

        function loadAdvancedSettings() {
            selectData("*", "customShop", "LIMIT 1", (res) => {
                if (!res.success || res.data.length === 0) return;
                const s = res.data[0];

                $('#contact-email').val(s.contact_email);
                $('#contact-phone').val(s.contact_phone);
                $('#contact-whatsapp').val(s.whatsapp);

                $('#address').val(s.address);
                $('#city').val(s.city);
                $('#postal-code').val(s.postal_code);
                $('#country').val(s.country);

                $('#facebook-url').val(s.facebook_url);
                $('#instagram-url').val(s.instagram_url);
                $('#twitter-url').val(s.twitter_url);
                $('#tiktok-url').val(s.tiktok_url);
                $('#youtube-url').val(s.youtube_url);

                $('#meta-title').val(s.meta_title);
                $('#meta-description').val(s.meta_description);
                $('#meta-keywords').val(s.meta_keywords);

                $('#footer-text').val(s.footer_text);
                $('#copyright-text').val(s.copyright_text);

                $('#currency').val(s.currency);
                $('#currency-symbol').val(s.currency_symbol);
                $('#tax-percent').val(s.tax_percent);

                $('#maintenance-mode').prop('checked', s.maintenance_mode == 1);
            });
        }

        $('#save-advanced').on('click', function() {

            const values = `
            contact_email='${$('#contact-email').val()}',
            contact_phone='${$('#contact-phone').val()}',
            whatsapp='${$('#contact-whatsapp').val()}',

            address='${$('#address').val()}',
            city='${$('#city').val()}',
            postal_code='${$('#postal-code').val()}',
            country='${$('#country').val()}',

            facebook_url='${$('#facebook-url').val()}',
            instagram_url='${$('#instagram-url').val()}',
            twitter_url='${$('#twitter-url').val()}',
            tiktok_url='${$('#tiktok-url').val()}',
            youtube_url='${$('#youtube-url').val()}',

            meta_title='${$('#meta-title').val()}',
            meta_description='${$('#meta-description').val()}',
            meta_keywords='${$('#meta-keywords').val()}',

            footer_text='${$('#footer-text').val()}',
            copyright_text='${$('#copyright-text').val()}',

            currency='${$('#currency').val()}',
            currency_symbol='${$('#currency-symbol').val()}',
            tax_percent='${$('#tax-percent').val()}',
            maintenance_mode=${$('#maintenance-mode').is(':checked') ? 1 : 0}
        `;

            updateData("customShop", values, "WHERE id = 1", (res) => {
                $('#save-status')
                    .text(res.success ? 'Configuración guardada' : 'Error al guardar')
                    .toggleClass('text-success', res.success)
                    .toggleClass('text-danger', !res.success);
            });
        });

    });
</script>