$(function(){
   var path = location.href;
   var path_arr=path.split("/");
   var array_length=path_arr.length
   if (array_length > 0){
     file=path_arr[array_length-1];
	 var file_arr=file.split("#");
	 var arr_length=file_arr.length;
	 
	 if (arr_length == 2){
		file=file_arr[arr_length-2];
   	 }
   }
   else{
       file=path;
   }
   
    //alert(arr_length);
	
	if (file && (file!='index.php')){
	 $('#topmenu ul li a[href$="' + file + '"]').attr('class', 'active');
	} else {
	 $('#topmenu ul li a[href$="index.php"]').attr('class', 'activel');
	}
	
	$(".main_menu div").hover(function () {
		$('#m1').addClass('active');
	},
	function () {
		$('#m1').removeClass('active');
	});
});
