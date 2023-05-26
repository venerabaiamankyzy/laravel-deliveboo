@extends('layouts.app')

@section('content')
  <div class="container">
    <h2 class="fs-4 text-secondary my-4">
      {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
      <div class="col-6">
        <div>
          <canvas id="myChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Recupera i dati del grafico dal tuo controller o da altre fonti
    var orderCountPerMonth = {!! $orderCountPerMonth !!};

    // Crea l'array di etichette dei mesi
    var months = Object.keys(orderCountPerMonth);

    // Crea l'array di dati dei conteggi degli ordini per mese
    var orderCounts = months.map(function(month) {
      return orderCountPerMonth[month];
    });

    // Crea il grafico utilizzando Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: months,
        datasets: [{
          label: 'Ordini',
          data: orderCounts,
          backgroundColor: 'rgba(255, 159, 64, 0.4)',
          borderColor: 'rgb(255, 159, 64)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              precision: 0
            }
          }
        }
      }
    });
  </script>
@endsection
