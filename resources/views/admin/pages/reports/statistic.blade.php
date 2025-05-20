@extends('admin.includes.master', ['title' => 'Statistik Data Penjualan', 'page' => 'statistic-report'])

@section('content')
    <div class="container-fluid">
        <form method="GET" action="{{ route('report.statistic') }}" class="mb-4">
            <div class="row g-2">
                <div class="col-md-3">
                    <label>Tanggal Awal</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Tanggal Akhir</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                </div>
                <div class="col-md-2 align-self-end">
                    <button class="btn btn-primary w-100" type="submit">Filter</button>
                </div>
                <div class="col-md-2 align-self-end">
                    <a href="{{ route('report.statistic') }}" class="btn btn-secondary w-100">Reset</a>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-md-6">
                @if(count($categories) > 0)
                    <div id="pie-chart" style="height: 400px;"></div>
                @else
                    <div class="alert alert-info">Data metode pembayaran kosong.</div>
                @endif
            </div>
            <div class="col-md-6">
                @if(count($sales) > 0)
                    <div id="line-chart" style="height: 400px;"></div>
                @else
                    <div class="alert alert-info">Data penjualan per bulan kosong.</div>
                @endif
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                @if(count($groupedSales) > 0)
                    <div id="column-chart" style="height: 400px;"></div>
                @else
                    <div class="alert alert-info">Data penjualan per partner kosong.</div>
                @endif
            </div>
            <div class="col-md-6">
                @if(isset($weeklySales) && count($weeklySales) > 0)
                    <div id="weekly-sales-chart" style="height: 400px;"></div>
                @else
                    <div class="alert alert-info">Data penjualan per minggu kosong.</div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

@if(count($categories) > 0)
<script>
    Highcharts.chart('pie-chart', {
        chart: { type: 'pie' },
        title: { text: 'Total Penjualan Per Metode Pembayaran' },
        exporting: { enabled: true },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: [{
                    enabled: true,
                    format: '{point.percentage:.1f} %',
                    distance: -50, // Atur jarak agar tidak keluar dari potongan
                    color: 'white', // Warna teks persentase
                    style: {
                        fontWeight: 'bold',
                        fontSize: '1.2em' // Perbesar ukuran font
                    }
                }, {
                    enabled: true,
                    format: '<b>{point.name}</b>',
                    distance: 30, // Atur jarak keterangan nama dari potongan
                    connectorShape: 'crookedLine',
                    connectorColor: 'silver',
                    connectorWidth: 1,
                    style: {
                        fontWeight: 'bold',
                        color: 'black',
                        fontSize: '0.9em'
                    }
                }]
            }
        },
        series: [{
            name: 'Persentase',
            colorByPoint: true,
            data: [
                @foreach ($categories as $name => $count)
                    { name: '{{ addslashes($name) }}', y: {{ $count }} },
                @endforeach
            ]
        }]
    });
</script>
@endif

@if(count($sales) > 0)
<script>
    Highcharts.chart('line-chart', {
        chart: { type: 'line', zoomType: 'x' },
        title: { text: 'Total Penjualan Per Bulan' },
        exporting: { enabled: true },
        xAxis: {
            categories: [
                @foreach ($sales as $sale)
                    '{{ $sale["month"] }}',
                @endforeach
            ],
            labels: {
                style: {
                    color: '#666'  // Warna default
                }
            }
        },
        yAxis: { title: { text: 'Jumlah Penjualan' }},
        series: [{
            name: 'Penjualan',
            data: [
                @foreach ($sales as $sale)
                    {{ $sale["total"] }},
                @endforeach
            ]
        }]
    });
</script>
@endif

@if(count($groupedSales) > 0)
<script>
    Highcharts.chart('column-chart', {
        chart: { type: 'column' },
        title: { text: 'Penjualan Per Tahun' },
        xAxis: {
            categories: {!! json_encode(array_keys($groupedSales)) !!},
            labels: {
                style: {
                    color: [
                        @php
                            $yearColors = ['#2f4554', '#81c784', '#ff6f61', '#ffeead', '#42a5f5', '#ffc107'];
                            $yearColorIndex = 0;
                            foreach(array_keys($groupedSales) as $year) {
                                echo "'" . $yearColors[$yearColorIndex % count($yearColors)] . "',";
                                $yearColorIndex++;
                            }
                        @endphp
                    ]
                }
            }
        },
        yAxis: { title: { text: 'Total Penjualan' }},
        exporting: { enabled: true },
        series: [
            @php
                $partnerships = [];
                $yearColors = ['#2f4554', '#81c784', '#ff6f61', '#ffeead', '#42a5f5', '#ffc107']; // Tambahkan lebih banyak warna jika perlu
                $yearColorIndex = 0;
                foreach ($groupedSales as $year => $partners) {
                    foreach ($partners as $partner => $value) {
                        $partnerships[$partner] = true;
                    }
                }
                $partnerships = array_keys($partnerships);
            @endphp
            @foreach ($partnerships as $partner)
                {
                    name: '{{ addslashes($partner) }}',
                    color: '{{ $yearColors[$yearColorIndex % count($yearColors)] }}', // Gunakan warna yang berbeda untuk setiap tahun
                    data: [
                        @foreach (array_keys($groupedSales) as $year)
                            {{ $groupedSales[$year][$partner] ?? 0 }},
                        @endforeach
                    ],
                },
                @php
                    $yearColorIndex++;
                @endphp
            @endforeach
        ]
    });
</script>
@endif

@if(isset($weeklySales) && count($weeklySales) > 0)
<script>
    Highcharts.chart('weekly-sales-chart', {
        chart: { type: 'column' },
        title: { text: 'Total Penjualan Per Minggu' },
        xAxis: {
            categories: [
                @foreach ($weeklySales as $weeklySale)
                    '{{ $weeklySale["week_label"] }}',
                @endforeach
            ],
            labels: {
                style: {
                    color: [
                        @php
                            $weekColors = ['#f44336', '#e06459', '#d3867d', '#c8a7a0', '#c2c9c3', '#bcd0e0'];
                            $weekColorIndex = 0;
                            foreach($weeklySales as $weeklySale) {
                                echo "'" . $weekColors[$weekColorIndex % count($weekColors)] . "',";
                                $weekColorIndex++;
                            }
                        @endphp
                    ]
                }
            }
        },
        yAxis: {
            title: { text: 'Jumlah Penjualan' }
        },
        exporting: { enabled: true },
        series: [{
            name: 'Penjualan',
            colors: ['#f44336', '#e06459', '#d3867d', '#c8a7a0', '#c2c9c3', '#bcd0e0'], // Array warna untuk setiap minggu
            data: [
                @foreach ($weeklySales as $weeklySale)
                    {{ $weeklySale["total"] }},
                @endforeach
            ]
        }]
    });
</script>
@endif
@endpush
