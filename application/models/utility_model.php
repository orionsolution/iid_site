<?php
Class Utility_model extends CI_Model
{
	function generate_tb(){
	//echo "aaa";
		$inv_arr=array(
1=>'HIV_I_II',
2=>'HIV_PCR',
3=>'WESTERN_BLOT',
4=>'HBSAG',
5=>'HCV',
6=>'VDRL',
7=>'BUN',
8=>'CREATININE',
9=>'SODIUM',
10=>'POTASSIUM',
11=>'TOTAL_BILIRUBIN',
12=>'DIRECT_BILIRUBIN',
13=>'INDIRECT_BILIRUBIN',
14=>'SGOT',
15=>'SGPT',
16=>'ALK_PHOS',
17=>'BSF',
18=>'TRIGLYCERIDES',
19=>'CHOLESTEROL',
20=>'HDL',
21=>'LDL',
22=>'VLDL',
23=>'TC_HDLC',
24=>'HDLC_LDLC',
25=>'HAEMOGLOBIN',
26=>'WBC',
27=>'PLATELETS',
28=>'CD4',
29=>'CD8',
30=>'CD3',
31=>'CD4_CD8',
32=>'VIRAL_LOAD',
33=>'LACTATE',
34=>'AMYLASE',
35=>'LIPASE',
36=>'LDH',
37=>'METHOD ELISA',
38=>'RESULT ELISA',
39=>'FNAC Cytological Diagnosis',
40=>'FNAC MICROSCOPY',
41=>'Magnesium',
42=>'Phosphorus',
43=>'PT INR',
44=>'Modified AFB STOOL',
45=>'Result TPHA',
46=>'Total Proteins',
47=>'Albumin',
48=>'Globulin',
49=>'Uric Acid',
50=>'Proteins Urine',
51=>'ASO titre',
52=>'CPK Total',
53=>'BSPP',
54=>'BSR',
55=>'TIBC',
56=>'SR IRON',
57=>'Dengue Test',
58=>'T3',
59=>'T4',
60=>'TSH',
61=>'Result MP',
62=>'RA FACTOR TITRE',
63=>'24 Hrs Urinary Proteins',
64=>'Ferritin',
65=>'CRP Quantitative',
66=>'Result HbsAb',
67=>'Anti Hep B Surface Ag & Ab',
68=>'HbeAg',
69=>'HBsAg CMIA microwell',
70=>'Anti Hcv AB',
71=>'Procalcitonin',
72=>'Genotypic Viral Res',
73=>'VDRL TEST II',
74=>'PHOSPHROUS',
75=>'CRYPTOCOCCUS');
	//print_r($inv_arr);
	$sql="select * from pi_investigation where transfer_flag!='Done' limit 3000";
	$query = $this->db->query($sql);           
    foreach($query->result_array() as $row):
		$details_id=$row["details_id"];
		$mrdno=$row["mrdno"];
		$inv_source=$row["inv_source"];
		$report_dt=$row["report_dt"];
		$visit_dt=$row["visit_dt"];
		foreach($inv_arr as $curr_id=>$curr_inv):
			$curr_fld_val=$row[$curr_inv];
			if($curr_fld_val!=NULL):
				//echo "<br>$mrdno-$inv_source-$report_dt-$curr_id-$curr_fld_val";
				$ins_sql="insert into pi_inv(mrdno,head_id,inv_source,visit_dt,report_dt,param_id,addinfo)
					values('$mrdno','272','$inv_source','$visit_dt','$report_dt','$curr_id','$curr_fld_val')";
				$this->db->query($ins_sql);
				//echo "<br> $ins_sql";
			endif; 
		endforeach;
		$up_sql="update pi_investigation set transfer_flag='done' where details_id='$details_id'";
		$this->db->query($up_sql);
		echo "<br>$up_sql<hr>";	
    endforeach;
	}
}
?>