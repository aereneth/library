<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ACQUISITION</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css');?>" />


    <base href="<?php print base_url(); ?>" />
  </head>
  <body>


  <div class="container">
    <h1>ACQUISITION</h1>
</center>
    <h3>Book List</h3>
    <br />
    <button class="btn btn-success" onclick="add_book()"><i class="glyphicon glyphicon-plus"></i> Add Book</button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
					<th>Book ID</th>
					<th>Book ISBN</th>
					<th>Book Title</th>
          <th>Book Other Title</th>
					<th>Book Author</th>
          <th>Book Other Author</th>
          <th>Publisher</th>
          <th>Edition</th>
          <th>Publication Year</th>
          <th>Book Category</th>
					<th>Description</th>
          <th>Abstract</th>

          <th style="width:125px;">Action
          </p></th>
        </tr>
      </thead>
      <tbody>
				<?php foreach($books as $book){?>
				     <tr>
				         <td><?php echo $book->id;?></td>
				         <td><?php echo $book->isbn;?></td>
								 <td><?php echo $book->title;?></td>
                <td><?php echo $book->other_title;?></td>
								<td><?php echo $book->author;?></td>
                <td><?php echo $book->other_author;?></td>
              	<td><?php echo $book->publisher;?></td>
              	<td><?php echo $book->edition;?></td>
              	<td><?php echo $book->publication_year;?></td>
								<td><?php echo $book->category;?></td>
              	<td><?php echo $book->description;?></td>
              	<td><?php echo $book->abstract;?></td>
								<td>
									<button class="btn btn-warning" onclick="edit_book(<?php echo $book->id;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
									<button class="btn btn-danger" onclick="delete_book(<?php echo $book->id;?>)"><i class="glyphicon glyphicon-remove"></i></button>


								</td>
				      </tr>
				     <?php }?>



      </tbody>

      <tfoot>
        <tr>
          <th>Book ID</th>
          <th>Book ISBN</th>
          <th>Book Title</th>
          <th>Book Other Title</th>
          <th>Book Author</th>
          <th>Book Other Author</th>
          <th>Publisher</th>
          <th>Edition</th>
          <th>Publication Year</th>
          <th>Book Category</th>
          <th>Description</th>
          <th>Abstract</th>
          <th>Action</th>
        </tr>
      </tfoot>
    </table>

  </div>

  <script src="<?php echo base_url('assets/jquery/jquery-3.1.0.min.js');?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js');?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js');?>"></script>


  <script type="text/javascript">
  $(document).ready( function () {
      $('#table_id').DataTable();
  } );
    var save_method; //for save method string
    var table;
    //var base_url = <?php// echo base_url(); ?>;

    function add_book()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal

    }

    function edit_book(id)
    {
      save_method = 'update';

      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('index.php/book/ajax_edit/')?>/" + id,
      //  url: base_url + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="isbn"]').val(data.isbn);
            $('[name="title"]').val(data.title);
            $('[name="othertitle"]').val(data.othertitle);
            $('[name="author"]').val(data.author);
            $('[name="otherauthor"]').val(data.otherauthor);
            $('[name="publisher"]').val(data.publisher);
            $('[name="edition"]').val(data.edition);
            $('[name="publicationyear"]').val(data.publicationyear);
            $('[name="category"]').val(data.category);
            $('[name="description"]').val(data.description);
            $('[name="abstract"]').val(data.abstract);


            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Book'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }



    function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo base_url('index.php/book/book_add')?>";
      }
      else
      {
        url = "<?php echo base_url('index.php/book/book_update')?>";
      }

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {

               $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }

    function delete_book(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo base_url('index.php/book/book_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {

               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

      }
    }

  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Book Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Book ISBN</label>
              <div class="col-md-9">
                <input name="isbn" placeholder="Book ISBN" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Book Title</label>
              <div class="col-md-9">
                <input name="title" placeholder="Book_title" class="form-control" type="text">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Book other Title</label>
              <div class="col-md-9">
                <input name="othertitle" placeholder="Bookothertitle" class="form-control" type="text">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Book Author</label>
              <div class="col-md-9">
								<input name="author" placeholder="Book Author" class="form-control" type="text">

              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-md-3">Book other Author</label>
              <div class="col-md-9">
                <input name="otherauthor" placeholder="BookotherAuthor" class="form-control" type="text">

              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Book Publisher</label>
              <div class="col-md-9">
                <input name="publisher" placeholder="Book Publisherr" class="form-control" type="text">

              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Book Edition</label>
              <div class="col-md-9">
                <input name="edition" placeholder="Book Edition" class="form-control" type="text">

              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Book Publication_Year</label>
              <div class="col-md-9">
                <input name="publicationyear" placeholder="Book Edition" class="form-control" type="date">

              </div>
            </div>



						<div class="form-group">
							<label class="control-label col-md-3">Book Category</label>
							<div class="col-md-9">
								<input name="category" placeholder="Book Category" class="form-control" type="text">

							</div>
						</div>


            <div class="form-group">
              <label class="control-label col-md-3">Book Description</label>
              <div class="col-md-9">
                <input name="description" placeholder="Book Description" class="form-control" type="text">

              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-md-3">Book Abstract</label>
              <div class="col-md-9">
                <input name="abstract" placeholder="Book Abstract" class="form-control" type="textarea">

              </div>
            </div>

          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->

  </body>
</html>
