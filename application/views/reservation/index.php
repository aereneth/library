<div class="container">
    <h3 class="blue-text text-darken-1 center-align">Reservation</h3>
    <br>
    <div class="card">
        <div class="card-content">
            <div id="bookContainer" class="row">
                <div class="input-field col s8">
                    <input type="text" name="book[]" class="validate" list="bookList">
                    <label>Book Name</label>
                </div>
                <div class="input-field col s4">
                    <input type="date" name="date[]" class="validate">
                    <label>Reservation Date</label>
                </div>
            </div>
        </div>
        <div class="card-action">
            <button class="btn-flat waves-effect waves-blue" onclick="addBook(event)">Add Book</button>
        </div>
    </div>
</div>

<datalist id="bookList">
    <?php foreach($books as $book): ?>
    <?php if(count($book->copies)): ?>
    <option value="<?= "{$book->title} ({$book->edition})" ?>"><?= "{$book->title} ({$book->edition})" ?></option>
    <?php endif ?>
    <?php endforeach ?>
</datalist>

<script>
    function addBook(e) {
        $('#bookContainer').append(`
            <div class="input-field col s8">
                <input type="text" name="book[]" class="validate" list="bookList">
                <label>Book Name</label>
            </div>
            <div class="input-field col s4">
                <input type="date" name="date[]" class="validate">
                <label>Reservation Date</label>
            </div>`
        );
    }
</script>