<div class="container">
    <h3 class="blue-text text-darken-1 center-align">Accounts</h3>
    <br>
    <div class="card-panel">
        <a href="<?= base_url('account/create') ?>" class="btn waves-effect waves-light blue"><i class="material-icons left">add</i>Add Account</a>
        <table class="striped highlight responsive-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Contact Number</th>
                    <th>Privilege</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($accounts as $account): ?>
                <tr>
                    <th><?= $account->id ?></th>
                    <td><?= $account->first_name ?></td>
                    <td><?= $account->last_name ?></td>
                    <td><?= $account->email_address ?></td>
                    <td><?= $account->contact_number ?></td>
                    <td>
                        <?php if($account->privilege <= 1) {
                            echo 'Admin';
                        } else if($account->privilege == 2) {
                            echo 'Staff';
                        } else if($account->privilege == 3) {
                            echo 'User';
                        }  ?>
                    </td>
                    <td>
                        <a href="<?= base_url("account/update/{$account->id}") ?>" class="btn waves-effect green">Edit</a>
                        <button data-value="<?= $account->id ?>" onclick="deleteAccount(event)" class="btn waves-effect red">Delete</button>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function deleteAccount(e) {
        if(confirm('Are you sure you want to delete this account?')) {
            window.location.href = `/account/delete/${$(e.target).attr('data-value')}`;
        }
    }
</script>