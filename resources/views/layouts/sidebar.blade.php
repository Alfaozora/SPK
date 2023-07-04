<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"><a href="{{route ('profil.index')}}">{{ Auth::user()->name }}</div></a>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>

    <ul class="nav menu">
        <li class="{{ request()->is('/') ? 'active' : '' }}">
            <a href="{{ route('home') }}">
                <em class="fa fa-home">&nbsp;</em>
                Dashboard
            </a>
        </li>
        <li class="{{ request()->is('kriteria*') ? 'active' : '' }}"><a href="{{route ('kriteria.index') }}"><em class="fa fa-cubes">&nbsp;</em> Kriteria</a></li>
        <li class="{{ request()->is('alternatif*') ? 'active' : '' }}"><a href="{{route ('alternatif.index') }}"><em class="fa fa-user-o">&nbsp;</em> Alternatif</a></li>
        <li class="parent">
            <a href="#sub-item-3" data-toggle="collapse" aria-expanded="false">
                <em class="fa fa-navicon ">&nbsp;</em>
                Nilai Bobot
                <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right">
                    <em class="fa fa-plus"></em>
                </span>
            </a>
            <ul class="children collapse" id="sub-item-3">
                <li>
                    <a class="{{ request()->is('nilaiIntensitas*') ? 'active' : '' }}" href="{{ route('nilaiIntensitas.index') }}">
                        <span class="fa fa-file-text-o">&nbsp;</span>
                        Nilai Intensitas
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('crips*') ? 'active' : '' }}" href="{{ route('crips.index') }}">
                        <span class="fa fa-user-o">&nbsp;</span>
                        Nilai Bobot Kriteria
                    </a>
                </li>
                <li>
                    <a class="" href="">
                        <span class="fa fa-book">&nbsp;</span>
                        Nilai Bobot Alternatif
                    </a>
                </li>
            </ul>
        </li>
        <li class="{{ request()->is('perhitungan*') ? 'active' : '' }}"><a href="{{route ('perhitungan.index') }}"><em class="fa fa-calculator">&nbsp;</em> Perhitungan</a></li>
        <li class="{{ request()->is('hasil*') ? 'active' : '' }}"><a href="{{route ('hasil') }}"><em class="fa fa-file-text-o">&nbsp;</em> Hasil</a></li>
        @if (Auth::user()->role != 1)
        @else
        <li class="{{ request()->is('register*') ? 'active' : '' }}"><a href="{{route ('register.index')}}"><em class="fa fa-address-book" aria-hidden="true">&nbsp;</em> Menu User</a></li>
        @endif
        <li><a href="/login/logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
</div><!--/.sidebar-->