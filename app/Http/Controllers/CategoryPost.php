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
    // public function edit_category_product($category_product_id)
    // {
    //     $this->AuthLogin();

    //     $edit_category_product = DB::table('tbl_category_product')
    //         ->where('category_id', $category_product_id)
    //         ->get();
    //     $manager_category_product = view('admin.edit_category_product')
    //         ->with('edit_category_product', $edit_category_product);
    //     return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    // }

    // public function update_category_product(Request $request, $category_product_id)
    // {
    //     $this->AuthLogin();

    //     $data = array();
    //     $data['category_name'] = $request->category_product_name;
    //     $data['slug_category_product'] = $request->slug_category_product;
    //     $data['category_desc'] = $request->category_product_desc;

    //     DB::table('tbl_category_product')
    //         ->where('category_id', $category_product_id)
    //         ->update($data);
    //     Session::put('message', 'Cập nhật danh mục sản phẩm thành công');
    //     return Redirect::to('all-category-product');
    // }

    // public function delete_category_product($category_product_id)
    // {
    //     $this->AuthLogin();

    //     DB::table('tbl_category_product')
    //         ->where('category_id', $category_product_id)
    //         ->delete();
    //     Session::put('message', 'Xóa danh mục sản phẩm thành công');
    //     return Redirect::to('all-category-product');
    // }


    public function danh_muc_bai_viet($cate_post_id){
        
    }

}
