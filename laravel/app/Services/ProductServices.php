<?php 

namespace App\Services;

use App\Models\Product;
use Carbon\Carbon;
use File;

class ProductServices
{	
	public function index()
	{
		$data = Product::where('delete_status', false)->get();
		
		return $data;
	}

	public function store($data, $gambar)
	{	
		$model = new Product();
		$model->name = $data['name'];
		$model->product_category_id = $data['product_category_id'];
		$model->price = $data['price'];
		
		if($gambar != null)
		{
			$ext = $gambar->getClientOriginalExtension();
			$namafile = rand(100000,999999);
			$name = $namafile.".".$ext;
			$model->image = $name;
			$gambar->move(public_path().'/files/', $name);
		}
		$model->created_at = Carbon::now();
		$model->save();
		return $model; 
	}
	
	public function show($id)
	{
		$data = Product::findOrFail($id);
		
		return $data;
	}
	
	public function update($id, $data, $gambar)
	{
		$model = Product::findOrFail($id);
		if($model == NULL)
		{
			return false;
		}
		else
		{
			$model->name = $data['name'];
			$model->product_category_id = $data['product_category_id'];
			$model->price = $data['price'];
			
			if($gambar != null)
			{
				$ext = $gambar->getClientOriginalExtension();
				$namafile = rand(100000,999999);
				$name = $namafile.".".$ext;
				$model->image = $name;
				$gambar->move(public_path().'/files/', $name);
			}
			$model->created_at = Carbon::now();
			$model->save();
			return $model; 
		}
	}
	
	public function destroy($id)
	{
		$model = Product::find($id);
		if($model == NULL)
		{
			return false;
		}
		else
		{
			$model->updated_at = Carbon::now();
			$model->delete_status = true;
			$model->save();
			return true; 			
		}
	}
}