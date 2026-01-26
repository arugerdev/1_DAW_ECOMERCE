  <aside class="flex-column main-sidebar sidebar-light-secondary bg-white elevation-1">
      <a href="/admin/" class="brand-link bg-lightblue">
          <img src="/assets/img/evimerce_logo.png" alt="EviMerce" class="brand-image " style="opacity: 1" width="128" height="128">
          <span class="brand-text font-weight-light text-white">EviMerce</span>
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
                          <div class="search-title"><strong class="text-dark"></strong>N<strong class="text-dark"></strong>o<strong class="text-dark"></strong> <strong class="text-dark"></strong>e<strong class="text-dark"></strong>l<strong class="text-dark"></strong>e<strong class="text-dark"></strong>m<strong class="text-dark"></strong>e<strong class="text-dark"></strong>n<strong class="text-dark"></strong>t<strong class="text-dark"></strong> <strong class="text-dark"></strong>f<strong class="text-dark"></strong>o<strong class="text-dark"></strong>u<strong class="text-dark"></strong>n<strong class="text-dark"></strong>d<strong class="text-dark"></strong>!<strong class="text-dark"></strong></div>
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
                  <li class="nav-item">
                      <a href="/admin/refounds" class="nav-link">
                          <i class="fa-solid fa-arrow-rotate-left nav-icon"></i>
                          <p>Devoluciones</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="/admin/categories" class="nav-link">
                          <i class="fa-solid fa-icons nav-icon"></i>
                          <p>Categorias</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="/admin/users" class="nav-link">
                          <i class="fa-solid fa-users nav-icon"></i>
                          <p>Usuarios</p>
                      </a>
                  </li>
              </ul>
          </nav>
          <nav class="mt-2">
              <div class="separator"></div>
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-item">
                      <a href=" /admin/orders" class="disconnect-button nav-link danger btn-danger text-danger ">
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