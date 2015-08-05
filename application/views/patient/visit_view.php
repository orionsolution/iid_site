<? $this->load->view('common/toplinks'); ?>
<div class="box boxtop patient">
  <div class="visittop">
    <?php
    foreach ($patient_info as $curr_patient):
      $patient_name = $curr_patient['firstname'];
      $patient_surname = $curr_patient['surname'];
      $patient_age = $curr_patient['date_of_birth'];
      $patient_hiv_year = $curr_patient['hiv_year'];
      $patient_art_year = $curr_patient['art_year'];
      $patient_children = $curr_patient['children'];
      $patient_spouse = $curr_patient['spouse'];
      $patient_diabetic = $curr_patient['diabetic'];
      $patient_hypertension = $curr_patient['hypertension'];
      $patient_gender = $curr_patient['gender'];
    endforeach;
    $str = '';
    if ($patient_diabetic == 'Yes' && $patient_hypertension == 'Yes'):
      $str = "Diabetic, Hypertension";
    elseif ($patient_diabetic == 'Yes'):
      $str = 'Diabetic';
    elseif ($patient_hypertension == 'Yes'):
      $str = 'Hypertension';
    else:
      $str = '';
    endif;

    $spouse_status = '';
    if ($patient_gender == 'Male'):
      $spouse_status = 'Wife';
    elseif ($patient_gender == 'Female'):
      $spouse_status = 'Husband';
    else:
      $spouse_status = 'Spouse';
      $patient_spouse = 'None';
    endif;
    ?>

    <table class="main tpatient" width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="head">
        <td class="left" width="8%">HIV: <?= $patient_hiv_year; ?></td>
        <td class="left" width="8%">ART: <?= $patient_art_year; ?></td>
        <? if ($patient_spouse == '+ve'): ?><td width="15%"><?= $spouse_status; ?>: <span class="high"><span style="font-size:14px;"><?= $patient_spouse; ?></span></span></td><? else: ?>
          <td class="left" width="15%"><?= $spouse_status; ?>: <?= $patient_spouse; ?></td><? endif; ?>
        <td class="left" width="14%">CHILDREN: <?= $patient_children; ?></td>
        <td width="15%" class="nopad">
          <div class="wrapper-demo">
            <div id="dd" class="wrapper-dropdown">REGIMEN
              <ul class="dropdown" style="min-width:250px;">
                <!-- <li><a href="#">EFV + ERV + ARC</a></li>
                <li><a href="#">ERV + ARC</a></li>
                <li><a href="#">EFV + ERV</a></li>
                <li><a href="#">ARC</a></li>
                <li><a href="#">ERV</a></li> -->
              </ul>
            </div>
          </div>
        </td>
        <td width="8%" class="nopad">
          <div class="wrapper-demo">
            <div id="dd5" class="wrapper-dropdown">wgt
              <ul class="dropdown"></ul>
            </div>
          </div>
        </td>
        <td width="8%" class="nopad">
          <div class="wrapper-demo">
            <div id="dd2" class="wrapper-dropdown">cd4
              <ul class="dropdown"></ul>
            </div>
          </div>
        </td>
        <td width="8%" class="nopad">
          <div class="wrapper-demo">
            <div id="dd3" class="wrapper-dropdown">vl
              <ul class="dropdown"></ul>
            </div>
          </div>
        </td>
        <td width="10%" class="nopad">
          <div class="wrapper-demo">
            <div id="dd4" class="wrapper-dropdown">creatine
              <ul class="dropdown"></ul>
            </div>
          </div>
        </td>
        <td class="last" width="10%">&nbsp;</td>
      </tr>
      <tr>
        <!-- calculate person age -->
        <?php
        $dob = new DateTime("$patient_age");
        $now = new DateTime('now');

        function year_diff($date1, $date2) {
          list($year1, $dayOfYear1) = explode(' ', $date1->format('Y z'));
          list($year2, $dayOfYear2) = explode(' ', $date2->format('Y z'));
          return $year1 - $year2 - ($dayOfYear1 < $dayOfYear2);
        }

        $age = year_diff($now, $dob);
        ?>
        <td colspan="4"><a><span class="name"><?php echo $patient_name . " " . $patient_surname; ?> <?php if ($patient_age != '1970-01-01' && $patient_age != '' && $patient_age != '0000-00-00'): ?>-<?php endif; ?></span></a> <span class="age"><?php
            if ($patient_age != '1970-01-01' && $patient_age != '' && $patient_age != '0000-00-00'):
              echo "$age yrs.";
            endif;
            ?></span><br />
          <table width="65%" border="0" cellspacing="0" cellpadding="0" style="margin:0; padding:0;">
            <tr>
              <td class="nop" width="50%" valign="top">
                <?php if ($str != ''): ?>
                  <span class="bottomtext" style="color:#fff; font-size:10px; margin-right:10px;"><?= $str; ?></span>
                <?php endif; ?>
                <?php if ($last_visit_date != ''): ?>
                  <span class="bottomtext" style="font-size:10px; text-transform:uppercase;">last visit <?= ($last_visit_date != '') ? date("d M.Y", strtotime($last_visit_date)) : ''; ?></span>
                <?php endif; ?>
              </td>
            </tr>
          </table>
        </td>
		<?//echo '<pre>';	print_r($patient_regimen_details);exit;?>
		<?if (!empty($patient_regimen_details)):$str = '';?>
        <td valign="top">
			<?foreach($patient_regimen_details as $last_date => $value):
				foreach($value as $curr_data):
					$str .= $curr_data . " + ";
				endforeach;
				$str = rtrim($str,"+ ");
			?>
			<?=$str;?> <br />
          <span class="bottomtext"><?= ($last_date != '') ? date("d M.'y", strtotime($last_date)) : ''; ?></span></td>
		  
		  <?
          endforeach;
        else:
          ?>
          <td align="center" valign="top">&nbsp;
          <? endif; ?>
		  
		  
        <?
        if (!empty($patient_weight_details)):
          foreach ($patient_weight_details as $row):
            ?>
            <td align="center" valign="top"><?= (isset($row->addinfo)) ? $row->addinfo : '&nbsp;'; ?><br />
              <span class="bottomtext"><?= date("d M.'y", strtotime($row->visit_dt)); ?></span>
            </td>
            <?
          endforeach;
        else:
          ?>
          <td align="center" valign="top">&nbsp;
          <? endif; ?>


          <?
          if (!empty($patient_cd4_details)):
            foreach ($patient_cd4_details as $row):
              ?>
            <td align="center" valign="top">
              <div class="high"><?= $row->cd4; ?></div> <span class="bottomtext"><?= date("d M.'y", strtotime($row->visit_dt)); ?></span>                                                </td>
            <?
          endforeach;
        else:
          ?>
          <td align="center" valign="top">&nbsp;
          <? endif; ?>


          <?
          if (!empty($patient_vl_details)):
            foreach ($patient_vl_details as $row):
              ?>
            <td align="center" valign="top"><?= $row->viral_load; ?><br />
              <span class="bottomtext"><?= date("d M.'y", strtotime($row->visit_dt)); ?></span>
            </td>
            <?
          endforeach;
        else:
          ?>
          <td align="center" valign="top">&nbsp;
          <? endif; ?>

          <?
          if (!empty($patient_creatinine_details)):
            foreach ($patient_creatinine_details as $row):
              ?>
            <td align="center" valign="top">
              <span class="high"><?= $row->creatinine; ?></span><br><span class="bottomtext"><?= date("d M.'y", strtotime($row->visit_dt)); ?></span>
            </td>
            <?
          endforeach;
        else:
          ?>
          <td align="center" valign="top">&nbsp;
          <? endif; ?>
        <td valign="top" class='last'>&nbsp;</td>				  
      </tr>
    </table>

    <?php $this->load->view('common/tabs'); ?>
	
	<div id="tabbottom">
	
    </div>
  </div>

 
   
  <input type="hidden" class="modification_date" value="<?=date('Y-m-d');?>">


  <!--<div class="visitbottom" id="patient_record">-->
  <div class="visitbottom" id="patient_record">

  </div>

</div> <!-- end of box div -->




<?
if ($this->uri->segment(2) == 'visit'):
  $date_cnt = 1;
else:
  $date_cnt = '';
endif;
$uri_seg = $this->uri->segment(2);
?>

<script>
  $(document).ready(function() {

    var date_count = "<?= $date_cnt; ?>";
    var uri_seg = "<?= $uri_seg; ?>";
    console.log("Date count is: " + date_count);
    console.log("Uri Segment is: " + uri_seg);
  });
</script>


<script type="text/javascript">
  function style_row() {
    $("#tabbottom #table_list tr.td_header").css({'background-image': 'url(<?= base_url(); ?>images/edit_popupbg.gif)', 'background-repeat': 'repeat-x', 'background-color': '#f1f1f1'});
    $("#tabbottom #table_list tr.td_header").css({'background': '#f1f1f1'});
    $(function() {
      $('#tabbottom #table_list tr.td_header').hover(function() {
        $(this).css('background-color', '#ffffff');
        $(this).css("color", "#5cb1ea");
        $("#tabbottom #table_list tr.td_header td.detail").css("color", "#02bac5");
      }, function() {
        $(this).css('background-color', '#eaeaea');
        $(this).css("color", "#959595");
        $("#tabbottom #table_list tr.td_header td.detail").css("color", "#959595");
      });
    });
  }

  style_row();

  $(document).ready(function() {
	
	var curr_record_url = "<?=base_url()?>patient/past_record/<?=$mrd_no;?>";
	var curr_record_view_name = "patient/current_visit_record_view";
	var curr_date = "<?=date('Y-m-d');?>";
	
	var data = {
		"past_date": curr_date,
		"view_name": curr_record_view_name
	};
	
	$.get(curr_record_url,data,function(data){
		$('#tabbottom').html(data);
	});
	
	
	
	var url="<?=base_url()?>patient/record/<?=$mrd_no?>/<?=$date_cnt;?>";			
	$.get( url, function( data ) {
		$( "#patient_record" ).html( data );
	});
	


	function clear_save() {
	  setTimeout(function() {
		$('.saved').html("");
	  }, 3000);
	}




        function get_url(value) {
          var add_url = "<?= base_url(); ?>patient/" + value + "/<?= $mrd_no ?>";
          console.log(add_url);
          return add_url;
        }


        $.ajaxSetup({cache: false});

        $('#hist_form, #exam_form, #diag_form').submit(function(event) {
          event.preventDefault();
          var cat_val = $(this).find('input.sel_subcat').val();
          console.log("Cat val " + cat_val);
          if (cat_val === '') {
            $('span.add_value').html("");
            $('span.valparam').addClass('error').html("* required");
          } else {
            $('span.valparam').html("");
			$('span.add_value').html("");
            var img_html = '<img src="<?php echo base_url(); ?>images/snake_transparent.gif" width="16" height="16" alt="" />';
			
            var value = $(this).find('input.get_value').val();
            var table_name = $(this).find('input.get_value').attr('data-tablename');
            $('.saved_' + value).html(img_html);
            var add_url = get_url(value);

            var info = $(this).serialize();
            console.log("Info: " + info);

            $.post(add_url, info, function() {
              console.log('insert successful');
              $('.saved_' + value).html('Saved');
              clear_save();
			  
			  var curr_record_url = "<?=base_url()?>patient/past_record/<?=$mrd_no;?>";
			  var curr_record_view_name = "patient/current_visit_record_view";
			  var curr_date = "<?=date('Y-m-d');?>";
			
			  var data = {
				"past_date": curr_date,
				"view_name": curr_record_view_name
			  };
			
			  $.get(curr_record_url,data,function(data){
				$('#tabbottom').html(data);
				$('#table_list').find('tr.record_info')
				.first()
				.css('background-color', '#ffffff')
				.css("color", "#5cb1ea")
				.find('td.detail').css("color", "#02bac5");
				});
             });
          }

        });

        // treatment form submission

        $('#treat_form').submit(function(event) {
          event.preventDefault();
          var cat_val = $(this).find('input.sel_subcat').val();
          console.log("Cat val " + cat_val);
          if (cat_val === '') {
            $('span.add_value').html("");
            $('span.valparam').addClass('error').html("* required");
          } else {
            var img_html = '<img src="<?php echo base_url(); ?>images/snake_transparent.gif" width="16" height="16" alt="" />';

            var value = $(this).find('input.get_value').val();

            var date = "<?= date('d M.Y'); ?>";

            $('.saved_' + value).html(img_html);
            var add_url = get_url(value);

            console.log("Value is " + value + " url is " + add_url);

            var info = $(this).serialize();
            console.log(info);

            $.post(add_url, info, function() {
              console.log('insert successful');
              $('.saved_' + value).html('Saved');
              clear_save();
			  
			  var curr_record_url = "<?=base_url()?>patient/past_record/<?=$mrd_no;?>";
			  var curr_record_view_name = "patient/current_visit_record_view";
			  var curr_date = "<?=date('Y-m-d');?>";
			
			  var data = {
				"past_date": curr_date,
				"view_name": curr_record_view_name
			  };
			
			  $.get(curr_record_url,data,function(data){
				$('#tabbottom').html(data);
				$('#table_list').find('tr.record_info')
				.first()
				.css('background-color', '#ffffff')
				.css("color", "#5cb1ea")
				.find('td.detail').css("color", "#02bac5");
				});
              
            });

          }

        });

      });

// Investigation Form Submit
    function clear_save() {
      setTimeout(function() {
        $('.saved').html("");
      }, 3000);
    }


$('#invest_form').submit(function(event) {
event.preventDefault();
console.log('investigation form started');

if ($('input[name=invest_result]').val() === '') {
$('span.add_value').html("");
$('span.val_invest_result').addClass('error').html('* required');
} else {
$('span.val_invest_result').html("");
var img_html = '<img src="<?php echo base_url(); ?>images/snake_transparent.gif" width="16" height="16" alt="" />';
var value = 'add_invest';
var cat_val = $(this).find('input.sel_subcat').val();
var cat_name = "Clinic";
var title = 'INV';
var date = "<?= date('d M.Y'); ?>";
$('.saved_' + value).html(img_html);
//var column_name = $(this).find('input.sel_subcat').val();
var column_name = $(this).find('select#select_272').find('option:selected').text();
var column_value = $(this).find('input[name=invest_result]').val();


console.log(column_name);
console.log(column_value);

var info = {
  'column_name': column_name,
  'column_value': column_value
};

var add_url = "<?= base_url(); ?>patient/add_inv/<?= $mrd_no; ?>";

		$.post(add_url, info, function() {
		  $('#invest_form').find('input[name=invest_result]').val("");
		  console.log('insert successful');
		  $('.saved_' + value).html('Saved');
		  clear_save();
		  
	   var curr_record_url = "<?=base_url()?>patient/past_record/<?=$mrd_no;?>";
	   var curr_record_view_name = "patient/current_visit_record_view";
	   var curr_date = "<?=date('Y-m-d');?>";

	  var data = {
		"past_date": curr_date,
		"view_name": curr_record_view_name
	  };
		
	  $.get(curr_record_url,data,function(data){
		$('#tabbottom').html(data);
			$('#table_list_invest').find('td.detail').each(function(){
				var curr_text = $(this).text();
				if(curr_text === column_name){
					$(this).parent('tr.record_info')
					.css('background-color', '#ffffff')
					.css("color", "#5cb1ea")
					.find('td.detail').css("color", "#02bac5");
				}
			});	// end each function 		
		}); // end get ajax
		  
	}); // end post ajax

   }  // end else block
}); // end of invest submit


$('#freq_invest_form').submit(function(event) {
event.preventDefault();
console.log('frequent investigation form started');
var validate = 0;
$('input.clear').each(function(){
	curr_input = $(this).val();
	if( curr_input !== ''){
		validate++
	}
});

if (validate == 0) {
console.log("No input field selected");
} else {
var img_html = '<img src="<?php echo base_url(); ?>images/snake_transparent.gif" width="16" height="16" alt="" />';
var value = 'add_freq_invest';
var cat_name = "Clinic";
var title = 'INV';
var date = "<?= date('d M.Y'); ?>";
$('.saved_' + value).html(img_html);

var cd4 = $('input[name="cd4"]').val();
var hiv_i_ii = $('input[name="hiv_i_ii"]').val();
var vdrl = $('input[name="vdrl"]').val();
var viral_load = $('input[name="viral_load"]').val();
var creatinine = $('input[name="creatinine"]').val();
var bsf = $('input[name="bsf"]').val();
var hbsag = $('input[name="hbsag"]').val();
var cryptococcus = $('input[name="cryptococcus"]').val();

var info = {
  'cd4': cd4,
  'hiv_i_ii': hiv_i_ii,
  'viral_load': viral_load,
  'vdrl': vdrl,
  'creatinine': creatinine,
  'bsf': bsf,
  'hbsag': hbsag,
  'cryptococcus': cryptococcus
};

console.log(info);


var add_url = "<?= base_url(); ?>patient/add_freq_inv/<?= $mrd_no; ?>";

		$.post(add_url, info, function() {
		  $('input.clear').val("");
		  console.log('insert successful');
		  $('.saved_' + value).html('Saved');
		  clear_save();
		  
	   var curr_record_url = "<?=base_url()?>patient/past_record/<?=$mrd_no;?>";
	   var curr_record_view_name = "patient/current_visit_record_view";
	   var curr_date = "<?=date('Y-m-d');?>";

	  var data = {
		"past_date": curr_date,
		"view_name": curr_record_view_name
	  };
		
	   $.get(curr_record_url,data,function(data){
		 $('#tabbottom').html(data);
			// $('#table_list_invest').find('td.detail').each(function(){
				// var curr_text = $(this).text();
				// if(curr_text === column_name){
					// $(this).parent('tr.record_info')
					// .css('background-color', '#ffffff')
					// .css("color", "#5cb1ea")
					// .find('td.detail').css("color", "#02bac5");
				// }
			// });	// end each function 		
		}); // end get ajax
		  
	}); // end post ajax

	} // end else
}); // end of invest submit


</script>


<!-- jQuery if needed -->
<script type="text/javascript">
  $('#dd').on('click', function(event) {
    $(this).toggleClass('active');
    if ($('#dd').hasClass('active')) {
      $('#dd2').removeClass('active');
      $('#dd3').removeClass('active');
      $('#dd4').removeClass('active');
      $('#dd5').removeClass('active');
	  
		var url = "<?= base_url(); ?>patient/get_regimen/<?= $mrd_no ?>";
        $.get(url, function(data) {
          $('#dd ul.dropdown').html(data);
        });
	  
    }

    event.stopPropagation();
  });
  
  
  
  $('#dd2').on('click', function(event) {
    $(this).toggleClass('active');
    if ($('#dd2').hasClass('active')) {
      $('#dd').removeClass('active');
      $('#dd3').removeClass('active');
      $('#dd4').removeClass('active');
      $('#dd5').removeClass('active');
    }
    var url = "<?= base_url(); ?>patient/get_cd4/<?= $mrd_no ?>";
        $.get(url, function(data) {
          $('#dd2 ul.dropdown').html(data);
        });
        event.stopPropagation();

      });
  $('#dd3').on('click', function(event) {
	$(this).toggleClass('active');
	if ($('#dd3').hasClass('active')) {
	  $('#dd').removeClass('active');
	  $('#dd2').removeClass('active');
	  $('#dd4').removeClass('active');
	  $('#dd5').removeClass('active');
	}
	var url = "<?= base_url(); ?>patient/get_vl/<?= $mrd_no ?>";
		$.get(url, function(data) {
		  $('#dd3 ul.dropdown').html(data);
		});
		event.stopPropagation();
	  });
	  $('#dd4').on('click', function(event) {
		$(this).toggleClass('active');
		if ($('#dd4').hasClass('active')) {
		  $('#dd').removeClass('active');
		  $('#dd2').removeClass('active');
		  $('#dd3').removeClass('active');
		  $('#dd5').removeClass('active');
		}

var url = "<?= base_url(); ?>patient/get_creatinine/<?= $mrd_no ?>";
	$.get(url, function(data) {
	  if (data === 'No data') {

	  }
	  $('#dd4 ul.dropdown').html(data);
	});

	event.stopPropagation();
  });
  $('#dd5').on('click', function(event) {
	$(this).toggleClass('active');
	if ($('#dd5').hasClass('active')) {
	  $('#dd').removeClass('active');
	  $('#dd2').removeClass('active');
	  $('#dd3').removeClass('active');
	  $('#dd4').removeClass('active');
	}
	var url = "<?= base_url(); ?>patient/get_patient_weight/<?= $mrd_no ?>";
		$.get(url, function(data) {
		  $('#dd5 ul.dropdown').html(data);
		});
		event.stopPropagation();
	  });


	  $(document).click(function() {
		$('#dd,#dd2,#dd3,#dd4,#dd5').removeClass('active');
	  });
</script>

