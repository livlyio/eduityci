{include file="home/header.tpl" title="Eduity" name="$Name"}

    <div id="hero" class="static-header clearfix">
    <div class="container">
    <div class="row">
        <div class="text-heading col-sm-6" style="margin-top:100px;">
        <form class="form-signin panel" method="post" action="{#base_url#}/auth/login">	
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="form-control" placeholder="Username" name="login_identity" id="identity" autofocus />
        <input type="password" class="form-control" placeholder="Password" name="login_password" id="password" />
        <label class="checkbox">
        <input type="checkbox" id="remember_me" name="remember_me" value="1" />Remember Me
        </label>
        <button class="btn btn-lg btn-primary btn-block" name="login_user" id="submit" value="Submit" type="submit">Sign in</button>
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
  
{include file="home/footer.tpl"}
