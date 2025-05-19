<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function Category(Request $request)
    {
        $search_value = $request->query("search");
        $rowLength = $request->query('row_length', 10);

        try {
            $categories = Category::where('name', 'like', '%' . $search_value . '%')->paginate($rowLength);

            return view('page.categories.index', [
                'categories' => $categories,
                'search_value' => $search_value,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'An error occurred while fetching categories.');
        }
    }

    public function Insert()
    {
        return view('page.categories.insert');
    }

    public function InsertData(Request $request)
    {
        try {
            $categories = new Category();
            $categories->name = $request->input('name');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/categories', $filename);
                $categories->image = $filename;
            }
            $categories->save();

            return redirect()->route('category')->with('message', 'Category Inserted Successfully');
        } catch (\Exception $e) {
            return redirect()->route('category')->with('error', 'An error occurred while inserting the category.');
        }
    }

    public function Update($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('category')->with('error', 'Category not found.');
        }

        return view('page.categories.edit', ['category' => $category]);
    }

    public function DataUpdate(Request $request, $id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return redirect()->route('category')->with('error', 'Category not found.');
            }

            $category->name = $request->input('name');
            if ($request->hasFile('image')) {
                $destination = 'uploads/categories/' . $category->image;

                // Delete old image if exists
                if (file_exists($destination)) {
                    unlink($destination);
                }

                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/categories', $filename);
                $category->image = $filename;
            }
            $category->save();

            return redirect()->route('category')->with('message', 'Category Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->route('category')->with('error', 'An error occurred while updating the category.');
        }
    }

    public function Delete(Request $request, $id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return redirect()->route('category')->with('error', 'Category not found.');
            }

            $destination = 'uploads/categories/' . $category->image;

            // Delete image if exists
            if (file_exists($destination)) {
                unlink($destination);
            }

            $category->delete();

            return redirect()->route('category')->with('message', 'Category Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->route('category')->with('error', 'An error occurred while deleting the category.');
        }
    }
}
