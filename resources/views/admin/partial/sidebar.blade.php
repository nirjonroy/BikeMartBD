<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link">
    <img src="{{ asset('backend/imgs/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Bike Mart Bd</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('site-information.index') }}" class="nav-link {{ request()->routeIs('site-information.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-industry"></i>
            <p>Site Information</p>
          </a>
        </li>

        <!-- Sliders -->
        <li class="nav-item has-treeview {{ request()->routeIs('slider.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->routeIs('slider.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-images"></i>
            <p>Sliders <i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('slider.index') }}" class="nav-link {{ request()->routeIs('slider.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Sliders</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('slider.create') }}" class="nav-link {{ request()->routeIs('slider.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create Slider</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Brands -->
        <li class="nav-item has-treeview {{ request()->routeIs('brand.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->routeIs('brand.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tags"></i>
            <p>Brands <i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('brand.index') }}" class="nav-link {{ request()->routeIs('brand.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Brands</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('brand.create') }}" class="nav-link {{ request()->routeIs('brand.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create Brand</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Category -->
        <li class="nav-item has-treeview {{ request()->routeIs('category.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>Categories <i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('category.index') }}" class="nav-link {{ request()->routeIs('category.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Categories</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('sub-category.index') }}" class="nav-link {{ request()->routeIs('sub-category.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Sub Categories</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('child-category.index') }}" class="nav-link {{ request()->routeIs('child-category.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Child Categories</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Products -->
        <li class="nav-item has-treeview {{ request()->routeIs('product.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->routeIs('product.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-box"></i>
            <p>Products <i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('product.index') }}" class="nav-link {{ request()->routeIs('product.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Products</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('product.create') }}" class="nav-link {{ request()->routeIs('product.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create Product</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Blogs -->
        <li class="nav-item has-treeview {{ request()->routeIs('blog.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-blog"></i>
            <p>Blogs <i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Blogs</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('blog.create') }}" class="nav-link {{ request()->routeIs('blog.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create Blog</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- reports -->

        <li class="nav-item has-treeview {{ request()->routeIs('inventory.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->routeIs('inventory.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-file"></i>
            <p>Reports <i class="fas fa-angle-left right"></i> </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('inventory') }}" class="nav-link {{ request()->routeIs('inventory') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p> Report</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('inventory') }}" class="nav-link {{ request()->routeIs('inventory') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Inventory</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Logout -->
        <li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>
