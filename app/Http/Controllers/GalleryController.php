<?php

namespace App\Http\Controllers;

use App\Models\CatePost;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Gallery;

session_start();

class GalleryController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Auth::id();
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function add_gallery($product_id)
    {
        $pro_id = $product_id;
        return view('admin.gallery.add_gallery')->with(compact('pro_id'));
    }
    public function select_gallery(Request $request)
    {
        $product_id =  $request->pro_id;
        $gallery = Gallery::where('product_id', $product_id)->get();
        $gallery_count = $gallery->count();
        $output = '
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Thứ tự</th>
                    <th>Tên hình ảnh</th>
                    <th>Hình ảnh</th>
                    <th>Quản lý</th>
                </tr>
            </thead>
            <tbody>
    ';

        if ($gallery_count > 0) {
            $i = 0;
            foreach ($gallery as $key => $gal) {
                $i++;
                $output .= '
                <tr>
                    <td>' . $i . '</td>
                    <td>' . $gal->gallery_name . '</td>
                    <td><img src = "' . url('uploads/gallery/' . $gal->gallery_image) . '" class="img-thumbnail" width="120px" height="120px"></td>
                    <td><button dât-gal_id="' . $gal->gallery_id . '" class="btn btn-xs btn-danger delete-gallery"></button></td>
                    
                </tr>
            ';
            }
        } else {
            $output .= '
            <tr>
                <td colspan="4">Sản phẩm này chưa có thư viện ảnh</td>
            </tr>
            </table>
        ';
        }

        echo $output;
    }
}
