<?php

namespace App\Http\Controllers\ProductImage;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function showImages($id)
    {
        $product = Product::with('images')->find($id);

        return view('admin.image.list', compact('product'));
    }
    public function storeImages(Request $request, $id)
    {
        $product = Product::find($id);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload'), $filename);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_name' => $file->getClientOriginalName(),
                    'image_path' => 'upload/' . $filename
                ]);
            }
        }

        return redirect()->back()->with('success', 'Ảnh chi tiết đã được tải lên!');
    }

    public function deleteImage($id)
    {
        $image = ProductImage::find($id);


        $image_path = public_path('upload/' . $image->image_path);
        if (file_exists($image_path)) {
            unlink($image_path);
        }


        $image->delete();

        return redirect()->back()->with('success', 'Ảnh đã được xóa!');
    }
    public function deleteSelected(Request $request)
    {


        $ids = $request->input('ids');

        if (!empty($ids)) {

            ProductImage::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', 'Các mục đã được xóa thành công!');
        }

        return redirect()->back()->with('error', 'Vui lòng chọn ít nhất một mục để xóa.');
    }
}
