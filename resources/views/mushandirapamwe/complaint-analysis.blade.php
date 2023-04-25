@extends('layouts.app')

@section('page-css')
    @livewireStyles





@endsection
@section('content')
    <div class="card-body">
        <h5 class="card-title">Reports <span>/Today</span></h5>

        <!-- Line Chart -->
        <button id="changeTypeBtn">Change to Bar</button>
        <div id="reportsChart"></div>


        <!-- End Line Chart -->

    </div>









@endsection



@section('page-js')
    @livewireScripts
    <script>
        const data = @json($data);
        const colors = ['#FFC312', '#C4E538',  '#ED4C67', '#F79F1F', '#A3CB38', '#1289A7', '#D980FA', '#B53471'];
        document.addEventListener("DOMContentLoaded", () => {
           const chart = new ApexCharts(document.querySelector("#reportsChart"), {
                series:data,
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                },
                markers: {
                    size: 4
                },
                colors: colors,
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.3,
                        opacityTo: 0.4,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                xaxis: {
                    type: 'datetime',
                    categories: ["2022-10-19T00:00:00.000Z", "2022-11-19T01:30:00.000Z", "2022-12-19T02:30:00.000Z", "2023-01-19T03:30:00.000Z", "2023-02-19T04:30:00.000Z", "2023-03-19T05:30:00.000Z", "2023-04-19T06:30:00.000Z"]
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
                animation: {
                    enabled: true,
                    speed: 3000, // Animation duration in milliseconds
                    delay: 1000, // Delay between each data point in milliseconds
                },
            })

            // Event listener for the button
            document.querySelector("#changeTypeBtn").addEventListener("click", () => {
                // console.log(chart.config.chart.type)


                    chart.updateOptions({
                        chart: {
                            type: "bar"
                        }
                    });


            });

            // Render the chart
            chart.render();
        });
    </script>



@endsection
