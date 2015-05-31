{include file="user/header.tpl" title="Eduity" name="$Name"}

{$topnav}

{$sidebar}


     <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Timeline
            <small>example</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">UI</a></li>
            <li class="active">Timeline</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
{$page_content|default:'No Updates'}
</div>
  
    
{include file="user/footer.tpl"}