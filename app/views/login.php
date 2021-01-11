<div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
            <div class="card-body">
                <h5 class="card-title text-center">Login</h5>
                <form id="loginform" method="POST" action="<?php
                        echo $path.'login/postLogin'; ?>">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email de acesso" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Senha de acesso" required>
                    </div>
                    <div class="form-group form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" id="lembrar" name="lembrar" value="lembrar"> Lembrar-me
                        </label>
                    </div>
                    <input type="submit" id="btnlogin" class="btn btn-lg btn-outline-primary btn-block text-uppercase" name="btnlogin" value="Login" disabled>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $path; ?>public/js/login.js"></script>