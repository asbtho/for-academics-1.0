<?php

//Add sidemenu 
function addMenu(){
	//home menu
	$page_title="For Academics";
	$menu_title="For Academics";
	$capability="administrator";
	$menu_slug="pfa_home";
	$function="draw_pfa_newpub";
	$icon_url=plugins_url() . "/for-academics/images/pfa_icon.png";
	add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);

	//add submenus
	add_submenu_page('pfa_home','','','administrator','pfa_home','draw_pfa_home'); // Used to hide duplicate top menu subpage
	
	//New publication
	$parent_slug="pfa_home";
	$page_title="New Publication";
	$menu_title="New Publication";
	$capability="administrator";
	$menu_slug="pfa_newpub";
	$function="draw_pfa_newpub";
	add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);

	//View publications
	$parent_slug="pfa_home";
	$page_title="View Publications";
	$menu_title="View Publications";
	$capability="administrator";
	$menu_slug="pfa_viewpub";
	$function="draw_pfa_viewpub";
	add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);

	//Authors
	//$parent_slug="pfa_home";
	//$page_title="Authors";
	//$menu_title="Authors";
	//$capability="administrator";
	//$menu_slug="pfa_authors";
	//$function="draw_pfa_authors";
	//add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);

	//Settings
	//$parent_slug="pfa_home";
	//$page_title="Settings";
	//$menu_title="Settings";
	//$capability="administrator";
	//$menu_slug="pfa_settings";
	//$function="draw_pfa_settings";
	//add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);

	//Add edit page
	$parent_slug="pfa_viewpub";
	$page_title="edit";
	$menu_title="edit";
	$capability="administrator";
	$menu_slug="pfa_edit";
	$function="draw_pfa_edit";
	add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
}

//Function for adding publication tables on activation, see ~/for-academics.php
function addTables(){
	global $wpdb;

	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE wp_pfa_publications (
	    pub_id varchar(32) NOT NULL,
	    pub_key varchar(32) NOT NULL,
	    pub_value varchar(128) NOT NULL,
	    CONSTRAINT pub_primarykey PRIMARY KEY(pub_id,pub_key)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

//Function for adding new table with integer AUTO INCREMENT for publication ID's
function addPubIdTable(){
	global $wpdb;

	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE wp_pfa_storedpublicationids (
	    pub_storedid int NOT NULL AUTO_INCREMENT,
	    PRIMARY KEY(pub_storedid)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

//Function for adding new publication, see ~/admin/newpub.php
function addNewPub(){
	global $wpdb;
	$field_array = ["np-title", "np-type","np-authors", "np-bibtexkey", "np-address", "np-booktitle", "np-chapter", "np-crossref", "np-edition", "np-editors", "np-howpublished", "np-institution", "np-journal", "np-key", "np-month", "np-note", "np-number", "np-organization", "np-pages", "np-publisher", "np-school", "np-series", "np-volume", "np-year"];

	$wpdb->insert( 'wp_pfa_storedpublicationids', array('pub_storedid' => 'DEFAULT') );
	$pub_id = $wpdb->insert_id;

	for ($i = 0; $i < count($field_array); $i++){
		if (isset($_POST[$field_array[$i]])){
			if ( $_POST[$field_array[$i]] != ""){
				$wpdb->insert( 
				'wp_pfa_publications', 
					array( 
						'pub_id' => $pub_id,
						'pub_key' => str_replace("np-", "", $field_array[$i]), 
						'pub_value' => $_POST[$field_array[$i]]
					)
				);
			}
		}
	}
}

//Function for adding new publication, see ~/admin/editpub.php
function editPub(){
	echo "";
}

//Function for getting values for a certain publication and storing them in $_SESSION, see ~/admin/edit.php
function getPubValues(){
	global $wpdb;

	$id = $_GET["pub_id"];

	$publication = $wpdb->get_results(
		"
		SELECT * 
		FROM wp_pfa_publications
		WHERE pub_id=$id
		"
	);

	foreach($publication as $publication){
		$_POST["np-".$publication->pub_key] = $publication->pub_value; 
	}
}

function getBibtexValues($id){
	global $wpdb;

	$publication = $wpdb->get_results(
		"
		SELECT * 
		FROM wp_pfa_publications
		WHERE pub_id=$id
		"
	);
	return $publication;
}

function parseBibtex($publication){
	$bibtex = "";
	$bibtexfields = "";
	foreach($publication as $publication){
		if ($publication->pub_key == "type"){
			$type = $publication->pub_value;
		}
		else if ($publication->pub_key == "key"){
			$key = $publication->pub_value;
		}
		else {
			$keyvalue = $publication->pub_key.' = "'.$publication->pub_value.'",'."\n"; 
			$bibtexfields .= $keyvalue;
		}
	}
	$bibtex .= "@".$type."{ ".$key.","."\n";
	$bibtex .= $bibtexfields;
	$bibtex = substr($bibtex, 0, -2) . " }";

	return $bibtex;
}

//function for generating bibtex text
function sendBibtex(){
	$id = $_POST['dialogid'];
	$publication = getBibtexValues($id);
	echo parseBibtex($publication);
	wp_die();
}
add_action( 'wp_ajax_my_action', 'sendBibtex' );

// FUNCTION FOR BIBTEX SHORTCODE IN POSTS FORMAT:
// [bibtex id=2] window=true for open text in new window
function bibtex_func( $atts ) {
    $a = shortcode_atts( array(
        'id' => 'bibtex ID not specified',
        'window' => 'false',
    ), $atts );

    $id = $a['id'];
    $window = $a['window'];
    $publication = getBibtexValues($id);
    $bibtex_text = nl2br(parseBibtex($publication));

    if($window == 'true'){
    	$uniqid = uniqid($id);
    	$htmlcode = "<a id='togglebibtex".$uniqid."' style='text-decoration: none' href='#'>[BIB]</a><br>
    		<div id='bibtex".$uniqid."' style='display: none'>
    		$bibtex_text
    		</div>
    		<script type='text/javascript'>
    		jQuery(document).ready(function($) {
    			$(document).on('click', '#togglebibtex".$uniqid."', function() {
    				var bibtext = document.getElementById('bibtex".$uniqid."').innerHTML;
    				var myWindow = window.open('','','width=400,height=400');
    				var doc = myWindow.document;
    				doc.open();
    				doc.write(bibtext);
    				doc.close();
    				return false;
    			});
			});
    		</script>";
    }else{
    	$uniqid = uniqid($id);
    	$htmlcode = "<a id='togglebibtex".$uniqid."' style='text-decoration: none' href='#'>[BIB]</a><br>
    		<div id='bibtex".$uniqid."' style='display: none'>
    		$bibtex_text
    		</div>
    		<script type='text/javascript'>
    		jQuery(document).ready(function($) {
    			$(document).on('click', '#togglebibtex".$uniqid."', function() {
    				$('#bibtex".$uniqid."').toggle();
    				return false;
    			});
			});
    		</script>";
    }
    return $htmlcode;
}
add_shortcode( 'bibtex', 'bibtex_func' );

// FUNCTION FOR BIBTEX LIST SHORTCODE IN POSTS FORMAT:
// [bibtex-list id=2 values=type,authors,title]
function bibtex_list_func( $atts ) {
    $a = shortcode_atts( array(
        'id' => 'bibtex ID not specified',
        'values' => 'No list values specified',
        'finish' => 'false',
        'window' => 'false',
    ), $atts );
    $id = $a['id'];
    $window = $a['window'];
    $finish = $a['finish'];
    $values = explode(",",$a["values"]);
    $htmlcode ='<ul style="list-style-type:disc">
    				<li>';

    if ($values[0] == "No list values specified"){
    	$htmlcode .= 'No list values specified</li></ul>';
    }else{
    	$publication = getBibtexValues($id);
	    foreach($values as $value){
	    	foreach($publication as $publicationrow){
	    		if ($publicationrow->pub_key == $value){
	    			if ($value == "authors"){
	    				$htmlcode .= '<span style="text-decoration: underline;">'.$publicationrow->pub_value . '</span>, ';
	    			} else if ($value == "title"){
	    				$htmlcode .= '<b>'.$publicationrow->pub_value . '</b>, ';
	    			} else if ($value == "type"){
	    				$htmlcode .= ucfirst($publicationrow->pub_value).', ';
	    			}else{
	    				$htmlcode .= $publicationrow->pub_value . ', ';
	    			}
	    		}
	   		}
	   		unset($publicationrow);
	    }
	    unset($value);
	    $htmlcode = substr($htmlcode, 0, -2) . ".<br/>";
	    $htmlcode .= bibtex_func(array( 'id' => $id, 'window' => $window)) . '</li>';
	    if($finish == 'true'){
	    	$htmlcode .= '</ul>';
	    }
    }
    return $htmlcode;
}
add_shortcode( 'bibtex-list', 'bibtex_list_func' );

// FUNCTION FOR BIBTEX TABLE SHORTCODE IN POSTS FORMAT:
// [bibtex-table id=2,3,4 values=type,title,authors]
function bibtex_table_func( $atts ) {
    $a = shortcode_atts( array(
        'id' => 'bibtex ID not specified',
        'values' => 'No table values specified',
    ), $atts );

    $id = explode(',',$a['id']);
    $values = explode(",",$a["values"]);
    $htmlcode ='<table>';
    if ($values[0] == "No table values specified"){
    	$htmlcode .= '<td>No table values specified</td></table>';
    }else{
    	$htmlcode .= '<thead><tr>';
    	foreach ($values as $value){
    		$htmlcode .= '<th>'.ucfirst($value).'</th>';
    	}
    	unset($value);
    	$htmlcode .= '<th>[BIB]</th>';
    	$htmlcode .= '</tr></thead><tbody>';
    	foreach ($id as $currentid){
    		$htmlcode .= '<tr>';
    		$publication = getBibtexValues($currentid);
    		foreach($values as $value){
    			foreach ($publication as $publicationrow){
    				if($publicationrow->pub_key == $value){
    					if ($publicationrow->pub_key == 'type'){
    						$htmlcode .= '<td>'.ucfirst($publicationrow->pub_value).'</td>';
    					}else{
    						$htmlcode .= '<td>'.$publicationrow->pub_value.'</td>';
    					}
    				}
    			}
    			unset($publicationrow);
    		}
    		unset($value);
    		$htmlcode .= '<td>'.bibtex_func(array( 'id' => $currentid, 'window' => 'true')).'</td>';
    		$htmlcode .= '</tr>';
    	}
    	unset($currentid);
    	$htmlcode .= '</tbody></table>';
    }
    return $htmlcode;
}
add_shortcode( 'bibtex-table', 'bibtex_table_func' );

// FUNCTION FOR DYNAMIC BIBTEX TABLE SHORTCODE IN POSTS FORMAT:
// [dynamic-bibtex-table id=2,3,4 values=type,title,authors sortby=title,year]
function dyn_bibtex_table_func( $atts ) {
    $a = shortcode_atts( array(
        'id' => 'bibtex ID not specified',
        'values' => 'No table values specified',
        'sortby' => 'none',
    ), $atts );

    $id = explode(',',$a['id']);
    $sortby = explode(",",$a['sortby']);
    $values = explode(",",$a["values"]);
    $divid = uniqid('dyntable');
    $htmlcode ='<div id="'.$divid.'"><input class="search" placeholder="Search" />';
    if ($values[0] == "No table values specified"){
    	$htmlcode .= '<td>No table values specified</td></table>';
    }else{
    	if(!($sortby == 'none')){
    		$sorts = array_unique($values);
	    	foreach ($sorts as $sort) {
	    		if(in_array($sort, $sortby)){
	    			$htmlcode .= '<button class="sort" data-sort="'.$sort.'">Sort by '.$sort.'</button>';
	    		}
	    	}
	    	unset($sort);
    	}
    	$htmlcode .= '<table>';
    	$htmlcode .= '<thead><tr>';
    	foreach ($values as $value){
    		$htmlcode .= '<th>'.ucfirst($value).'</th>';
    	}
    	unset($value);
    	$htmlcode .= '<th>[BIB]</th>';
    	$htmlcode .= '</tr></thead><tbody class="list">';
    	foreach ($id as $currentid){
    		$htmlcode .= '<tr>';
    		$publication = getBibtexValues($currentid);
    		foreach($values as $value){
    			foreach ($publication as $publicationrow){
    				if($publicationrow->pub_key == $value){
    					if ($publicationrow->pub_key == 'type'){
    						$htmlcode .= '<td class="'.$publicationrow->pub_key.'">'.ucfirst($publicationrow->pub_value).'</td>';
    					}else{
    						$htmlcode .= '<td class="'.$publicationrow->pub_key.'">'.$publicationrow->pub_value.'</td>';
    					}
    				}
    			}
    			unset($publicationrow);
    		}
    		unset($value);
    		$htmlcode .= '<td>'.bibtex_func(array( 'id' => $currentid, 'window' => 'true')).'</td>';
    		$htmlcode .= '</tr>';
    	}
    	unset($currentid);
    	$htmlcode .= '</tbody></table></div>
    	<script type="text/javascript">
    	jQuery(document).ready(function($) {
    		var options = {valueNames: [';
    	foreach ($values as $value){
    		$htmlcode .= "'".$value."',";
    	}
    	unset($value);
    	$htmlcode = substr($htmlcode, 0, -1);
		$htmlcode .= ']};
			var userList = new List("'.$divid.'", options);
		});
    	</script>';
    }
    return $htmlcode;
}
add_shortcode( 'dynamic-bibtex-table', 'dyn_bibtex_table_func' );

?>

