<div class="section">
    <div class="container">
        <div class="row">
            <div class="col s4 m2 offset-s4 offset-m5">
                <img src="<?= base_url('assets/img/logo-fit.png') ?>" class="responsive-img" alt="">
            </div>
            <div class="col s12">
                <h4 class="center-align blue-text text-darken-1">adInfinitum</h4>
            </div>
            <div class="col s12 m6 offset-m3">
                <div class="card">
                    <form action="<?= base_url('reset') ?>" method="post">
                        <div class="card-content">
                            <h5 class="blue-text">Reset Password</h5>
                            <div class="row">
                                <div class="input-field col s12">
                                    <div class="material-icons prefix">account_circle</div>
                                    <input id="emailField" type="email" class="validate" name="email" required>
                                    <label for="emailField">Email Address</label>
                                </div>
                                <div class="input-field col s12">
                                    <div class="material-icons prefix">lock</div>
                                    <input id="passwordField" type="password" class="validate" name="password" maxlength="32" required>
                                    <label for="passwordField">Password</label>
                                </div>
                                <div class="input-field col s12">
                                    <div class="material-icons prefix">lock</div>
                                    <input id="confirmPasswordField" type="password" class="validate" name="confirm_password" maxlength="32" required>
                                    <label for="confirmPasswordField">Confirm Password</label>
                                </div>
                            </div>
                            <center>
                                <button type="submit" class="btn blue waves-effect waves-light"><i class="material-icons right">send</i>Reset Password</button>
                            </center>
                        </div>
                    </form>
                </div>
                <?php if($this->session->flashdata('errors')): ?>
                <div class="card-panel red">
                    <p class="white-text"><?= $this->session->flashdata('errors') ?></p>
                </div>
                <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>