
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="alert alert-block">
            <a class="close" data-dismiss="alert" href="#">×</a>
            <h4 class="alert-heading">What is Sports Social Rank?</h4>
            Sports Social Rank is a ranking of sports teams and players based on twitter followers being updated
            every 15 minutes.
          </br></br><em>Followers Today</em> is followers gained since 12:00 am central time of the current day
          </div>

          <div class="row">

<div class="row">
  <?php foreach ($categories as $category) {
    ?>

            <div class="col-lg-12 col-md-12">
                            <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title"><?php echo $category->name; ?></h4>
                </div>
                <div class="card-body table-responsive">
<?php   if ($category->name == "College Football") {
        $rank[1] = "cfb";
    }
    if ($category->name == "College Football") {
        $category->name = "cfb";
    }
    if ($category->name == "NFL Player") {
        $category->name = "nflplayer";
    }
    if ($category->name == "Premier League") {
        $category->name = "premierleague";
    }
    if ($category->name == "College Basketball") {
        $category->name = "collegebasketball";
    }
    if ($category->name == "FCS Football") {
        $category->name = "FCSFootball";
    } ?>
                  <table id="<?php echo $category->name; ?>-accounts" class="table table-striped " style="width:100%">
                  <thead>
                    <tr>
                      <th>Rank</th>



                      <th>Name</th>

                      <th>Followers</th>
                                        <th>Following</th>
                                                                  <th>Followers Today</th>



                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
                </div>

        </div>

              </div>  <?php
} ?>
      </div>
