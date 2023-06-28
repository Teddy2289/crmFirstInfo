<x-crm-layout>
<div class="main-content-wrap sidenav-open d-flex flex-column">
    <div class="breadcrumb">
        <h1 class="mr-2">Version 1</h1>
        <ul>
            <li><a href="">Dashboard</a></li>
            <li>Version 1</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <!-- ICON BG -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Globe"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">{{ __('Utilisateurs') }}</p>
                        <p class="text-primary text-24 line-height-1 mb-2">20</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Home1"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">{{ __('Clients')}}</p>
                        <p class="text-primary text-24 line-height-1 mb-2">150</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
</x-crm-layout>