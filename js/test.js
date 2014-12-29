$(document).ready(function(){
  
	var num = '<?php echo $number_of_relationship; ?>';

	



	for(i=1;i<=num;i++){
		$('head').append('<script>$(document).ready(function(){$(".profile'+i+'").on("taphold",function(){$(".delete").show();$(".undo").show();$(".profile'+i+'").addClass("selected");$(".delete-friend'+i+'").show();$(".hide-manage'+i+'").hide();</script>');
		


	  });
	});




			
