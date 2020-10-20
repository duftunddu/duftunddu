<script src="{{ asset('js/chart.min.js') }}" defer></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script> --}}

<canvas id="myChart" width="80%" height="50%"></canvas>

<script defer>
    window.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('myChart').getContext("2d");

        var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, '#80b6f4');
        gradientStroke.addColorStop(1, '#f49080');

        var gradientFill = ctx.createLinearGradient(500, 0, 100, 0);
        gradientFill.addColorStop(0, "rgba(128, 182, 244, 0.6)");
        gradientFill.addColorStop(1, "rgba(244, 144, 128, 0.6)");

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                // labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL"],
                labels: ["...", "6 Days Ago", "5 Days Ago", "4 Days Ago", "3 Days Ago", "2 Days Ago", "Day Before", "Today", "..."],
                datasets: [{
                    label: "Data",
                    borderColor: gradientStroke,
                    pointBorderColor: gradientStroke,
                    pointBackgroundColor: gradientStroke,
                    pointHoverBackgroundColor: gradientStroke,
                    pointHoverBorderColor: gradientStroke,
                    pointBorderWidth: 10,
                    pointHoverRadius: 10,
                    pointHoverBorderWidth: 1,
                    pointRadius: 3,
                    fill: true,
                    backgroundColor: gradientFill,
                    borderWidth: 4,
                    // data: [100, 120, 150, 170, 180, 170, 160]
                    data: ["...", {{$counts[0]}}, {{$counts[1]}}, {{$counts[2]}}, {{$counts[3]}}, {{$counts[4]}}, {{$counts[5]}}, {{$counts[6]}}, "..."]
                }]
            },
            options: {
                legend: {
                    position: "bottom"
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold",
                            beginAtZero: true,
                            maxTicksLimit: 5,
                            padding: 20
                        },
                        gridLines: {
                            drawTicks: false,
                            display: false
                        }

                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: 20,
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold"
                        }
                    }]
                }
            }
        });
    })
</script>