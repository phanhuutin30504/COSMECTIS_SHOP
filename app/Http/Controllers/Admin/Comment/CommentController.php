<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
public function detail($id){
    $comment = Comment::where('product_id',$id)->get();

    return view('admin.comment.list',compact('comment'));
}
public function destroy($id){
    try {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa sản phẩm');
    }
}
public function deleteSelected(Request $request)
{

    // Lấy danh sách các id được chọn
    $ids = $request->input('ids');

    if (!empty($ids)) {
        // Xóa các sản phẩm tương ứng với các id
        Comment::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'Các mục đã được xóa thành công!');
    }

    return redirect()->back()->with('error', 'Vui lòng chọn ít nhất một mục để xóa.');
}
}
