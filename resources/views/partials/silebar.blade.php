<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('admin.myName')}}" class="d-block">Alexander Pierce</a>
            </div>
        </div>
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.category.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Danh mục sản phẩm
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.menu.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Menus
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.product.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Sản Phẩm</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.slider.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Slider</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.setting.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Setting</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Danh sách nhân viên </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.role.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Danh sách vai trò(Roles)</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.permission.add')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Tạo dữ liệu bảng Permission</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>