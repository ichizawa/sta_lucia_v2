<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Events\CategoryUpdated;
use App\Models\SubCategory;
class CategoryController extends Controller
{
    public function adminCategory()
    {
        $categories = Categories::all();
        return view('admin.category', compact('categories'));
    }

    public function getCategories(Request $request)
    {
        $categories = Categories::with('subCategories')->orderBy('id', 'desc')->get();
    
        $data = $categories->map(function ($category) {
            return [
                'id'=> $category->id,  
                'category_name' => $category->name,
                'subcategory_names' => $category->subCategories->pluck('name')->implode(', ')
            ];
        });
    
        $totalRecords = $data->count();
        $filteredRecords = $totalRecords;
    
        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ]);
    }
    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Categories::create([
            'name' => $validateData['name'],
        ]);

        // event(new CategoryUpdated($category));


        return response()->json([
            'success' => true,
            'message' => 'Category added successfully!',
            'data' => $category,
        ]);
    }

    public function storeSubCategory(Request $request)
    {

        $request->validate([
            'category' => 'required|exists:categories,id',
            // 'sub_categories' => 'required|string|max:255'
        ]);

        $category = $request->category;
        $sub_category = $request->input('sub_categories', []);

        $data = [];
        foreach ($sub_category as $name) {
            $data[] = [
                'category_id' => $category,
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        SubCategory::insert($data);

        return response()->json(['success' => true, 'message' => 'Sub-Category added successfully']);

    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:categories,id',
        ]);

        $category = Categories::find($request->id);
        $category->delete();
        return response()->json(['success'=> true,'message'=> 'Category deleted successfully']);
    }
}
