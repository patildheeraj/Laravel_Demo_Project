<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/admin') }}" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Welcome {{ Session::get('Logged_Email') }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="#" class="nav-link @yield('dashboard')">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin" class="nav-link  @yield('dashboard')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item @yield('menu')">
            <a href="#" class="nav-link @yield('category')">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Category Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('category.add') }}" class="nav-link @yield('category_add')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('category.fetch') }}" class="nav-link @yield('category_list')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item @yield('product_menu')">
            <a href="#" class="nav-link @yield('product')">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Products Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('product.add') }}" class="nav-link @yield('product_add')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('product.fetch') }}" class="nav-link @yield('product_list')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item @yield('banner_menu')">
            <a href="#" class="nav-link @yield('banner')">
              <i class="nav-icon fas fa-th"></i>
              <p>
                 Banner
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('Banner.add') }}" class="nav-link @yield('banner_add')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Banner</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('Banner.fetch') }}" class="nav-link @yield('banner_list')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Banner List</p>
                </a>
              </li>
            </ul>
          </li>
          </li>
          <li class="nav-item @yield('coupon_menu')">
            <a href="#" class="nav-link @yield('coupon')">
              <i class="nav-icon fas fa-tag"></i>
              <p>
                 Coupon
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('coupon.add') }}" class="nav-link @yield('coupon_add')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Coupon</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('coupon.fetch') }}" class="nav-link @yield('coupon_list')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Coupon List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item @yield('cms_menu')">
            <a href="#" class="nav-link @yield('cms')">
              <i class="nav-icon fa fa-certificate"></i>
              <p>
                CMS Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/add-cms-page') }}" class="nav-link @yield('cms_add')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add CMS</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('/admin/list-cms-page') }}" class="nav-link @yield('cms_list')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View CMS</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('view.order') }}" class="nav-link @yield('viewOrder')">
              <i class="fa fa-eye-slash"></i>
              <p>
                  View Orders
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/view-frontend-user') }}" class="nav-link @yield('viewRegister')">
              <i class="fa fa-eye"></i>
              <p>
                 View Registered User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('user.feedback') }}" class="nav-link @yield('userFeedback')">
              <i class="fas fa-comments"></i>
              <p>
                 User Feedback
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('configuration.edit') }}" class="nav-link @yield('configuration')">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                 Configuration
              </p>
            </a>
          </li>
          <li class="nav-item @yield('user_menu')">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('user.add') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('user.fetch') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('/admin/reports') }}" class="nav-link @yield('report')">
              <i class="fa fa-recycle"></i>
              <p>
                 Report
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
