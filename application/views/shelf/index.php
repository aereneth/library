<div class="container">
    <h3 class="blue-text text-darken-1 center-align">Shelf</h3>
    <br>
    <div class="row">
        <?php foreach($books as $index => $book): ?>
        <div class="col s3">
            <div class="card sticky-action">
                <div class="card-image waves-effect waves-block waves-light">
                    <img src="<?= $book->image_url ?>" class="activator" alt="">
                </div>
                <div class="card-content">
                    <span class="card-title activator"><?= $book->title ?></span>
                </div>
                <div class="card-action">
                    <a href="#" onclick="borrowBook(event)" data-value="<?= $book->id ?>">Borrow</a>
                </div>
                <div class="card-reveal">
                    <span class="card-title"><?= $book->title ?><i class="material-icons right">close</i></span>
                    <p><?= $book->description ?></p>
                </div>
            </div>
        </div>
        <?php if($index % 4 == 3): ?>
        <div class="col s12"></div>
        <?php endif ?>
        <?php endforeach ?>
    </div>
</div>

<script>
    function borrowBook(e) {
        $.ajax({
            url: 'api/cart/add',
            type: 'post',
            data: {
                book_id: $(e.target).attr('data-value'),
            },
            dataType: 'json',
        }).done(function() {
            M.toast({html: 'Book added to cart', classes: 'rounded'});
        }).fail(function(data) {
            M.toast({html: data['responseJSON']['error'], classes: 'rounded'});
        });

        e.preventDefault();
    }
</script>