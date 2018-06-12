<div class="container">
    <?= var_dump($copies) ?>
    <h3 class="blue-text text-darken-1 center-align">Inventory</h3>
    <br>
    <div class="card-panel">
        <table class="responsive-table">
            <thead>
                <tr>
					<th>Accession Number</th>
					<th>Title</th>
					<th>Author</th>
					<th>Copy Date</th>
					<th>Status</th>
				</tr>
            </thead>
            <tbody>
                <?php foreach($copies as $copy): ?>
                <tr>
                    <th><?= "{$copy->book->isbn}-{$copy->id}" ?></th>
                    <td><?= $copy->book->title ?></td>
                    <td><?= $copy->book->author ?></td>
                    <td><?= (new DateTime($copy->copy_date))->format('d M Y h:m A') ?></td>
                    <td><?= $copy->status || $copy->status == 't' ? 'On shelf' : 'Borrowed' ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>