<div class="container">
    <h3 class="blue-text text-darken-1 center-align">Reservation</h3>
    <br>
    <div class="card-panel">
        <table id="reservationTable" class="highlight responsive-table">
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>Book Title</th>
                    <th>Borrower's Name</th>
                    <th>Reservation Date</th>
                    <th>Due Date</th>
                    <th>Overdue Fine</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.js"></script>

<script>
    var reservationTable = $('#reservationTable').DataTable({
        ajax: {
            url: 'api/reservation/get_all',
            dataSrc: ''
        },
        columns: [
            { data: 'id' },
            {
                data: 'book',
                render: function(data, type, row) {
                    return data['title'];
                },
            },
            {
                data: 'user',
                render: function(data, type, row) {
                    return `${data['first_name']} ${data['last_name']}`;
                },
            },
            { data: 'reservation_date' },
            { 
                data: 'due_date',
                render: function(data, type, row) {
                    if(data) {
                        return data;
                    } else {
                        return 'To be set';
                    }
                },
            },
            { data: 'overdue_fine' },
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
            {
                data: 'status',
                render: function(data, type, row) {
                    if(data == 0) {
                        return `<button class="btn waves-effect waves-light green" data-value="${row['id']}" onclick="accept(event)">Accept</button>
                            <button class="btn waves-effect waves-light red" data-value="${row['id']}" onclick="deny(event)">Deny</button>`;
                    } else if(data == 1) {
                        return `<button class="btn waves-effect waves-light blue" data-value="${row['id']}" onclick="returned(event)">Return</button>`;
                    } else if(data == 2) {
                        return `<button class="btn waves-effect waves-light blue" disabled>Returned</button>`;
                    } else if(data == 4) {
                        return `<button class="btn waves-effect waves-light red" disabled>Denied</button>`;
                    } else if(data == 5) {
                        return `<button class="btn waves-effect waves-light grey" disabled>Not Available</button>`;
                    }
                },
            },

        ],
    });

    function accept(e) {
        $.ajax({
            url: 'api/reservation/accept',
            type: 'post',
            data: {
                reservation_id: $(e.target).attr('data-value'),
            },
            dataType: 'json',
        }).done(function() {
            reservationTable.ajax.reload();
            M.toast({
                html: 'Reservation accepted',
                classes: 'rounded'
            });
        }).fail(function(data) {
            reservationTable.ajax.reload();
            M.toast({
                html: data['responseJSON']['error'],
                classes: 'rounded'
            });
        });

        e.preventDefault();
    }

    function deny(e) {
        $.ajax({
            url: 'api/reservation/deny',
            type: 'post',
            data: {
                reservation_id: $(e.target).attr('data-value'),
            },
            dataType: 'json',
        }).done(function() {
            reservationTable.ajax.reload();
            M.toast({
                html: 'Reservation denied',
                classes: 'rounded'
            });
        }).fail(function(data) {
            reservationTable.ajax.reload();
            M.toast({
                html: data['responseJSON']['error'],
                classes: 'rounded'
            });
        });

        e.preventDefault();
    }

    function returned(e) {
        $.ajax({
            url: 'api/reservation/return',
            type: 'post',
            data: {
                reservation_id: $(e.target).attr('data-value'),
            },
            dataType: 'json',
        }).done(function(data) {
            reservationTable.ajax.reload();
            M.toast({
                html: data['message'],
                classes: 'rounded'
            });
        }).fail(function(data) {
            reservationTable.ajax.reload();
            M.toast({
                html: data['responseJSON']['error'],
                classes: 'rounded'
            });
        });

        e.preventDefault();
    }
</script>