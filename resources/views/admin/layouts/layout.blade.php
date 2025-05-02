<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Responsive Admin & Dashboard Template">
  <meta name="author" content="Your Name">
  <meta name="keywords" content="admin, dashboard, template, responsive, css, html">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="shortcut icon" href="{{ asset('img/icons/icon-48x48.png') }}" />

  <title>Admin Dashboard</title>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    @include('admin.layouts.sidebar')
    
    <div class="main">
      <!-- Navbar -->
      @include('admin.layouts.navbar')

      <main class="content">
        <!-- Content will be inserted here -->
        @yield('content')
      </main>

      <!-- Footer (if you have one) -->
      @include('admin.layouts.footer')
    </div>
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
  
  <!-- Chart scripts (if needed) -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
      var gradient = ctx.createLinearGradient(0, 0, 0, 225);
      gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
      gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
      // Line chart
      new Chart(document.getElementById("chartjs-dashboard-line"), {
        type: "line",
        data: {
          labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
            label: "Sales ($)",
            fill: true,
            backgroundColor: gradient,
            borderColor: window.theme.primary,
            data: [
              2115,
              1562,
              1584,
              1892,
              1587,
              1923,
              2566,
              2448,
              2805,
              3438,
              2917,
              3327
            ]
          }]
        },
        options: {
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          tooltips: {
            intersect: false
          },
          hover: {
            intersect: true
          },
          plugins: {
            filler: {
              propagate: false
            }
          },
          scales: {
            xAxes: [{
              reverse: true,
              gridLines: {
                color: "rgba(0,0,0,0.0)"
              }
            }],
            yAxes: [{
              ticks: {
                stepSize: 1000
              },
              display: true,
              borderDash: [3, 3],
              gridLines: {
                color: "rgba(0,0,0,0.0)"
              }
            }]
          }
        }
      });
    });
  </script>
  
  <!-- Other scripts (if needed) -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Pie chart
      new Chart(document.getElementById("chartjs-dashboard-pie"), {
        type: "pie",
        data: {
          labels: ["Chrome", "Firefox", "IE"],
          datasets: [{
            data: [4306, 3801, 1689],
            backgroundColor: [
              window.theme.primary,
              window.theme.warning,
              window.theme.danger
            ],
            borderWidth: 5
          }]
        },
        options: {
          responsive: !window.MSInputMethodContext,
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          cutoutPercentage: 75
        }
      });
    });
  </script>
</body>
</html>