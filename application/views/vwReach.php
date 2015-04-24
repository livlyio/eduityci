<?php
$this->load->view('vwHeader');
?>
<link href="<?php echo HTTP_CSS_PATH; ?>jumbotron.css" rel="stylesheet">

<div class="jumbotron">
      <div class="container">
        <h1>Just Livly!</h1>
        <p>Multi-Channel marketing that delivers results.</p>
        <p><a class="btn btn-primary btn-lg">Learn more &raquo;</a></p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-4">
          <h2>Professional</h2>
          <p>We employ an experienced team of marketing and IT professionals who work together to provide quality marketing solutions.    </p>
          <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
        </div>
        <div class="col-lg-4">
          <h2>Targeted</h2>
          <p>Livly is focused on results-driven programs.  Traffic is specifically targeted to maximize results while minimizing non-converting click throughs. </p>
          <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
       </div>
        <div class="col-lg-4">
          <h2>Reaching</h2>
          <p>Our proprietary multi-channel marketing platform reaches more than 1 Million users per day.</p>
          <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
        </div>
      </div>

      <hr>
<?php
$this->load->view('vwFooter');
?>