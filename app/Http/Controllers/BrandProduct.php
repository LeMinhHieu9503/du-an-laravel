<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Để sử dụng Hash
use App\Models\Brand;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;

session_start();

class BrandProduct extends Controller
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
    // Hiển thị form thêm thương hiệu sản phẩm
    public function add_brand_product()
    {
        $this->AuthLogin();

        return view('admin.add_brand_product');
    }

    // Hiển thị danh sách tất cả thương hiệu sản phẩm
    public function all_brand_product()
    {
        $this->AuthLogin();

        // $all_brand_product = DB::table('tbl_brand')->get(); //Static hướng đối tượng
        $all_brand_product = Brand::orderBy('brand_id','DESC')->get();

        $manager_brand_product = view('admin.all_brand_product')
            ->with('all_brand_product', $all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);
    }

    // Lưu thương hiệu sản phẩm vào cơ sở dữ liệu
    public function save_brand_product(Request $request)
    {
        // Cách 1
        $this->AuthLogin();
        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_slug = $data['brand_slug'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();

        // Cách 2
        // Lấy dữ liệu từ form gửi lên và lưu vào mảng $data
        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_desc'] = $request->brand_product_desc;
        // $data['brand_status'] = $request->brand_product_status;

        // // Thêm dữ liệu vào bảng 'tbl_brand'
        // DB::table('tbl_brand')->insert($data);



        // Lưu thông báo thành công vào session
        Session::put('message', 'Thêm thương hiệu sản phẩm thành công');

        // Điều hướng đến trang danh sách thương hiệu sản phẩm
        return redirect::to('all-brand-product');
    }

    public function unactive_brand_product($brand_product_id)
    {
        $this->AuthLogin();

        DB::table('tbl_brand')->where('brand_id', $brand_product_id)
            ->update(['brand_status' => 0]);
        Session::put('message', 'Kích hoạt thương hiệu thành công');
        return Redirect::to('all-brand-product');
    }

    public function active_brand_product($brand_product_id)
    {
        $this->AuthLogin();

        DB::table('tbl_brand')->where('brand_id', $brand_product_id)
            ->update(['brand_status' => 1]);
        Session::put('message', 'Không kích hoạt thương hiệu thành công');
        return Redirect::to('all-brand-product');
    }

    public function edit_brand_product($brand_product_id)
    {
        $this->AuthLogin();

        $edit_brand_product = DB::table('tbl_brand')
            ->where('brand_id', $brand_product_id)
            ->get();

        // $edit_brand_product = Brand::find($brand_product_id);

        $manager_brand_product = view('admin.edit_brand_product')
            ->with('edit_brand_product', $edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }

    public function update_brand_product(Request $request, $brand_product_id)
    {
        $this->AuthLogin();
        $data = $request->all();
        $brand = Brand::find($brand_product_id);
        // $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_slug = $data['brand_product_slug'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_slug'] = $request->brand_slug;
        // $data['brand_desc'] = $request->brand_product_desc;
        // DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    public function delete_brand_product($brand_product_id)
    {
        $this->AuthLogin();

        DB::table('tbl_brand')
            ->where('brand_id', $brand_product_id)
            ->delete();
        Session::put('message', 'Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    //End Function Admin PAGE


    //HOME
    public function show_brand_home(Request $request, $brand_id)
    {
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();

        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')->get();

        $brand_by_id = DB::table('tbl_product')
            ->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')
            ->where('tbl_product.brand_id', $brand_id)
            ->get();

        $brand_name = DB::table('tbl_brand')
            ->where('tbl_brand.brand_id', $brand_id)
            ->limit(1)
            ->get();


        return view('pages.brand.show_brand')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('brand_by_id', $brand_by_id)
            ->with('brand_name', $brand_name)
            ->with('slider',$slider);
    }
}
