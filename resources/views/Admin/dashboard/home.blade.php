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
                <li class="breadcrumb-item"><a href="#">{{__('Dashboard')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('Dashboard')}}</li>
            </ol>
        </nav>

        <div class="row">
            <div class=" col-md-6">
                <div class="card mb-4">
                    <div class="card-body"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; inset: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                        <div class="card-title">Utilisateur inscrit par mois</div>
                        <canvas id="userChart" style="display: block; width: 444px; height: 222px;" width="444" height="222"></canvas>
                    </div>
                </div>
            </div>
            <div class=" col-md-6">

            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        var ctx = document.getElementById('userChart').getContext('2d');
        var data = @json($monthlyUsers);

        var months = [];
        var counts = [];

        var monthNames = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        data.forEach(item => {
            months.push(monthNames[item.month - 1]); // Convert month number to name
            counts.push(item.count);
        });

        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Users per Month',
                    data: counts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    </script>
    @endpush
</x-crm-layout>