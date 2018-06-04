<div class="container">
    <h3 class="blue-text text-darken-1 center-align">History</h3>
    <br>
    <div class="card-panel">
        <table class="highlight responsive-table">
            <thead>
                <tr>
                    <th>Accession #</th>
                    <th>Book Title</th>
                    <th>Book Author</th>
                    <th>Borrow Date</th>
                    <th>Return Date</th>
                    <th>Due Date</th>
                    <th>Overdue Fine</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($reservations as $reservation): ?>
                <tr>
                    <th><?= "{$reservation->book->isbn}-{$reservation->copy->id}" ?></th>
                    <td><?= $reservation->book->title ?></td>
                    <td><?= $reservation->book->author ?></td>
                    <td><?= (new DateTime($reservation->borrow_date))->format('d M Y') ?></td>
                    <td><?= (new DateTime($reservation->return_date))->format('d M Y') ?></td>
                    <td><?= (new DateTime($reservation->due_date))->format('d M Y') ?></td>
                    <td>&#8369; <?= $reservation->overdue_fine ?>.00</td>
                    <td>
                        <?php switch($reservation->status): 
                            case 1: ?>
                            Borrowed
                            <?php break ?>
                            <?php case 2: ?>
                            Returned
                            <?php break ?>
                            <?php case 4: ?>
                            Denied
                            <?php break ?>
                            <?php case 5: ?>
                            Not Available
                        <?php endswitch ?>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    </div>
</div>