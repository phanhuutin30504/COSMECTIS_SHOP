<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->orderBy("id", "desc")->get();
        return view("admin.product.list", compact("products"));
    }
    public function create() {
        $categories = Category::pluck('name', 'id');
        $brands = Brand::pluck('name', 'id');
        return view('admin.product.add', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|string',
            'inventory_qty' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'featured' => 'required|boolean',
            'description' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['name', 'price', 'inventory_qty', 'category_id', 'brand_id', 'featured', 'description']);

        $data['barcode'] = Str::upper(Str::random(10));
        // Tạo SKU tự động
        $sku = $this->generateSKU();

        $data['sku'] = $sku;
        if (isset($data['price'])) {
            $data['price'] = str_replace(['.', ','], '', $data['price']);

            $data['price'] = (float)$data['price']    ;
        }
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload'), $filename);
            $data['featured_image'] ='upload/'. $filename;
        }
        Product::create($data);
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm thành công!');
    }

    private function generateSKU()
    {
        // Tạo SKU mới bằng cách sử dụng số sản phẩm lớn nhất hiện tại + 1
        $latestProduct = Product::orderBy('id', 'desc')->first();
        $latestSKU = $latestProduct ? $latestProduct->sku : null;
        $nextSkuNumber = $latestSKU ? intval(substr($latestSKU, 3)) + 1 : 1;
        return 'SKU' . str_pad($nextSkuNumber, 5, '0', STR_PAD_LEFT);
    }
    public function edit($id){
        try {
            $product = Product::with('category')->findOrFail($id);
            $categories = Category::all();
            return view('admin.product.edit', compact('product','categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không tìm thấy sản phẩm');
        }
    }
    public function update(Request $request, $id)
{

    $request->validate([
        'name' => 'nullable|string|max:255',
        'price' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    try {

        $product = Product::findOrFail($id);

        $input = $request->all();
        if (isset($input['price'])) {
            $input['price'] = str_replace(['.', ','], '', $input['price']);

            $input['price'] = (float)$input['price']    ;
        }

        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload'), $filename);
            $input['featured_image'] ='upload/'. $filename;
        }else{
            $input['featured_image'] = $product->featured_image;
        }
        $product->update($input);
        return redirect()->back()->with('success', 'Cập nhật sản phẩm thành công');
    } catch (\Exception $e) {
        dd($e->getMessage());
        return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật sản phẩm');
    }
}

    public function destroy($id){

        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa sản phẩm');
        }
    }
    public function deleteSelected(Request $request)
{


    $ids = $request->input('ids');

    if (!empty($ids)) {

        Product::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'Các mục đã được xóa thành công!');
    }

    return redirect()->back()->with('error', 'Vui lòng chọn ít nhất một mục để xóa.');
}


}
