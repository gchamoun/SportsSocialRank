<!DOCTYPE html>
<html>
<head>
	<title>Codeigniter 3 Datatables Ajax Example</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
</head>
<body>

<div class="container">
	<h2>Sports Social Rank | Twitter Followers</h2>


	<table id="item-list" class="table table-bordered table-striped table-hover">
		<thead>
			<tr>                          
                            <th>Rank</th>

				<th>Name</th>

				<th>Display Name</th>
				<th>Followers</th>
                          <th>Following</th>
                                                    <th>Followers Today</th>
                                                    <th>Category</th>

                            <th>Date</th>


			</tr>
		</thead>
		<tbody>


		</tbody>
	</table>
</div>


</body>


<script type="text/javascript">
$(document).ready(function() {
    $('#item-list').DataTable({        
        "ajax": {
            url : "/get_items",
            type : 'GET'
        },
        
        "order": [[ 0, "asc" ]],
            "paging": false
            

    });
});
</script>


</html>
