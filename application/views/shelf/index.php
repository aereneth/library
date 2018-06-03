<div class="container">
    <h3 class="blue-text text-darken-1 center-align">Shelf</h3>
    <br>
    <div class="row">
        <?php foreach($books as $book): ?>
        <div class="col s3">
            <div class="card sticky-action">
                <div class="card-image waves-effect waves-block waves-light">
                    <img src="<?= $book->image_url ?>" class="activator" alt="">
                </div>
                <div class="card-content">
                    <span class="card-title activator"><?= $book->title ?></span>
                </div>
                <div class="card-action">
                    <a href="#">Borrow</a>
                </div>
                <div class="card-reveal">
                    <span class="card-title"><?= $book->title ?><i class="material-icons right">close</i></span>
                    <p><?= $book->description ?></p>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>