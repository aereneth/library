<div class="section">
    <div class="container">
        <h3 class="blue-text text-darken-1 center-align">Settings</h3>
        <br>
        <div class="card-panel">
            <form action="<?= base_url('settings') ?>" method="post">
                <div class="row">
                    <div class="input-field col s12 m5">
                        <input type="number" class="validate" name="overdue_rate" id="overdueRateField" value="<?= $overdue_rate->value ?>" min="0" required>
                        <label for="overdueRateField">Overdue Rate (in Philippine Peso)</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <input type="number" class="validate" name="borrow" id="borrowField" value="<?= $borrow_duration->value ?>" min="0" required>
                        <label for="overdueRateField">Allowed days of borrowing of books</label>
                    </div>
                    <div class="col s12 m2">
                        <center>
                            <button type="submit" class="btn btn-large waves-effect waves-light"><i class="material-icons left">save</i>Save</button>
                        </center>
                    </div>
                    <div class="col s12">
                        <p class="red-text"><?= $this->session->flashdata('errors') ?? '' ?></p>
                        <p class="green-text"><?= $this->session->flashdata('message') ?? '' ?></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>