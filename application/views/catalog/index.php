<div class="container">
    <br>
    <br>
    <div class="row">
        <div class="col s4 m2 offset-s4 offset-m5">
            <img src="<?= base_url('assets/img/logo-fit.png') ?>" class="responsive-img" alt="">
        </div>
        <div class="col s12">
            <h4 class="center-align blue-text text-darken-1">adInfinitum</h4>
        </div>
    </div>
    <h3 class="blue-text text-darken-1 center-align">Online Public Access Catalog</h3>
    <div class="card-panel">
        <table id="bookTable" class="hover">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Publisher</th>
                    <th>Publication Year</th>
                    <th>Edition</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.js"></script>

<script>
    $('#bookTable').DataTable({
		ajax: {
			url: 'api/book/get_all',
			dataSrc: '',
		},
		columns: [
			{data: 'isbn'},
			{data: 'title'},
			{data: 'author'},
			{
				data: 'category',
				render: function(data, type, row) {
					return data['name'];
				} 
			},
			{data: 'publisher'},
			{data: 'publication_year'},
			{data: 'edition'},
        ]
    });
</script>