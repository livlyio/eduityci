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

?>