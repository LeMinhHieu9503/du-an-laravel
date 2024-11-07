<?php

namespace App\Http\Controllers;

use App\Models\CatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Để sử dụng Hash
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
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
    public function add_post()
    {
        $this->AuthLogin();

        $cate_post = CatePost::orderBy('cate_post_id', 'DESC')->get();

        return view('admin.post.add_post')->with(compact('cate_post'));
    }

    // Hiển thị danh sách tất cả danh mục sản phẩm
    public function all_post()
    {
        $this->AuthLogin();
        $all_post = Post::orderBy('post_id', 'DESC')->get();
        return view('admin.post.list_post')->with(compact('all_post'));
    }

    // // // Lưu danh mục sản phẩm vào cơ sở dữ liệu
    public function save_post(Request $request)
    {
        $this->AuthLogin();

        // Lấy dữ liệu từ form gửi lên và lưu vào mảng $data
        $data = $request->all();
        $post = new Post();

        $post->post_title = $data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_content = $data['post_content'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->post_desc = $data['post_desc'];
        $post->post_status = $data['post_status'];
        $post->cate_post_id = $data['cate_post_id'];

        // Xử lý ảnh
        if ($request->hasFile('post_image')) {
            $get_image = $request->file('post_image');
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
            // Đặt tên mới cho ảnh
            $new_image = $name_image . '_' . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            // Di chuyển ảnh vào thư mục uploads/post
            $get_image->move('uploads/post', $new_image);
            $post->post_image = $new_image;
        } else {
            Session::put('message', 'Làm ơn thêm hình ảnh');
            return redirect()->back();
        }

        // Lưu bài viết vào cơ sở dữ liệu
        $post->save();
        Session::put('message', 'Thêm bài viết thành công');
        return redirect()->back();
    }
    public function editPost($post_id)
    {
        $edit_post = DB::table('tbl_posts')->where('post_id', $post_id)->get();
        $cate_post = DB::table('tbl_category_post')->get(); // Lấy danh mục bài viết cho dropdown

        return view('admin.post.edit_post')->with('edit_post', $edit_post)->with('cate_post', $cate_post);
    }

    // Cập nhật bài viết
    public function updatePost(Request $request, $post_id)
    {
        $data = array();
        $data['post_title'] = $request->post_title;
        $data['post_slug'] = $request->post_slug;
        $data['post_desc'] = $request->post_desc;
        $data['post_meta_desc'] = $request->post_meta_desc;
        $data['post_content'] = $request->post_content;
        $data['cate_post_id'] = $request->cate_post_id;
        $data['post_status'] = $request->post_status;

        // Kiểm tra nếu có upload hình ảnh mới
        if ($request->hasFile('post_image')) {
            $image = $request->file('post_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/post', $image_name);
            $data['post_image'] = $image_name;
        }

        // Cập nhật bài viết vào cơ sở dữ liệu
        DB::table('tbl_posts')->where('post_id', $post_id)->update($data);

        Session::put('message', 'Cập nhật bài viết thành công');
        return Redirect::to('all-post');
    }


    public function delete_post($post_id)
    {
        $this->AuthLogin();

        $post = Post::find($post_id);

        $post_image = $post->post_image;
        if ($post_image) {
            $path = 'uploads/post/' . $post_image;
            unlink($path);
        }
        $post->delete();
        Session::put('message', 'Xóa bài viết thành công');
        return redirect()->back();
    }

    public function danh_muc_bai_viet(Request $request, $post_id)
    {
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(4)->get();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();

        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')->get();

        // Tìm danh mục bài viết bằng post_id
        $catepost = CatePost::where('cate_post_id', $post_id)->first();

        // Kiểm tra nếu tìm thấy $catepost
        if ($catepost) {
            $post = Post::with('cate_post')->where('post_status', 1)->where('cate_post_id', $catepost->cate_post_id)->get();
        } else {
            $post = collect(); // Trả về tập hợp rỗng nếu không tìm thấy $catepost
        }

        return view('pages.baiviet.danhmucbaiviet')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('slider', $slider)
            ->with('post', $post)
            ->with('category_post', $category_post);
    }
}
