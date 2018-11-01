<?php

return [
    /*
    |--------------------------------------------------------------------------
    | System component
    |--------------------------------------------------------------------------
    |
    */

    // menu labels
    "lbl_system"                    => "Hệ thống",
    "lbl_dashboard"                 => "Bảng điều khiển",
    "lbl_config"                    => "Cấu hình chung",
    "lbl_user_manager"              => "Người dùng",
    "lbl_user"                      => "Quản lý người dùng",
    "lbl_usergroup"                 => "Nhóm người dùng",
    "lbl_component"                 => "Components",
    "lbl_block"                     => "Block manager",
    "lbl_extension"                 => "Extensions",
    "lbl_extension_manager"         => "Quản lý phần mở rộng",
    "lbl_template"                  => "Giao diện",
    "lbl_language"                  => "Ngôn ngữ",

    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    |
    */
    "lbl_group_info_user"           => "Thông tin cá nhân",
    "lbl_fullname"                  => "Họ tên",
    "lbl_gender"                    => "Giới tính",
    "lbl_address"                   => "Địa chỉ",
    "lbl_phone"                     => "Điện thoại",
    "lbl_email"                     => "E-Mail",
    "lbl_user_groups_render"        => "Nhóm",
    "lbl_active_render"             => "Trạng thái",
    "lbl_active"                    => "Kích hoạt",
    "lbl_disable"                   => "Khoá",
    "lbl_id"                        => "ID",
    "lbl_group_account"             => "Thông tin tài khoản",
    "lbl_username"                  => "Tên đăng nhập",
    "lbl_password"                  => "Mật khẩu",
    "lbl_change_password"           => "Đổi mật khẩu",
    "lbl_new_password"              => "Mật khẩu mới",
    "lbl_re_new_password"           => "Nhập lại mật khẩu mới",
    "lbl_note"                      => "Ghi chú",
    "lbl_content"                   => "Nội dung",
    "lbl_login_backend"             => "Cho phép đăng nhập giao diện quản trị",
    "lbl_login_frontend"            => "Cho phép đăng nhập giao diện người dùng",
    "lbl_group_account_member_user"             => "Thông tin pháp lí",
    "lbl_group_info_member_certificate_type"    => "Thông tin danh mục chứng chỉ",
    "lbl_group_member_certificate"              => "Thông tin chứng chỉ",
    "lbl_new_input_for_change"      => "Nhập mới nếu thay đổi",
    "help_user"                     => "<p>- Quản lý tất cả những người dùng có thể đăng nhập vào hệ thống của bạn.</p><p>- Mỗi người dùng sẽ thuộc vào một nhóm và có tất cả các quyền của nhóm đó. Vì vậy, hãy lưu ý khi chọn nhóm cho người dùng.</p><p>- Tất cả các nhóm quyền đều được quản lý ở danh mục <b>Nhóm người dùng</b>. Vì vậy, để thêm hoặc thay đổi các quyền đối với các nhóm, bạn vui lòng sang danh mục <b>Nhóm người dùng</b> để cập nhật.</p><p>- <u class='text-danger'><b><i>Lưu ý:</i></b></u> Tên đăng nhập của các của người dùng là duy nhất, hệ thống sẽ không cho phép bạn cập nhật tên đăng nhập đã tồn tại trước đó.</p>",

    "message_change_pass_error"                 => "Sai mật khẩu",
    "message_change_pass_input_error"           => "Mật khẩu không khớp",
    "message_change_pass_success"               => "Đổi mật khẩu thành công",
    "message_forget_pass_info"                  => "Chào <b>:name</b>!<br><br>Đây có phải là yêu cầu của bạn? Nếu không thì hãy bỏ qua email này.<br>Nếu là bạn, hãy click vào link bên dưới!<br><a href=':link'>Đổi mật khẩu</a>",
    "message_forget_pass_error"                 => "Lỗi trong quá trình thực thi. Xin thử lại!",
    "message_forget_pass_warning"               => "Đã gởi yêu cầu!!!",
    "message_forget_pass_input_error"           => "Tên đăng nhập hoặc email không đúng. Thử lại!",
    "message_forget_pass_success"               => "Đã gởi mail lấy lại mật khẩu đến ",
    "message_input_error"                       => "Lỗi trong quá trình nhập. Thử lại!",
    "message_reset_pass_error"                  => "Yêu cầu đã không còn hiệu lực!",
    "message_reset_pass_member_error"           => "Thành viên không tồn tại!",

    /*
    |--------------------------------------------------------------------------
    | User group
    |--------------------------------------------------------------------------
    |
    */
    "lbl_group_usergroup"           => "Thông tin nhóm người dùng",
    "lbl_group_name"                => "Tên nhóm",
    "lbl_group_permission"          => "Chi tiết quyền truy cập",
    "lbl_permission"                => "Phân quyền",
    "lbl_function"                  => "Chức năng",
    "lbl_user_lastest"              => "Người dùng mới nhất",
    "help_usergroup"                => "<p class='text-success'><b>Ghi chú:</b></p><p>- Quản lý các nhóm người dùng trong hệ thống.</p><p>- Phân quyền truy cập chi tiết cho từng chức năng trong hệ thống. Vì vậy, hãy lưu ý khi cấp quyền cho một chức năng bất kỳ, trong đó:</p><ul><li><i class='glyphicon glyphicon-ok text-success'></i> : cho phép người dùng thực hiện.</li><li><i class='glyphicon glyphicon-remove text-danger'></i> : không cho phép người dùng thực hiện.</li></ul>",

    /*
    |--------------------------------------------------------------------------
    | Block
    |--------------------------------------------------------------------------
    |
    */
    "lbl_title"                     => "Tiêu đề",
    "lbl_position"                  => "Position",
    "lbl_module_id_render"          => "Module",
    "lbl_public_render"             => "Kích hoạt",
    "lbl_sort"                      => "Sắp xếp",
    "lbl_global_config"             => "Thông tin chung",

    "lbl_mail_config"               => "Thông tin Email",
    "lbl_host"                      => "Host",
    "lbl_port"                      => "Port",
    "lbl_driver"                    => "Driver",
    "lbl_encryption"                => "Encryption",
    "lbl_assignment"                => "Assignment",

    "lbl_show_block"                => "Hiển thị",
    "lbl_show_block_at_menu"        => "Hiển thị trên các trang đã chọn",
    "lbl_not_show_block_at_menu"    => "Không hiển thị trên các trang đã chọn",

    /*
    |--------------------------------------------------------------------------
    | Extension
    |--------------------------------------------------------------------------
    |
    */
    "lbl_name"                      => "Tên",
    "lbl_type"                      => "Loại",
    "lbl_location"                  => "Trang",
    "lbl_author"                    => "Tác giả",
    "lbl_author_email"              => "E-mail",
    "lbl_author_url"                => "URL",
    "lbl_version"                   => "Phiên bản",
    "lbl_creation_date"              => "Ngày tạo",
    "lbl_copyright"                 => "Copyright",
    "lbl_license"                   => "License",
    "lbl_description"               => "Mô tả",

    "tit_package_info"              => "Thông tin gói cài đặt",
    "tit_install_package"           => "Chọn gói cài đặt",
    "comment_install_package"       => "Vui lòng chọn gói cài đặt. Chú ý: hệ thống chỉ hỗ trợ định dạng file \".zip\"",

    "message_package_install_not_found"         => "Không tìm thấy gói cài đặt",
    "message_package_install_not_found_config"  => "Không tìm thấy file config",
    "message_package_install_can_not_read_config"  => "Không thể đọc file config",
    "lbl_package_uninstall_question"            => "Bạn chắc chắn muốn gỡ bỏ gói cài đặt này?",
    "lbl_export_option_db"                      => "Tuỳ chọn export cơ sở dữ liệu",
    "lbl_export_option_db_structure"            => "Cấu trúc bảng",
    "lbl_export_option_db_structure_and_data"   => "Cấu trúc bảng và dữ liệu",
    "lbl_all"                       => "Tất cả",
    "lbl_filter"                    => "Lọc dữ liệu",
    "lbl_clear_filter"              => "Xoá lọc",

    /*
    |--------------------------------------------------------------------------
    | Language
    |--------------------------------------------------------------------------
    |
    */
    "lbl_lang_code_render"          => "Ngôn ngữ",
    "lbl_alias"                     => "Alias",
    "lbl_template_id_render"        => "Giao diện",
    "lbl_default_render"            => "Mặc định",
    "lbl_default_render"            => "Mặc định",

    /*
    |--------------------------------------------------------------------------
    | Template
    |--------------------------------------------------------------------------
    |
    */
    "lbl_template_select_layout"    => "Chọn layout",

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    |
    */
    "lbl_system_info"               => "System Information",
    "lbl_system_dir_permissions"    => "Thông tin thư mục hệ thống",
    "lbl_system_dir_can_writable"   => "Có thể ghi",
    "lbl_system_dir_not_writable"   => "Không thể ghi",
    "help_dashboard"                => "<p class='text-success'><b>Ghi chú:</b></p><p>- Cung cấp các thông tin tổng quan về trạng hiện tại của hệ thống.</p><p>- Hãy thêm các thống kê nhanh và tùy chỉnh vị trí của chúng để bạn có thể dễ dàng theo dõi.</p>",

    /*
    |--------------------------------------------------------------------------
    | Config
    |--------------------------------------------------------------------------
    |
    */
    "lbl_site_config"               => "Cấu hình site",
    "lbl_offline"                   => "Tạm ngưng hoạt động trang web",
    "lbl_seo"                       => "SEO",
    "lbl_keyword"                   => "Từ khoá",
    "lbl_title_vi"                  => "Tiêu đề tiếng Việt",
    "lbl_title_en"                  => "Tiêu đề tiếng Anh",

    "lbl_view_detail"               => "Xem chi tiết",
    "lbl_quick_stat"                => "Thống kê nhanh",

    "help_config"                   => "<p><b class='text-success'>Ghi chú:</b></p><p>- Nhập các thông tin về website để hỗ trợ cho các bộ máy tìm kiếm dễ dàng tìm thấy website của bạn.</p><p>- Thông tin email sẽ được sử dụng cho hệ thống mail tự động của website. Vì vậy, hãy nhập thật chính xác thông tin này và hãy đảm bảo rằng hệ thống mail tự động có thể hoạt động tốt.</p><p>- Hãy đảm bảo các thư mục cơ bản được phép ghi để hệ thống hoạt động tốt.</p>",
];
