<!DOCTYPE html>

<html>
    <head>

        <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">

    </head>
	<title>Sports Social Rank</title>
</head>
<body>
<div class="container">
    </br>
  	<table id="item-list" class="table table-bordered table-striped table-hover" style="width:100%">
		<thead>
			<tr>

				<th>Name</th>

				<th>Followers</th>
                          <th>Following</th>
                                                    <th>Followers Today</th>
                                                    <th>Growth Rate</th>

                                                    <th>Category</th>
                                                    <th>Last Run</th>
                                                    <th>Group Run ID</th>


			</tr>
		</thead>
		<tbody>

		</tbody>
	</table>
  <?php
  echo "latest update: ". date('h:i:s a m/d/Y', strtotime($latestUpdate));?>
</br>
  <?php
  echo "previous update: ". date('h:i:s a m/d/Y', strtotime($previousUpdate));?>


</div>
<p>Last Run: </p>

</body>



</html>
