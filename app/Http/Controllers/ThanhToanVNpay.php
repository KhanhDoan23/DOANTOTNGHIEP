<?php

namespace App\Http\Controllers;

use App\Models\QuanLyDatSan;
use App\Models\ThanhToan;
use Illuminate\Http\Request;

class ThanhToanVNpay extends Controller
{
    public function vnpay_payments(Request $request, $id)
    {
        $datSan = QuanLyDatSan::find($id);

        if (!$datSan) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn đặt sân.');
        }

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
         $vnp_Returnurl = route('vnpay.return', ['id' => $id]);
        $vnp_TmnCode = "189X5DXZ"; // Mã website tại VNPAY
        $vnp_HashSecret = "3USCYAFT2TGK2OFCIC3Q71VBB1VARQG2"; // Chuỗi bí mật

        $vnp_TxnRef = rand(00, 9999); // Mã đơn hàng
        $vnp_OrderInfo =  "Thanh toán cho đơn hàng #" . $datSan->id;
        $vnp_OrderType = 'billpayments';
        $vnp_Amount = $datSan->tong_tien * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $request->ip();

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $returnData = array('code' => '00', 'message' => 'success', 'data' => $vnp_Url);

        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            return response()->json($returnData); // Trả về dữ liệu JSON khi không yêu cầu redirect
        }
    }

    public function vnpayReturn(Request $request,$id)
    {
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
        $vnp_TxnRef = $request->input('vnp_TxnRef');
        if ($vnp_ResponseCode == '00') {
            $datSan = QuanLyDatSan::find($id);
            $thanhToan=ThanhToan::find($id);
            if( $thanhToan->trang_thai_thanh_toan_id==1)
            {
                return redirect()->back()->with('error', 'Bạn Đã cho hoá đơn này rồi thanh toán rồi.');
            }
            if ($datSan) {
                $datSan->trang_thai_thanh_toan_id = 1;
                $datSan->save();
                
                $thanhToan->trang_thai_thanh_toan_id=1;
                $thanhToan->ngay_thanh_toan=now();
                $thanhToan->save();

                return redirect()->route('thanh-toan-thanh-cong.success');
            } else {
                return redirect()->route('user.index')->with('error', 'Không tìm thấy đơn đặt hàng.');
            }
        } else {
            return redirect()->route('user.index')->with('error', 'Thanh toán không thành công.');
        }
    }
}
