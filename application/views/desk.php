<link rel="stylesheet" href="<?php echo base_url(); ?>css/desk.css">		
	<div style="width:900px; padding-bottom:20px;">	
		<div class="box pq fltleft">
			<div class="top">
				<h2>Pending Queue (<span class="pending_count"><?php echo $pending_count; ?></span>)</h2>
				<table width="100%" border="0" cellspacing="2" cellpadding="0">
				  <tr>
					<td width="7%">no.</td>
					<td width="10%">mrd.</td>
					<td width="35%">name</td>
					<td width="28%">last attended by</td>
					<td width="20%">actions</td>
				  </tr>
				</table>
			</div>
			<div class="bottom">
				<table id="table_list" width="100%" border="0" cellspacing="0" cellpadding="0">
				<?php $count=0;
				foreach ($pending_queue as $patient):
					$count++;
					$mrdno=$patient["mrdno"];
					$firstname=$patient["firstname"];
					$surname=$patient["surname"];
					$visit_status=$patient["visit_status"];
					$attended_by = $patient['attended_by'];
					$status_html="<a class='open' href='".base_url()."patient/visit/$mrdno'>Open</a>";

					echo "<tr class='td_header' onclick='document.location=\"".get_url($mrdno)."\";'>
							<td width='7%'>$count.</td>
							<td width='10%'>$mrdno</td>
							<td width='35%' class='name'>$firstname $surname</td>
							<td width='28%'>$attended_by</td>
							<td width='20%'>
                            	<div class='dnedit'>
									<a class='open' href='".base_url()."patient/visit/$mrdno'>Open</a>
									<a class='del' href='".base_url()."desk/remove_patient_entry/$mrdno'></a>						
									<br class='clearfloat' />
                                </div>
                            </td>
						</tr>";
				endforeach; ?>
				</table>
			</div>
		</div>
		<div class="box dq fltright">
			<div class="top">
				<h2>Completed Queue (<span class="completed_count"><?php echo $completed_count; ?></span>)</h2>
				<table width="100%" border="0" cellspacing="2" cellpadding="0">
				  <tr>
					<td width="15%">mrd.</td>
					<td width="50%">name</td>
					<td width="35%">attended by</td>
				  </tr>
				</table>
			</div>
			<div class="bottom">
				<table id="table_list" width="100%" border="0" cellspacing="0" cellpadding="0">
				<?php				
				function get_url($mrdno){
					return base_url(). "patient/visit/$mrdno"; 
				}
				
				foreach ($done_queue as $patient):	
					$mrdno=$patient["mrdno"];
					$firstname=$patient["firstname"];
					$surname=$patient["surname"];
					$visit_status=$patient["visit_status"];
					$in_time=$patient["in_time"];
					$out_time=$patient["out_time"];
					$attended_by = $patient['attended_by'];
					$in_tm = new DateTime($in_time);
					$out_tm = new DateTime($out_time);
					if($out_time):
						$timestamp_from = (int) $out_tm->format('U');
						$timestamp_to = (int) $in_tm->format('U');
						$mins = (int) round(($timestamp_from - $timestamp_to)/(60));
						if($mins<60):
							$time_disp=$mins."min";
						else:
							$time_disp=round($mins/60).".".($mins % 60)."Hrs";
						endif;
					endif;
					echo "<tr class='td_header' onclick='document.location=\"".get_url($mrdno)."\";'>							
							<td width='15%'>$mrdno</td>
							<td width='50%' class='name'>$firstname $surname</td>
							<td width='35%'>$attended_by</td>						
						</tr>";
				endforeach; ?>
				</table>
			</div>
		</div>
		<br class="clearfloat" />
	</div>