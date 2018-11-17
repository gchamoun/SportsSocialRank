<html>
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawWeekChart);
    google.charts.setOnLoadCallback(drawDayChart);

    function drawWeekChart() {
      var data = google.visualization.arrayToDataTable([
        ['Year', 'Followers'],
        ['11-12-18',  1000],
        ['11-13-18',  1170],
        ['11-14-18',  660],
        ['11-15-18',  1030]
      ]);

      var options = {
        title: 'Followers',
        curveType: 'function',
        legend: { position: 'bottom' }
      };

      var chart = new google.visualization.LineChart(document.getElementById('week_chart'));

      chart.draw(data, options);
    }




    function drawDayChart() {
      var data = google.visualization.arrayToDataTable([
        ['Year', 'Followers'],
        ['8:00',  1000],
        ['9:00',  1170],
        ['10:00',  660],
        ['11:00',  1030]
      ]);

      var options = {
        title: 'Followers',
        curveType: 'function',
        legend: { position: 'bottom' }
      };

      var chart = new google.visualization.LineChart(document.getElementById('day_chart'));

      chart.draw(data, options);
    }




  </script>










</head>
<body>
  <h1>Followers growth by week</h1>
  <div id="day_chart" style="width: 900px; height: 500px"></div>
  <div id="week_chart" style="width: 900px; height: 500px"></div>

</body>
</html>
