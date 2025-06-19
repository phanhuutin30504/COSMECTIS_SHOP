<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index(){
        $customer = Customer::all();

        return view('admin.customer.list', compact('customer'));
    }
    public function create(){
        $provinces =Province::all();
        return view('admin.customer.add', compact('provinces'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'mobile' => 'required|digits_between:10,11',
            'housenumber_street' => 'required|string|max:255',
            'shipping_name' => 'required|string|max:255',
            'shipping_mobile' => 'required|digits_between:10,11',
        ]);
        $customer = Customer::create($request->all());
        return redirect()->back()->with('success', 'Người dùng đã được thêm thành công!');

    }
    public function show($id){
        try{
            $customer = Customer::findOrFail($id);
            return view('admin.customer.edit', compact('customer'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không tìm thấy người dùng');
        }


    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'mobile' => 'nullable|digits_between:10,11',
            'housenumber_street' => 'nullable|string|max:255',
            'shipping_name' => 'nullable|string|max:255',
            'shipping_mobile' => 'nullable|digits_between:10,11',
        ]);
        try{
            $customer = Customer::findOrFail($id);
            $data = $request->except('password');

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $customer->update($data);
            return redirect()->back()->with('success','Sửa thông tin người dùng thành công');
        }catch (\Exception $e) {
            return redirect()->back()->with('error','Sửa thông tin người dùng thất bại');
        }

    }
    public function destroy($id){

        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();
            return redirect()->back()->with('success', 'Xóa người dùng thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa người dùng');
        }
    }
    public function deleteSelected(Request $request)
    {

        // Lấy danh sách các id được chọn
        $ids = $request->input('ids');

        if (!empty($ids)) {
            // Xóa các sản phẩm tương ứng với các id
            Customer::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', 'Các mục đã được xóa thành công!');
        }

        return redirect()->back()->with('error', 'Vui lòng chọn ít nhất một mục để xóa.');
    }
}
