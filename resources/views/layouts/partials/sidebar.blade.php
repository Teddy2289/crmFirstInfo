<!-- 663399 -->
<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item" data-item="salaries">
                <a class="nav-item-hold " href="#">
                    <i class="nav-icon i-Windows-2"></i>
                    <span class="nav-text">{{__('Gestion des salariés')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="clients">
                <a class="nav-item-hold " href="#">
                    <i class="nav-icon i-Windows-2"></i>
                    <span class="nav-text">{{__('Gestion des clients / entreprises')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="facture">
                <a class="nav-item-hold " href="#">
                    <i class="nav-icon i-Windows-2"></i>
                    <span class="nav-text">{{__('Facturation')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="dashboard">
                <a class="nav-item-hold " href="#">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">{{__('Tableau de bord')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="sessions">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Gears"></i>
                    <span class="nav-text">{{ __('Accée et securité')}}</span>
                </a>
                <div class="triangle"></div>
            </li>


        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu Dashboards -->

        <ul class="childNav" data-parent="salaries">
            @can('view_employee_list', auth()->user())
            <li class="nav-item">
                <a href="{{ route('gestionEmploye.employe') }}">
                    <i class="nav-icon i-Business-ManWoman"></i>
                    <span class="item-name">{{ __(' Employées') }}</span>
                </a>
            </li>
            @endcan
            @can('view_post_employer', auth()->user())
            <li class="nav-item">
                <a href="{{ route('gestionEmploye.postEmploye') }}">
                    <i class="nav-icon i-Calendar-4"></i>
                    <span class="item-name">{{ __('Post Employer') }}</span>
                </a>
            </li>
            @endcan

            @can('view_type_leave', auth()->user())
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Calendar-4"></i>
                    <span class="item-name">{{ __('Suivi congée') }}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a class="" href="{{ route('gestionEmploye.typeleave') }}">
                            <i class="nav-icon i-Calendar-4"></i>
                            <span class="item-name">{{ __('Type conge') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="" href="{{ route('gestionEmploye.leaveRequest') }}">
                            <i class="nav-icon i-Calendar-4"></i>
                            <span class="item-name">{{ __('Demande conge') }}</span>
                        </a>
                    </li>
                    <!-- Other sub-menu items for users with the 'view_type_leave' permission -->
                </ul>
            </li>
            @endcan
        </ul>


        <ul class="childNav" data-parent="clients">
            @can('view_clients', auth()->user())
            <li class="nav-item">
                <a class="" href="{{ route('esn.client') }}">
                    <i class="nav-icon i-Receipt"></i>
                    <span class="item-name">{{ __('Clients') }}</span>
                </a>
            </li>
            @endcan
            @can('view_company', auth()->user())
            <li class="nav-item">
                <a class="" href="{{ route('esn.company') }}">
                    <i class="nav-icon i-Shop-2"></i>
                    <span class="item-name">{{ __('Entreprise') }}</span>
                </a>
            </li>
            @endcan
            @can('view_technology', auth()->user())
            <li class="nav-item">
                <a href="{{ route('esn.technology') }}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{ __('Technologie') }}</span>
                </a>
            </li>
            @endcan
        </ul>

        <ul class="childNav" data-parent="facture">
            @can('view_invoice_list', auth()->user())
            <li class="nav-item">
                <a href="{{route('facturation.invoice')}}">
                    <i class="nav-icon i-Add-File"></i>
                    <span class="item-name">{{__('facture')}}</span>
                </a>
            </li>
            @endcan
            @can('view_contract', auth()->user())
            <li class="nav-item">
                <a href="{{ route('facturation.contract') }}">
                    <i class="nav-icon i-Calendar-4"></i>
                    <span class="item-name">{{ __('Contrat') }}</span>
                </a>
            </li>
            @endcan
            @can('view_contract', auth()->user())
            <li class="nav-item">
                
                <a href="{{ route('Payement.contract') }}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{ __('Payement') }}</span>
                </a>
            </li>
            @endcan
        </ul>

        <ul class="childNav" data-parent="dashboard">
            <li class="nav-item">
                <a href="{{ route('home') }}">
                    <i class="nav-icon i-Clock-3"></i>
                    <span class="item-name">{{ __('Tableau de bord')}}</span>
                </a>
            </li>
        </ul>

        <ul class="childNav" data-parent="sessions">
        @can('manage_roles', auth()->user())
            <li class="nav-item">
                <a href="{{ route('security.role') }}">
                    <i class="nav-icon i-Key"></i>
                    <span class="item-name">{{ __('Role') }}</span>
                </a>
            </li>
            @endcan
            @can('manage_permissions', auth()->user())
            <li class="nav-item">
                <a href="{{ route('security.permission') }}">
                    <i class="nav-icon i-Key"></i>
                    <span class="item-name">{{ __('Permission') }}</span>
                </a>
            </li>
            @endcan
            @can('manage_users', auth()->user())
            <li class="nav-item">
                <a href="{{ route('security.users') }}">
                    <i class="nav-icon i-Business-Mens"></i>
                    <span class="item-name">{{ __('Utilisateurs') }}</span>
                </a>
            </li>
            @endcan
            @can('manage_countries', auth()->user())
            <li class="nav-item">
                <a href="{{ route('esn.country') }}">
                    <span class="item-name">{{ __('Country') }}</span>
                </a>
            </li>
            @endcan
            <ul>
                <ul class="childNav" data-parent="others">
                    <li class="nav-item">
                        <a href="not.found.html">
                            <i class="nav-icon i-Error-404-Window"></i>
                            <span class="item-name">Not Found</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="user.profile.html">
                            <i class="nav-icon i-Male"></i>
                            <span class="item-name">User Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="blank.html" class="open">
                            <i class="nav-icon i-File-Horizontal"></i>
                            <span class="item-name">Blank Page</span>
                        </a>
                    </li>
                </ul>
            </ul>
    </div>
    <div class="sidebar-overlay"></div>
</div>