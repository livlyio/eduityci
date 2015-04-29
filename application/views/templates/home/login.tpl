{include file="home/header.tpl" title="Eduity" name="$Name"}

    <div id="hero" class="static-header clearfix">
    <div class="container">
    <div class="row">
        <div class="text-heading col-sm-6">
            <div style="width:500px;height:400px;background-color:#FFF;">
            
            				<form method="post" action="{$smarty.const.BASE_URL}/auth/login" />	
					<fieldset class="w50 parallel_target">
						<legend>Registered Users</legend>
						<ul>
							<li>
								<label for="identity">Email or Username:</label>
								<input type="text" id="identity" name="login_identity" value="" class="tooltip_parent"/>
					
							</li>
							<li>
								<label for="password">Password:</label>
								<input type="password" id="password" name="login_password" value=""/>
							</li>
					
							<li>
								<label for="remember_me">Remember Me:</label>
								<input type="checkbox" id="remember_me" name="remember_me" value="1" />
							</li>
							<li>
								<label for="submit">Login:</label>
								<input type="submit" name="login_user" id="submit" value="Submit" class="link_button large"/>
							</li>
							<li>
								<small>Note: On this demo, 3 failed login attempts will raise security on the account, activating a 10 second time limit ban per login attempt (20 secs after 9+ attempts), and activation of a captcha that must be completed to login.</small> 
							</li>
							<li>
								<hr/>
								<a href="<?php echo $base_url;?>auth/forgotten_password">Reset Forgotten Password</a>
							</li>
							<li>
								<a href="<?php echo $base_url;?>auth/resend_activation_token">Resend Account Activation Token</a>
							</li>
						</ul>
					</fieldset>

					<fieldset class="w50 r_margin parallel_target">
						<legend>New Users</legend>
						<ul>
							<li>
								New users can register for an account.
							</li>
							<li>
								<hr/>
								<a href="<?php echo $base_url;?>auth/register_account" class="link_button large">Register New Account</a>
							</li>
						</ul>
					</fieldset>
				</form>
			</div>
		</div>
	</div>	
            
            </div>
            
        </div>
        <div class="main-image">
            
                <img src="assets/img/features/lady.png" alt="video" class="img-responsive animated hiding" data-animation="fadeInRight" data-delay="1000" />

        </div>
    </div>
    </div>
    </div>
  
{include file="home/footer.tpl"}
