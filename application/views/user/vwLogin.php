<?php
$arr['css'] = '<link href="'. HTTP_CSS_PATH .'signin.css" rel="stylesheet">';
$this->load->view('vwHeader',$arr);
?>
    <div id="hero" class="static-header clearfix">
    <div class="container">
    <div class="row">
        <div class="text-heading col-sm-6" style="margin-top:100px;">
        <form class="form-signin panel" method="post" action="<?php echo base_url(); ?>user/home/do_login">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="form-control" placeholder="Username" name="username" autofocus>
        <input type="password" class="form-control" placeholder="Password" name="password">
        <label class="checkbox">
          <input type="checkbox" value="remember-me">Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
         
            	<ul class="list-inline">
                	<li><a href="<?php echo base_url('user/register'); ?>" class="btn btn-primary animated hiding" data-animation="bounceIn" data-delay="700">Get started</a></li>
				</ul>
        </div>
        <div class="main-image">
            
                <img src="assets/img/features/lady.png" alt="video" class="img-responsive animated hiding" data-animation="fadeInRight" data-delay="1000" />

        </div>
    </div>
    </div>
    </div>

<?php
$this->load->view('vwFooter');
?>