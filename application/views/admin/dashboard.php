
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">

          <div class="row">

<div class="row">
  <?php foreach ($categories as $category) {
    ?>

            <div class="col-lg-6 col-md-6">
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

                      <th>+/-</th>


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
