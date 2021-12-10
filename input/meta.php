<?php
function oc_title() {
    global $config, $do;
    if ( isset($do) ) {
        $title	= ucwords( htmlspecialchars( $do ) ). ' | ' . $config->meta_title;
    }else{
	$title	= $config->meta_title;
    }
    return $title;			
}
function oc_description() {
    global $config, $do;
    if ( isset($do) ) {
        $title	= ucwords( htmlspecialchars( $do ) ) . ' ' . $config->meta_description;
    }else{
	$title	= $config->meta_description;
    }
    return $title;			
}
function seo_movie( $id, $query ) {
        global $config,$_ocim;
        if ( $config->seo == 'true' ):
                return $config->url . '/'.$config->url_movie.'/'.$id.'/'.$_ocim->permalink($query).'.html'; 
        else:
                return $config->url . '/?action=movie&id='.$id;
        endif;
}
function seo_tv( $id, $query ) {
        global $config,$_ocim;
        if ( $config->seo == 'true' ):
                return $config->url . '/'.$config->url_tv.'/'.$id.'/'.$_ocim->permalink($query).'.html'; 
        else:
                return $config->url . '/?action=tv&id='.$id;
        endif;
}
?>