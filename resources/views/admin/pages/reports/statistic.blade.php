@extends('layouts.app')


@section('content')
<div class="container">
    <h1 class="mb-4">Statistik Data Penjualan</h1>

    <div id="pie-chart" style="width: 45%; height: 400px; float: left;"></div>
    <div id="line-chart" style="width: 50%; height: 400px; float: right;"></div>
    <div style="clear: both;"></div>
    <div id="column-chart" style="width: 100%; height: 400px; margin-top: 50px;"></div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.chart('pie-chart', {
        chart: { type: 'pie' },
        title: { text: 'Product Count by Category Chart' },
        series: [{
            name: 'Jumlah',
            colorByPoint: true,
            data: [
                @foreach ($categories as $name => $count)
                    { name: '{{ $name }}', y: {{ $count }} },
                @endforeach
            ]
        }]
    });

    Highcharts.chart('line-chart', {
        chart: { type: 'line' },
        title: { text: 'Sum of Sales Chart' },
        xAxis: {
            categories: [
                @foreach ($sales as $sale)
                    '{{ $sale["month"] }}',
                @endforeach
            ]
        },
        series: [{
            name: 'Sales',
            data: [
                @foreach ($sales as $sale)
                    {{ $sale["total"] }},
                @endforeach
            ]
        }]
    });

    Highcharts.chart('column-chart', {
        chart: { type: 'column' },
        title: { text: 'Sum of Product Grouped by Year Chart' },
        xAxis: {
            categories: {!! json_encode(array_keys($groupedSales)) !!}
        },
        yAxis: { title: { text: 'Sales' } },
        series: [
            @php $catList = array_keys($categories); @endphp
            @foreach ($catList as $cat)
                {
                    name: '{{ $cat }}',
                    data: [
                        @foreach (array_keys($groupedSales) as $year)
                            {{ $groupedSales[$year][$cat] ?? 0 }},
                        @endforeach
                    ]
                },
            @endforeach
        ]
    });
</script>
@endsection
