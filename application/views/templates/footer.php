</br>     
<em>&copy; 2018</em>
        </body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src='https://code.jquery.com/jquery-3.3.1.js'></script>
   <script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
   <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
   <script src="http://benpickles.github.io/peity/jquery.peity.js" charset="utf-8"></script>
<script>
$(".line").peity("line");

</script>

<script>
    $(document).ready(function() {
    $('#example').DataTable( {
  "order": [[ 3, "desc" ]]
} );
} );
    </script>
    
    <script>
    
    </script>
<script type="text/javascript">
$(document).ready(function() {
    $('#item-list').DataTable({     
                // This shows just the table,
                "ajax": {
            url : "/get_items",
            type : 'GET',
        },    responsive: true,
                "deferRender": true,
        
         paging: false,
                "bAutoWidth": false,
        "order": [[ 0, "asc" ]]
            

    }) ;
});

</script>