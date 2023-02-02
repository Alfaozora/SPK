<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">Username</div>
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
        <li class="{{ request()->is('kriteria*' && 'crips*') ? 'active' : '' }}, parent">
            <a href="#sub-item-1" data-toggle="collapse" aria-expanded="false">
                <em class="fa fa-navicon ">&nbsp;</em>
                Kriteria
                <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right">
                    <em class="fa fa-plus"></em>
                </span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li>
                    <a class="{{ request()->is('kriteria*') ? 'active' : '' }}" href="{{route ('kriteria.index') }}">
                        <span class="fa fa-cubes">&nbsp;</span>
                        Kriteria
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('crips*') ? 'active' : '' }}" href="{{route ('crips.index') }}">
                        <span class="fa fa-book">&nbsp;</span>
                        Nilai Kriteria
                    </a>
                </li>
            </ul>
        </li>
        <li class="parent">
            <a href="#sub-item-2" data-toggle="collapse" aria-expanded="false">
                <em class="fa fa-navicon ">&nbsp;</em>
                Alternatif
                <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right">
                    <em class="fa fa-plus"></em>
                </span>
            </a>
            <ul class="children collapse" id="sub-item-2">
                <li>
                    <a class="" href="">
                        <span class="fa fa-user-o">&nbsp;</span>
                        Alternatif
                    </a>
                </li>
                <li>
                    <a class="" href="">
                        <span class="fa fa-book">&nbsp;</span>
                        Nilai Alternatif
                    </a>
                </li>
            </ul>
        </li>
        <li class=""><a href="index.html"><em class="fa fa-calculator">&nbsp;</em> Hasil</a></li>
        <li><a href="login.html"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
</div><!--/.sidebar-->