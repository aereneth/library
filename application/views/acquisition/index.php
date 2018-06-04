<div class="container">
	<h3 class="blue-text text-darken-1 center-align">Acquisition</h3>
	<br>
	<div class="card-panel">
		<button class="btn waves-effect blue" onclick="openAddBookModal()"><i class="material-icons left">add</i>Add Book</button>
		<button class="btn waves-effect blue modal-trigger" data-target="categoryModal"><i class="material-icons left">add</i>Category</button>
		<br>
		<br>
		<table id="bookTable" class="highlight responsive-table">
			<thead>
				<tr>
					<th>ISBN</th>
					<th>Title</th>
					<th>Author</th>
					<th>Category</th>
					<th>Publisher</th>
					<th>Publication Year</th>
					<th>Edition</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>

<div id="bookModal" class="modal modal-fixed-footer">
	<form id="submitBookForm" method="post" onsubmit="submitBook(event)" enctype="multipart/form-data">
		<input type="hidden" id="actionField">
		<input type="hidden" name="id" id="idField">
		<div class="modal-content">
			<h5 id="bookModalLabel" class="blue-text">Add/Update Book</h5>
			<div class="row">
				<div id="isbnInput" class="input-field col s12">
					<input id="isbnField" type="text" class="validate" name="isbn" required>
					<label for="isbnField">ISBN</label>
				</div>
				<div class="input-field col s12">
					<input id="titleField" type="text" class="validate" name="title" required>
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
					<input id="otherAuthorField" type="text" class="validate" name="other_author">
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
					<input id="yearField" type="text" class="validate" name="publication_year" maxlength="4" required>
					<label for="yearField">Publication Year</label>
				</div>
				<div class="input-field col s6">
					<input id="editionField" type="text" class="validate" name="edition">
					<label for="editionField">Edition</label>
				</div>
				<div class="file-field input-field col s12">
					<div class="btn">
						<span>Book Cover</span>
						<input id="coverField" name="cover" type="file">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text">
					</div>
				</div>
				<div class="input-field col s12" required>
					<textarea name="description" id="descriptionField" class="materialize-textarea" cols="80" rows="10"></textarea>
					<label for="descriptionField">Description</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button id="bookSubmitButton" type="submit" class="waves-effect waves-green btn-flat">Save</button>
			<button class="modal-close waves-effect waves-red btn-flat">Cancel</button>
		</div>
	</form>
</div>

<div id="categoryModal" class="modal modal-fixed-footer">
	<div class="modal-content">
		<div class="row valign-wrapper">
			<div class="col s10">
				<h5 class="blue-text">Add Category</h5>
			</div>
			<div class="col s2">
				<button type="submit" form="addCategoryForm" class="btn waves-effect green right"><i class="material-icons left">add</i>Create</button>
			</div>
		</div>
		<form id="addCategoryForm" method="post" onsubmit="addCategory(event)">
			<div class="row">
				<div class="input-field col s12">
					<input id="categoryNameField" type="text" class="validate" name="name" required>
					<label for="categoryNameField">Name</label>
				</div>
			</div>
		</form>
		<div class="divider"></div>
		<div class="row valign-wrapper">
			<div class="col s10">
				<h5 class="blue-text">Delete Category</h5>
			</div>
			<div class="col s2">
				<button type="submit" form="deleteCategoryForm" class="btn waves-effect red right"><i class="material-icons left">delete</i>Delete</button>
			</div>
		</div>
		<form id="deleteCategoryForm" method="post" onsubmit="deleteCategory(event)">
			<div id="categoryRow" class="row">
				<?php foreach($categories as $category): ?>
				<p class="col s3">
					<label>
						<input type="checkbox" name="category[<?= $category->id ?>]">
						<span><?= $category->name ?></span>
					</label>
				</p>
				<?php endforeach ?>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<button class="modal-close waves-effect waves-red btn-flat">Close</button>
	</div>
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

		$('#isbnInput').show();

		$('#bookModalLabel').html('Add Modal');

		$('form#submitBookForm')[0].reset();
		$('form#submitBookForm input#actionField').val('add');
		modal.modal('open');
	}
	
	function openUpdateBookModal(e) {
		var modal = $('#bookModal');

		$('#isbnInput').hide();

		$('#bookModalLabel').html('Update Modal');

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

			M.updateTextFields(modal.find('input#idField'));
			M.updateTextFields(modal.find('input#isbnField'));
			M.updateTextFields(modal.find('input#titleField'));
			M.updateTextFields(modal.find('input#otherTitleField'));
			M.updateTextFields(modal.find('select#categoryField'));
			M.updateTextFields(modal.find('input#authorField'));
			M.updateTextFields(modal.find('input#otherAuthorField'));
			M.updateTextFields(modal.find('input#publisherField'));
			M.updateTextFields(modal.find('input#yearField'));
			M.updateTextFields(modal.find('input#editionField'));
			M.updateTextFields(modal.find('input#descriptionField'));
			M.textareaAutoResize(modal.find('textarea#descriptionField'));
		});

		modal.modal('open');
	}

	function submitBook(e) {
		$('#bookSubmitButton').prop('disabled', true);

		if($(e.target).find('input#actionField').val() == 'add') {
			$.ajax({
				url: 'api/book/add',
				type: 'post',
				enctype: 'multipart/form-data',
				contentType: false,
				processData: false,
				data: new FormData($(e.target)[0]),
			}).done(function(data) {
				$(e.target)[0].reset();
				bookTable.ajax.reload();
				$('#bookModal').modal('close');
				M.toast({html: 'Book added', classes: 'rounded'});
				$('#bookSubmitButton').prop('disabled', false);
			}).fail(function(data) {
				M.toast({html: data['responseText'], classes: 'rounded'});
				$('#bookSubmitButton').prop('disabled', false);
			});
		} else if($(e.target).find('input#actionField').val() == 'update') {
			$.ajax({
				url: 'api/book/update',
				type: 'post',
				enctype: 'multipart/form-data',
				contentType: false,
				processData: false,
				data: new FormData($(e.target)[0]),
			}).done(function(data) {
				$(e.target)[0].reset();
				bookTable.ajax.reload();
				$('#bookModal').modal('close');
				M.toast({html: 'Book updated', classes: 'rounded'});
				$('#bookSubmitButton').prop('disabled', false);
			}).fail(function(data) {
				M.toast({html: data['responseText'], classes: 'rounded'});
				$('#bookSubmitButton').prop('disabled', false);
			});
		}

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

	function addCategory(e) {
		$(e.target).find('input#categoryNameField').val(titleCase($(e.target).find('input#categoryNameField').val()));

		$.ajax({
			url: 'api/category/add',
			type: 'post',
			data: $(e.target).serializeArray()
		}).done(function(data) {
			reloadCategories();

			$(e.target)[0].reset();
			M.toast({html: 'Category added', classes: 'rounded'});
		}).fail(function(data) {
			M.toast({html: data['responseText'], classes: 'rounded'});
		});

		e.preventDefault();
	}

	function deleteCategory(e) {
		if(!confirm('Are you sure you want to delete these categories?')) {
			return;
		}

		$.ajax({
			url: 'api/category/delete',
			type: 'post',
			data: $(e.target).serializeArray(),
		}).done(function() {
			reloadCategories();	
			M.toast({html: 'Category deleted', classes: 'rounded'});
		}).fail(function(data) {
			M.toast({html: data['responseText'], classes: 'rounded'});
		});

		e.preventDefault();
	}

	function titleCase(str) {
		return str.toLowerCase().split(' ').map(function(word) {
			return (word.charAt(0).toUpperCase() + word.slice(1));
		}).join(' ');
	}

	function reloadCategories() {
		$('form#submitBookForm select#categoryField').html('');
		$('#categoryRow').html('');

		$.ajax({
			url: 'api/category/get_all',
			type: 'get',
			dataType: 'json',
		}).done(function(data) {
			for(var i = 0; i < data.length; i++) {
				$('#categoryRow').append(`
				<p class="col s3">
					<label>
						<input type="checkbox" name="category[${data[i]['id']}]">
						<span>${data[i]['name']}</span>
					</label>
				</p>
				`);
				$('form#submitBookForm select#categoryField').append(`<option value="${data[i]['id']}">${data[i]['name']}</option>`);
			}
			$('form#submitBookForm select#categoryField').formSelect();
		});
	}
</script>