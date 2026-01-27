<?php include_once __DIR__ . "/../components/navbar.php" ?>

<section class="bg text container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Progreso del checkout -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-center flex-fill">
                            <span class="badge bg-primary rounded-circle p-2" style="width: 28px; height:28px">1</span>
                            <p class="mt-2 mb-0 small fw-bold">Información</p>
                        </div>
                        <div class="flex-fill">
                            <hr class="my-0">
                        </div>
                        <div class="text-center flex-fill">
                            <span class="badge bg-secondary rounded-circle p-2" style="width: 28px; height:28px">2</span>
                            <p class="mt-2 mb-0 small text-muted">Confirmación</p>
                        </div>
                        <div class="flex-fill">
                            <hr class="my-0">
                        </div>
                        <div class="text-center flex-fill">
                            <span class="badge bg-secondary rounded-circle p-2" style="width: 28px; height:28px">3</span>
                            <p class="mt-2 mb-0 small text-muted">Pago</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="fs-4 mb-0">Información del cliente</h3>
                </div>
                <div class="card-body">
                    <!-- Tabs para registro/login -->
                    <ul class="nav nav-tabs mb-4" id="checkoutTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="text nav-link active" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab">
                                Nuevo cliente
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="text nav-link" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">
                                Cliente existente
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="checkoutTabContent">
                        <!-- Formulario de registro -->
                        <div class="tab-pane fade show active" id="register" role="tabpanel">
                            <form id="register-form">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Nombre *</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name" class="form-label">Apellidos *</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Teléfono *</label>
                                    <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Dirección *</label>
                                    <textarea class="form-control" id="address" name="address" rows="2" required></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">Ciudad *</label>
                                        <input type="text" class="form-control" id="city" name="city" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cp" class="form-label">Código Postal *</label>
                                        <input type="text" class="form-control" id="cp" name="cp" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="country" class="form-label">País *</label>
                                    <select class="form-control" id="country" name="country" required>
                                        <option value="">Seleccionar país</option>
                                        <option value="ES">España</option>
                                        <option value="FR">Francia</option>
                                        <option value="IT">Italia</option>
                                        <option value="DE">Alemania</option>
                                        <option value="PT">Portugal</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="create_account" name="create_account">
                                        <label class="form-check-label" for="create_account">
                                            Crear una cuenta para futuras compras
                                        </label>
                                    </div>
                                </div>

                                <div id="account-fields" class="d-none">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="password" class="form-label">Contraseña *</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="confirm_password" class="form-label">Confirmar Contraseña *</label>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="/cart" class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>Volver al carrito
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        Continuar <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Formulario de login -->
                        <div class="tab-pane fade" id="login" role="tabpanel">
                            <form id="login-form">
                                <div class="mb-3">
                                    <label for="login_email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="login_email" name="email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="login_password" class="form-label">Contraseña *</label>
                                    <input type="password" class="form-control" id="login_password" name="password" required>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="/cart" class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>Volver al carrito
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        Iniciar sesión <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resumen del pedido -->
        <div class="col-lg-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header">
                    <h4 class="fs-5 mb-0">Resumen del pedido</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span id="checkout-subtotal">0.00€</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Envío:</span>
                        <span id="checkout-shipping">5.00€</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total:</span>
                        <span id="checkout-total">0.00€</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'templates/components/footer.php' ?>


<script>
    $(document).ready(function() {
        // Calcular total del carrito
        loadOrderSummary((res) => {
            if (res.cart.length <= 0) window.location.replace('/cart')
        })

        updateCheckoutTotals((res) => {
            const subtotal = res.total || 0;
            const shipping = 5.00; // Envío fijo por ahora
            const total = subtotal + shipping;

            $('#checkout-subtotal').text(subtotal.toFixed(2) + '<?php echo SHOP_DATA->currency_symbol ?>');
            $('#checkout-shipping').text(shipping.toFixed(2) + '<?php echo SHOP_DATA->currency_symbol ?>');
            $('#checkout-total').text(total.toFixed(2) + '<?php echo SHOP_DATA->currency_symbol ?>');
        });

        // Mostrar/ocultar campos de cuenta
        $('#create_account').on('change', function() {
            if ($(this).is(':checked')) {
                $('#account-fields').removeClass('d-none');
                $('#password, #confirm_password').prop('required', true);
            } else {
                $('#account-fields').addClass('d-none');
                $('#password, #confirm_password').prop('required', false);
            }
        });

        // Validar contraseñas coinciden
        $('#confirm_password').on('keyup', function() {
            const password = $('#password').val();
            const confirmPassword = $(this).val();

            if (password !== confirmPassword) {
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        // Formulario de registro
        $('#register-form').on('submit', function(e) {
            e.preventDefault();

            const formData = $(this).serializeArray();
            const data = {};

            $.each(formData, function(_, field) {
                data[field.name] = field.value;
            });

            // Validar contraseñas si se crea cuenta
            if ($('#create_account').is(':checked')) {
                if ($('#password').val() !== $('#confirm_password').val()) {
                    alert('Las contraseñas no coinciden');
                    return;
                }
            }

            register(data, (res) => {
                if (res.success) {
                    window.location.href = '/checkout/confirm';
                } else {
                    alert(res.message || 'Error al guardar la información');
                }
            })

        });

        // Formulario de login
        $('#login-form').on('submit', function(e) {
            e.preventDefault();

            const email = $('#login_email').val();
            const password = $('#login_password').val();



            login(email, password, (res) => {
                if (res.success) {
                    window.location.href = '/checkout/confirm';
                } else {
                    alert(res.message || 'Credenciales incorrectas');
                }
            })
        });
    })
</script>