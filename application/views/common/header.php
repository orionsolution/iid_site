<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>
<?php if ( $main_content == 'desk' ) : ?>IID - Home<?php elseif ( $main_content == 'patient/visit_view' || $main_content == 'patient/patient_history_view') : ?>IID - Patient Visit<?php else: ?>IID - Patient<?php endif; ?>
</title>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" />
<!------------------------------------------------------------Stylesheet for Patient Views Start------------------------------------------------------------>
<?php if ( $main_content == 'patient/visit_view' || $main_content == 'patient/patient_history_view' || $main_content == 'patient/past_data_view' || $main_content == 'patient/thankyou_view') : ?>
<link href="<?php echo base_url(); ?>css/patient.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
<?php if ( $main_content == 'patient/profile_view' || $main_content == 'patient/add_view') : ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/profile.css">
<?php endif; ?>
<!------------------------------------------------------------Stylesheet for Patient Views Ends------------------------------------------------------------>
<!----------------------------------------------------------------Fancybox code Start---------------------------------------------------------------->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>fancybox/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript">
$(document).ready(function() {

	// function to replace space with _ in search string
	function hasWhiteSpace(s) {		
		if(s.indexOf(' ') >= 0){
			// add '_' character instead of space in search string
			var replaced = s.split(' ').join('_');
			return replaced;
		}else{
			return s;
		}
	}

	$('.fancybox').fancybox({
           'padding': 0,
           'closeBtn': false
    });



	$('#fancysearch').click(function() {
		var hrefm = '<?=base_url()?>search/index/';
		var search_no = document.getElementById("_Alt_s").value;
		search_no = hasWhiteSpace(search_no);
		console.log('search_no ' + search_no);
		if(search_no!='' && search_no!='Search Patient...'){
			$('a#fancysearch').attr("href", hrefm+search_no);
			console.log($('a#fancysearch').attr("href"));
			$('a#fancysearch').attr("class", "fancybox fancybox.ajax");
		}else {			
			$('a#fancysearch').attr("href", "#search_error");
			$('a#fancysearch').attr("class", "fancybox");
		}
	})
});
</script>
<!----------------------------------------------------------------Fancybox code Ends---------------------------------------------------------------->
<!----------------------------------------------------------------hotkeys code Start---------------------------------------------------------------->
<script src="<?php echo base_url(); ?>js/jquery.hotkeys.js"></script>
<script type="text/javascript">
    function domo(){
    	jQuery('#platform-details').html('<code>' + navigator.userAgent + '</code>');
        	var elements = [
            	"Alt+h","Alt+e","Alt+i","Alt+d","Alt+t","Alt+1","Alt+2","Alt+3","Alt+4","Alt+x","Alt+l","Alt+s","Alt+a","Alt+o"
            ];
            // the fetching...
            $.each(elements, function(i, e) { // i is element index. e is element as text.
            	var newElement = ( /[\+]+/.test(elements[i]) ) ? elements[i].replace("+","_") : elements[i];
                // Binding keys
				$(document).bind('keydown', elements[i], function() {						
					if(elements[i] == 'Alt+h' || elements[i] == 'Alt+e' || elements[i] == 'Alt+i' || elements[i] == 'Alt+d' || elements[i] == 'Alt+t'){		
						switch (elements[i]){
						   	case "Alt+h":
								$("#tabs").tabs({active:0});
								break;
						  	case "Alt+e":
							 	$("#tabs").tabs({active:1});
							 	break;
							case "Alt+i":
								$("#tabs").tabs({active:2});
								break;
						  	case "Alt+d":
							 	$("#tabs").tabs({active:3});
							 	break;	
						 	default:
							 	$("#tabs").tabs({active:4});
							 	break;
					   	}
					} else if(elements[i] == 'Alt+s') {
						document.getElementById("_Alt_s").focus();
						$("#_Alt_s").keyup(function(event){
							if(event.keyCode == 13){
								document.getElementById("_Alt_s").blur();
							}
						});
					} else {
						var url = $('#_'+ newElement).attr('href');
						if (url) {
							window.location = url;
						}
					}	
						
					return false;
				});
			});
		}
	jQuery(document).ready(domo);
</script>
<!----------------------------------------------------------------hotkeys code Ends---------------------------------------------------------------->
<!----------------------------------------------------------------Code for Patient Views Start---------------------------------------------------------------->
<?php if ( $main_content == 'patient/visit_view' || $main_content == 'patient/add_view' || $main_content == 'patient/profile_view' || $main_content == 'patient/edit_view' || $main_content == 'patient/patient_history_view' || $main_content == 'patient/past_data_view') : ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>ui/jquery.ui.core.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>ui/jquery.ui.theme.css" type="text/css">
<script src="<?php echo base_url(); ?>ui/jquery.ui.core.js"></script>
<script src="<?php echo base_url(); ?>ui/jquery.ui.widget.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>ui/jquery.ui.datepicker.css" type="text/css">
<script src="<?php echo base_url(); ?>ui/jquery.ui.datepicker.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/dd.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>ui/jquery.ui.tabs.css" type="text/css">
<script src="<?php echo base_url(); ?>ui/jquery.ui.tabs.js"></script>
<?php if ( $main_content == 'patient/visit_view' ) : ?>
<script type="text/javascript">
	$(document).ready(function () {
		$("#tabs").tabs({active:4});
	});
</script>
<?php endif; ?>
<?php if ( $main_content == 'patient/past_data_view' ) : ?>
<script type="text/javascript">
	$(document).ready(function () {
		$("#tabs").tabs({active:2});
	});
</script>
<?php endif; ?>
<script src="<?php echo base_url(); ?>js/custom-form-elements.js"></script>
	<?php if ( $main_content == 'patient/add_view' || $main_content == 'patient/edit_view' || $main_content == 'patient/profile_view' ) : ?>
	<script type="text/javascript">
		$(function() {
			// date picker for add and edit patient view
			$("#birth_date, #birth_date_modify").datepicker({
			  maxDate: 0,
			  changeMonth: true,
			  changeYear: true,
			  yearRange: "-100:+0",
			  dateFormat: "dd/mm/yy"
			});
		});
	</script>
	<?php endif;
endif; ?>
<!----------------------------------------------------------------Code for Patient Views End---------------------------------------------------------------->
<!----------------------------------------------------------------Code to get the desk count Start---------------------------------------------------------------->
<script type="text/javascript">
$(document).ready(function(){
	var count = $('div.bottom #table_list tbody > tr').length;
	$('span.pend_que').text(count);
    	$('a.search_close_btn').click(function(){
        	jQuery.fancybox.close();        
        });
});
</script>
<!----------------------------------------------------------------Code to get the desk count Ends---------------------------------------------------------------->

<script type="text/javascript" src="<?=base_url();?>js/patient.js"></script>
</head>

<body>
<?php $this->load->view('common/tooltip'); ?>
<!-- start of container -->
<div id="container">
	<!-- start of header -->
	<div id="header">
		<div id="topmenu">
			<ul>
				<li style="margin-right:7px;">
					<a class="<?php echo ($this->uri->segment(1)==='desk')?'active':'' ?>" href="<?php echo base_url(); ?>desk" style="min-width:70px;">desk (<?php echo $desk_count; ?>)</a>
				</li>
				<li class="mrd">
					<div class="content">
						<? $cur_mrd = $this->session->userdata('curr_mrdno'); 
						if($main_content == 'desk' && !empty($cur_mrd)): ?>
							<a id="_Alt_x" class='sess close' href="<?php echo base_url(); ?>desk/done/<?php echo $this->session->userdata('curr_mrdno'); ?>">close <img src="<?php echo base_url(); ?>images/mrd_close.png" alt="" /></a><br />
							<a class="" href="<?=base_url();?>patient/visit/<?=$this->session->userdata('curr_mrdno');?>"><span class="big"><?=$this->session->userdata('curr_mrdno');?></span></a>       
						<? endif; ?>
						<? if($main_content != 'desk' && $main_content != 'patient/add_view'): ?>              
							<a id="_Alt_x" class='nosess close' href="<?php echo base_url(); ?>desk/done/<?php echo $mrd_no; ?>">close <img src="<?php echo base_url(); ?>images/mrd_close.png" alt="" /></a><br />
							<a class="<?php echo ($this->uri->segment(2)==='visit' || $this->uri->segment(2)==='profile' || $this->uri->segment(2)==='patient_history' || $this->uri->segment(2)==='add_past_data' || $this->uri->segment(2)==='update_patient_info')?'active':'' ?>" href="<?=base_url();?>patient/visit/<?=$mrd_no;?>"><span class="big"><?=$mrd_no;?></span></a>
						<? endif; ?>
					</div>
				</li>
				<li style="margin-right:7px;">
					<a class="<?php echo ($this->uri->segment(2)==='add')?'active':'' ?>" href="<?php echo base_url(); ?>patient/add" style="width:105px;">add patient</a>
				</li>
				<li class="text">
					<form method="post" id="searchform" action=""> 
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="80%"><input type="text" name="IdentityNo" id="_Alt_s" class="search" value="Search Patient..." onfocus="if (this.value == 'Search Patient...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search Patient...';}" /></td>
							<td width="20%">
								<a id="fancysearch"><input type="submit" value="" class="go" name="submit" id="go" /></a>
							</td>
						  </tr>
						</table>
					</form>
				</li>
				<li style="margin-right:7px;"><a href="#" style="width:65px;">reports</a></li>
				<li style="margin-right:33px;"><a href="#" style="width:65px;">utilities</a></li>
				<li class="logout">
					<center><div style="padding-bottom:5px;">IID Pune</div><a id="_Alt_l" href="<?php echo base_url(); ?>login/logout" onMouseover="ddrivetip('Logout')"; onMouseout="hideddrivetip()"></a></center>
				</li>
				<br class="clearfloat" />
			</ul>
		</div>
	</div>
	<!-- end of header -->
	
	<!-- start of maincontent -->
	<div id="maincontent">