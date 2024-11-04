<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Roles;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Phương thức này sẽ tạo dữ liệu mẫu (seeds) cho bảng `admins`
     * và gán vai trò (roles) cho mỗi người dùng mẫu.
     */
    public function run(): void
    {
        // Xóa tất cả các bản ghi hiện tại trong bảng `admins`
        Admin::truncate();

        // Lấy các vai trò (roles) từ bảng `roles` theo tên vai trò
        $adminRoles = Roles::where('name', 'admin')->first();
        $authorRoles = Roles::where('name', 'author')->first();
        $userRoles = Roles::where('name', 'user')->first();

        // Tạo một người dùng mới với vai trò admin
        $admin = Admin::create([
            'admin_name' => 'hieuadmin',                 // Tên admin
            'admin_email' => 'hieuadmin@gmail.com',      // Email admin
            'admin_phone' => '123456789',                // Số điện thoại admin
            'admin_password' => md5('123456'),           // Mật khẩu mã hóa của admin
        ]);

        // Tạo một người dùng mới với vai trò author
        $author = Admin::create([
            'admin_name' => 'hieuauthor',                // Tên author
            'admin_email' => 'hieuauthor@gmail.com',     // Email author
            'admin_phone' => '123456789',                // Số điện thoại author
            'admin_password' => md5('123456'),           // Mật khẩu mã hóa của author
        ]);

        // Tạo một người dùng mới với vai trò user
        $user = Admin::create([
            'admin_name' => 'hieuuser',                  // Tên user
            'admin_email' => 'hieuuser@gmail.com',       // Email user
            'admin_phone' => '123456789',                // Số điện thoại user
            'admin_password' => md5('123456'),           // Mật khẩu mã hóa của user
        ]);

        // Gắn vai trò cho từng người dùng vừa tạo
        $admin->roles()->attach($adminRoles);           // Gắn vai trò admin cho người dùng admin
        $author->roles()->attach($authorRoles);         // Gắn vai trò author cho người dùng author
        $user->roles()->attach($userRoles);             // Gắn vai trò user cho người dùng user
    }
}
