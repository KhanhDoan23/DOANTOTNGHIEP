<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TinTuc;

class TinTucController extends Controller
{
    public function DanhSach()
    {
        $news = TinTuc::latest()->paginate(10); // Lấy danh sách tin tức, sắp xếp theo thời gian và phân trang
        return view('admin/tin-tuc/danh-sach', compact('news'));
    }

    public function ThemMoi()
    {
        return view('admin/tin-tuc/them-moi');
    }

    public function XuLyThemMoi(Request $request)
    {
        $request->validate([
            'tieu_de' => 'required',
            'noi_dung' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra hình ảnh có đúng định dạng và kích thước
        ]);

        $news = new TinTuc();
        $news->tieu_de = $request->tieu_de;
        $news->noi_dung = $request->noi_dung;

        // Xử lý lưu hình ảnh nếu có được tải lên
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // Lưu hình ảnh vào thư mục public/images
            $news->image = 'images/'.$imageName;
        }

        $news->save();

        return redirect()->route('tin-tuc.danh-sach')
            ->with('success', 'Tin tức đã được tạo thành công.');
    }
    public function ChiTiet($id)
    {
        $news = TinTuc::findOrFail($id);
        return view('tin-tuc.chi-tiet', compact('news'));
    }

    public function CapNhat($id)
    {
        $news = TinTuc::findOrFail($id);
        return view('tin-tuc.cap-nhat', compact('news'));
    }

    public function XuLyCapNhat(Request $request, $id)
    {
        $request->validate([
            'tieu_de' => 'required',
            'noi_dung' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra hình ảnh có đúng định dạng và kích thước
        ]);

        $news = TinTuc::findOrFail($id);
        $news->tieu_de = $request->tieu_de;
        $news->noi_dung = $request->noi_dung;

        // Xử lý lưu hình ảnh nếu có được tải lên
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // Lưu hình ảnh vào thư mục public/images
            $news->image = 'images/'.$imageName;
        }

        $news->save();

        return redirect()->route('tin-tuc.danh-sach')
            ->with('success', 'Tin tức đã được cập nhật thành công.');
    }

    public function Xoa($id)
    {
        $news = TinTuc::findOrFail($id);
        $news->delete();

        return redirect()->route('tin-tuc.danh-sach')
            ->with('success', 'Tin tức đã được xóa thành công.');
    }
}
