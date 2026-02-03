  <nav class="main-header navbar navbar-expand navbar-light">

      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="text nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>

      </ul>

      <ul class="navbar-nav ml-auto">

          <!-- <li class="nav-item">
              <a class="text nav-link" data-widget="navbar-search" href="#" role="button">
                  <i class="fas fa-search"></i>
              </a>
              <div class="navbar-search-block">
                  <form class="form-inline">
                      <div class="input-group input-group-sm">
                          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                          <div class="input-group-append">
                              <button class="btn btn-navbar" type="submit">
                                  <i class="fas fa-search"></i>
                              </button>
                              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                  <i class="fas fa-times"></i>
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </li> -->

          <li class="nav-item dropdown">
              <a id="chatDropdown" class="nav-link " data-toggle="dropdown" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                  <i class="far fa-comments"></i>
                  <span id="msg-quantity" class="badge badge-danger navbar-badge">3</span>
              </a>
              <div aria-labelledby="chatDropdown" class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                  <section id="msgContainer">

                  </section>
                  <div class="dropdown-divider"></div>
                  <a href="/admin/chat" class="dropdown-item dropdown-footer">See All Messages</a>
              </div>
          </li>

          <li class="nav-item">
              <a class="text nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
              </a>
          </li>
      </ul>
  </nav>

  <script defer>
      $(document).ready(() => {
          selectData('msg.id,msg.created_at,chat.id AS chatId,customers.name AS author,msg.text',
              'msg INNER JOIN chat ON chat.id = msg.chatId INNER JOIN customers ON customers.id = chat.customerId',
              'WHERE chat.readed = 0 AND msg.from_admin = 0 ORDER BY msg.created_at DESC ',
              (res) => {
                  if (res.data.length <= 0) {
                      $('#msg-quantity').hide()
                      return
                  }
                  $('#msg-quantity').html(res.data.length)
                  res.data.forEach(msg => {
                      console.log(msg)
                      $('#msgContainer').html($('#msgContainer').html() + getMessageNotification(msg, true))
                  });

              })
      })
  </script>