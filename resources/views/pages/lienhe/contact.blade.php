@extends('layout')

@section('content')
    <style>
        /* Overall Container */
        .shop-introduction-container {
            padding: 60px 20px;
            background-color: #f8f9fa;
            /* Light gray background for the whole container */
        }

        /* Header Section */
        .shop-header {
            background-color: #007bff;
            /* Blue background */
            padding: 40px 20px;
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .shop-header h2 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .shop-header p {
            font-size: 18px;
            line-height: 1.6;
        }

        /* About the Shop */
        .about-shop {
            margin-top: 40px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .about-shop h3 {
            font-size: 30px;
            color: #333;
            margin-bottom: 15px;
        }

        .about-shop p {
            font-size: 16px;
            color: #555;
            line-height: 1.8;
        }

        /* Contact Information */
        .contact-info {
            margin-top: 40px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .contact-info h3 {
            font-size: 30px;
            color: #333;
            margin-bottom: 15px;
        }

        .contact-info p {
            font-size: 16px;
            color: #555;
            line-height: 1.8;
        }

        /* Contact Information - Button Style */
        .contact-info .btn {
            margin-top: 15px;
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }

        .contact-info .btn:hover {
            background-color: #0056b3;
            transition: background-color 0.3s;
        }

        /* Google Map */
        iframe {
            margin-top: 40px;
            border-radius: 8px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .shop-header h2 {
                font-size: 28px;
            }

            .shop-header p {
                font-size: 16px;
            }

            .about-shop h3,
            .contact-info h3 {
                font-size: 24px;
            }

            .about-shop p,
            .contact-info p {
                font-size: 14px;
            }
        }
    </style>

    <div class="shop-introduction-container">
        <!-- Header Section -->
        <div class="shop-header text-center">
            <h2>Chào Mừng Đến Với Cửa Hàng Điện Thoại</h2>
            <p>Chúng tôi cung cấp các sản phẩm điện thoại di động chất lượng với dịch vụ tốt nhất.</p>
        </div>

        <!-- About the Shop -->
        <div class="about-shop">
            <h3>Giới Thiệu Cửa Hàng</h3>
            <p>Chúng tôi là cửa hàng chuyên cung cấp các dòng điện thoại di động từ những thương hiệu nổi tiếng như Apple,
                Samsung, Xiaomi, Oppo và nhiều hơn nữa. Cửa hàng của chúng tôi cam kết mang đến những sản phẩm chất lượng,
                đáp ứng nhu cầu sử dụng của khách hàng với giá cả hợp lý.</p>
            <p>Với hơn 10 năm hoạt động trong ngành, chúng tôi tự hào về chất lượng sản phẩm và dịch vụ chăm sóc khách hàng.
                Mỗi khách hàng khi đến với cửa hàng đều nhận được sự tư vấn tận tình và dịch vụ bảo hành chu đáo.</p>
        </div>

        <!-- Contact Information -->
        <div class="contact-info text-center">
            <h3>Liên Hệ Với Chúng Tôi</h3>
            <p>Địa chỉ: 120 P. Thái Hà, Đống Đa, Hà Nội</p>
            <p>Số điện thoại: 0968686868</p>
            <p>Email: support@phoneshop.com</p>
        </div>

        <div>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.5189936941397!2d105.81882847503094!3d21.011909980633156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab7dbe72d225%3A0xff2723e4039fb40!2zMTIwIFAuIFRow6FpIEjDoCwgVHJ1bmcgTGnhu4d0LCDEkOG7kW5nIMSQYSwgSMOgIE7hu5lpLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1731267144916!5m2!1sen!2s"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
@endsection
