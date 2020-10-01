<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
    	return view('index');
    }

    public function create(Request $request)
    {
    	Product::create([
    		'kd_barang' => $request->kd_barang,
    		'nama_barang' => $request->nama_barang,
    		'jumlah' => $request->jumlah,
    		'harga' => $request->harga,
    	]);
    	echo "success";
    }
    // show table
    public function table()
    {
    	$products = Product::all();
    	return view('table', compact('products'));
    }

    public function edit($id)
    {
    	$products = Product::find($id);
    	return response()->json($products);
    }

    public function update(Request $request, $id)
    {
    	Product::where('id', $id)->update([
    		'kd_barang' => $request->kd_barang_edit,
    		'nama_barang' => $request->nama_barang_edit,
    		'jumlah' => $request->jumlah_edit,
    		'harga' => $request->harga_edit,
    	]);

    	echo "success";
    }

    public function delete($id)
    {
    	Product::destroy($id);
    	echo "success";
    }
}
