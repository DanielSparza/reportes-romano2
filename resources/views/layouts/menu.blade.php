<div class="fondo-menu" id="fondo-menu">
    <aside id="menu-lateral" class="desplegar">
        <div class="container-menu container-border">
            @if (auth()->user()->fk_rol == 1) 
            <h3>Administrador</h3>
            @elseif (auth()->user()->fk_rol == 2)
            <h3>Atención al cliente</h3>
            @elseif (auth()->user()->fk_rol == 3)
            <h3>Soporte técnico</h3>
            @endif
        </div>
        <div class="container-menu">
            @if (auth()->user()->fk_rol == 1 || auth()->user()->fk_rol == 2) 
            <div>
                <a href="/levantar-reportes">
                    <i class="fa-solid fa-pen-to-square fa-lg" title="Levantar reportes"></i>
                    <span>Levantar reportes</span>
                </a>
            </div>
            <div>
                <a href="/historial-reportes">
                    <i class="fa-solid fa-list fa-lg" title="Historial reportes"></i>
                    <span>Historial reportes</span>
                </a>
            </div>
            @endif
            @if (auth()->user()->fk_rol == 1 || auth()->user()->fk_rol == 3)
            <div>
                <a href="/reportes-pendientes">
                    <i class="fa-solid fa-list-ul fa-lg" title="Reportes pendientes"></i>
                    <span>Reportes pendientes</span>
                </a>
            </div>
            <div>
                <a href="/mis-reportes">
                    <i class="fa-solid fa-list-check fa-lg" title="Mis reportes"></i>
                    <span>Mis reportes</span>
                </a>
            </div>
            @endif
            @if (auth()->user()->fk_rol == 1)
            <div>
                <a href="/administrar-pagina-web">
                    <i class="fa-solid fa-globe fa-lg" title="Administrar página web"></i>
                    <span>Administrar p. web</span>
                </a>
            </div>
            <div>
                <a href="/administrar-usuarios">
                    <i class="fa-solid fa-users fa-lg" title="Administrar usuarios"></i>
                    <span>Administrar usuarios</span>
                </a>
            </div>
            @if (auth()->user()->fk_rol == 1 || auth()->user()->fk_rol == 2)
            <div>
                <a href="/administrar-clientes">
                    <i class="fa-solid fa-user-tag fa-lg" title="Administrar clientes"></i>
                    <span>Administrar clientes</span>
                </a>
            </div>
            @endif
            <div>
                <a href="/administrar-comunidades">
                    <i class="fa-solid fa-signs-post fa-lg" title="Administrar comunidades"></i>
                    <span>Administrar comunidades</span>
                </a>
            </div>
            <div>
                <a href="/estadisticas">
                    <i class="fa-solid fa-chart-column fa-lg" title="Estadisticas"></i>
                    <span>Estadísticas</span>
                </a>
            </div>
            @endif
        </div>
        <div class="menu-list"></div>
    </aside>
</div>