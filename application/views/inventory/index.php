<div class="container">
    <h3 class="blue-text text-darken-1 center-align">Inventory</h3>
    <br>
    <div class="card-panel">
        <table id="inventoryTable" class="highlight responsive-table">
            <thead>
                <tr>
					<th>ISBN</th>
					<th>Title</th>
					<th>Author</th>
					<th>Category</th>
					<th>Publisher</th>
					<th>Copies</th>
					<th>Actions</th>
				</tr>
            </thead>
        </table>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.js"></script>

<script>
    var inventoryTable = $('#inventoryTable').DataTable({
        ajax: {
            url: 'api/book/get_all',
            dataSrc: ''
        },
        columns: [
            { data: 'isbn' },
            { data: 'title' },
            { data: 'author' },
            { 
                data: 'category',
                render: function(data, type, row) {
                    return data['name'];
                },
            },
            { data: 'publisher' },
            { 
                data: 'copies',
                render: function(data, type, row) {
                    return data.length;
                },
            },
            { 
                data: 'id',
                render: function(data, type, row) {
                    return `<button class="btn waves-effect waves-light green" data-value="${data}" onclick="createCopy(event)">Make a copy</button>
                    <a href="<?= base_url('inventory/view') ?>/${data}" class="btn waves-effect waves-light blue" data-value="${data}"">View copies</button>`;
                },
            },
        ]
    });

    function createCopy(e) {
        $.ajax({
            url: 'api/copy/add',
            type: 'post',
            data: {
                book_id: $(e.target).attr('data-value')
            },
        }).done(function() {
            M.toast({html: 'Copy created', classes: 'rounded'});
            inventoryTable.ajax.reload();
        });

        e.preventDefault();
    }
</script>