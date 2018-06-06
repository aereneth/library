<div class="container">
    <br>
    <br>
    <div class="row">
        <div class="col s4 m2 offset-s4 offset-m5">
            <img src="<?= base_url('assets/img/logo-fit.png') ?>" class="responsive-img" alt="">
        </div>
        <div class="col s12">
            <h4 class="center-align blue-text text-darken-1">adInfinitum</h4>
        </div>
        <div class="col s12">
            <div class="card">
                <form action="<?= base_url('register') ?>" method="post">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12">
                                <h5 class="blue-text">Register</h5>
                            </div>
                            <div class="input-field col s12 m6">
                                <input type="text" name="first_name" id="firstNameField" class="validate" value="<?= set_value('first_name') ?>" required>
                                <label for="firstNameField">First Name</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input type="text" name="last_name" id="lastNameField" class="validate" value="<?= set_value('last_name') ?>" required>
                                <label for="lastNameField">Last Name</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input type="email" name="email" id="emailField" class="validate" value="<?= set_value('email') ?>" required>
                                <label for="emailField">Email Address</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input type="text" name="contact_number" id="contactNumberField" class="validate" value="<?= set_value('contact_number') ?>" maxlength="11" required>
                                <label for="contactNumberField">Contact Number</label>
                            </div>
                            <div class="input-field col s12">
                                <input type="text" name="address" id="addressField" class="validate" value="<?= set_value('address') ?>" required>
                                <label for="addressField">Address</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="password" name="password" id="passwordField" class="validate" maxlength="32" required>
                                <label for="passwordField">Password</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="password" name="confirm_password" id="confirmPasswordField" class="validate" maxlength="32" required>
                                <label for="confirmPasswordField">Confirm Password</label>
                            </div>
                            <div class="col s12">
                                <span class="red-text text-lighten-1"><?= $this->session->flashdata('errors') ?></span>
                            </div>
                            <div class="col s12">
                                <center>
                                    <button type="submit" class="btn blue waves-effect waves-light">
                                        Register
                                        <i class="material-icons left">add</i>
                                    </button>
                                </center>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>