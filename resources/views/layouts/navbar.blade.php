<style>
    #div-notifications::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    #div-notifications::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 10px;
    }

    /* Handle */
    #div-notifications::-webkit-scrollbar-thumb {
        background: #9ca19d;
        border-radius: 10px;
    }

    /* Handle on hover */
    #div-notifications::-webkit-scrollbar-thumb:hover {
        background: #797d7a;
    }

</style>
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">
        <ul class="navbar-item flex-row">
            <li class="nav-item theme-logo">
                <a href="javascript:void">
                    <img src="{{ asset('logo/logo.png') }}" class="navbar-logo" alt="logo">
                </a>
            </li>
        </ul>
        
        <a href="javascript:void(0);" class="sidebarCollapseCust" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg></a>
        
        <ul class="navbar-item flex-row navbar-dropdown ml-auto">
            <li class="nav-item dropdown notification-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                    @if (count($notif_data) > 0)
                    <span class="badge badge-success"></span>
                    @endif
                </a>
                <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="notificationDropdown" style="overflow-y: auto;max-height: 360px;min-width: 19rem" id="div-notifications">
                    <div class="notification-scroll">
                        @forelse($notif_data as $n)
                        <div class="dropdown-item">
                            <div class="media server-log">
                                @if ($n->status_id == 1 || $n->status_id == 3)
                                <a href="{{ route('operasional.collection.show', $n->id) }}">
                                @elseif($n->status_id == 7 || $n->status_id == 8)
                                <a href="{{ route('v_detail', $n->id) }}">
                                @elseif($n->status_id == 2 || $n->status_id == 12)
                                <a href="{{route('collection.aplikasi.edit', $n->id)}}">
                                @elseif($n->status_id == 6 && $n->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                                <a href="{{route('operasional.collection.edit', $n->id)}}">
                                @elseif($n->status_id == 17 || $n->status_id == 18)
                                <a href="{{route('collection.aplikasi.custom_detail', $n->id)}}">
                                @endif
                                    <div class="media-body">
                                        <div class="data-info">
                                            <h6 class="">{{ \Helper::cutString($n->nama_calon_debitur) }}</h6>
                                            <p class="">
                                                {{ \Helper::cutString($n->nama_developer, 15) . '-' . \Helper::cutString($n->nama_project, 9) }}
                                            </p>
                                            {!! \Helper::badgeStatus($n->status_id) !!}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="dropdown-item">
                            <div class="media server-log">
                                <div class="media-body">
                                    Tidak ada notif terbaru
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('assets/img/user.png') }}" alt="admin-profile" class="img-fluid">
                </a>
                <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="userProfileDropdown">
                    <div class="user-profile-section">
                        <div class="media mx-auto">
                            <img src="{{ asset('assets/img/user.png') }}" class="img-fluid mr-2" alt="avatar">
                            <div class="media-body">
                                <h5>{{ \Auth::user()->name }}</h5>
                                <p>{{ ucfirst(\Auth::user()->getRoleNames()->first()) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <a href="{{ url('profile/' . \Auth::user()->id . '/' . \Auth::user()->username) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"> <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path> <circle cx="12" cy="7" r="4"></circle>
                            </svg> <span>Profile</span>
                        </a>
                    </div>
                    <div class="dropdown-item">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"> <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path> <polyline points="16 17 21 12 16 7"></polyline> <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg> <span>Log Out</span>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </header>
</div>
