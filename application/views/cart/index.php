<div class="container">
    <h3 class="blue-text text-darken-1 center-align">Cart</h3>
    <br>
    <div class="card-panel">
        <button class="btn waves-effect waves-light green" onclick="checkoutCart(event)"><i class="material-icons left">check_circle</i>Borrow Books</button>
        <button class="btn waves-effect waves-light red" onclick="emptyCart(event)"><i class="material-icons left">remove_shopping_cart</i>Empty Cart</button>
        <table id="cartTable" class="responsive-table">
            <thead>
                <tr>
                    <th>Accession Number</th>
                    <th>Book Title</th>
                    <th>Book Author</th>
                    <th>Book Publisher</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($cart as $index => $item): ?>
                <tr>
                    <th><?= "{$item->book->isbn}-{$item->id}" ?></th>
                    <td><?= $item->book->title ?></td>
                    <td><?= $item->book->author ?></td>
                    <td><?= $item->book->publisher ?></td>
                    <td>
                        <button class="btn waves-effect waves-light red" data-value="<?= $index ?>" onclick="removeBook(event)"><i class="material-icons left">remove_shopping_cart</i>Remove</button>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function checkoutCart(e) {
        $.ajax({
            url: 'api/cart/checkout',
            type: 'post',
            dataType: 'json',
        }).done(function() {
            alert('Reservation successfully submitted');
            window.location.href = '/';
        }).fail(function(data) {
            M.toast({
                html: data['responseJSON']['error'],
                classes: 'rounded',
            });
        });

        e.preventDefault();
    }

    function removeBook(e) {
        $.ajax({
            url: 'api/cart/remove',
            type: 'post',
            data: {
                copy_id: $(e.target).attr('data-value'),
            },
            dataType: 'json',
        }).done(function() {
            $(e.target).closest('tr').remove();
            M.toast({
                html: 'Book removed',
                classes: 'rounded',
            });
        }).fail(function(data) {
            M.toast({
                html: data['responseJSON']['error'],
                classes: 'rounded',
            });
        });
    }

    function emptyCart(e) {
        if(!confirm('Are you sure you want to empty your cart?')) {
            return;
        }

        $.ajax({
            url: 'api/cart/empty',
            type: 'post',
            dataType: 'json',
        }).done(function() {
            $('table#cartTable tbody').html('');
            M.toast({
                html: 'Table emptied',
                classes: 'rounded',
            });
        }).fail(function(data) {
            M.toast({
                html: data['responseJSON']['error'],
                classes: 'rounded',
            });
        });
    }
</script>