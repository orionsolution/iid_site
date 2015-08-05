<table id="table_list2" width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr class='headrow'>
					<td width="11%">date</td>
					<td width="30%">history</td>
					<td width="15%">EXAMINATION</td>
					<td width="14%">DIAGNOSIS</td>
					<td width="30%">treatment</td>
				  </tr>
				  <?
					$cnt=0;
					foreach($patient_visited_dates as $row): ?>
				  <? 
				  //print_r($row);
				  //exit;
				  if($cnt++>=3) break;
				  $visit_date = date("d M Y", strtotime($row->visit_dt)); ?>
					  <tr class="td_header">

						<td><?=$visit_date?></td>

						<td><? foreach($history_visit as $his_visit):
							//print_r($his_visit);
							$his_visit['head'] = str_replace('_', ' ', $his_visit['head']);
							if(date("d M Y", strtotime($his_visit['visit_dt'])) === $visit_date):
								if($his_visit['addinfo']!="--"):
									echo ucwords($his_visit['parameter'])." : ".$his_visit['addinfo']."<br>";
								else:
									echo ucwords($his_visit['parameter'])."<br>";
								endif;
							endif;
						   endforeach;?>
						   </td>

						 <td><? foreach($examinations_visit as $exam_visit):
							$exam_visit['head'] = str_replace('_', ' ', $exam_visit['head']);
							if(date("d M Y", strtotime($exam_visit['visit_dt'])) === $visit_date):
								echo ucwords($exam_visit['parameter'])." : ".$exam_visit['addinfo']."<br>";
							endif;
						   endforeach;?>
						   </td>

						<td><? foreach($diagnosis_visit as $diagnosis_visits):
							$diagnosis_visits['head'] = str_replace('_', ' ', $diagnosis_visits['head']);
							if(date("d M Y", strtotime($diagnosis_visits['visit_dt'])) === $visit_date):
								echo ucwords($diagnosis_visits['parameter'])." : ".$diagnosis_visits['addinfo']."<br>";
							endif;
						   endforeach;?></td>

						<td class="last"><? foreach($treatment_visit as $treatment_visits):
							$treatment_visits['head'] = str_replace('_', ' ', $treatment_visits['head']);
							if(date("d M Y", strtotime($treatment_visits['visit_dt'])) === $visit_date):
								echo ucwords($treatment_visits['parameter'])." : ".$treatment_visits['addinfo']."<br>";
							endif;
						   endforeach;?></td>
					  </tr>
				  <?endforeach;?>
				</table>