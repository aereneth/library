<div class="container">
    <h3 class="blue-text text-darken-1 center-align">Circulation</h3>
    <br>
    <div class="card-panel">
        <table id="circulationTable" class="highlight responsive-table">
            <thead>
                <tr>
                    <th>Accession #</th>
                    <th>Book Title</th>
                    <th>Book Author</th>
                    <th>Borrower's Name</th>
                    <th>Borrowed Date</th>
                    <th>Returned Date</th>
                    <th>Due Date</th>
                    <th>Status</th>
                </tr>
            </thead>
        </table>
    </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.js"></script>

<script>
    var circulationTable = $('#circulationTable').DataTable({
        ajax: {
            url: 'api/reservation/get_all',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'copy',
                render: function(data, type, row) {
                    return `${row['book']['isbn']}-${data['id']}`
                }
            },
            {
                data: 'book',
                render: function(data, type, row) {
                    return data['title'];
                },
            },
            {
                data: 'book',
                render: function(data, type, row) {
                    return data['author'];
                },
            },
            {
                data: 'user',
                render: function(data, type, row) {
                    return `${data['first_name']} ${data['last_name']}`;
                },
            },
            { data: 'borrow_date' },
            { 
                data: 'return_date',
                render: function(data, type, row) {
                    if(data) {
                        return data;
                    } else {
                        return 'Not yet returned';
                    }
                },
            },
            { data: 'due_date' },
            {
                data: 'status',
                render: function(data, type, row) {
                    if(data == 0) {
                        return 'Reserved';
                    } else if(data == 1) {
                        return 'Borrowed';
                    } else if(data == 2) {
                        return 'Returned';
                    } else if(data == 4) {
                        return 'Denied';
                    } else if(data == 5) {
                        return 'Not Available';
                    }
                },
            },
        ],
    });
</script>