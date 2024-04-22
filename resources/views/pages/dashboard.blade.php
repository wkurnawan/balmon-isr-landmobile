@extends('layouts.app', ['title' => 'Dashboard'])

@push('style')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
@endpush

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Grafik - ISR</h6>
                <div class="px-4" style="position: relative; margin:auto; height:40vh;">
                    <canvas id="dashboardChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-4 px-4">
        <div class="col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <table class="table table-borderless fw-bold">
                    <tbody>
                        <tr class="bg-primary">
                            <td class="text-white">KAB/KOTA</td>
                            <td class="text-white text-center">TOTAL</td>
                        </tr>
                        @foreach ($isrCity as $index => $city)
                            <tr>
                                <td>{{ $city }}</td>
                                <td class="text-center">{{ number_format($isrData[$index], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr class="bg-primary">
                            <td class="text-white">GRAND TOTAL</td>
                            <td class="text-white text-center">{{ number_format($grandTotalIsr, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            var ctx = document.getElementById("dashboardChart").getContext('2d');
            var isrCity = {!! json_encode($isrCity) !!};
            var isrData = {!! json_encode($isrData) !!};
            var data = {
                datasets: [{
                    data: isrData,
                    label: 'Total',
                    backgroundColor: '#9BD0F5',
                }],
                labels: isrCity
            };
            var isrBarChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12
                        }
                    }
                }
            });
        });
    </script>
@endsection
