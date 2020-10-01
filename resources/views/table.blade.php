@foreach($products as $product)
<tr>
	<td>{{ $loop->iteration }}</td>
	<td>{{ $product->kd_barang }}</td>
	<td>{{ $product->nama_barang }}</td>
	<td>{{ $product->jumlah }}</td>
	<td>{{ $product->harga }}</td>
	<td>
		<button type="button" class="btn btn-warning mr-2 edit-btn" data-id="{{ $product->id}}">Edit</button>
		<button type="button" class="btn btn-danger delete-btn" data-id="{{ $product->id}}">Delete</button>
	</td>
</tr>
@endforeach