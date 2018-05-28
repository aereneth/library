<div class="container">
	<h3 class="blue-text text-darken-1 center-align">Acquisition</h3>
	<br>
	<div class="card-panel">
		<button class="btn waves-effect blue" onclick="openAddBookModal()"><i class="material-icons left">add</i>Add Book</button>
		<button class="btn waves-effect blue modal-trigger" data-target="addCategoryModal"><i class="material-icons left">add</i>Add Category</button>
		<br>
		<br>
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
					<th>Acquisition Date</th>
					<th>Recent Update Date</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>

<div id="bookModal" class="modal modal-fixed-footer">
	<form id="submitBookForm" method="post" onsubmit="submitBook(event)">
		<input type="hidden" id="actionField">
		<input type="hidden" name="id" id="idField">
		<div class="modal-content">
			<h4>Add/Update Book</h4>
			<div class="row">
				<div class="input-field col s12">
					<input id="isbnField" type="text" class="validate" name="isbn" required>
					<label for="isbnField">ISBN</label>
				</div>
				<div class="input-field col s12">
					<input id="titleField" type="text" class="validate" name="title">
					<label for="titleField">Title</label>
				</div>
				<div class="input-field col s12">
					<input id="otherTitleField" type="text" class="validate" name="other_title">
					<label for="otherTitleField">Other Title</label>
				</div>
				<div class="input-field col s12">
					<input id="authorField" type="text" class="validate" name="author" required>
					<label for="authorField">Author</label>
				</div>
				<div class="input-field col s12">
					<input id="otherAuthorField" type="text" class="validate" name="other_author" >
					<label for="otherAuthorField">Other Author</label>
				</div>
				<div class="input-field col s12">
					<select id="categoryField" name="category_id" required>
						<?php foreach($categories as $category): ?>
						<option value="<?= $category->id ?>"><?= $category->name ?></option>
						<?php endforeach ?>
					</select>
					<label for="titleField">Category</label>
				</div>
				<div class="input-field col s12">
					<input id="publisherField" type="text" class="validate" name="publisher" required>
					<label for="publisherField">Publisher</label>
				</div>
				<div class="input-field col s6">
					<input id="yearField" type="text" class="validate" name="publication_year" maxlenght="4">
					<label for="yearField">Publication Year</label>
				</div>
				<div class="input-field col s6">
					<input id="editionField" type="text" class="validate" name="edition">
					<label for="editionField">Edition</label>
				</div>
				<div class="input-field col s12" required>
					<textarea name="description" id="descriptionField" class="materialize-textarea" cols="80" rows="10"></textarea>
					<label for="descriptionField">Description</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="waves-effect waves-green btn-flat">Save</button>
			<button class="modal-close waves-effect waves-red btn-flat">Cancel</button>
		</div>
	</form>
</div>

<div id="addCategoryModal" class="modal modal-fixed-footer">
	<form id="addCategoryForm" method="post" onsubmit="addCategory(event)">
		<div class="modal-content">
			<h4>Add Category</h4>
			<div class="row">
				<div class="input-field col s12">
					<input id="categoryNameField" type="text" class="validate" name="name" required>
					<label for="categoryNameField">Name</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="waves-effect waves-green btn-flat">Save</button>
			<button class="modal-close waves-effect waves-red btn-flat">Cancel</button>
		</div>
	</form>
</div>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.js"></script>

<script>
	var bookTable = $('#bookTable').DataTable({
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
			{data: 'acquisition_date'},
			{data: 'recent_update_date'},
			{
				data: 'id',
				render: function(data, type, row) {
					return `<button class="btn btn-small blue waves-effect white-text" data-value="${data}" onclick="openUpdateBookModal(event)">Update</button>
					<button class="btn btn-small red waves-effect white-text" data-value="${data}" onclick="deleteBook(event)">Delete</button>`;
				}
			}
		]
	});

	function openAddBookModal(e) {
		var modal = $('#bookModal');

		$('form#submitBookForm')[0].reset();
		$('form#submitBookForm input#actionField').val('add');
		modal.modal('open');
	}
	
	function openUpdateBookModal(e) {
		var modal = $('#bookModal');

		$('form#submitBookForm')[0].reset();
		$('form#submitBookForm input#actionField').val('update');

		$.ajax({
			url: 'api/book/get',
			type: 'get',
			data: {
				id: $(e.target).attr('data-value'),
			},
			dataType: 'json',
		}).done(function(book) {
			modal.find('input#idField').val(book['id']);
			modal.find('input#isbnField').val(book['isbn']);
			modal.find('input#titleField').val(book['title']);
			modal.find('input#otherTitleField').val(book['other_title']);
			modal.find('select#categoryField').val(book['category_id']);
			modal.find('input#authorField').val(book['author']);
			modal.find('input#otherAuthorField').val(book['other_author']);
			modal.find('input#publisherField').val(book['publisher']);
			modal.find('input#yearField').val(book['publication_year']);
			modal.find('input#editionField').val(book['edition']);
			modal.find('textarea#descriptionField').val(book['description']);
			M.textareaAutoResize($('textarea#descriptionField'));
		});

		modal.modal('open');
	}

	function submitBook(e) {
		if($(e.target).find('input#actionField').val() == 'add') {
			$.ajax({
				url: 'api/book/add',
				type: 'post',
				data: $(e.target).serializeArray()
			}).done(function(data) {
				$(e.target)[0].reset();
				bookTable.ajax.reload();
				$('#bookModal').modal('close');
				M.toast({html: 'Book added', classes: 'rounded'});
			}).fail(function(data) {
				M.toast({html: data['responseText'], classes: 'rounded'});
			});
		} else if($(e.target).find('input#actionField').val() == 'update') {
			$.ajax({
				url: 'api/book/update',
				type: 'post',
				data: $(e.target).serializeArray()
			}).done(function(data) {
				$(e.target)[0].reset();
				bookTable.ajax.reload();
				$('#bookModal').modal('close');
				M.toast({html: 'Book added', classes: 'rounded'});
			}).fail(function(data) {
				M.toast({html: data['responseText'], classes: 'rounded'});
			});
		}

		e.preventDefault();
	}

	function addCategory(e) {
		$.ajax({
			url: 'api/category/add',
			type: 'post',
			data: $(e.target).serializeArray()
		}).done(function(data) {
			$('form#submitBookForm select#categoryField').html('');

			$.ajax({
				url: 'api/category/get_all',
				type: 'get',
				dataType: 'json',
			}).done(function(data) {
				for(var i = 0; i < data.length; i++) {
					$('form#submitBookForm select#categoryField').append(`<option value="${data[i]['id']}">${data[i]['name']}</option>`);
				}
				$('form#submitBookForm select#categoryField').formSelect();
			});

			$(e.target)[0].reset();
			M.toast({html: 'Category added', classes: 'rounded'});
			$('#addCategoryModal').modal('close');
		}).fail(function(data) {
			M.toast({html: data['responseText'], classes: 'rounded'});
		});

		e.preventDefault();
	}

	function deleteBook(e) {
		if(!confirm('Are you sure you want to delete this book?')) {
			return;
		}
		
		$.ajax({
			url: 'api/book/delete',
			type: 'post',
			data: {
				id: $(e.target).attr('data-value')
			}
		}).done(function() {
			M.toast({html: 'Book deleted', classes: 'rounded'});
			bookTable.ajax.reload();
		});

		e.preventDefault();
	}
</script>