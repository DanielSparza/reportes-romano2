<nav class="navbar navbar-expand-lg  fixed-top">
  <!--navbar-dark bg-dark -->
  <div class="container">

    @auth
      @if (auth()->user()->fk_rol != 4)
      <div class="icon_menu">
        <label for="btn-menu"><i class="fa-solid fa-arrow-right-arrow-left"></i></label>
      </div>
      @endif
    @endauth

    <a class="navbar-brand" href="/"> <img src="{!! asset('img/logo.png') !!}" class="navbar-logo" alt="Logo de la empresa">
      <strong>El Romano @auth @if (auth()->user()->fk_rol != 4) STAFF @endif @endauth</strong>
    </a>

    <!--Usar "if" para que solo se vea si hay un usuario con sesion activa -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <!-- <span class="navbar-toggler-icon"></span> -->
      <i class="fa-solid fa-bars icon_menu_bars"></i>
    </button>
    <!--finaliza "if" -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">

        @guest
        <li class="nav-menu-item">
          <a href="/mi-cuenta" class="nav-menu-link btn btn-header">
            <i class="fa-solid fa-user mr-2" title="Mi Cuenta"></i> Mi Cuenta
          </a>
        </li>
        @endguest
        @auth
        <li>
          <a class="nav-link" id="etiqueta_usuario">Usuario: {{auth()->user()->usuario}}</a>
        </li>
        @if (auth()->user()->fk_rol == 4)
        <li class="nav-menu-item mr-2">
          <a href="/mi-cuenta" class="nav-menu-link btn btn-header">
            <i class="fa-solid fa-user mr-2" title="Mi Cuenta"></i> Mi Cuenta
          </a>
        </li>
        @endif
        <li class="nav-item">
          <a href="/logout" class="nav-menu-link btn btn-header">
            <i class="fa-solid fa-right-from-bracket mr-2"></i>Cerrar sesión
          </a>
        </li>
        @endauth
      </ul>
    </div>

  </div>
  <input type="checkbox" hidden id="btn-menu">
</nav>