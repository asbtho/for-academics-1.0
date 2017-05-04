<h1>View Publications</h1>

<?php

echo "<html>
		<head>
		</head>
		<body>
			<table class='widefat' id='table_id'>
			    <thead>
			        <tr>
			        	<th>ID</th>
			        	<th>Author(s)</th>
			            <th>Title</th>
			            <th>Type</th>
			            <th>Year</th>
			        </tr>
			    </thead>
			    <tbody>";

global $wpdb;

$publications = $wpdb->get_results(
	"
	SELECT * 
	FROM wp_pfa_storedpublicationids
	"
);

foreach ( $publications as $publications ){
	$id = $publications->pub_storedid;

	$data = $wpdb->get_results( 
		"
		SELECT pub_value
		FROM wp_pfa_publications
		WHERE pub_id=$id
		AND (pub_key='title' OR pub_key='type' OR pub_key='authors' OR pub_key='year');
		"
	);

	echo "<tr>";
	echo "<td>";
	echo $id;
	echo " - <a href='admin.php?page=pfa_edit&pub_id=".$id."'> Edit </a>";
	echo " - <a id='".$id."' class='openbibtex' href='#'> Bibtex </a>";
	echo "</td>";
	
	$counter = 1;
	foreach ( $data as $data ){
		if($counter = 3){
			echo "<td>".ucfirst($data->pub_value)."</td>";
		}else{
			echo "<td>".$data->pub_value."</td>";
		}
		$counter++;
	}
	echo "</tr>";
}

echo		"</tbody>
		</table>
	</body>
</html>";

//Load jquery dialog script
wp_enqueue_script('jquery-ui-dialog');

?>

<!-- DIV BOX AND SCRIPT FOR SHOWING BIBTEX FIELDS, also see functions.php-->
<div id="dialog" style="display: none">
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $(document).on('click', '.openbibtex', function() {
    	var dialogid = $(this).attr('id');
    	var data = {
			'action': 'my_action',
			'dialogid': dialogid 
		};

		$.post(ajaxurl, data, function(response) {
			var bibtex = response.replace(/(?:\r\n|\r|\n)/g, '<br />');
			$('#dialog').empty();
			$('#dialog').append(bibtex);
		});

        setTimeout(function(){
	    	$('#dialog').dialog()
	    }, 300)					
    });
});
</script>