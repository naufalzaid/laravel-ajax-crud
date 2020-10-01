<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <title>CRUD AJAX</title>
</head>
<body>
  <div class="modal-group">
    <!-- Modal Create -->
    <div class="modal fade" id="newProduct" tabindex="-1" aria-labelledby="newProductLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newProductLabel">New Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form name="create_form">
              @csrf
              <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" name="kd_barang" class="form-control" placeholder="Masukan kode barang">
              </div>
              <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" placeholder="Masukan nama barang">
              </div>
              <div class="form-group">
                <label>Jumlah Barang</label>
                <input type="text" name="jumlah" class="form-control" placeholder="Masukan jumlah barang">
              </div>
              <div class="form-group">
                <label>Harga Barang</label>
                <input type="text" name="harga" class="form-control" placeholder="Masukan harga barang">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="save-btn">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editProductLabel">Edit Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form name="update_form">
              @csrf
              <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" name="kd_barang_edit" class="form-control" placeholder="Masukan kode barang">
              </div>
              <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang_edit" class="form-control" placeholder="Masukan nama barang">
              </div>
              <div class="form-group">
                <label>Jumlah Barang</label>
                <input type="text" name="jumlah_edit" class="form-control" placeholder="Masukan jumlah barang">
              </div>
              <div class="form-group">
                <label>Harga Barang</label>
                <input type="text" name="harga_edit" class="form-control" placeholder="Masukan harga barang">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="update-btn">Update Product</button>
          </div>
        </div>
      </div>
    </div>  
  </div>

  <div class="container">
    <div class="text-center mt-4">
      <h1>CRUD LARAVEL AJAX</h1>
    </div>
    <div class="table-product">
      <div class="text-right mb-4">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newProduct">Add Product</button>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Kode</th>
            <th scope="col">Nama</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Harga</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

  <script type="text/javascript">
  $(document).on('click', '#save-btn', function () {
    $('form[name=create_form]').submit();
  });

  $(document).on('click', '#update-btn', function () {
    $('form[name=update_form]').submit();
  });

  $('form[name=create_form]').submit(function (e) {
    e.preventDefault();
    var request = new FormData(this);
    $.ajax({
      method: "POST",
      url: "{{ url('/product/create')}}",
      data: request,
      processData: false,
      contentType: false,
      success:function(data){
        if (data == 'success') {
          $('#newProduct').modal('hide');
          loadData();
        }
      }
    });
  });

  $(document).on('click', '.edit-btn', function () {
    var id = $(this).attr('data-id');
    $.ajax({
      method: "GET",
      url: "{{ url('product/edit')}}/" + id,
      success:function(response){
        $('#editProduct').modal('show');
        $('input[name=kd_barang_edit]').val(response.kd_barang);
        $('input[name=nama_barang_edit]').val(response.nama_barang);
        $('input[name=jumlah_edit]').val(response.jumlah);
        $('input[name=harga_edit]').val(response.harga);
        $('form[name=update_form]').attr('action', '{{ url("/product/update")}}/' + id);
      }
    });
  });

  $('form[name=update_form]').submit(function (e) {
    e.preventDefault();
    var action = $(this).prop('action');
    var request = new FormData(this);
    $.ajax({
      method: "POST",
      url: action,
      data: request,
      processData: false,
      contentType: false,
      success:function(data){
        if (data == 'success') {
          $('#editProduct').modal('hide');
          loadData();
        }
      }
    });
  });


  $(document).on('click', '.delete-btn', function () {
    var id = $(this).attr('data-id');
    $.ajax({
      method: "GET",
      url: "{{ url('/product/delete')}}/" + id,
      success:function (data) {
        if (data == 'success') {
          loadData();
        }
      }
    });
  });

  function loadData() {
    $.ajax({
      method: "GET",
      url: "{{ url('/product/table')}}",
      success:function(data){
        $('tbody').html(data);
      }
    });
  }

  loadData();
  </script>
</body>
</html>