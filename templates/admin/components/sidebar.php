  <!-- Main Sidebar Container -->
  <aside class="flex-column main-sidebar sidebar-light-secondary elevation-4">
      <a href="/admin/" class="brand-link bg-warning ">
          <img src="/assets/img/logo.png" alt="EviMerce" class="brand-image " style="opacity: 1" width="128" height="128">
          <span class="brand-text font-weight-light">EviMerce</span>
      </a>

      <div class="sidebar width-full mt-2">
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
              <div class="sidebar-search-results">
                  <div class="list-group"><a href="#" class="list-group-item">
                          <div class="search-title"><strong class="text-light"></strong>N<strong class="text-light"></strong>o<strong class="text-light"></strong> <strong class="text-light"></strong>e<strong class="text-light"></strong>l<strong class="text-light"></strong>e<strong class="text-light"></strong>m<strong class="text-light"></strong>e<strong class="text-light"></strong>n<strong class="text-light"></strong>t<strong class="text-light"></strong> <strong class="text-light"></strong>f<strong class="text-light"></strong>o<strong class="text-light"></strong>u<strong class="text-light"></strong>n<strong class="text-light"></strong>d<strong class="text-light"></strong>!<strong class="text-light"></strong></div>
                          <div class="search-path"></div>
                      </a></div>
              </div>
          </div>

          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                  <li class="nav-item">
                      <a href="/admin/" class="nav-link">
                          <i class="fa-solid fa-gauge nav-icon"></i>
                          <p>Inicio</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="/" class="nav-link">
                          <i class="fa-solid fa-eye nav-icon"></i>
                          <p>Vista Previa</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="/admin/products" class="nav-link">
                          <i class="fa-solid fa-boxes-stacked nav-icon"></i>
                          <p>Productos</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="/admin/orders" class="nav-link">
                          <i class="fa-solid fa-cart-flatbed nav-icon"></i>
                          <p>Pedidos</p>
                      </a>
                  </li>
              </ul>
          </nav>
          <nav class="mt-2">
            <div class="separator"></div>
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-item" >
                      <a href=" /admin/orders" class="disconnect-button nav-link danger btn-danger color-danger text-danger" >
                          <i class=" fa-solid fa-right-from-bracket nav-icon"></i>
                      <p>Desconectar</p>
                      </a>
                  </li>

              </ul>
          </nav>
      </div>
  </aside>

  <script defer>
    $('.disconnect-button').on('click', () => {
        clearSession();
    })
  </script>

