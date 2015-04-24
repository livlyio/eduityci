<?php
$this->load->view('admin/vwHeader');
?>
<link href="<?php echo HTTP_CSS_PATH; ?>starter-template.css" rel="stylesheet">
 <style>
/*     .panel{
       margin-left: 55px;
       float: left;
    width: 500px;}
     */
     </style>
<div class="page-header container">
  <h1><small>Twitter Accounts</small></h1>
</div>
    <div class="container">
 
 <div class="panel panel-default" >
        <!-- Default panel contents -->
        <div class="panel-heading">Accounts List <span style='float:right; margin-top: -7px;'><a href="<?php echo base_url('admin/twitter/add_acct'); ?>" class="btn btn-info">Add Account</a></span></div>

        <!-- Table -->
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Niche</th>
              <th>Username</th>
              <th>Sex</th>
              <th>Email</th>
              <th>Password</th>
              <th>Operations</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($list as $row) { ?>
            <tr>
              <td><?php echo $row['acct_id']; ?></td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['niche']; ?></td>
              <td><a href="http://www.twitter.com/<?php echo $row['username']; ?>">@<?php echo $row['username']; ?></a></td>
              <td><?php echo $row['sex']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['password']; ?></td>
              <td>
                  <a href="<?php echo base_url() . 'admin/twitter/view_acct/' . $row['acct_id']; ?>" title='View'> <i class="fam-zoom"></i></a>
                 <a href='#' title='Edit'><i class="fam-user-edit"></i></a>
                 <a href='#' title='Block'><i class="fam-user-gray"></i></a>
                 <a href='#' title='Delete'><i class="fam-user-delete"></i></a>
              </td>
            </tr>
            <?php } ?>
            </table>
            </div>
            </div>
            
        <?php echo $pages; ?>
<!-- /.container -->
     <hr>
<?php
$this->load->view('admin/vwFooter');
?>