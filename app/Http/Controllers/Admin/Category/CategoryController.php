<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.category.list',compact('categories'));
    }
    public function create(){
        return view('admin.category.add');
    }
    public function store(Request $request){
        $this->validate($request,
        [
         'name'=> 'required|string|max:255|unique:name',
        ]
    );
    $category = Category::create($request->all());
    return redirect()->back()->with('success', 'Danh mục đã được thêm thành công!');
    }
    public function destroy($id){
        try {
            $Category = Category::findOrFail($id);
            $Category->delete();
            return redirect()->back()->with('success', 'Xóa danh mục thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa danh mục');
        }

    }
    public function show($id){
        try{
            $category = Category::findOrFail($id);
            return view('admin.category.edit', compact('category'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không tìm thấy danh mục');
        }

    }

    public function update(Request $request, $id){

        try{
            $this->validate($request, [
                'name' => 'required|string|max:255|unique:categories,name,' . $id,
            ]);
            $category = Category::findOrFail($id);
            $category->update($request->all());
            return redirect()->back()->with('success','Sửa thông danh mục thành công');
        }catch (\Exception $e) {
            return redirect()->back()->with('error','Sửa thông tin danh mục thất bại');
        }
    }
}
