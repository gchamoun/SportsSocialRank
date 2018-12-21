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

<script type="text/javascript">



$('#item-list').DataTable({
  //'deferRender': false,
  'ajax'       : {
    "type"   : "Get",
    "url"    : "users/get_latest",

    "dataSrc": function (json) {
      var return_data = new Array();
      for(var i=0;i< json.length; i++){
        return_data.push({
          'rank' : i+1,
          'user':'<a href="user/'+ json[i].screen_name +' "><img style="border-radius:50%; float:left;" src="' + json[i].profile_image_url + '"><div style="padding-left:65px;" class="text-box"> <strong>' + json[i].name + '</strong> ' + " @" + json[i].screen_name + '</div></a>',
          'profile_image_url'  : '<img src="' + json[i].profile_image_url + '">',
          'followers' : json[i].followers,
          'following' : json[i].following,
          'followers_today_count' : json[i].followers_today_count,



        })
      }
      return return_data;
    }
  },
  "columns"    : [
    {'data': 'rank'},
    {'data': 'user'},
    {'data': 'followers', render: $.fn.dataTable.render.number(',', '.', 0, '') },
    {'data': 'following', render: $.fn.dataTable.render.number(',', '.', 0, '') },
    {'data': 'followers_today_count', render: $.fn.dataTable.render.number(',', '.', 0, '') },



  ]
});


$('#cfb-table').DataTable({
  "ordering": false,
  "searching": false,
  "lengthChange": false,
  "paging": false,
  "bInfo": false,

  'ajax'       : {
    "type"   : "Get",
    "url"    : "users/gettopfive/cfb",

    "dataSrc": function (json) {
      var return_data = new Array();
      for(var i=0;i< json.length; i++){
        return_data.push({

          'rank' : i+1,
          'user':'<img style="border-radius:50%; float:left;" src="' + json[i].profile_image_url + '"><div style="padding-left:65px;" class="text-box"> <strong>' + json[i].name + '</strong> ' + " @" + json[i].screen_name + '</div></a>',

        'profile_image_url'  : '<img src="' + json[i].profile_image_url + '">',
          'followers' : json[i].followers,
          'followers_today_count' : json[i].followers_today_count
        })
      }




      return return_data;
    }
  },
  "columns"    : [
    {'data': 'rank'},
    {'data': 'user'},
    {'data': 'followers', render: $.fn.dataTable.render.number(',', '.', 0, '') },
    {'data': 'followers_today_count', render: $.fn.dataTable.render.number(',', '.', 0, '') }


  ]
});


$('#nfl-table').DataTable({

  "ordering": false,
  "searching": false,
  "lengthChange": false,
  "paging": false,
  "bInfo": false,

  'ajax'       : {
    "type"   : "Get",
    "url"    : "users/gettopfive/nfl",

    "dataSrc": function (json) {
      var return_data = new Array();
      for(var i=0;i< json.length; i++){
        return_data.push({

          'rank' : i+1,
          'user':'<img style="border-radius:50%; float:left;" src="' + json[i].profile_image_url + '"><div style="padding-left:65px;" class="text-box"> <strong>' + json[i].name + '</strong> ' + " @" + json[i].screen_name + '</div></a>',
          'profile_image_url'  : '<img src="' + json[i].profile_image_url + '">',
          'followers' : json[i].followers,
          'followers_today_count' : json[i].followers_today_count



        })
      }
      return return_data;
    }
  },
  "columns"    : [
    {'data': 'rank'},
    {'data': 'user'},
    {'data': 'followers', render: $.fn.dataTable.render.number(',', '.', 0, '') },
    {'data': 'followers_today_count', render: $.fn.dataTable.render.number(',', '.', 0, '') }


  ]
});

$('#nba-table').DataTable({

  "ordering": false,
  "searching": false,
  "lengthChange": false,
  "paging": false,
  "bInfo": false,

  'ajax'       : {
    "type"   : "Get",
    "url"    : "users/gettopfive/nba",

    "dataSrc": function (json) {
      var return_data = new Array();
      for(var i=0;i< json.length; i++){
        return_data.push({

          'rank' : i+1,
          'user':'<img style="border-radius:50%; float:left;" src="' + json[i].profile_image_url + '"><div style="padding-left:65px;" class="text-box"> <strong>' + json[i].name + '</strong> ' + " @" + json[i].screen_name + '</div></a>',
          'profile_image_url'  : '<img src="' + json[i].profile_image_url + '">',
          'followers' : json[i].followers,
          'followers_today_count' : json[i].followers_today_count



        })
      }
      return return_data;
    }
  },
  "columns"    : [
    {'data': 'rank'},
    {'data': 'user'},
    {'data': 'followers', render: $.fn.dataTable.render.number(',', '.', 0, '') },
    {'data': 'followers_today_count', render: $.fn.dataTable.render.number(',', '.', 0, '') }


  ]
});

$('#premierleague-table').DataTable({
  "ordering": false,
  "searching": false,
  "lengthChange": false,
  "paging": false,
  "bInfo": false,

  'ajax'       : {
    "type"   : "Get",
    "url"    : "users/gettopfive/premierleague",

    "dataSrc": function (json) {
      var return_data = new Array();
      for(var i=0;i< json.length; i++){
        return_data.push({

          'rank' : i+1,
          'user':'<img style="border-radius:50%; float:left;" src="' + json[i].profile_image_url + '"><div style="padding-left:65px;" class="text-box"> <strong>' + json[i].name + '</strong> ' + " @" + json[i].screen_name + '</div></a>',
          'profile_image_url'  : '<img src="' + json[i].profile_image_url + '">',
          'followers' : json[i].followers,
          'followers_today_count' : json[i].followers_today_count



        })
      }
      return return_data;
    }
  },
  "columns"    : [
    {'data': 'rank'},
    {'data': 'user'},
    {'data': 'followers', render: $.fn.dataTable.render.number(',', '.', 0, '') },
    {'data': 'followers_today_count', render: $.fn.dataTable.render.number(',', '.', 0, '') }


  ]
});
$('#nflplayers-table').DataTable({
  "ordering": false,
  "searching": false,
  "lengthChange": false,
  "paging": false,
  "bInfo": false,

  'ajax'       : {
    "type"   : "Get",
    "url"    : "users/gettopfive/nflplayers",

    "dataSrc": function (json) {
      var return_data = new Array();
      for(var i=0;i< json.length; i++){
        return_data.push({

          'rank' : i+1,
          'user':'<img style="border-radius:50%; float:left;" src="' + json[i].profile_image_url + '"><div style="padding-left:65px;" class="text-box"> <strong>' + json[i].name + '</strong> ' + " @" + json[i].screen_name + '</div></a>',
          'profile_image_url'  : '<img src="' + json[i].profile_image_url + '">',
          'followers' : json[i].followers,
          'followers_today_count' : json[i].followers_today_count



        })
      }
      return return_data;
    }
  },
  "columns"    : [
    {'data': 'rank'},
    {'data': 'user'},
    {'data': 'followers', render: $.fn.dataTable.render.number(',', '.', 0, '') },
    {'data': 'followers_today_count', render: $.fn.dataTable.render.number(',', '.', 0, '') }


  ]
});
$('#mls-table').DataTable({
  "ordering": false,
  "searching": false,
  "lengthChange": false,
  "paging": false,
  "bInfo": false,

  'ajax'       : {
    "type"   : "Get",
    "url"    : "users/gettopfive/mls",

    "dataSrc": function (json) {
      var return_data = new Array();
      for(var i=0;i< json.length; i++){
        return_data.push({

          'rank' : i+1,
          'user':'<img style="border-radius:50%; float:left;" src="' + json[i].profile_image_url + '"><div style="padding-left:65px;" class="text-box"> <strong>' + json[i].name + '</strong> ' + " @" + json[i].screen_name + '</div></a>',
          'profile_image_url'  : '<img src="' + json[i].profile_image_url + '">',
          'followers' : json[i].followers,
          'followers_today_count' : json[i].followers_today_count



        })
      }
      return return_data;
    }
  },
  "columns"    : [
    {'data': 'rank'},
    {'data': 'user'},
    {'data': 'followers', render: $.fn.dataTable.render.number(',', '.', 0, '') },
    {'data': 'followers_today_count', render: $.fn.dataTable.render.number(',', '.', 0, '') }


  ]
});
$('#mlb-table').DataTable({
  "autoWidth": true,
  "ordering": false,
  "searching": false,
  "lengthChange": false,
  "paging": false,
  "bInfo": false,

  'ajax'       : {
    "type"   : "Get",
    "url"    : "users/gettopfive/MLB",

    "dataSrc": function (json) {
      var return_data = new Array();
      for(var i=0;i< json.length; i++){
        return_data.push({

          'rank' : i+1,
          'user':'<img style="border-radius:50%; float:left;" src="' + json[i].profile_image_url + '"><div style="padding-left:65px;" class="text-box"> <strong>' + json[i].name + '</strong> ' + " @" + json[i].screen_name + '</div></a>',
          'profile_image_url'  : '<img src="' + json[i].profile_image_url + '">',
          'followers' : json[i].followers,
          'followers_today_count' : json[i].followers_today_count



        })
      }
      return return_data;
    }
  },
  "columns"    : [
    {'data': 'rank'},
    {'data': 'user'},
    {'data': 'followers', render: $.fn.dataTable.render.number(',', '.', 0, '') },
    {'data': 'followers_today_count', render: $.fn.dataTable.render.number(',', '.', 0, '') }


  ]
});
jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');


</script>
