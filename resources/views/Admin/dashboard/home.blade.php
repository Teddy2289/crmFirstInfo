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
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-title">Utilisateur inscrit par mois</div>
                        <canvas id="userChart" style="display: block; width: 444px; height: 222px;" width="444" height="222"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-title">Clients inscrit par mois</div>
                        <canvas id="clientChart" style="display: block; width: 444px; height: 222px;" width="444" height="222"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
       @push('scripts')
    <script>
        // Chart.js configuration for the bar chart
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
                    backgroundColor: '#7569b3',
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
   <script>
        // Chart.js configuration for the bar chart
        var ctx = document.getElementById('clientChart').getContext('2d');
        var data = @json($monthlyClients);

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
                    label: 'Clients per Month',
                    data: counts,
                    backgroundColor: '#7569b3',
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
