<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(){
        return view('contact.form');
    }
    public function send(Request $request)
    {
        // dd($request);
        $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|string',
            'content' => 'required|string',
        ]);

        $data = $request->only(['fullname', 'email', 'mobile', 'content']);

        // Gửi email
        Mail::to('phanhuutin3052004@gmail.com')->send(new ContactMail($data));

        return redirect()->back()->with('success', 'Tin nhắn của bạn đã được gửi thành công!');
    }
    public function comment(Request $request){
        $commentData = $request->all();


          $comment = Comment::create($commentData);
          $product = Product::find($commentData['product_id']);
          if ($product) {

              $product->star = $commentData['star'];
              $product->save();
          }
          return redirect()->back()->with('success', 'Cảm ơn bạn đã đánh giá sản phẩm!');
    }
}
