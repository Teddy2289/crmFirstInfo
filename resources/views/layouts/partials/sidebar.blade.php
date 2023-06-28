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
					<span class="nav-text">{{__('Gestion des ESN')}}</span>
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
			<li class="nav-item">
				<a href="">
					<i class="nav-icon i-Business-ManWoman"></i>
					<span class="item-name">{{__('Liste Employées')}}</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="">
					<i class="nav-icon i-Calendar-4"></i>
					<span class="item-name">{{__('Suivi congée')}}</span>
				</a>
			</li>
			<!-- <li class="nav-item">
				<a href="">
					<i class="nav-icon i-File-Horizontal"></i>
					<span class="item-name">{{__('Documment Administratif')}}</span>
				</a>
			</li> -->
		</ul>


		<ul class="childNav" data-parent="clients">
			<li class="nav-item dropdown-sidemenu">
				<a>
					<i class="nav-icon i-Checked-User"></i>
					<span class="item-name">{{__('Gestion clients')}}</span>
					<i class="dd-arrow i-Arrow-Down"></i>
				</a>
				<ul class="submenu">
					<li>
						<a class="" href="http://gull-html-laravel.ui-lib.com/apps/task-manager">
							<i class="nav-icon i-Receipt"></i>
							<span class="item-name">{{__('Liste clients')}}</span>
						</a>
					</li>
					<li></li>
				</ul>
			</li>
			<li class="nav-item dropdown-sidemenu">
				<a>
					<i class="nav-icon i-Shop-2"></i>
					<span class="item-name">{{__('Entreprises prestataires')}}</span>
					<i class="dd-arrow i-Arrow-Down"></i>
				</a>
				<ul class="submenu">
					<li>
						<a class="" href="http://gull-html-laravel.ui-lib.com/apps/task-manager">
							<i class="nav-icon i-Receipt-4"></i>
							<span class="item-name">{{__('Liste entreprise')}}</span>
						</a>
					</li>
					<li></li>
				</ul>
			</li>

			<li class="nav-item">
				<a href="">
					<i class="nav-icon i-Receipt-4"></i>
					<span class="item-name">{{__('Liste techno')}}</span>
				</a>
			</li>
		</ul>

		<ul class="childNav" data-parent="facture">
			<li class="nav-item">
				<a href="">
					<i class="nav-icon i-Add-File"></i>
					<span class="item-name">{{__('Liste facture')}}</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="">
					<i class="nav-icon i-Calendar-4"></i>
					<span class="item-name">{{__('Suivi payement')}}</span>
				</a>
			</li>

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
			<li class="nav-item">
				<a href="{{ route('security.role')}}">
					<i class="nav-icon i-Key"></i>
					<span class="item-name">Role et permissions</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{ route('security.users')}}">
					<i class="nav-icon i-Business-Mens"></i>
					<span class="item-name">Utilisateurs</span>
				</a>
			</li>
		</ul>

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
	</div>
	<div class="sidebar-overlay"></div>
</div>