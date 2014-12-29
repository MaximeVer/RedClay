
	$(document).ready(function(){
  $(".friend").on("tap",function(){
    $('.friend-notification').toggle("slow");
  });
});
	$(document).ready(function(){
  $(".profile1").on("taphold",function(){
    $('.delete').show();
    $('.undo').show();
    $('.profile1').addClass('selected');
    $('.delete-friend1').show();
    $('.hide-manage1').hide();
    


  });
});
	$(document).ready(function(){
  $(".delete1").on("tap",function(){
    $('.profile1').hide('slow');


  });
});
	$(document).ready(function(){
  $(".undo").on("tap",function(){
    $('.delete').hide();
    $('.undo').hide();
    $('.profile1').removeClass('selected');
    $('.delete-friend1').hide();
    $('.hide-manage1').show();


  });
});

  $(document).ready(function(){
  $(".profile2").on("taphold",function(){
    $('.delete').show();
    $('.undo').show();
    $('.profile2').addClass('selected');
    $('.delete-friend2').show();
    $('.hide-manage2').hide();


  });
});
  $(document).ready(function(){
  $(".delete2").on("tap",function(){
    $('.profile2').hide('slow');

  });
});
  $(document).ready(function(){
  $(".undo").on("tap",function(){
    $('.delete').hide();
    $('.undo').hide();
    $('.profile2').removeClass('selected');
    $('.delete-friend2').hide();
    $('.hide-manage2').show();


  });
});
