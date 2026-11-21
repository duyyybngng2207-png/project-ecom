<?php
if (!defined('_HIENU')) {
    die('Truy cập không hợp lệ');
}
?>




<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="<?php echo _HOST_URL; ?>" class="brand-link">
            <!--begin::Brand Image-->
            <img
                src="/public/assets/img/AdminLTELogo.png"
                alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Equal Marketing</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="navigation"
                aria-label="Main navigation"
                data-accordion="false"
                id="navigation">
                <li class="nav-item menu-open">
                    <a href="<?php echo _HOST_URL; ?>/dashboard" class="nav-link active">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>   
                        Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Bài viết
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _HOST_URL; ?>/admin/posts" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Danh sách bài viết</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Sản phẩm
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _HOST_URL; ?>/admin/product" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>
                                    Danh sách sản phẩm
                                </p>
                            </a>
                        <li class="nav-item">
                            <a href="<?php echo _HOST_URL; ?>/admin/comments" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Comments</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo _HOST_URL; ?>/admin/reviews" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Reviews</p>
                            </a>
                        </li>
                    </ul>
                </li>
                    
                </li>
                <li class="nav-item menu-open">
                    <a href="<?php echo _HOST_URL; ?>/admin/orders" class="nav-link active">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>   
                        Đặt hàng 
                        </p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <a href="<?php echo _HOST_URL; ?>/admin/coupons" class="nav-link active">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>   
                        Mã giảm giá 
                        </p>
                    </a>
                </li>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->