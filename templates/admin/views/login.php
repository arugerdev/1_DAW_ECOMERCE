<?php


?>

<main class="min-vh-100 " style="display: flex; justify-content:center; place-items:center; overflow:hidden;">

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>EviMerce</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="javascript:void(0)" id="loginAdminForm" method="post">
                    <div class="input-group mb-3">
                        <input type="user" class="form-control loginAdminForm_username" placeholder="User">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control loginAdminForm_password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- <div class="social-auth-links text-center mt-2 mb-3">
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div> -->
                <!-- /.social-auth-links -->
                <!-- 
                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p> -->
                <!-- <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</main>

<script defer>
    $("#loginAdminForm").on('submit', () => {
        const username = $(".loginAdminForm_username").val();
        const password = $(".loginAdminForm_password").val();

        loginAdmin(username, password, (data) => {
            console.log(data);
            if (data.success) {
                // Redirigir a la página de admin
                window.location.href = data.redirect || '/admin/';
            } else {
                // Mostrar error al usuario
                alert(data.error || 'Error en el login');
            }
        });
    });
</script>