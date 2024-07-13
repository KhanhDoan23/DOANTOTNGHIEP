<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TinTuc;
use Illuminate\Support\Facades\Gate;

class TinTucController extends Controller
{
    public function HienThi()
    {
        
        $news = TinTuc::all(); 

        return view('user/tin-tuc/hien-thi', compact('news'));
    }
    public function ChiTietHienThi($id)
    {
        $news = TinTuc::findOrFail($id);
        $randomNews = TinTuc::where('id', '!=', $news->id)
                      ->inRandomOrder()
                      ->take(5)
                      ->get();
        return view('user/tin-tuc/chi-tiet', compact('news','randomNews'));
    }
    public function DanhSach(Request $request)
    {
        $Page = $request->input('Page', 5 );
        $news = TinTuc::latest()->paginate(10);
        return view('admin/tin-tuc/danh-sach', compact('news','Page'));
    }

    public function ThemMoi()
    {
        if (Gate::denies('quan-ly-tin-tuc')) {
            return redirect()->route('admin.index')->with('error','bạn không có quyền truy cập vào chức năng này');
        }
        return view('admin/tin-tuc/them-moi');
    }

    public function XuLyThemMoi(Request $request)
    {
        $request->validate([
            'tieu_de' => 'required',
            'mo_ta_ngan' => 'required',
            'noi_dung' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $news = new TinTuc();
        $news->tieu_de = $request->tieu_de;
        $news->mo_ta_ngan=$request->mo_ta_ngan;
        $news->noi_dung = $request->noi_dung;
        $news->ngay_dang = now();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $news->image = 'images/'.$imageName;
        }

        $news->save();

        return redirect()->route('tin-tuc.danh-sach')
            ->with('success', 'Tin tức đã được tạo thành công.');
    }
    public function ChiTiet($id)
    {
        if (Gate::denies('quan-ly-tin-tuc')) {
            return redirect()->route('admin.index')->with('error','bạn không có quyền truy cập vào chức năng này');
        }
        $news = TinTuc::findOrFail($id);
        return view('admin/tin-tuc/chi-tiet', compact('news'));
    }

    public function CapNhat($id)
    {
        if (Gate::denies('quan-ly-tin-tuc')) {
            return redirect()->route('admin.index')->with('error','bạn không có quyền truy cập vào chức năng này');
        }
        $news = TinTuc::findOrFail($id);
        return view('admin/tin-tuc/cap-nhat', compact('news'));
    }

    public function XuLyCapNhat(Request $request, $id)
    {
        $request->validate([
            'tieu_de' => 'required',
            'mo_ta_ngan' => 'required',
            'noi_dung' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $news = TinTuc::findOrFail($id);
        $news->tieu_de = $request->tieu_de;
        $news->mo_ta_ngan=$request->mo_ta_ngan;
        $news->noi_dung = $request->noi_dung;
        $news->ngay_dang = now();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $news->image = 'images/'.$imageName;
        }

        $news->save();

        return redirect()->route('tin-tuc.danh-sach')
            ->with('success', 'Tin tức đã được cập nhật thành công.');
    }

    public function Xoa($id)
    {
        if (Gate::denies('quan-ly-tin-tuc')) {
            return redirect()->route('admin.index')->with('error','bạn không có quyền truy cập vào chức năng này');
        }
        $news = TinTuc::findOrFail($id);
        $news->delete();

        return redirect()->route('tin-tuc.danh-sach')
            ->with('success', 'Tin tức đã được xóa thành công.');
    }
    public function Search(Request $request)
    {
        if (Gate::denies('quan-ly-tin-tuc')) {
            return redirect()->route('admin.index')->with('error','bạn không có quyền truy cập vào chức năng này');
        }
        $query = $request->input('query');
        $Page = $request->input('Page', 5); 

        $news = TinTuc::where('tin_tuc.tieu_de', 'LIKE', "%$query%")
        ->orWhere('tin_tuc.mo_ta_ngan', 'LIKE', "%$query%")
        ->orWhere('tin_tuc.noi_dung', 'LIKE', "%$query%")
        ->paginate($Page);


        return view('admin/tin-tuc/danh-sach', compact('news','Page'));
    } 
}
