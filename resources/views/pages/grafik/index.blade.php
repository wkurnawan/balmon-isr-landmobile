@extends('layouts.app', ['title' => 'Grafik'])

@push('style')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
@endpush

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-4 mb-4">
            <h6 class="mb-4">Filer</h6>
            <form action="#" method="GET">
                <div class="row">
                    <div class="col-sm-4">
                        <select class="form-select mb-3" aria-label="Default select example" name="bulan">
                            <option value="" {{ $bulan == '' ? 'selected' : '' }}>-- Pilih Bulan --</option>
                            <option value="01" {{ $bulan == '01' ? 'selected' : '' }}>Januari</option>
                            <option value="02" {{ $bulan == '02' ? 'selected' : '' }}>Februari</option>
                            <option value="03" {{ $bulan == '03' ? 'selected' : '' }}>Maret</option>
                            <option value="04" {{ $bulan == '04' ? 'selected' : '' }}>April</option>
                            <option value="05" {{ $bulan == '05' ? 'selected' : '' }}>Mei</option>
                            <option value="06" {{ $bulan == '06' ? 'selected' : '' }}>Juni</option>
                            <option value="07" {{ $bulan == '07' ? 'selected' : '' }}>Juli</option>
                            <option value="08" {{ $bulan == '08' ? 'selected' : '' }}>Agustus</option>
                            <option value="09" {{ $bulan == '09' ? 'selected' : '' }}>September</option>
                            <option value="10" {{ $bulan == '10' ? 'selected' : '' }}>Oktober</option>
                            <option value="11" {{ $bulan == '11' ? 'selected' : '' }}>November</option>
                            <option value="12" {{ $bulan == '12' ? 'selected' : '' }}>Desember</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select class="form-select mb-3" aria-label="Default select example" name="tahun">
                            <option value="">-- Pilih Tahun --</option>
                            @foreach ($tahuns as $tahunOption)
                                <option value="{{ $tahunOption }}"
                                    {{ old('tahun', $tahun) == $tahunOption ? 'selected' : '' }}>{{ $tahunOption }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-primary"><i class="fa fa-filter me-2"></i>Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Grafik - ISR</h6>
            <div class="px-4" style="position: relative; margin:auto; height:40vh;">
                <canvas id="grafikChart"></canvas>
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
                        @foreach ($labels as $index => $city)
                            <tr>
                                <td>{{ $city }}</td>
                                <td class="text-center">{{ number_format($data[$index], 0, ',', '.') }}</td>
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
            var ctx = document.getElementById("grafikChart").getContext('2d');
            var data = {!! json_encode($data) !!};
            var labels = {!! json_encode($labels) !!};
            var data = {
                datasets: [{
                    data: data,
                    label: 'Total',
                    backgroundColor: '#9BD0F5',
                }],
                labels: labels
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
