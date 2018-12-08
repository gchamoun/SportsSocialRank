<!DOCTYPE html>
<html lang="en">
<html>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SportsSocialRank</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css">

    <!-- Custom fonts for this template -->
    <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/creative.min.css" rel="stylesheet">
    <!-- Move After -->

<style>
.dataTables_scroll
{
    overflow:auto;
}


.nav-tabs .nav-link.active {
    background-color: #000;}
    .ui-corner-all
{
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
}

</style>
  </head>


  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Sports Social Rank</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#services">Why Sports Social Rank</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#demo">Demo</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="masthead text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1  class="text-uppercase">
              <strong style="background-color: black;+">Gain <span style="color:#f05f40;"> Insights</span> into sports social media</strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <!-- <p class="text-faded mb-5">See not only where your team stands but see every team across every major sports league</p> -->
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out how</a>
          </div>
        </div>
      </div>
    </header>
    <div class="modal" id="exampleModal" tabindex="100000" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <section class="bg-primary" id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">We collect twitter data on players and teams accounts from some of the top leagues</h2>
            <hr class="light my-4">
            <p class="text-faded mb-4">Choose a league to explore some of our data</p>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a style="color:white;"class="nav-link active" id="cfb-tab" data-toggle="tab" href="#cfb" role="tab" aria-controls="cfb-tab" aria-selected="true">College Football</a>
  </li>
  <li class="nav-item">
    <a style="color:white;" class="nav-link" id="nfl" data-toggle="tab" href="#nfl-tab" role="tab" aria-controls="nfl-tab" aria-selected="false">NFL</a>
  </li>
  <li class="nav-item">
    <a style="color:white;" class="nav-link" id="contact-tab" data-toggle="tab" href="#nba-tab" role="tab" aria-controls="contact" aria-selected="false">NBA</a>
  </li>
  <li class="nav-item">
    <a style="color:white;" class="nav-link" id="contact-tab" data-toggle="tab" href="#mlb-tab" role="tab" aria-controls="contact" aria-selected="false">MLB</a>
  </li>
  <li class="nav-item">
    <a style="color:white;" class="nav-link" id="contact-tab" data-toggle="tab" href="#mls-tab" role="tab" aria-controls="contact" aria-selected="false">MLS</a>
  </li>
  <li class="nav-item">
    <a style="color:white;" class="nav-link" id="contact-tab" data-toggle="tab" href="#nflplayers-tab" role="tab" aria-controls="contact" aria-selected="false">NFL Players</a>
  </li>
  <li class="nav-item">
    <a style="color:white;" class="nav-link" id="contact-tab" data-toggle="tab" href="#premierleague-tab" role="tab" aria-controls="contact" aria-selected="false">Premier League</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="cfb" role="tabpanel" aria-labelledby="cfb-tab">
 	<table id="cfb-table" class="cfbtable table table-bordered table-striped table-hover" style="background-color:white; width:100%">
  		<thead>
  			<tr>

  				<th>Rank</th>

  				<th>Name</th>
                            <th>Followers</th>
                                                      <th>Followers Today</th>


  			</tr>
  		</thead>
  		<tbody>

  		</tbody>
  	</table>
</div>
  <div class="tab-pane fade" id="nfl-tab" role="nfl-tab" aria-labelledby="nfl-tab">

  <table id="nfl-table" class="table table-bordered table-striped table-hover" style="background-color:white; width:100%">
      <thead>
        <tr>

          <th>Rank</th>

          <th>Name</th>
                            <th>Followers</th>
                                                      <th>Followers Today</th>


        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
</div>
  <div class="tab-pane fade" id="nba-tab" role="tabpanel" aria-labelledby="contact-tab"><table id="nba-table" class="table table-bordered table-striped table-hover" style="background-color:white; width:100%">
      <thead>
        <tr>

          <th>Rank</th>

          <th>Name</th>
                            <th>Followers</th>
                                                      <th>Followers Today</th>


        </tr>
      </thead>
      <tbody>

      </tbody>
    </table></div>
    <div class="tab-pane fade" id="mlb-tab" role="tabpanel" aria-labelledby="contact-tab"><table id="mlb-table" class="table table-bordered table-striped table-hover" style="background-color:white; width:100%">
        <thead>
          <tr>

            <th>Rank</th>

            <th>Name</th>
                              <th>Followers</th>
                                                        <th>Followers Today</th>


          </tr>
        </thead>
        <tbody>

        </tbody>
      </table></div>
      <div class="tab-pane fade" id="mls-tab" role="tabpanel" aria-labelledby="contact-tab"><table id="mls-table" class="table table-bordered table-striped table-hover" style="background-color:white; width:100%">
          <thead>
            <tr>

              <th>Rank</th>

              <th>Name</th>
                                <th>Followers</th>
                                                          <th>Followers Today</th>


            </tr>
          </thead>
          <tbody>

          </tbody>
        </table></div>
        <div class="tab-pane fade" id="nflplayers-tab" role="tabpanel" aria-labelledby="contact-tab"><table id="nflplayers-table" class="table table-bordered table-striped table-hover" style="background-color:white; width:100%">
            <thead>
              <tr>

                <th>Rank</th>

                <th>Name</th>
                                  <th>Followers</th>
                                                            <th>Followers Today</th>


              </tr>
            </thead>
            <tbody>

            </tbody>
          </table></div>
          <div class="tab-pane fade" id="premierleague-tab" role="tabpanel" aria-labelledby="contact-tab"><table id="premierleague-table" class="table table-bordered table-striped table-hover" style="background-color:white; width:100%">
              <thead>
                <tr>

                  <th>Rank</th>

                  <th>Name</th>
                                    <th>Followers</th>
                                                              <th>Followers Today</th>


                </tr>
              </thead>
              <tbody>

              </tbody>
            </table></div>



</div>
</br>
</br>

            <a class="btn btn-light btn-xl js-scroll-trigger" href="#demo">Sign up For Demo</a>
          </div>
        </div>
      </div>
    </section>

    <section id="services">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">Why Sports Social Rank?</h2>
            <hr class="my-4">
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-gem text-primary mb-3 sr-icon-1"></i>
              <h3 class="mb-3">Know your value</h3>
              <p class="text-muted mb-0">We allow you to see where your social media accounts stands against others in your league and all sports.</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-chart-line text-primary mb-3 sr-icon-2"></i>
              <h3 class="mb-3">Know when someone goes viral</h3>
              <p class="text-muted mb-0">Track viral trends in sports.</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-chart-pie text-primary mb-3 sr-icon-3"></i>
              <h3 class="mb-3">Competitor Insight</h3>
              <p class="text-muted mb-0">Gain insight into your competitions content and growth patterns.</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-cogs text-primary mb-3 sr-icon-4"></i>
              <h3 class="mb-3">Custom Reports</h3>
              <p class="text-muted mb-0">Create custom reports around data being collected.</p>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section id="demo" class="bg-dark text-white">
      <div class="container text-center">
        <h2 class="mb-4">Sign up for a Free Demo and Walkthrough</h2>
        <form id="demo-form">
        </br>
      </br>
          <div class="row">
            <div class="col">
              <input name="first-name" class="form-control" placeholder="First name" value="">
            </div>
            <div class="col">
              <input type="text" name="last-name" class="form-control" placeholder="Last name">
            </div>
          </div>
        </br>        </br>

        <div class="row">
          <div class="col">
            <input type="text" name="email" class="form-control" placeholder="Email">
          </div>
          <div class="col">
            <input type="tel" name="phone" class="form-control" placeholder="Phone">
          </div>
        </div>
      </br>      </br>

<div class="row">
  <div class="col">
    <input type="text" name="organization"class="form-control" placeholder="organization">
  </div>
  <div class="col">
    <input type="text" name="job-title"class="form-control" placeholder="Job Title">
  </div>
</div>
</br>      </br>
<button type="submit" class="btn btn-success">Submit <span class="fa fa-arrow-right"></span></button>

<p id="success" style="display:none; color:green; padding-top:15px;">Successfully Submitted!</p>
</form>
      </div>
    </section>
    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>


    <script>
    $(document).ready(function(){

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
       $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust()
          .fixedColumns().relayout();
    });
});
    $(function(){
        $("#demo-form").submit(function(){
            dataString = $("#demo-form").serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>/FormSubmission/demoform",
                data: dataString,
                success: function(data){
                  if(data != "1"){
                    alert('Error Submiting');
                  }
                  else {
                    alert('Successfully Submitted!');
                    location.reload();

                  }
                }

            });

            return false;  //stop the actual form post !important!

        });
    });

	var uri = window.location.toString();
	if (uri.indexOf("?") > 0) {
	    var clean_uri = uri.substring(0, uri.indexOf("?"));
	    window.history.replaceState({}, document.title, clean_uri);
	}



    </script>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url(); ?>assets/js/creative.min.js"></script>


  </body>

</html>
