<x-crm-layout>
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="breadcrumb">
            <h1>Table</h1>
            <ul>
                <li><a href="">Componets</a></li>
                <li>Table</li>
            </ul>
        </div>

        <div class="separator-breadcrumb border-top"></div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">{{__('Payement')}}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{__('Liste Payement')}}</li>
            </ol>
          </nav>
          @livewire('payement')
</div>
</x-crm-layout>