
    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
      <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
      <div class="sidebar-content">
        <div class="sidebar-brand">
          <a href="#">Panel de control</a>
          <div id="close-sidebar">
            <i class="fas fa-times"></i>
          </div>
        </div>
        <div class="sidebar-header">
          <div class="user-pic">
            @if (Auth::user()->foto===null)
                <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
                alt="User picture">
                @else
                <img class="img-responsive img-rounded" src={{asset("images/perfil/usuarios/".Auth::user()->foto)}}
                alt="User picture">
            @endif
          </div>
          <div class="user-info">
            <span id="nom" class="user-name">{{ Auth::user()->name }}</span>
            <span id="rol" class="user-role"></span>
            <span class="user-status">
              @if (Auth::user()->actiu===1)
                <i class="fa fa-circle con"></i>
                <span>Conectado</span>
                @else
                    <i class="fa fa-circle nocon"></i>
                    <span>No conectado</span>
              @endif
            </span>
          </div>
        </div>
        <!-- sidebar-search  -->
        <div class="sidebar-menu">
          <ul>
            <li>
                <a href={{url('/')}}><i class="fa fa-home"></i> Home
                </a>
              </li>
            <li class="header-menu">
              <span>General</span>
            </li>
            <li class="sidebar-dropdown" id="dashboard">
                <a href="#" id="page_nav_dashboard">
                    <i class="fa fa-chart-line"></i>
                    <span>Dashboard</span>
                  </a>
                  <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href={{url('/back/admin/dashboard')}} id="dash">Dashboard
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="sidebar-dropdown" id="usuario">
              <a href="#" id="page_nav_usuario">
                <i class="fa fa-user"></i>
                <span>Usuarios</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href={{url('/back/admin/u/adminify')}} id="adminify">Hacer admin
                    </a>
                  </li>
                  <li>
                    <a href={{url('/back/admin/u/notify')}} id="notificacion">Notificación</a>
                  </li>
                  <li>
                    <a href={{url('/back/admin/u/block')}} id="bloquear">Bloquear</a>
                  </li>
                  <li>
                    <a href={{url('/back/admin/u/notifyList')}} id="lista">Lista de avisos</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="sidebar-dropdown" id="tipoUser">
              <a href="#" id="page_nav_typeUser">
                <i class="fa fa-users"></i>
                <span>Tipo usuario</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href={{url('/back/admin/tipususer')}} id="crud">Crear tipos de usuario
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="sidebar-dropdown" id="contenido">
                <a href="#" id="page_nav_content">
                  <i class="fa fa-users"></i>
                  <span>Contenido</span>
                </a>
                <div class="sidebar-submenu">
                  <ul>
                    <li>
                      <a href={{url('/back/admin/adultify')}} id="adultify">+18
                      </a>
                    </li>
                    <li>
                        <a href={{url('/back/admin/tipocontent')}} id="typeContent">Tipo contenido
                        </a>
                    </li>
                    <li>
                        <a href={{url('/back/admin/rights')}} id="rights">Derechos de autor
                        </a>
                    </li>
                    @if (Auth::user()->tipus===3)
                        <li>
                            <a href={{url('/back/admin/contenido')}} id="contSup">Eliminar contenido
                            </a>
                        </li>
                    @endif
                  </ul>
                </div>
            </li>
            <li class="sidebar-dropdown" id="tags">
                <a href="#" id="page_nav_tags">
                  <i class="fa fa-users"></i>
                  <span>Tags</span>
                </a>
                <div class="sidebar-submenu">
                  <ul>
                    <li>
                      <a href={{url('/back/admin/tags')}} id="tag">Controlar tags
                      </a>
                    </li>
                  </ul>
                </div>
            </li>

        </div>
        <!-- sidebar-menu  -->
      </div>
      <!-- sidebar-content  -->
      <div class="sidebar-footer">
        <a href={{ url('/logout') }}>
          <i class="fa fa-power-off"></i>
        </a>
      </div>
    </nav>

