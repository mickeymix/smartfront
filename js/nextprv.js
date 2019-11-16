// $(document).ready(function(){
//     $('a.imgprd').click(function(){
//       var largeImage = $(this).attr('data-full');
// 	   var dataCount = $(this).attr('data-count');
//       $('.selected').removeClass('selected');
//       $(this).addClass('selected');
//       $('.full img').hide();
//       $('.full img').attr('src', largeImage);
//       $('.full img').fadeIn();
//
// 	  $('.drift-demo-trigger').attr('data-zoom' , largeImage);
//
// 	  	var max = $('.imgprd').length;
// 		if(dataCount == max){
//
//
// 			 $(".youtube-play").css("display", "");
//
// 		}else{
//
// 			 $(".youtube-play").css("display", "none");
// 		}
//
//     }); // closing the listening on a click
//
//
//   //  $('.full img').on('click', function(){
//   //    var modalImage = $(this).attr('src');
//    //   $.fancybox.open(modalImage);
//    // });
//   }); //closing our doc ready
  


  
//  $('#nextimg').click(function(){
	
	function nextimg(){

		
	
	
	var max = $('.imgprd').length;

	var curr = parseInt($('.selected').attr('data-count'))+1;

	if(curr > max){
	curr = 1;
	}	
		if(curr == max){
		

			 $(".youtube-play").css("display", "");
			 
		}else{
		
			 $(".youtube-play").css("display", "none");
		}	
	
      var largeImage = $('.previews').find("[data-count='" + curr + "']").attr('data-full'); 
	  
      $('.selected').removeClass('selected');	  
      $('.previews').find("[data-count='" + curr + "']").addClass('selected');  
      $('.full img').hide();
      $('.full img').attr('src', largeImage);
      $('.full img').fadeIn();	  
	  $('.drift-demo-trigger').attr('data-zoom' , largeImage);
	}

//    });
	
//	$('#prvimg').click(function(){
	function prvimg(){
	var min = 1;
	var curr = parseInt($('.selected').attr('data-count'))-1;
	if(curr < min){
	curr = $('.imgprd').length;
	}
		var max = $('.imgprd').length;
		if(curr == max){
		

			 $(".youtube-play").css("display", "");
			 
		}else{
		
			 $(".youtube-play").css("display", "none");
		}	
	
      var largeImage = $('.previews').find("[data-count='" + curr + "']").attr('data-full'); 
	
	  
         $('.selected').removeClass('selected');
	  
	  
      $('.previews').find("[data-count='" + curr + "']").addClass('selected');
	  
	
	  
	  
      $('.full img').hide();
      $('.full img').attr('src', largeImage);
      $('.full img').fadeIn();  
	  $('.drift-demo-trigger').attr('data-zoom' , largeImage);

	}
//    });
	
	
	
	 $(document).ready(function() {
							
		//Click will scroll image thumnails to the bottom
		$("#imageThumbnail-ScrollDown").click(function() {
	
			if ((parseInt($("#imageThumbnailCarousel").css("top")) * -1) < parseInt($("#imageThumbnailCarousel").css("height")) - parseInt($("#imageThumbnailMask").css("height"))) {
				var height = parseInt($("#imageThumbnailCarousel").css("height")) - parseInt($("#imageThumbnailMask").css("height")) - (parseInt($("#imageThumbnailCarousel").css("top")) * -1);

				$("#imageThumbnailCarousel").animate({
					top: parseInt($("#imageThumbnailCarousel").css("top")) - height + "px"
				}, 500);
			} else {
				$("#imageThumbnailCarousel").css("top", -1 * (parseInt($("#imageThumbnailCarousel").css("height")) - parseInt($("#imageThumbnailMask").css("height"))) + "px");
			}
		});

		//Hover will slowly scroll imagethumbnails down
		$("#imageThumbnail-ScrollDown").mouseenter(function() {
			scrollDown = setInterval(function() {
				if (parseInt($("#imageThumbnailCarousel").css("height")) - parseInt($("#imageThumbnailMask").css("height")) > (parseInt($("#imageThumbnailCarousel").css("top")) * -1)) {
					$("#imageThumbnailCarousel").css("top", "-=7");
				}
			}, 50);
		}).mouseleave(function() {
			clearInterval(scrollDown);
		});

		//Click will scroll image thumbnails to the top
		$("#imageThumbnail-ScrollUp").click(function() {
			if (parseInt($("#imageThumbnailCarousel").css("top")) < 0) {
				var height = parseInt($("#imageThumbnailCarousel").css("top")) * -1;

				$("#imageThumbnailCarousel").animate({
					top: parseInt($("#imageThumbnailCarousel").css("top")) + height + "px"
				}, 500);
			} else {
				$("#imageThumbnailCarousel").css("top", "0px");
			}
		});

		//Hover will slowly scroll imagethumbnails up
		$("#imageThumbnail-ScrollUp").mouseenter(function() {
			scrollUp = setInterval(function() {
				if (parseInt($("#imageThumbnailCarousel").css("top")) < 0) {
					$("#imageThumbnailCarousel").css("top", "+=7");
				}
			}, 50);
		}).mouseleave(function() {
			clearInterval(scrollUp);
		});

		var titleRowHeight = -15 - $('#productDetailTitleRow').height();
		//$('#product-detail-page-main').children('#productOptionSelectionPanel').css('top', titleRowHeight);
		document.querySelector('style').textContent +=
			'@media screen and (min-width:768px) { #product-detail-page-main #productOptionSelectionPanel{ top:' + titleRowHeight + 'px;}}';
	});
