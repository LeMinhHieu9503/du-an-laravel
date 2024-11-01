<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

session_start();
class ProductController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
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
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_quantity'] = $request->product_quantity;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            // Đặt tên mới cho ảnh
            $new_image = $get_name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();

            // Di chuyển ảnh vào thư mục uploads/product
            $get_image->move('uploads/product', $new_image);

            // Lưu tên ảnh vào mảng $data
            $data['product_image'] = $new_image;

            // Thêm sản phẩm vào bảng 'tbl_product'
            DB::table('tbl_product')->insert($data);

            // Lưu thông báo vào session
            Session::put('message', 'Thêm sản phẩm thành công');

            // Điều hướng về trang thêm sản phẩm
            return redirect::to('add-product');
        }

        // Nếu không có hình ảnh
        $data['product_image'] = '';

        // Thêm dữ liệu vào bảng 'tbl_product'
        DB::table('tbl_product')->insert($data);

        // Lưu thông báo thành công vào session
        Session::put('message', 'Thêm sản phẩm thành công');

        // Điều hướng đến trang danh sách sản phẩm
        return redirect::to('all-product');
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
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();

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

        foreach ($details_product as $key => $value) {
            $category_id = $value->category_id;
        }

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
            ->with('slider',$slider);
    }
}
