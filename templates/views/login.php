<?php
require __DIR__ . "/../../utils/checkout_utils.php";
require __DIR__ . "/../../utils/auth_utils.php";


if (isLoggedIn()) {
    header("Location: /");
    exit;
}

?>

<?php include __DIR__ . "/../components/navbar.php"; ?>

<section class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Iniciar sesión</h3>
                </div>
                <div class="card-body">
                    <form id="login-form">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script defer>
    $('#login-form').on('submit', function(e) {
        e.preventDefault();

        const email = $('#email').val();
        const password = $('#password').val();

        login(email, password, (res) => {
            if (res.success) {
                // Redirigir después del login
                const urlParams = new URLSearchParams(window.location.search);
                const redirectUrl = urlParams.get('redirect') || '/';
                window.location.href = redirectUrl;
            } else {
                alert(res.message || 'Error al iniciar sesión');
            }
        })
    });
</script>