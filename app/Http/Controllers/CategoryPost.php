<?php

namespace App\Http\Controllers;

use App\Models\CatePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Để sử dụng Hash
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;


class CategoryPost extends Controller
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

    public function add_category_post()
    {
        $this->AuthLogin();

        return view('admin.category_post.add_category_post');
    }

    // Hiển thị danh sách tất cả danh mục sản phẩm
    public function all_category_post()
    {
        $this->AuthLogin();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        return view('admin.category_post.all_category_post')->with(compact('category_post'));
    }

    // // Lưu danh mục sản phẩm vào cơ sở dữ liệu
    public function save_category_post(Request $request)
    {
        $this->AuthLogin();

        // Lấy dữ liệu từ form gửi lên và lưu vào mảng $data
        $data = $request->all();
        $category_post = new CatePost();

        $category_post->cate_post_name = $data['cate_post_name'];
        $category_post->cate_post_slug = $data['cate_post_slug'];
        $category_post->cate_post_desc = $data['cate_post_desc'];
        $category_post->cate_post_status = $data['cate_post_status'];

        $category_post->save();
        // Lưu thông báo thành công vào session
        Session::put('message', 'Thêm danh mục bài viết thành công');

        // Điều hướng đến trang danh sách danh mục sản phẩm
        return redirect()->back();
    }
    public function edit_category_post($category_post_id)
    {
        $this->AuthLogin();

        $category_post = CatePost::find($category_post_id);

        return view('admin.category_post.edit_category_post')->with(compact('category_post'));

    }

    public function update_category_post(Request $request, $cate_id)
{
    $this->AuthLogin();

    // Tìm bản ghi cần cập nhật theo ID
    $category_post = CatePost::find($cate_id);
    
    // Kiểm tra nếu bản ghi tồn tại
    if ($category_post) {
        // Lấy tất cả dữ liệu từ request
        $data = $request->all();

        // Cập nhật các trường thông tin từ request
        $category_post->cate_post_name = $data['cate_post_name'];
        $category_post->cate_post_slug = $data['cate_post_slug'];
        $category_post->cate_post_desc = $data['cate_post_desc'];
        $category_post->cate_post_status = $data['cate_post_status'];

        // Lưu thay đổi vào CSDL
        $category_post->save();

        Session::put('message', 'Cập nhật danh mục bài viết thành công');
    } else {
        Session::put('message', 'Danh mục bài viết không tồn tại');
    }
    
    return Redirect::to('all-category-post');
}


    public function delete_category_post($cate_id)
    {
        $this->AuthLogin();
        $category_post = CatePost::find($cate_id);

        $category_post->delete();
        
        Session::put('message', 'Xóa danh mục bài viết thành công');
        return Redirect::to('all-category-post');
    }


    public function danh_muc_bai_viet($cate_post_id){

    }

}
