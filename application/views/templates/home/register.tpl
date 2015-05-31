{include file="home/header.tpl" title="Eduity" name="$Name"}


	<section id="team" class="section dark">
        <div class="container">
            <div class="section-header animated hiding col-sm-8 col-sm-offset-2" data-animation="fadeInDown">
                <h2><span class="highlight">Account Registration</span></h2>
                {if isset($message)}
                <div class="subheading">
                <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                {$message}
                </div>
                </div>
                {/if}
				<div class="sub-heading">
                    {$page_content|default:'No Content Defined.'}
                </div>




</div> 

</div>
</div>

{include file="home/footer.tpl"}
