@extends('layouts.app')

@section('content')


    <section id="user-stats">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box-title">
                        <h1>Statistiche</h1>
                    </div>
                    <div class="panel-body">
                        <canvas id="canvas" height="280" width="600"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        var year = {{$year}};
        var user = {{$user}};

        var barChartData = {
            labels: year,
            datasets: [{
                label: 'Prezzo',
                backgroundColor: "red",
                data: user
            }]
        };

        window.onload = function () {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Prezzo complessivo prodotti'
                    }
                }
            });
        };
    </script>
@endsection


