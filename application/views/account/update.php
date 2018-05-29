<div class="container">
    <h3 class="blue-text text-darken-1 center-align">Accounts</h3>
    <br>
    <form action="<?= base_url("account/update/{$account->id}") ?>" method="post">
        <div class="card">
            <div class="card-content">
                <span class="card-title blue-text text-darken-1">Update Account</span>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input type="text" name="first_name" id="firstNameField" class="validate" value="<?= $account->first_name ?>" required>
                        <label for="firstNameField">First Name</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" name="last_name" id="lastNameField" class="validate" value="<?= $account->last_name ?>" required>
                        <label for="lastNameField">Last Name</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="email" name="email" id="emailField" class="validate" value="<?= $account->email_address ?>" required>
                        <label for="emailField">Email Address</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" name="contact_number" id="contactNumberField" class="validate" maxlength="11" value="<?= $account->contact_number ?>" required>
                        <label for="contactNumberField">Contact Number</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="address" id="addressField" class="validate" value="<?= $account->address ?>" required>
                        <label for="addressField">Address</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <select name="privilege" id="privilegeField">
                            <option value="1" <?= $account->privilege == 1 ? 'selected' : '' ?> >Admin</option>
                            <option value="2" <?= $account->privilege == 2 ? 'selected' : '' ?> >Staff</option>
                            <option value="3" <?= $account->privilege == 3 ? 'selected' : '' ?> >User</option>
                        </select>
                        <label for="privilegeField">Privilege</label>
                    </div>
                </div>
                <small class="red-text text-lighten-1"><?= $errors ?? '' ?></small>
            </div>
            <div class="card-action">
                <button type="submit" class="btn-flat waves-effect waves-green">Update Account</button>
            </div>
        </div>
    </form>
</div>