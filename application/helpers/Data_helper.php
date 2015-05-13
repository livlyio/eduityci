<?php

function secs_to_h($secs)
{
        $units = array(
                "wk"   => 7*24*3600,
                "day"    =>   24*3600,
                "hr"   =>      3600,
                "min" =>        60,
              //  "sec" =>         1,
        );

	// specifically handle zero
        if ( $secs == 0 ) return "0 seconds";

        $s = "";

        foreach ( $units as $name => $divisor ) {
                if ( $quot = intval($secs / $divisor) ) {
                        $s .= "$quot $name";
                        $s .= (abs($quot) > 1 ? "s" : "") . ", ";
                        $secs -= $quot * $divisor;
                }
        }

        return substr($s, 0, -2);
}

    function getquery($org = false, $unit = false, $code = false)
    {
        $out['org'] = $org ?: '0';
        $out['unit'] = $unit ?: '0';
        $out['code'] = $code ?: '0';
        //$out['code'] = isset($this->get->code) ?: '0';
        return $this->uri->assoc_to_uri($out);
    }

function make_menu($name,$items = false) {
   if (!$items) {
   return '';
   } else {
   $out =
   '<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">'. $name .'<b class="caret"></b></a>
              <ul class="dropdown-menu">';
              
    $c = count($items);
    $i = 1;
    
    foreach ($items as $item) {
        $out .= '<li><a href="'.$item['url'].'">'.$item['anchor'].'</a></li>'."\n";
        if ($i < $c) { $out .= '<li class="divider"></li>'."\n"; }
        $i++;
    }          
    $out .= '</ul>
            </li>';
   }
   return $out;
}

    function printTree($array,$child = '0'){
    $out = "<ul>\n";
    foreach($array as $item){
        if(is_array($item) && isset($item['unit_title'])){
                if(isset($item['children']) && is_array($item['children'])){
                    $out .= "<li><a href=\"". base_url() . 'user/organization/units/'. $item['unit_id'] ."\">".$item['unit_title']."</a>";
                    $out .= printTree($item['children'],'1');
                    $out .= "</li>\n";
                } else {
                    $out .= "<li><a href=\"". base_url() . 'user/organization/units/'. $item['unit_id'] ."\">".$item['unit_title']."</a></li>\n";
                }   
        }  
    }
    $out .= "</ul>\n\n";
    return $out;
    }

?>