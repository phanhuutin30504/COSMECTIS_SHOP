<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.show', ['customer' => $customer]);
    }
    public function shippingDefault($id)
    {
        $customer = Customer::findOrFail($id);
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();

        return view('customer.shippingDefault', [
            'customer' => $customer,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
        ]);
    }
    public function updatePassword(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->back()->with('error', 'Người dùng không tồn tại.');
        }
        $customer->name = $request->input('name');
        $customer->mobile = $request->input('mobile');
        $customer->password = Hash::make($request->input('password'));
        try {
            $customer->save();
            return redirect()->back()->with('success', 'Mật khẩu đã được cập nhật thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật mật khẩu.');
        }
    }


    public function getDistricts($provinceId)
    {
        $districts = District::where('province_id', $provinceId)->get();
        return response()->json($districts);
    }

    // Trả về danh sách phường dựa trên ID của quận/huyện
    public function getWards($districtId)
    {
        $wards = Ward::where('district_id', $districtId)->get();
        return response()->json($wards);
    }
}
