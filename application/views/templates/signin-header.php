       <?php
			if(!empty($css))
			{
				foreach($css as $cssfile)
				{
					echo "<link rel='stylesheet' href='";echo base_url()."css/$cssfile' type='text/css' />";
				}
			}
			if(!empty($scripts))
			{
				foreach($scripts as $script)
				{
					echo "<script type='text/javascript' src='";echo base_url()."js/$script'></script>";
				}
			}
		?>