<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Barra lateral - Marca -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('user')}}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Usuario</div>
    </a>

    <!-- Separador -->
    <hr class="sidebar-divider my-0">

    <!-- Elemento de navegación - Tablero -->
    <li class="nav-item active">
      <a class="nav-link" href="{{route('user')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Tablero</span></a>
    </li>

    <!-- Separador -->
    <hr class="sidebar-divider">

    <!-- Encabezado -->
    <div class="sidebar-heading">
        Tienda
    </div>

    <!-- Órdenes -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('user.order.index')}}">
            <i class="fas fa-hammer fa-chart-area"></i>
            <span>Órdenes</span>
        </a>
    </li>

    <!-- Reseñas -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('user.productreview.index')}}">
            <i class="fas fa-comments"></i>
            <span>Reseñas</span></a>
    </li>

    <!-- Separador -->
    <hr class="sidebar-divider">

    <!-- Encabezado -->
    <div class="sidebar-heading">
      Publicaciones
    </div>

    <!-- Comentarios -->
    <li class="nav-item">
      <a class="nav-link" href="{{route('user.post-comment.index')}}">
          <i class="fas fa-comments fa-chart-area"></i>
          <span>Comentarios</span>
      </a>
    </li>

    <!-- Botón para mostrar/ocultar la barra lateral (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
