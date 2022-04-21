<div class="sidebar" data-color="orange">
    <div class="logo">
        <a href="{{ route('admin.dashboard') }}" class="simple-text logo-mini">
            GTV
        </a>
        <a href="{{ route('admin.dashboard') }}" class="simple-text logo-normal">
            {{ config('app.name') }}
        </a>
        <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-simple btn-icon btn-neutral btn-round">
                <i class="now-ui-icons text_align-center visible-on-sidebar-regular"></i>
                <i class="now-ui-icons design_bullet-list-67 visible-on-sidebar-mini"></i>
            </button>
        </div>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{ auth()->user()->profile ? Storage::url(auth()->user()->profile) : asset('/admin/img/default-avatar.png' ) }}" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#profile" class="collapsed">
                <span>
                    {{ auth()->user()->login }} <br>
                    @if (auth()->user()->roles->first()->name == 'Super Administrador')
                        {{ auth()->user()->roles->find(2)->name  }}
                    @else
                        <small>{{ auth()->user()->roles->first()->name  }} </small>
                    @endif
                <b class="caret"></b>
                </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="profile">
                    <ul class="nav">
                        <li>
                            <a href="{{ route('admin.users.show', auth()->user()->id) }}">
                                <span class="sidebar-mini-icon">P</span>
                                <span class="sidebar-normal">Mi perfil</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.edit', auth()->user()->id) }}">
                                <span class="sidebar-mini-icon">EP</span>
                                <span class="sidebar-normal">Editar Perfil</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="{{ request()->is('admin/home') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="now-ui-icons design_app"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @if(Auth::User()->hasAnyDirectPermission(['Crear roles', 'Editar roles']) || Auth::User()->hasRole('Administrador') || Auth::User()->hasRole('Super Administrador'))
            <li class="{{ request()->is('admin/roles*') ? 'active' : '' }}">
                <a data-toggle="collapse" href="#roles">
                    <i class="fa fa-cog"></i>
                    <p>Roles
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="roles">
                    <ul class="nav">
                        <li class="{{ request()->is('admin/roles') ? 'active' : '' }}">
                            <a href="{{ route('admin.roles.index') }}">
                                <span class="sidebar-normal"><i class="fa fa-list"></i></span>
                                <span class="sidebar-normal">Lista de roles</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            @if(Auth::User()->hasAnyDirectPermission(['Ver usuarios', 'Crear usuarios', 'Editar usuarios']) || Auth::User()->hasRole('Administrador') || Auth::User()->hasRole('Super Administrador'))
            <li class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                <a data-toggle="collapse" href="#users">
                    <i class="fa fa-user"></i>
                    <p>Usuarios
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="users">
                    <ul class="nav">
                        <li class="{{ request()->is('admin/users') ? 'active' : '' }}">
                            <a href="{{ route('admin.users.index') }}">
                                <span class="sidebar-normal"><i class="fa fa-list"></i></span>
                                <span class="sidebar-normal">Lista de usuarios</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/users/create') ? 'active' : '' }}">
                            <a href="{{ route('admin.users.create') }}">
                                <span class="sidebar-normal"><i class="fa fa-plus"></i></span>
                                <span class="sidebar-normal">Nuevo usuario</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            <li class="{{ request()->is('admin/places*') ? 'active' : '' }}">
                <a data-toggle="collapse" href="#places">
                    <i class="now-ui-icons location_world"></i>
                    <p>Lugares
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="places">
                    <ul class="nav">
                        <li class="{{ request()->is('admin/places') ? 'active' : '' }}">
                            <a href="{{ route('admin.places.index') }}">
                                <span class="sidebar-normal"><i class="fa fa-list"></i></span>
                                <span class="sidebar-normal">Lista de lugares</span>
                            </a>
                        </li>
                        <li>
                            @if(request()->is('admin/places/*'))
                            <a href="{{ route('admin.places.index', '#place') }}">
                                <span class="sidebar-normal"><i class="fa fa-plus"></i></span>
                                <span class="sidebar-normal">Nuevo lugar</span>
                            </a>
                            @else
                                <a href="#" data-toggle="modal" data-target="#createPlaces">
                                    <span class="sidebar-normal"><i class="fa fa-plus"></i></span>
                                    <span class="sidebar-normal">Nuevo lugar</span>
                                </a>
                            @endif
                        </li>

                    </ul>
                </div>
            </li>
            <li class="{{ request()->is('admin/photographies*') ? 'active' : '' }}">
                <a data-toggle="collapse" href="#photographies">
                    <i class="fa fa-camera"></i>
                    <p>Fotografías
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="photographies">
                    <ul class="nav">
                        <li class="{{ request()->is('admin/photographies') ? 'active' : '' }}">
                            <a href="{{ route('admin.photographies.index') }}">
                                <span class="sidebar-normal"><i class="fa fa-list"></i></span>
                                <span class="sidebar-normal">Lista de fotografías</span>
                            </a>
                        </li>
                        <li>
                            @if(request()->is('admin/photographies/*'))
                            <a href="{{ route('admin.photographies.index', '#photography') }}">
                                <span class="sidebar-normal"><i class="fa fa-plus"></i></span>
                                <span class="sidebar-normal">Nueva fotografía</span>
                            </a>
                            @else
                                <a href="#" data-toggle="modal" data-target="#createPhotographies">
                                    <span class="sidebar-normal"><i class="fa fa-plus"></i></span>
                                    <span class="sidebar-normal">Nueva fotografía</span>
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </li>
            <li class="{{ request()->is('admin/pointsofinterest*') ? 'active' : '' }}">
                <a data-toggle="collapse" href="#pointsofinterest">
                    <i class="now-ui-icons location_pin"></i>
                    <p>Puntos de interés
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="pointsofinterest">
                    <ul class="nav">
                        <li class="{{ request()->is('admin/pointsofinterest') ? 'active' : '' }}">
                            <a href="{{ route('admin.pointsofinterest.index') }}">
                                <span class="sidebar-normal"><i class="fa fa-list"></i></span>
                                <span class="sidebar-normal">Lista de puntos de interés</span>
                            </a>
                        </li>
                        <li>
                            @if(request()->is('admin/pointsofinterest/*'))
                                <a href="{{ route('admin.pointsofinterest.index', '#point') }}">
                                    <span class="sidebar-normal"><i class="fa fa-plus"></i></span>
                                    <span class="sidebar-normal">Nuevo punto de interés</span>
                                </a>
                            @else
                                <a href="#" data-toggle="modal" data-target="#createPointsofinterest">
                                    <span class="sidebar-normal"><i class="fa fa-plus"></i></span>
                                    <span class="sidebar-normal">Nuevo punto de interés</span>
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </li>
            <li class="{{ request()->is('admin/visits*') ? 'active' : '' }}">
                <a data-toggle="collapse" href="#visits">
                    <i class="fa fa-images"></i>
                    <p>Visitas
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="visits">
                    <ul class="nav">
                        <li class="{{ request()->is('admin/visits') ? 'active' : '' }}">
                            <a href="{{ route('admin.visits.index') }}">
                                <span class="sidebar-normal"><i class="fa fa-list"></i></span>
                                <span class="sidebar-normal">Lista de visitas</span>
                            </a>
                        </li>
                        <li>
                            @if(request()->is('admin/visits/*'))
                            <a href="{{ route('admin.visits.index', '#visit') }}">
                                <span class="sidebar-normal"><i class="fa fa-plus"></i></span>
                                <span class="sidebar-normal">Nueva visita</span>
                            </a>
                            @else
                                <a href="#" data-toggle="modal" data-target="#createVisits">
                                    <span class="sidebar-normal"><i class="fa fa-plus"></i></span>
                                    <span class="sidebar-normal">Nueva visita</span>
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </li>
            <li class="{{ request()->is('admin/thematicareas*') ? 'active' : '' }}">
                <a data-toggle="collapse" href="#thematicareas">
                    <i class="now-ui-icons design_palette"></i>
                    <p>Áreas temáticas
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="thematicareas">
                    <ul class="nav">
                        <li class="{{ request()->is('admin/thematicareas') ? 'active' : '' }}">
                            <a href="{{ route('admin.thematicareas.index') }}">
                                <span class="sidebar-normal"><i class="fa fa-list"></i></span>
                                <span class="sidebar-normal">Lista de áreas temáticas</span>
                            </a>
                        </li>
                        <li>
                            @if(request()->is('admin/thematicareas/*'))
                            <a href="{{ route('admin.thematicareas.index', '#thematicArea') }}">
                                <span class="sidebar-normal"><i class="fa fa-plus"></i></span>
                                <span class="sidebar-normal">Nueva área temática</span>
                            </a>
                            @else
                                <a href="#" data-toggle="modal" data-target="#createThematicsAreas">
                                    <span class="sidebar-normal"><i class="fa fa-plus"></i></span>
                                    <span class="sidebar-normal">Nueva área temática</span>
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </li>
            <li class="{{ request()->is('admin/videos*') ? 'active' : '' }}">
                <a data-toggle="collapse" href="#videos">
                    <i class="fa fa-video"></i>
                    <p>Videos
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="videos">
                    <ul class="nav">
                        <li class="{{ request()->is('admin/videos') ? 'active' : '' }}">
                            <a href="{{ route('admin.videos.index') }}">
                                <span class="sidebar-normal"><i class="fa fa-list"></i></span>
                                <span class="sidebar-normal">Lista de videos</span>
                            </a>
                        </li>
                        <li>
                            @if(request()->is('admin/videos/*'))
                                <a href="{{ route('admin.videos.index', '#video') }}">
                                    <span class="sidebar-normal"><i class="fa fa-plus"></i></span>
                                    <span class="sidebar-normal">Nuevo video</span>
                                </a>
                            @else
                                <a href="#" data-toggle="modal" data-target="#createVideos">
                                    <span class="sidebar-normal"><i class="fa fa-plus"></i></span>
                                    <span class="sidebar-normal">Nuevo video</span>
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
