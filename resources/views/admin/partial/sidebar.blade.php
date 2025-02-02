<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link">
    <img src="{{asset('backend/imgs/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">Bike Mart Bd</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
          <a href="" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard

            </p>
          </a>

        </li>
        <li class="nav-item">
          <a href="{{route('site-information.index')}}" class="nav-link">
            <i class="nav-icon fas fa-industry"></i>
            <p>
              Site Information
              {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{route('slider.index')}}" class="nav-link">
            <i class="nav-icon fas fa-school"></i>
            {{-- <i class="fa-solid fa-person-chalkboard"></i> --}}
            <p>
              Sliders
              <i class="fas fa-angle-left right"></i>
              {{-- <span class="badge badge-info right">6</span> --}}
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('slider.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Slider</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('slider.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create</p>
              </a>
            </li>

          </ul>
        </li>


        <li class="nav-item has-treeview">
          <a href="{{route('brand.index')}}" class="nav-link">
            <i class="nav-icon fas fa-school"></i>
            {{-- <i class="fa-solid fa-person-chalkboard"></i> --}}
            <p>
              Brands
              <i class="fas fa-angle-left right"></i>
              {{-- <span class="badge badge-info right">6</span> --}}
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('brand.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Brand</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('brand.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create</p>
              </a>
            </li>

          </ul>
        </li>


        <li class="nav-item has-treeview">
          <a href="{{route('category.index')}}" class="nav-link">
            <i class="nav-icon fas fa-school"></i>
            {{-- <i class="fa-solid fa-person-chalkboard"></i> --}}
            <p>
              Category
              <i class="fas fa-angle-left right"></i>
              {{-- <span class="badge badge-info right">6</span> --}}
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('category.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('sub-category.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sub Category</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('child-category.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Child Category</p>
              </a>
            </li>


          </ul>
        </li>


        <li class="nav-item has-treeview">
          <a href="{{route('blog.index')}}" class="nav-link">
            <i class="nav-icon fas fa-school"></i>
            {{-- <i class="fa-solid fa-person-chalkboard"></i> --}}
            <p>
              blog
              <i class="fas fa-angle-left right"></i>
              {{-- <span class="badge badge-info right">6</span> --}}
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('blog.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Blog</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('blog.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              user
              {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
          </a>
        </li>

        <li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="btn btn-success">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            Logout
          </a>

        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>