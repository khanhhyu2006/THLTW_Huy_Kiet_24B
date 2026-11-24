# Ghi chú API Laravel Phần 1

Repo đang khóa Laravel 12 trong Composer. Mã dùng cú pháp tương thích với phiên bản này. Sanctum và tiền tố /api đã có sẵn.

## Chuẩn bị

Trong thư mục backend, chạy `composer install`, sao chép `.env.example` thành `.env` và chạy `php artisan key:generate`. Tạo cơ sở dữ liệu MySQL `ecommerce_thltw` trên máy rồi điền các giá trị sau vào `.env` theo cấu hình thực tế.

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_thltw
DB_USERNAME=root
DB_PASSWORD=
```

Với cơ sở dữ liệu mới dành cho bài thực hành, chạy `php artisan config:clear`, `php artisan migrate` và `php artisan db:seed --class=CategorySeeder`. Chạy `php artisan route:list --path=api` để xem route và `php artisan serve` để mở API tại `http://localhost:8000`. Các migration phục vụ bảng của API Phần 1. Nếu đã import CSDL của lớp, dùng dữ liệu có sẵn và đối chiếu các cột trước khi chạy migration nghiệp vụ.

## Danh sách danh mục

| Hàm | Tác dụng |
| --- | --- |
| `Category::casts()` | Ép kiểu `parent_id`, `sort_order` và `status` về số nguyên khi đọc model. |
| `Category::parent()` | Lấy danh mục cha theo `parent_id`. |
| `Category::children()` | Lấy các danh mục có `parent_id` trỏ tới danh mục hiện tại. |
| `Category::scopeActive()` | Thêm điều kiện `status = 1`. Trong truy vấn gọi qua `active()`. |
| `CategoryController::index()` | Lấy danh mục gốc đang hiển thị và nạp sẵn danh mục con đang hiển thị để tránh N+1. Sắp xếp hai cấp theo `sort_order` rồi `id`. |
| `CategoryResource::toArray()` | Xuất `id`, `name`, `slug` và thêm `children` khi quan hệ đã được nạp. |
| Migration `up()` / `down()` | Tạo / hoàn tác bảng danh mục và ràng buộc cha–con. |
| `CategorySeeder::run()` | Thêm danh mục mẫu đang hiển thị và danh mục ẩn theo slug để chạy lại seeder an toàn. |

Gửi `GET /api/categories` với header `Accept: application/json`. Mong đợi HTTP 200 và danh sách trong khóa `data`. API chỉ đọc nên bỏ qua bước FormRequest.

## Bài 1 Chi tiết danh mục

`CategoryController::show(string $slug)` tìm danh mục đang hiển thị theo slug rồi giao dữ liệu cho `CategoryResource`. `firstOrFail()` trả HTTP 404 khi slug không tồn tại hoặc danh mục đang ẩn.

Gọi `GET /api/categories/phu-kien` để kiểm tra HTTP 200. Dùng slug `khong-co-that` và `danh-muc-an` để kiểm tra HTTP 404.
