{include file="user/header.tpl" title="Eduity" name="$Name"}

{$topnav}

{$sidebar}

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            {$page_title|default:''}
            <small>{$page_sub_title|default:''}</small>
          </h1>
          <ol class="breadcrumb">
          {if isset($crumbs)}<small>{$crumbs}</small>{/if}
          <br />
          {if isset($heading)}<h1><small>{$heading}</small></h1>{/if}
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">{$box_title|default:''}</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              {$page_content}
            </div><!-- /.box-body -->

      
{include file="user/footer.tpl"}