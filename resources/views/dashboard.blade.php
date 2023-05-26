@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
  <div class="row g-4">
    <div class="col-12 col-lg-6">
      <div class="chart-content border rounded-2 p-3">
        <h4 class="text-center">Ordini</h4>
        <canvas id="orderChart"></canvas>
      </div>
    </div>
    <div class="col-12 col-lg-6">
      <div class="chart-content border rounded-2 p-3">
        <h4 class="text-center">Guadagno</h4>
        <canvas id="totalAmountChart"></canvas>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Recupera i dati del grafico dal tuo controller o da altre fonti
    var orderCountPerMonth = {!! $orderCountPerMonth !!};
    var totalAmountPerMonth = {!! json_encode($totalAmountPerMonth) !!};

    // Crea l'array di etichette dei mesi
    var months = Object.keys(orderCountPerMonth);

    // Crea l'array di dati dei conteggi degli ordini per mese
    var orderCounts = months.map(function(month) {
      return orderCountPerMonth[month];
    });

    // Crea l'array di dati del guadagno totale per mese
    var totalAmounts = months.map(function(month) {
      return totalAmountPerMonth[month];
    });

    // Crea il primo grafico per il conteggio degli ordini
    var orderChart = new Chart(document.getElementById('orderChart').getContext('2d'), {
      type: 'bar',
      data: {
        labels: months,
        datasets: [{
          label: 'Ordini',
          data: orderCounts,
          backgroundColor: 'rgba(255, 159, 64, 0.5)',
          borderColor: 'rgb(255, 159, 64)',
          borderWidth: 2
        }]
      },
      options: {
        plugins: {
          legend: {
            display: false
          }
        },
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1
            },
          }
        }
      }
    });

    // Crea il secondo grafico per il guadagno totale
    var totalAmountChart = new Chart(document.getElementById('totalAmountChart').getContext('2d'), {
      type: 'line',
      data: {
        labels: months,
        datasets: [{
          label: 'Guadagno',
          data: totalAmounts,
          borderColor: 'rgb(75, 192, 192)',
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function(value) {
                return '€' + value.toLocaleString('it-IT');
              }
            }
          }
        },
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                var value = context.dataset.data[context.dataIndex];
                var formattedValue = '€' + value.toLocaleString('it-IT');
                return 'Guadagno: ' + formattedValue;
              },
            }
          }
        }
      }
    });
  </script>
@endsection
