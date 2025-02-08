@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="px-4 pt-6">
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <!-- Card header -->
            <div class="items-center justify-between lg:flex">
                <div class="mb-4 lg:mb-0">
                    <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">@yield('title')</h3>
                </div>
                <div class="items-center sm:flex">
                    <div class="flex items-center">
                        <!-- Modal toggle -->
                        <div class="flex justify-center">
                            <button id="download-chart"
                                class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                type="button">
                                Download Chart
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full px-4 md:px-6">
                <div class="flex justify-between mb-5">
                    <div class="grid gap-1 grid-cols-1">
                        <div>
                            <h5
                                class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">
                                Total Pemesanan
                            </h5>
                            <p class="text-gray-900 dark:text-white text-center text-2xl leading-none font-bold">
                                {{ collect($chartData)->sum('count') }}
                            </p>
                        </div>
                    </div>
                </div>


                <div id="line-chart"></div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        const chartData = @json($chartData);

        const options = {
            chart: {
                height: "100%",
                maxWidth: "100%",
                type: "line",
                fontFamily: "Inter, sans-serif",
                dropShadow: {
                    enabled: false
                },
                toolbar: {
                    show: false,
                },
            },
            tooltip: {
                enabled: true,
                x: {
                    show: false
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 6
            },
            grid: {
                show: true,
                strokeDashArray: 4,
                padding: {
                    left: 10,
                    right: 10,
                    top: -26
                },
            },
            series: [{
                    name: "Total",
                    data: chartData.map(item => item.count),
                    color: "#1A56DB",
                },
                {
                    name: "Approved",
                    data: chartData.map(item => item.approved_count),
                    color: "#22C55E", // Warna hijau untuk approved
                },
                {
                    name: "Rejected",
                    data: chartData.map(item => item.rejected_count),
                    color: "#EF4444", // Warna merah untuk rejected
                }
            ],
            legend: {
                show: true,
                position: "top",
                labels: {
                    colors: "#6B7280"
                }
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                categories: chartData.map(item => item.month_name),
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                    }
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
            },
            yaxis: {
                labels: {
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                    }
                }
            },
        };

        if (document.getElementById("line-chart") && typeof ApexCharts !== 'undefined') {
            window.chart = new ApexCharts(document.getElementById("line-chart"), options);
            window.chart.render();
        }

        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("download-chart").addEventListener("click", function() {
                if (window.chart) {
                    window.chart.dataURI().then(({
                        imgURI
                    }) => {
                        const link = document.createElement("a");
                        link.href = imgURI;
                        link.download = "chart.png";
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    });
                } else {
                    console.error("Chart belum siap!");
                }
            });
        });
    </script>
@endpush
