<h1>New Publication</h1>


<table class="widefat">
	<td>
		<!--<?php echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">'; ?>-->
		<form action="#" method="post">	
			<p>Type <br />
				<select name="np-type" id="np-type">
				  <option value="article">Article</option>
				  <option value="book">Book</option>
				  <option value="booklet">Booklet</option>
				  <option value="conference">Conference</option>
				  <option value="inbook">Inbook</option>
				  <option value="incollection">Incollection</option>
				  <option value="inproceedings">Inproceedings</option>
				  <option value="manual">Manual</option>
				  <option value="mastersthesis">Mastersthesis</option>
				  <option value="misc">Misc</option>
				  <option value="phdthesis">PhD Thesis</option>
				  <option value="proceedings">Proceedings</option>
				  <option value="techreport">Techreport</option>
				  <option value="unpublished">Unpublished</option>
				</select> 
			</p>
			<p id="np-title">Title <br />
				<input type="text" name="np-title" id="np-title" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-title"] ) ? esc_attr( $_POST["np-title"] ) : '') . '"'; ?> >
			</p>
			<p id="np-authors">Author(s) <br />
				<input type="text" name="np-authors" id="np-authors" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-authors"] ) ? esc_attr( $_POST["np-authors"] ) : '') . '"'; ?> >
			</p>
			<p id="np-bibtexkey">BibTex Key <br />
				<input type="text" name="np-bibtexkey" id="np-bibtexkey" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-bibtexkey"] ) ? esc_attr( $_POST["np-bibtexkey"] ) : '') . '"'; ?> >
			</p>
			<p id="np-address">Address<br />
				<input type="text" name="np-address" id="np-address" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-address"] ) ? esc_attr( $_POST["np-address"] ) : '') . '"'; ?> >
			</p>
			<p id="np-booktitle">Book Title<br />
				<input type="text" name="np-booktitle" id="np-booktitle" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-booktitle"] ) ? esc_attr( $_POST["np-booktitle"] ) : '') . '"'; ?> >
			</p>
			<p id="np-chapter">Chapter<br />
				<input type="text" name="np-chapter" id="np-chapter" pattern="[0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-chapter"] ) ? esc_attr( $_POST["np-chapter"] ) : '') . '"'; ?> >
			</p>
			<p id="np-crossref">Crossref<br />
				<input type="text" name="np-crossref" id="np-crossref" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-crossref"] ) ? esc_attr( $_POST["np-crossref"] ) : '') . '"'; ?> >
			</p>
			<p id="np-edition">Edition<br />
				<input type="text" name="np-edition" id="np-edition" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-edition"] ) ? esc_attr( $_POST["np-edition"] ) : '') . '"'; ?> >
			</p>
			<p id="np-editors">Editor(s)<br />
				<input type="text" name="np-editors" id="np-editors" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-editors"] ) ? esc_attr( $_POST["np-editors"] ) : '') . '"'; ?> >
			</p>
			<p id="np-howpublished">howpublished<br />
				<input type="text" name="np-howpublished" id="np-howpublished" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-howpublished"] ) ? esc_attr( $_POST["np-howpublished"] ) : '') . '"'; ?> >
			</p>
			<p id="np-institution">Institution<br />
				<input type="text" name="np-institution" id="np-institution" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-institution"] ) ? esc_attr( $_POST["np-institution"] ) : '') . '"'; ?> >
			</p>
			<p id="np-journal">Journal<br />
				<input type="text" name="np-journal" id="np-journal" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-journal"] ) ? esc_attr( $_POST["np-journal"] ) : '') . '"'; ?> >
			</p>
			<p id="np-key">Key<br />
				<input type="text" name="np-key" id="np-key" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-key"] ) ? esc_attr( $_POST["np-key"] ) : '') . '"'; ?> >
			</p>
			<p id="np-month">Month<br />
				<input type="text" name="np-month" id="np-month" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-month"] ) ? esc_attr( $_POST["np-month"] ) : '') . '"'; ?> >
			</p>
			<p id="np-note">Note<br />
				<textarea rows="3" cols="50" name="np-note" id="np-note"></textarea>
			</p>
			<p id="np-number">Number<br />
				<input type="text" name="np-number" id="np-number" pattern="[0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-number"] ) ? esc_attr( $_POST["np-number"] ) : '') . '"'; ?> >
			</p>
			<p id="np-organization">Organization<br />
				<input type="text" name="np-organization" id="np-organization" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-organization"] ) ? esc_attr( $_POST["np-organization"] ) : '') . '"'; ?> >
			</p>
			<p id="np-pages">Pages<br />
				<input type="text" name="np-pages" id="np-pages" pattern="[0-9,-]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-pages"] ) ? esc_attr( $_POST["np-pages"] ) : '') . '"'; ?> >
			</p>
			<p id="np-publisher">Publisher<br />
				<input type="text" name="np-publisher" id="np-publisher" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-publisher"] ) ? esc_attr( $_POST["np-publisher"] ) : '') . '"'; ?> >
			</p>
			<p id="np-school">School<br />
				<input type="text" name="np-school" id="np-school" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-school"] ) ? esc_attr( $_POST["np-school"] ) : '') . '"'; ?> >
			</p>
			<p id="np-series">Series<br />
				<input type="text" name="np-series" id="np-series" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-series"] ) ? esc_attr( $_POST["np-series"] ) : '') . '"'; ?> >
			</p>
			<p id="np-volume">Volume<br />
				<input type="text" name="np-volume" id="np-volume" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-volume"] ) ? esc_attr( $_POST["np-volume"] ) : '') . '"'; ?> >
			</p>
			<p id="np-year">Year<br />
				<input type="text" name="np-year" id="np-year" pattern="[a-zA-Z0-9 ]+" size="50" value=<?php echo '"' . ( isset( $_POST["np-year"] ) ? esc_attr( $_POST["np-year"] ) : '') . '"'; ?> >
			</p>
			<p id="np-textarea">Textarea<br />
				<textarea rows="10" cols="50" name="np-textarea" id="textarea"></textarea>
			</p>
			<p><input type="submit" name="np-submitted" value="Save publication"></p>
		</form>
	</td>
</table>


<?php
function display()
{
    echo "Submitted ".$_POST["np-title"]."<br/>";
}

if(isset($_POST['np-submitted']))
{
   display();
   addNewPub();
} 

wp_enqueue_script('jquery');

?>

<script type="text/javascript">

//Filter function based on type select
jQuery(document).ready(function($) {
	showFields();
	$("#np-type").change(function(){
		showFields();
	});
	function showFields(){
		$("select option:selected").each(function(){
			if ($(this).attr("value")=="article"){
				$("[id^='np-']").hide();
				$("#np-type, #np-authors, #np-title, #np-journal, #np-year, #np-volume").show();	//required	
				$("#np-number, #np-pages, #np-month, #np-note, #np-key").show(); //optional		
			}
			if ($(this).attr("value")=="book"){
				$("[id^='np-']").hide();
				$("#np-type, #np-authors, #np-editors, #np-title, #np-publisher, #np-year").show();	//required
				$("#np-volume, #np-number, #np-series, #np-address, #np-edition, #np-month, #np-note, #np-key").show();	//optional
			}
			if ($(this).attr("value")=="booklet"){
				$("[id^='np-']").hide();
				$("#np-type, #np-title").show();	//required
				$("#np-authors, #np-howpublished, #np-address, #np-month, #np-year, #np-note, #np-key").show();	//optional
			}
			if ($(this).attr("value")=="conference"){
				$("[id^='np-']").hide();
				$("#np-type, #np-authors, #np-title, #np-booktitle, #np-year").show();	//required
				$("#np-edition, #np-volume, #np-number, #np-series, #np-pages, #np-address, #np-month, #np-organization, #np-publisher, #np-note, #np-key").show();	//optional
			}
			if ($(this).attr("value")=="inbook"){
				$("[id^='np-']").hide();
				$("#np-type, #np-authors, #np-editors, #np-title, #np-chapter, #np-pages, #np-publisher, #np-year").show();	//required
				$("#np-volume, #np-number, #np-series, #np-type, #np-address, #np-edition, #np-month, #np-note, #np-key").show();	//optional
			}
			if ($(this).attr("value")=="incollection"){
				$("[id^='np-']").hide();
				$("#np-type, #np-authors, #np-title, #np-booktitle, #np-year").show();	//required
				$("#np-editors, #np-volume, #np-number, #np-series, #np-type, #np-chapter, #np-pages, #np-address, #np-edition, #np-month, #np-note, #np-key").show();	//optional
			}
			if ($(this).attr("value")=="inproceedings"){
				$("[id^='np-']").hide();
				$("#np-type, #np-authors, #np-title, #np-booktitle, #np-year").show();	//required
				$("#np-edition, #np-volume, #np-number, #np-series, #np-pages, #np-address, #np-month, #np-organization, #np-publisher, #np-note, #np-key").show();	//optional
			}
			if ($(this).attr("value")=="manual"){
				$("[id^='np-']").hide();
				$("#np-type, #np-title").show();	//required
				$("#np-authors, #np-organization, #np-address, #np-edition, #np-month, #np-year, #np-note, #np-key").show();	//optional
			}
			if ($(this).attr("value")=="mastersthesis"){
				$("[id^='np-']").hide();
				$("#np-type, #np-title, #np-authors, #np-school, #np-year").show();	//required
				$("#np-address, #np-month, #np-note, #np-key").show();	//optional
			}
			if ($(this).attr("value")=="misc"){
				$("[id^='np-']").hide();
				$("#np-type").show();	//required
				$("#np-authors, #np-title, #np-howpublished, #np-month, #np-year, #np-note, #np-key").show();	//optional
			}
			if ($(this).attr("value")=="phdthesis"){
				$("[id^='np-']").hide();
				$("#np-type, #np-authors, #np-title, #np-school, #np-year").show();	//required
				$("#np-address, #np-month, #np-note, #np-key").show();	//optional
			}
			if ($(this).attr("value")=="proceedings"){
				$("[id^='np-']").hide();
				$("#np-type, #np-title, #np-year").show();	//required
				$("#np-editors, #np-volume, #np-number, #np-series, #np-address, #np-month, #np-publisher, #np-organization, #np-note, #np-key").show();	//optional
			}
			if ($(this).attr("value")=="techreport"){
				$("[id^='np-']").hide();
				$("#np-type, #np-authors, #np-title, #np-institution, #np-year").show();	//required
				$("#np-address, #np-number, #np-month, #np-note, #np-key").show();	//optional
			}
			if ($(this).attr("value")=="unpublished"){
				$("[id^='np-']").hide();
				$("#np-type, #np-title, #np-authors, #np-note").show();	//required
				$("#np-month, #np-year, #np-key").show();	//optional
			}
		});
	}
});


</script>