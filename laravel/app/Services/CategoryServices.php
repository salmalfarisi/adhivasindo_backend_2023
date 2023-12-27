<?php 

namespace App\Services;

use App\Models\Category;
use Carbon\Carbon;

class CategoryServices
{	
	public function index()
	{
		$data = Category::where('delete_status', false)->get();
		
		return $data;
	}

	public function store($data)
	{
		$model = new Category();
		$model->name = $data['name'];
		$model->created_at = Carbon::now();
		$model->save();
		return $model; 
	}
	
	public function show($id)
	{
		$data = Category::findOrFail($id);
		
		return $data;
	}
	
	public function update($id, $data)
	{
		$model = Category::findOrFail($id);
		if($model == NULL)
		{
			return false;
		}
		else
		{
			$model->name = $data['name'];
			$model->updated_at = Carbon::now();
			$model->save();
			return $model; 			
		}
	}
	
	public function destroy($id)
	{
		$model = Category::find($id);
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