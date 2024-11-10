<?php
// Đang có lỗi nên chỉ làm trang liên hệ có sẵn , basic nhất
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
use App\Models\Contact;

class ContactController extends Controller
{
    public function lien_he(Request $request)
    {
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(4)->get();
        // Post-category
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();


        $url_canonical = $request->url();
        $contact = Contact::where('info_id', 1)->first();
        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')->get();
        return view('pages.lienhe.contact')->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('url_canonical', $url_canonical)
            ->with('slider', $slider)
            ->with('category_post', $category_post)
            ->with('contact', $contact);
    }
    public function list_info()
    {
        $contacts = Contact::all();
        return view('admin.information.list_information', compact('contacts'));
    }

    public function information()
    {
        $contact = Contact::where('info_id', 1)->get();
        return view('admin.information.add_information')->with(compact('contact'));
    }

    public function save_info(Request $request)
    {
        $data = $request->all();
        $contact = new Contact();
        $contact->info_contact = $data['info_contact'];
        $contact->info_map = $data['info_map'];

        if ($request->hasFile('info_logo')) {
            $get_image = $request->file('info_logo');
            $path = 'uploads/contact/';

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();

            $get_image->move($path, $new_image);
            $contact->info_logo = $new_image;
        } else {
            return redirect()->back()->with('message', 'Logo image is required');
        }

        $contact->save();

        return redirect()->back()->with('message', 'Thông tin web đã được thêm thành công');
    }

    // Edit Information
    public function edit_info($info_id)
    {
        $contact = Contact::where('info_id', $info_id)->first(); // Fetch contact by info_id
        return view('admin.information.edit_info', compact('contact'));
    }

    // Update Information
    public function update_info(Request $request, $info_id)
    {
        $data = $request->all();
        $contact = Contact::where('info_id', $info_id)->first(); // Fetch contact by info_id

        // Update contact info
        $contact->info_contact = $request->info_contact;
        $contact->info_map = $request->info_map;

        if ($request->hasFile('info_logo')) {
            // Delete old logo if it exists
            $old_image = $contact->info_logo;
            if (file_exists(public_path('uploads/contact/' . $old_image))) {
                unlink(public_path('uploads/contact/' . $old_image));
            }

            // Save new logo image
            $get_image = $request->file('info_logo');
            $path = 'uploads/contact/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $contact->info_logo = $new_image;
        }

        $contact->save();
        return redirect()->route('list-information')->with('message', 'Cập nhật thông tin thành công');
    }
    // Delete Information
    public function delete_info($info_id)
    {
        $contact = Contact::where('info_id', $info_id)->first();

        if ($contact) {
            // Delete the logo image if it exists
            $old_image = $contact->info_logo;
            if (file_exists(public_path('uploads/contact/' . $old_image))) {
                unlink(public_path('uploads/contact/' . $old_image));
            }

            // Delete contact record
            $contact->delete();
            return redirect()->route('list-information')->with('message', 'Xóa thông tin thành công');
        }

        return redirect()->route('list-information')->with('message', 'Thông tin không tồn tại');
    }
}
