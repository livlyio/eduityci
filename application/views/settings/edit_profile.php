<div class="container">
  <div class="row">

    <!-- edit form column -->
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
      <div class="alert alert-info alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a> 
        <i class="fa fa-coffee"></i>
        <?php echo $this->session->flashdata('status'); ?>
      </div>
      <h3>Personal info</h3>
              
        
    	<form class="form-horizontal"id="personal-settings" method="post" enctype="multipart/form-data" action="<?php echo base_url('account/personal-settings'); ?>">
 

        <div class="form-group">
          <label class="col-lg-3 control-label">Display Name:</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" name="dis_name" value="<?php echo $display_name; ?>" id="dis_name" />
          </div>
        </div>
       <!-- <div class="form-group">
          <label class="col-lg-3 control-label">Company:</label>
          <div class="col-lg-8">
            <input class="form-control" value="" type="text">
          </div>
        </div>-->
        <div class="form-group">
          <label class="col-lg-3 control-label">Email:</label>
          <div class="col-lg-8">
            <input class="form-control" value="<?php echo $user_email; ?>" type="text">
          </div>
        </div>
        <div class="form-group">
                	<label class="col-lg-3 control-label" for="gender">Gender</label>
                    <div class="col-lg-8">
                	<select  name="gender" value="<?php echo $basic_details['gender']; ?>" >
                    <?php 
						if($basic_details['gender'] == "male")
						{
							$male = TRUE;
						}
						else if($basic_details['gender'] == "female")
						{
							$female = TRUE;
						}
						else
						{
							$select = TRUE;
						}
					?>
                    
                	<option value="male" <?php if($basic_details['gender'] == "male") echo 'selected="selected"'?> >Male</option>
                    <option value="female" <?php if($basic_details['gender'] == "female")echo 'selected="selected"'?>>Female</option>
                    <option value="" <?php if($basic_details['gender'] == "") echo 'selected="selected"'?>></option>
                	</select>
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-3 control-label" for="dob">Date of birth</label>
                    <div class="col-lg-8">
                	<input  id="datepicker" readonly="readonly" name="dob" value="<?php echo $basic_details['dob']; ?>" />
                    </div>
                </div>   
                <div class="form-group">
                	<label class="col-lg-3 control-label" for="about">About Me</label>
                    <div class="col-lg-8">
                    <textarea cols="45" rows="3" id="about" name="about"><?php echo $basic_details['about_me']; ?></textarea>
                    <span class="exceed"></span>
                    </div>
                </div>          
        
        
        <div class="form-group">
          <label class="col-lg-3 control-label">Time Zone:</label>
          <div class="col-lg-8">
            <div class="ui-select">
              <select id="user_time_zone" class="form-control">
                <option value="Hawaii">(GMT-10:00) Hawaii</option>
                <option value="Alaska">(GMT-09:00) Alaska</option>
                <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                <option value="Arizona">(GMT-07:00) Arizona</option>
                <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                <option value="Central Time (US &amp; Canada)" selected="selected">(GMT-06:00) Central Time (US &amp; Canada)</option>
                <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Username:</label>
          <div class="col-md-8">
            <input class="form-control" type="text" name="user_name" value="<?php echo $user_name; ?>" id="user_name"  />
            <?php  echo form_error('user_name','<li class="error" id="uerror">', '</li>'); ?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Password:</label>
          <div class="col-md-8">
            <input class="form-control" value="11111122333" type="password">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Confirm password:</label>
          <div class="col-md-8">
            <input class="form-control" value="11111122333" type="password">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="col-md-8">
            <input class="btn btn-primary" value="Save Changes" type="submit">
            <span></span>
            <input class="btn btn-default" value="Cancel" type="reset">
          </div>
        </div>
      </form>
    </div>
        <!-- left column -->
           	<form class="form-horizontal"id="personal-settings" method="post" enctype="multipart/form-data" action="<?php echo base_url('account/personal-settings/do_upload'); ?>">

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="text-center">
        <img src="http://localhost/uploads/photos/<?php echo $profile_pic; ?>" class="avatar img-circle img-thumbnail" alt="avatar">
        
  
      <h4 class="section-header section-header-toggle">Upload New Document</h4>

      <p class="section-instruction collapse">Upload a new document for review.</p>
      
      <div class="form-group">
        <label for="fileSelect" class="col-sm-2 control-label">* Select</label>
        <div class="col-sm-10">
          <input id="fileSelect" type="file" name="userfile" />
        </div>
      </div>    
      
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button class="btn btn-primary btn-xs" type="submit"><span class="glyphicon glyphicon-cloud-upload"></span> UPLOAD</button>
          <button class="btn btn-default btn-xs" type="button"><span class="glyphicon glyphicon-remove-circle"></span> CANCEL</button>
        </div>
      </div>                     
    </li>
</ul></div>        
        
     </div>
    </div>
  </div>
</form>

