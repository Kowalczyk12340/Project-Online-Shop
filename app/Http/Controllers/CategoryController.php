<?php 

namespace App\Http\Controllers;

use App\Http\Requests\Categories\StoreCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Models\Category;
use App\Events\CategoryDeleted;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller 
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $categories = Category::withTrashed()->get();

            return DataTables::of($categories)
                ->editColumn('category_name', function($category){
                    return $category->category_name;
                })
                ->addColumn('image', function($category){
                    $img = '';
                    if($category->image != null)
                    {
                        $img .= '<img class="img-fluid" style="width:50px; height:50px;" src="' . asset($category->image) . '">';
                    }
                    return $img;
                })
                ->editColumn('created_at', function ($category) {
                    return $category->created_at;
                })
                ->editColumn('deleted_at', function ($category) {
                    return $category->deleted_at;
                })
                ->addColumn('edit', function ($category) {
                    $button = '';
                    if (!$category->deleted_at) {
                        $button .= '<a class="btn btn-warning text-dark" href="';
                        $button .= route('category.edit', $category);
                        $button .= '">' . __('translations.categories.index.edit') . '</a>';
                    }
                    return $button;
                })
                ->addColumn('delete', function ($category) {
                    $button = '';
                    if (!$category->deleted_at) {
                        $button .= '<a data-delete-href="';
                            $button .=  route('category.delete', $category);
                            $button .=   '"';
                        $button .= 'class="btn btn-danger text-white"> ';
                        $button .= __('translations.categories.index.delete') . '</a>';
                    }
                    else 
                    {
                        // przycisk przywracania usuniętego elementu
                        $button .= '<a class="btn btn-success btn-sm"';
                        $button .= ' href="' . route('category.restore', $category->id) .'"';
                        $button .= 'data-toggle="tooltip"
                                    data-placement="top"';
                        $button .= 'data-title="' . __('translations.buttons.restore') . '"';
                        $button .= '>Przywróć</a>';
                    }
                    return $button;
                })
                ->rawColumns(['image', 'edit', 'delete'])
                ->make(true);
        }
        return view('category.categories');
    }

    public function create()
    {
        $edit = false;
        return view('category.create', compact('edit'));
    }

    public function store(StoreCategoryRequest $categoryRequest)
    {
        $category = new Category();
        $category->category_name = $categoryRequest->category_name;
        if($categoryRequest->image != null){
            $file = $categoryRequest->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('/public/category/images', $filename);
            $category->image = '/storage/category/images/' . $filename;
        }
        $category->save();
        return redirect()->route('category.index');
    }

    public function edit(Category $category)
    {
        $edit = true;
        return view('category.create', compact('category', 'edit'));
    }

    public function update(UpdateCategoryRequest $categoryRequest, Category $category)
    {
        $category = Category::findOrFail($category->id);
        $category->category_name = $categoryRequest->category_name;
        if($categoryRequest->image != null){
            $file = $categoryRequest->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('/public/category/images', $filename);
            $category->image = '/storage/category/images/' . $filename;
        }
        else{
            $category->image = $category->image;
        }
        $category->save();
        return redirect()->route('category.index');
    }

    public function delete(Category $category)
    {
        try 
        {
            $category = $category->findOrFail($category->id);
            $category->delete();
            return response()->json(['status'=>'success'], 200);
        }
        catch(Exception $ex)
        {
            return response()->json(['status'=>'fail'], 404);
        }
    }

    public function restore(int $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('category.index')
            ->with('success', __('translations.categories.flashes.success.restore', [
                'name' => $category->name
            ]));
    }
}
