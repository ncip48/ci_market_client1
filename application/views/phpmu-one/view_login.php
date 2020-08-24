<!--  <p class='sidebar-title'> Login Users</p> 

            <div class='alert alert-info'>Masukkan username dan password untuk login,...</div>
            <br>
            <div class="logincontainer">
                <form method="post" action="<?php echo base_url(); ?>auth/login" role="form" id='formku'>
                    <div class="form-group">
                        <label for="inputEmail">Username</label>
                        <input type="text" name="a" class="required form-control" placeholder="Masukkan Username" autofocus=""  minlength='5' onkeyup="nospaces(this)">
                    </div>

                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" name="b" class="form-control required" placeholder="Masukkan Password" onkeyup=\"nospaces(this)\" autocomplete="off">
                    </div>
                    <a href="#" data-toggle='modal' data-target='#lupass'>Lupa Password Anda?</a><br><br>
                    <div align="center">
                        <input name='login' type="submit" class="btn btn-primary" value="Login"> <a href="<?php echo base_url(); ?>auth/register" title="Mari gabung bersama Kami" class="btn btn-default">Belum Punya Akun?</a>
                    </div>
                </form>
            </div> -->

<div class='container container-login'>
    <div class='center row justify-content-center'>
        <div class="col-md-4"></div>
        <div class='col-md-4 col-12 login-form-2'>
            <h3>Login</h3>
            <form method='post' action="<?php echo base_url(); ?>auth/login" role='form' id='formku'>
                <div class='form-group'>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                        </div>
                        <input name='a' type='text' class='form-control' placeholder='Masukkan username' value='' />
                    </div>
                </div>
                <div class='form-group'>
                    <div class="input-group mb-2" id="show_hide_password">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></div>
                        </div>
                        <input name='b' type='password' class='form-control' placeholder='Masukkan Password' value='' />
                        <div class="input-group-append">
                            <button id="showHidePw" type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
                <div class='form-group'>
                    <input name='login' type='submit' class='btnSubmit' value='Login' />
                </div>
                <div class='form-group'>
                    <a href="#" data-toggle='modal' data-target='#lupass' class='ForgetPwd' value='Lupa Password'>Lupa Password?</a>
                </div>
                <div id='aksilogin'></div>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>