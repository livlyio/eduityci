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
  <h1><small>Links</small></h1>
</div>
    <div class="container">
 
 <div class="panel panel-default" >
        <!-- Default panel contents -->
        <div class="panel-heading">Links List <span style='float:right; margin-top: -7px;'><a href="<?php echo base_url('admin/redirects/add'); ?>" class="btn btn-info">Add Link</a></span></div>

        <!-- Table -->
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Category</th>
              <th>Alias</th>
              <th>URL</th>
              <th>User</th>
              <th>Created</th>
              <th>Operations</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($list as $row) { ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['category']; ?></td>
              <td><a href="http://livly.io/<?php echo $row['alias']; ?>" target="_blank">http://livly.io/<?php echo $row['alias'] ?></a></td>
              <td><a href="<?php echo $row['url']; ?>" target="_blank"><?php echo $row['url']; ?></a></td>
              <td><?php echo $row['user']; ?></td>
              <td><?php echo $row['created']; ?></td>
              <td>
                  <a href='#' title='View'> <i class="fam-zoom"></i></a>
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