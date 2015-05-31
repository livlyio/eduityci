<?php

class script {
    
    
    function output()
    {
        $out = '<!-- Dynamically Inserted Scripts -->'."\r\n";
        
        foreach ($this->js as $js) {
            $out .= '<script type="text/javascript" src="'. $js .'"></script>'."\r\n";
        }
        
        foreach ($this->css as $css) {
            $out .= '<link rel="stylesheet" href="'. $css .'" type="text/css" media="all" />'."\r\n";
        }
        
        $out .= '<!-- End Dynamic Scripts -->'."\r\n";
        
        echo $out;
    }
    
    function sortable()
    {
        $this->css[] = '';
        $this->js[] = "http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js";
        $this->js[] = "http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js";
        $this->output();

    }
    
    function editable()
    {
        $this->js[] = "http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/js/bootstrap-editable.min.js";
        $this->css[] = "http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css";
        $this->output();
    }
    
    
    
    
    
    
    
    
    
    
}
















?>