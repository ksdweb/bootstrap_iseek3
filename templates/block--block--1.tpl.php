<style type="text/css">
tbody > tr > td {
	font-size: small;
}
.gcd_pagination {
	text-align: center;
}	
.dutyStationBtn {
	margin: 2px 4px;
}
.modal-header .input-group, .modal-title {
	margin-bottom: 10px;
}
.btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active {

} 
.loading {
	opacity: 0.3;
}
.modal-body {
	padding-top: 0;
}
.modal-body table {
	table-layout: fixed;
	word-wrap: break-word;
}
</style>


<?php

/**
 * @file
 * Default theme implementation to display a block.
 *
 * Available variables:
 * - $block->subject: Block title.
 * - $content: Block content.
 * - $block->module: Module that generated the block.
 * - $block->delta: An ID for the block, unique within each module.
 * - $block->region: The block region embedding the current block.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - block: The current template type, i.e., "theming hook".
 *   - block-[module]: The module generating the block. For example, the user
 *     module is responsible for handling the default user navigation block. In
 *     that case the class would be 'block-user'.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Helper variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $block_zebra: Outputs 'odd' and 'even' dependent on each block region.
 * - $zebra: Same output as $block_zebra but independent of any block region.
 * - $block_id: Counter dependent on each block region.
 * - $id: Same output as $block_id but independent of any block region.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 * - $block_html_id: A valid HTML ID and guaranteed unique.
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 * @see template_process()
 *
 * @ingroup themeable
 */
 
$iseekFields = array(
	'title' => 'Title',
     'lastName' => 'Last name',
     'firstName' => 'First name',
     'email' => 'E-mail',
     'phoneDisplay1' => 'Phone',
     'dutyStation' => 'Duty station',
     'building' => 'Building',
     'room' => 'Room',
     'organizationalUnit' => 'Org unit');
 
?>

<script type="text/javascript">

	// var solrUrl = "http://intra-srch.un.org/solr/iseek/spell";
	// var solrUrl = "https://iseek:d6jAXEchEfr6nuCh@nyvm1482.stc.un.org:7984/solr/iseek/spell";

	var solrGcdUrl = "/solr-gcd-output";

	
	
	jQuery(document).ready(function() {
	
		// submitSearch();

/*		
		jQuery("a").click(function(e){
			 e.preventDefault(); 
		 });
*/
		jQuery('#searchSimpleInput').keypress(function (e) {
	
		  if (e.which == 13) {
  		    // console.log('searchSimpleInput keypress enter 3aa');

			submitSearch(jQuery("#searchSimpleInput").val(), 0, "", "", "", 0);

  		    // console.log('searchSimpleInput keypress enter 3bb');

			jQuery("#searchSimpleInputInModal").val(jQuery("#searchSimpleInput").val());

			jQuery('#myModal').modal('toggle');
			
			return false;

		  }
		});
		 
		 
		
		jQuery('#searchSimpleInputInModal').keypress(function (e) {
	
		  if (e.which == 13) {
  		    // console.log('searchSimpleInputInModal keypress enter 3aa');

			submitSearch(jQuery("#searchSimpleInputInModal").val(), 0, "", "", "", returnExact());

  		    // console.log('searchSimpleInputInModal keypress enter 3bb');

			return false;

		  }
		});



/*
		// pagination from the modal	
		jQuery(".pagination_link").click(function(){
			alert("pagination_link1");
			// event.preventDefault();
			
			// submitSearch(jQuery("#searchSimpleInputInModal").val(), jQuery(this).attr("href"));
			// jQuery("#searchSimpleInputInModal").val(jQuery("#searchSimpleInput").val());
			
			return false; //for good measure
		});
*/		
		// from the iSeek main page
		jQuery( "#searchTriggerSimple" ).click(function() {
			submitSearch(jQuery("#searchSimpleInput").val(), 0, "", "", "", 0);
			jQuery("#searchSimpleInputInModal").val(jQuery("#searchSimpleInput").val());
		});

		// from the modal	
		jQuery( "#searchTriggerSimpleInModal" ).click(function() {
			submitSearch(jQuery("#searchSimpleInputInModal").val(), 0, "", "", "", returnExact());
		});
		
	});		

	function submitSearch(q, start, fq, sort, sort_dir, exact) {

		jQuery(".modal-body").addClass("loading");	
		jQuery("#wildcard").addClass("loading");	

		// console.log('submit search: ' + q);

		var checkedSort = "lastName";	
		var checkedSort_dir = "asc";	

		if (sort.length > 0 && sort_dir.length > 0) {
			checkedSort = sort;
			checkedSort_dir = sort_dir;	
		}

		var checkedQ = q;	

		// console.log('submit search exact: ' + exact);
		
		if (exact == 0) {
			checkedQ = checkedQ + "*";
		}
		
		// console.log(solrGcdUrl + "/" + checkedQ + "/" + start + "/" + checkedSort + "/" + checkedSort_dir + "?fq=" + fq);


		jQuery.ajax({
			url: solrGcdUrl + "/" + checkedQ + "/" + start + "/" + checkedSort + "/" + checkedSort_dir + "?fq=" + fq,
			type: 'GET',
			// data: {'wt':'json', 'q':q },
			// data: {'q':q },
			dataType: 'json',
			// jsonp : 'json.wrf',			
			success: loadData,

			error: function(data) {
              // console.dir(data);			
			  // alert('Error1234'); 
			}
		});
	}

	function loadData(data) {

		// console.log("in loadData");
	
		// console.dir(data);
		
		// header
		
		jQuery( ".gcd_results" ).empty();
		jQuery( ".dutyStationButtons" ).empty();
		jQuery( "thead > tr" ).empty();
		jQuery( ".wildcard" ).empty();

		// set up variables
		// var start = 0;
		var start = data.response.start;
		var rows_per_page = 10;
		
		// number of results	
		var resultsStart = data.response.start + 1;
		var resultsEnd = rows_per_page;
		var resultsFound = data.response.numFound;
		
		if (resultsFound < rows_per_page) {
			resultsEnd = resultsFound;
		} else if (resultsFound < (resultsStart + rows_per_page - 1)) {
			resultsEnd = resultsFound;
		} else {
			resultsEnd = resultsStart + rows_per_page - 1;
		}

		// pagination
		var total_pages = Math.floor(resultsFound / rows_per_page) ;
		var current_page = start / rows_per_page;
		// var current_page = data.response.start / rows_per_page;

		
		jQuery( ".gcd_results" ).append("Results " + resultsStart + "-" + resultsEnd + " of " + resultsFound);	

		// wildcard
		var wildcardChecked = "";
		if (data.responseHeader.params.q.charAt(data.responseHeader.params.q.length - 1) === '*') {
		} else {
			wildcardChecked = "checked";
		}		
		
		
		jQuery( ".wildcard" ).append("<label><input type=\"checkbox\" name=\"wildcard\" id=\"wildcard\" " + wildcardChecked + "/>Exact search?</label>");
		
		// facets	

		// console.log(data.facet_counts.facet_fields.dutyStation);
		
		jQuery( ".gcd_results" ).append("<br/>");	

		jQuery.each(data.facet_counts.facet_fields.dutyStation,function(index,value){

			var buttonClass = "btn btn-default dutyStationBtn";	

			if (typeof data.responseHeader.params.fq !== 'undefined') {
				if (data.responseHeader.params.fq.indexOf(index) > -1) {
					buttonClass = "btn btn-primary dutyStationBtn active";
				}
			}	
		
			// console.log(index + ": " + value);
			jQuery( ".dutyStationButtons" ).append("<button type=\"button\" value=\"" + index + "\" class=\"" + buttonClass  + "\">" +  index + "</button>");
		
		});

		// set sort in table header
/*
		'title' => 'Title',
		 'lastName' => 'Last name',
		 'firstName' => 'First name',
		 'email' => 'E-mail',
		 'phoneDisplay1' => 'Phone',
		 'dutyStation' => 'Duty station',
		 'building' => 'Building',
		 'room' => 'Room',
		 'organizationalUnit' => 'Org unit');
*/		
		
		jQuery( "thead > tr" ).append("<th><a class=\"sort_link\" id=\"sort_link_title\" href=\"title\">Title</a></th>");	
		jQuery( "thead > tr" ).append("<th><a class=\"sort_link\" id=\"sort_link_lastName\" href=\"lastName\">Last name</a></th>");	
		jQuery( "thead > tr" ).append("<th><a class=\"sort_link\" id=\"sort_link_firstName\" href=\"firstName\">First name</a></th>");	
		jQuery( "thead > tr" ).append("<th><a class=\"sort_link\" id=\"sort_link_email\" href=\"email\">E-mail</a></th>");	
		jQuery( "thead > tr" ).append("<th><a class=\"sort_link\" id=\"sort_link_phoneDisplay1\" href=\"phoneDisplay1\">Phone</a></th>");	
		jQuery( "thead > tr" ).append("<th><a class=\"sort_link\" id=\"sort_link_dutyStation\" href=\"dutyStation\">Duty station</a></th>");	
		jQuery( "thead > tr" ).append("<th><a class=\"sort_link\" id=\"sort_link_building\" href=\"building\">Building</a></th>");	
		jQuery( "thead > tr" ).append("<th><a class=\"sort_link\" id=\"sort_link_room\" href=\"room\">Room</a></th>");	
		jQuery( "thead > tr" ).append("<th><a class=\"sort_link\" id=\"sort_link_organizationalUnit\" href=\"organizationalUnit\">Org unit</a></th>");	
		

		// remove existing sorts
		jQuery( ".glyphicon-arrow-down" ).remove();
		jQuery( ".glyphicon-arrow-up" ).remove();

		// 	

		var sort_from_solr = data.responseHeader.params.sort.split(" ");

		if (sort_from_solr[1] == "asc") {
			jQuery( "#sort_link_" + sort_from_solr[0] ).append("<i class=\"glyphicon glyphicon-arrow-down\"></i>");
		} else {
			jQuery( "#sort_link_" + sort_from_solr[0] ).append("<i class=\"glyphicon glyphicon-arrow-up\"></i>");
		}
		// <i class="glyphicon glyphicon-arrow-up"></i>
		
		// populate table
		
		jQuery( "tbody" ).empty();

		jQuery.each(data.response.docs,function(i,doc){
			var title = doc.title != undefined ? doc.title : "";
			var lastName = doc.lastName != undefined ? doc.lastName : "";
			var firstName = doc.firstName != undefined ? doc.firstName : "";
			var email = doc.email != undefined ? "<a href=\"mailto:" + doc.email + "\">" + doc.email + "</a>" : "";
			var phoneDisplay1 = doc.phoneDisplay1 != undefined ? doc.phoneDisplay1 : "";
			var dutyStation = doc.dutyStation != undefined ? doc.dutyStation : "";
			var building = doc.building != undefined ? doc.building : "";
			var room = doc.room != undefined ? doc.room : "";
			var organizationalUnit = doc.organizationalUnit != undefined ? doc.organizationalUnit : "";
			
			jQuery( "tbody" ).append( "<tr><td>TITLE " + title + "</td><td>" + lastName + "</td><td>" + firstName + "</td><td>" + email + "</td><td>" + phoneDisplay1 + "</td><td>" + dutyStation + "</td><td>" + building + "</td><td>" + room + "</td><td>" + organizationalUnit + "</td></tr>" );
		});

		// pagination

		jQuery( ".gcd_pagination" ).empty();
		
		// only show n links around the current_page
		var lower_page_limit = 0;
		var upper_page_limit = total_pages;
		var page_links_to_show = 10;

		// jQuery( ".gcd_results" ).append("<br/>current_page: " + current_page + " lower_page_limit: " + lower_page_limit + " upper_page_limit: " + upper_page_limit + " page_links_to_show: " + page_links_to_show );
		//echo "total_pages: $total_pages";

		if ((current_page < (page_links_to_show / 2)) && (total_pages > page_links_to_show)) {
			lower_page_limit = 0;
			upper_page_limit = page_links_to_show;
		} else if ((current_page <= (page_links_to_show / 2)) && (total_pages <= page_links_to_show)) {
			lower_page_limit = 0;
			upper_page_limit = total_pages;
		} else if ((current_page + page_links_to_show) > total_pages) {
			lower_page_limit = total_pages - page_links_to_show;
			upper_page_limit = total_pages;
		} else {
			lower_page_limit = current_page - (page_links_to_show / 2);
			upper_page_limit = current_page + (page_links_to_show / 2);
		}


		// create pagination
		
		var pagination = "<nav><ul class=\"pagination\">";

		pagination += "<li><a class=\"pagination_link\" href=\"0\">« first</a></li>";

		if (start > 0) {
			pagination += "<li><a class=\"pagination_link\" href=\"" + ((current_page - 1) * rows_per_page) + "\">‹ previous</a></li>";
		}
		for (var pager_i = lower_page_limit; pager_i <= upper_page_limit; pager_i++ ) {
			if (current_page == pager_i) {
				pagination += "<li class=\"active pagination_link\"><a href=\"" + (pager_i * rows_per_page) + "\">" + (pager_i + 1) + "</a></li>";
			} else {
				pagination += "<li><a class=\"pagination_link\" href=\"" + (pager_i * rows_per_page) + "\">" + (pager_i + 1) + "</a></li>";
			}
		}
		if (resultsFound - (current_page * rows_per_page) > rows_per_page) {
			pagination += "<li><a class=\"pagination_link\" href=\"" + ((current_page + 1) * rows_per_page)  + "\">next ›</a></li>";
		}
		
		pagination += "<li><a class=\"pagination_link\" href=\"" + (total_pages * rows_per_page) + "\">last »</a></li>";

		pagination += "</ul></nav>";	

		jQuery( ".gcd_pagination" ).append(pagination);

		// restore modal
		
		jQuery(".modal-body").removeClass("loading");	
		jQuery("#wildcard").removeClass("loading");	

		// add event listeners for clicks from dynamically created content
	
		// pagination from the modal -- must be added here	
		jQuery(".pagination_link").click(function(event){

			// console.log("in pagination_link 1a");
		
			event.preventDefault();

			// console.log("in pagination_link 1b");

			event.stopPropagation();

			// console.log("in pagination_link 1c");

/////////////////////// separate out into function
//////////////////////////
			
			submitSearch(jQuery("#searchSimpleInputInModal").val(), jQuery(this).attr("href"), returnSelectedDutyStationButtons(), returnSelectedSort(), returnSelectedSortDir(), returnExact());
			// jQuery("#searchSimpleInputInModal").val(jQuery("#searchSimpleInput").val());

			// console.log("in pagination_link 1d");
			
			return false; //for good measure
		});



		jQuery(".dutyStationBtn").click(function(){ 
		
			// front end
		
			// console.log(jQuery(this).attr("value"));
			if (jQuery(this).hasClass("active")) {
				jQuery(this).removeClass("active");
			} else {
				jQuery(this).addClass("active");
			}			
			if (jQuery(this).hasClass("btn-default")) {
				jQuery(this).removeClass("btn-default");
			} else {
				jQuery(this).addClass("btn-default");
			}			
			if (jQuery(this).hasClass("btn-primary")) {
				jQuery(this).removeClass("btn-primary");
			} else {
				jQuery(this).addClass("btn-primary");
			}			

			submitSearch(jQuery("#searchSimpleInputInModal").val(), 0, returnSelectedDutyStationButtons(), "", "", returnExact());
			
		});
		
		// pagination from the modal -- must be added here	
		jQuery("a.sort_link").click(function(event){

			event.preventDefault();

			event.stopPropagation();

			// console.log("in sort_link 7a");

			var sort_click_dir = "asc" ;

			// only override if the link already has a down arrow.
			// otherwise, arrow should be always down ("asc"). 		
			if (jQuery(this).find("i.glyphicon-arrow-down").length) {
				sort_click_dir = "desc";
			} 

/*			
			var sort_click_dir = "asc";

			if (returnSelectedSort() == jQuery(this).attr("href")) {
				sort_click_dir = returnSelectedSortDir();
			}
*/			
			submitSearch(jQuery("#searchSimpleInputInModal").val(), 0, returnSelectedDutyStationButtons(), jQuery(this).attr("href"), sort_click_dir, returnExact());

			// console.log("in sort_link 7b");
			
			return false; //for good measure
		});

		// pagination from the modal -- must be added here	
		jQuery("#wildcard").click(function(event){

			event.preventDefault();

			event.stopPropagation();

			// console.log("in wildcard click 1a");

			var sort_click_dir = "asc";

			submitSearch(jQuery("#searchSimpleInputInModal").val(), 0, returnSelectedDutyStationButtons(), returnSelectedSort(), returnSelectedSortDir(), returnExact());

			// console.log("in wildcard click 1b");
			
			return false; //for good measure
		});
		
	}

	function returnExact() {

		var selectedExact = 0;
	
		if (jQuery('#wildcard').prop("checked")) {
		
			selectedExact = 1;
			// console.log("wildcard checked");

		} else {
		
			// console.log("wildcard not checked");
		
		}
		
		return selectedExact;
	
	}
	
	
	function returnSelectedSort() {

		var selectedSort = "";
	
		jQuery("a.sort_link").each(function(){
		
			if (jQuery(this).find("i.glyphicon").length) {
			
				selectedSort = jQuery(this).attr("href");
				
			}
		});
		
		return selectedSort;
	
	}

	// the only instance in which we want to change direction is if the 
	// user clicks a header that already has a glyphicon. Otherwise, it should stay the same. 
	
	function returnSelectedSortDir() {

		var selectedSortDir = "asc";
	
		jQuery("a.sort_link").each(function(){
		
			if (jQuery(this).find("i.glyphicon-arrow-down").length) {

				selectedSortDir = "asc";
				
			} else if (jQuery(this).find("i.glyphicon-arrow-up").length) {

				selectedSortDir = "desc";
				
			}
		});
		
		return selectedSortDir;
	
	}
	
	
	function returnSelectedDutyStationButtons() {

		// iterate over active buttons
		var multivalue_facet_queryphrase_local = "";

		jQuery(".dutyStationBtn.btn-primary").each(function(){
			// console.log("btn-primary dutyStations: " + jQuery(this).attr("value"));
			// use quotes to escape spaces
			if (multivalue_facet_queryphrase_local.length > 0) {
				multivalue_facet_queryphrase_local += " OR \"" + jQuery(this).attr("value") + "\"";
				// multivalue_facet_queryphrase_local += " OR " + jQuery(this).attr("value") ;
			} else {
				multivalue_facet_queryphrase_local += "\"" + jQuery(this).attr("value") + "\"" ;
				// multivalue_facet_queryphrase_local += jQuery(this).attr("value")  ;

			}
			});	

		// console.log("multivalue_facet_queryphrase_local: " + multivalue_facet_queryphrase_local);

		return multivalue_facet_queryphrase_local;

	}		

	
</script>


<section id="<?php print $block_html_id; ?>" class="block clearfix">

	<h2>Find a Colleague</h2>
	
	<div class="content"<?php print $content_attributes; ?>>
	<!-- <form action="/global-contact-directory" id="searchForm" method="post" name="searchForm"> -->
		<div class="input-group">
			<input class="form-control" name="query" type="text" id="searchSimpleInput">
			<span class="input-group-btn">
				<button id="searchTriggerSimple" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Go</button> 
			</span>
		</div>
		<div><a class="redlink" href="/content/additional-phone-resources">Additional resources</a></div>
		<div><a href="/content/update-information-global-contact-directory">Update my information</a></div>
	<!-- </form> -->

		<div>v 3.09</div>
		
	</div>
</section>
  

  <!-- Modal -->
	<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h2 class="modal-title" id="myModalLabel">United Nations Global Contact Directory123</h2>
			<div class="input-group">
				<input class="form-control" name="query" type="text" id="searchSimpleInputInModal">
				<span class="input-group-btn">
					<button id="searchTriggerSimpleInModal" type="button" class="btn btn-primary">Go</button> 
				</span>
			</div>
			<div class="wildcard checkbox"></div>
			<h5>Narrow by duty station (You can select multiple duty stations or click again to deselect):</h5>
			<div class="dutyStationButtons"></div>
		  </div>
		  <div class="modal-body">

			<h3 class="gcd_results"></h3>

			<table class="table table-striped">
				<thead>
					<tr>
						<?php
/*
							foreach ($iseekFields as $header_key => $header_value) {
						?>
								<th>
									<a class="sort_link" id="sort_link_<?php echo $header_key; ?>" href="<?php echo $header_key; ?>"><?php echo $header_value; ?></a>
								</th>
						<?php
							}
*/
						?>
					</tr>
				</thead>
				<tbody>


				</tbody>
			</table>
			
			<div class="gcd_pagination">

			</div>

		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default"><a href="/global-contact-directory">Advanced search</a></button>
			<button type="button" class="btn btn-default"><a href="/content/update-information-global-contact-directory">Update my information</a></button>
			<button type="button" class="btn btn-default"><a href="/content/additional-phone-resources">Additional resources</a></button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>  
 