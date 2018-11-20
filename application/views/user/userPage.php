<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
// Load the Visualization API and the piechart package.
google.charts.load('current', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
	var jsonData = $.ajax({
			 type: "POST",
			 url: "get_team_chart",
			 data: {
					 team:'<?php echo $team ?>'
			 },
			 dataType:"json",          async: false

			}).responseText;

	// Create our data table out of JSON data loaded from server.
	var data = new google.visualization.DataTable(jsonData);

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
	chart.draw(data, {width: 900, height: 500});
}

</script>
<style>
h1 {
text-align: center;
}
</style>

</head>
<style>
    .body{
        padding-top: 0px;
    }
</style>
<body style="padding-top:0px;">

<div class="container">
	<h1>All Time</h1>
	<div id="chart_div"></div>

        <h1>@<?php echo $team ?></h1>
  	<table id="teamTable" class="table table-bordered table-striped table-hover" style="width:100%">
		<thead>
			<tr>
                            <th>Followers</th>

                                                    <th>Following</th>
                                                    <th>Followers Today</th>

                                                    <th>Date</th>
																										<th>Group Run ID</th>


			</tr>
		</thead>
		<tbody>


		</tbody>
	</table>
</div>


</body>


<script type="text/javascript">
$(document).ready(function() {

    $('#teamTable').DataTable({
                // This shows just the table,
responsive: true,
                "deferRender": true,

         paging: false,
                "bAutoWidth": false,
                "ajax": {
        'type': 'POST',
                url : "get_team",
                        'data': {
           team:  '<?php echo $team ?>',
                        }
        },
                        "order": [[ 3, "desc" ]],

    }) ;
});


</script>


</html>
