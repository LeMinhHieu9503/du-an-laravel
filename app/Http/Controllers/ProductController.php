<?php

namespace App\Http\Controllers;

use App\Models\CatePost;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


session_start();
class ProductController extends Controller
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
    // Hiển thị form thêm sản phẩm
    public function add_product()
    {
        $this->AuthLogin();

        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id', 'desc')->get();

        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    // Hiển thị danh sách tất cả sản phẩm
    public function all_product()
    {
        $this->AuthLogin();

        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')

            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->orderBy('tbl_product.product_id', 'desc')->get();

        $manager_product = view('admin.all_product')
            ->with('all_product', $all_product);
        return view('admin_layout')->with('admin.all_product', $manager_product);
    }

    // Lưu sản phẩm vào cơ sở dữ liệu
    public function save_product(Request $request)
    {
        $this->AuthLogin();

        // Lấy dữ liệu từ form gửi lên và lưu vào mảng $data
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_slug'] = $request->product_slug;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_quantity'] = $request->product_quantity;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_status'] = $request->product_status;
        $data['product_sold'] = 0;

        // Paths for file uploads
        $path_gallery = 'uploads/gallery/';
        $path = 'uploads/product/';

        // Get the product image from the form
        $get_image = $request->file('product_image');

        if ($get_image) {
            // Generate a unique name for the uploaded image
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
            $new_image = $name_image . '_' . Str::random(5) . '.' . $get_image->getClientOriginalExtension();

            // Move the image to the product folder
            $get_image->move(public_path($path), $new_image);

            // Copy the image to the gallery folder
            File::copy(public_path($path . $new_image), public_path($path_gallery . $new_image));

            // Store the image name in the data array
            $data['product_image'] = $new_image;
        }

        // Insert the product data into the database and get the product ID
        $pro_id = DB::table('tbl_product')->insertGetId($data);

        // Save the gallery image associated with the product
        $gallery = new Gallery();
        $gallery->gallery_image = $new_image;
        $gallery->gallery_name = $new_image;
        $gallery->product_id = $pro_id;
        $gallery->save();

        // Set a success message in the session
        Session::put('message', 'Thêm sản phẩm thành công');

        // Redirect to the product add page
        return redirect()->back();
    }

    public function unactive_product($product_id)
    {
        $this->AuthLogin();

        DB::table('tbl_product')->where('product_id', $product_id)
            ->update(['product_status' => 0]);
        Session::put('message', 'Kích hoạt thành công');
        return Redirect::to('all-product');
    }

    public function active_product($product_id)
    {
        $this->AuthLogin();

        DB::table('tbl_product')->where('product_id', $product_id)
            ->update(['product_status' => 1]);
        Session::put('message', 'Không kích hoạt thành công');
        return Redirect::to('all-product');
    }

    public function edit_product($product_id)
    {
        $this->AuthLogin();

        $cate_product = DB::table('tbl_category_product')->get();
        $brand_product = DB::table('tbl_brand')->get();

        $edit_product = DB::table('tbl_product')
            ->where('product_id', $product_id)
            ->get();
        $manager_product = view('admin.edit_product')
            ->with('edit_product', $edit_product)
            ->with('cate_product', $cate_product)
            ->with('brand_product', $brand_product);

        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }

    public function update_product(Request $request, $product_id)
    {
        $this->AuthLogin();

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_slug'] = $request->product_slug;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
            // Đặt tên mới cho ảnh
            $new_image = $name_image . '_' . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            // Di chuyển ảnh vào thư mục uploads/product
            $get_image->move('uploads/product', $new_image);
            // Lưu tên ảnh vào mảng $data
            $data['product_image'] = $new_image;
        }

        // Cập nhật sản phẩm vào bảng 'tbl_product'
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);

        // Lưu thông báo vào session
        Session::put('message', 'Cập nhật sản phẩm thành công');

        // Điều hướng về trang danh sách sản phẩm
        return redirect()->to('all-product');
    }

    public function delete_product($product_id)
    {
        $this->AuthLogin();

        DB::table('tbl_product')
            ->where('product_id', $product_id)
            ->delete();
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }
    //End Function Admin PAGE


    //HOME
    public function details_product(Request $request, $product_id)
    {
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(4)->get();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();


        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')->get();

        $details_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_product.product_id', $product_id)->get();
        // $category_id = null;
        foreach ($details_product as $key => $value) {
            $category_id = $value->category_id;
            $product_id = $value->product_id;
        }
        //gallery
        $gallery = Gallery::where('product_id', $product_id)->get();
        $related_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_category_product.category_id', $category_id)
            ->whereNotIn('tbl_product.product_id', [$product_id])
            ->get();

        return view('pages.sanpham.show_details')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('product_details', $details_product)
            ->with('relate', $related_product)
            ->with('category_post', $category_post)
            ->with('gallery', $gallery)
            ->with('slider', $slider);
    }


    // Comment
    public function list_comment()
    {
        $comment = Comment::with('product')->orderBy('comment_status', 'DESC')->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment', '>', 0)->orderBy('comment_id', 'DESC')->get();
        return view('admin.comment.list_comment')->with(compact('comment', 'comment_rep'));
    }

    public function allow_comment(Request $request)
    {
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }

    public function reply_comment(Request $request)
    {
        $data = $request->all();
        $comment = new Comment();
        $comment->comment_content = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_name = 'Admin';
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_status = 1;
        $comment->comment_date = now();

        $comment->save();
    }
    public function send_comment(Request $request)
    {
        // Kiểm tra nếu các trường bắt buộc bị trống
        if (empty($request->comment_name) || empty($request->comment_content)) {
            return response()->json(['error' => 'Tên và nội dung bình luận không được để trống!'], 400);
        }

        // Nếu không truyền comment_status, mặc định là 1
        $comment_status = $request->has('comment_status') ? $request->comment_status : 0;
        $comment_parent_comment = $request->has('comment_parent_comment') ? $request->comment_parent_comment : 0;

        // Thêm bình luận vào database
        Comment::create([
            'comment_name' => $request->comment_name,
            'comment_content' => $request->comment_content,
            'comment_date' => now(),
            'comment_product_id' => $request->product_id,
            'comment_status' => $comment_status
        ]);

        // Trả lại phản hồi thành công
        return response()->json(['success' => 'Bình luận đã được thêm thành công và đang đợi xét duyệt.']);
    }



    public function load_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id', $product_id)->where('comment_status', 0)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment', '>', 0)->get();
        $output = '';

        foreach ($comment as $key => $comm) {
            $output .= '
            
        <div class="row style_comment">
            <div class="col-md-2">
                <img src="' . asset('/uploads/avatar-batman.jpg') . '" width="100%" class="img img-responsive img-thumbnail" alt="">
            </div>
            <div class="col-md-10">
                <p style="color: green">' . htmlspecialchars($comm->comment_name) . '</p>
                <p style="color: black">' . htmlspecialchars($comm->comment_date) . '</p>
                <p>' . htmlspecialchars($comm->comment_content) . '</p>
            </div>
        </div>
        <br>
        ';

            foreach ($comment_rep as $key => $rep_comment) {
                if ($rep_comment->comment_parent_comment == $comm->comment_id) {
                    $output .= '

        <div class="row style_comment" style="margin:5px 40px;background-color:rgb(154 208 186)">
            <div class="col-md-2">
                <img src="' . asset('/uploads/avatar-admin.jpg') . '" width="75%" class="img img-responsive img-thumbnail" alt="">
            </div>
            <div class="col-md-10">
                <p style="color: green">@Store</p>
                <p style="color: black">' . $rep_comment->comment_content . '</p>
                <p></p>
            </div>
        </div>
        <br>';
                }
            }
        }
        echo $output;
    }

    public function delete_comment($comment_id)
    {
        $comment = Comment::find($comment_id);
        if ($comment) {
            $comment->delete();
            return redirect()->back()->with('message', 'Xóa bình luận thành công!');
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy bình luận!');
        }
    }

    public function edit_comment($comment_id)
    {
        $comment = Comment::find($comment_id);
        if ($comment) {
            return view('admin.comment.edit_comment')->with('comment', $comment);
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy bình luận!');
        }
    }

    public function update_comment(Request $request, $comment_id)
    {
        // Tìm bình luận theo ID
        $comment = Comment::find($comment_id);

        // Kiểm tra nếu tìm thấy bình luận
        if ($comment) {
            // Cập nhật nội dung bình luận từ form
            $comment->comment_content = $request->comment_content;

            // Lưu lại thay đổi
            $comment->save();

            // Thêm thông báo vào session
            Session::put('message', 'Cập nhật bình luận thành công!');
        } else {
            // Nếu không tìm thấy bình luận, hiển thị thông báo lỗi
            Session::put('message', 'Không tìm thấy bình luận!');
        }

        // Quay lại trang danh sách bình luận
        return redirect()->back();
    }
}
