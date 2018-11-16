<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
</head>
<style>
    .body{
        padding-top: 0px;
    }
</style>
<body style="padding-top:0px;">

<div class="container">
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
                url : "/get_team",
                        'data': {
           formName:  '<?php echo $team ?>',
                        }
        },
                        "order": [[ 3, "desc" ]],

    }) ;
});


</script>


</html>
