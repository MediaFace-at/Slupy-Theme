
//jQuery( document ).ready( function( $ ) {
//    // $() will work as an alias for jQuery() inside of this function
//  $(document).ready(function(){
//        $("a.scrolldown").on('click', function(event) {
//          if (this.hash !== "") {
//            event.preventDefault();
//            var hash = this.hash;
//            $('html, body').animate({
//              scrollTop: $(hash).offset().top
//            }, 800, function(){
//              window.location.hash = hash;
//            });
//          } 
//        });
      
//        function updateStyles(){
//          
//          let root = document.documentElement;
//          root.style.setProperty('--primaryColor', 'white');
        
//        }
      
          // Add smooth scrolling to all links
//          $("a").on('click', function(event) {
//                
//            // Make sure this.hash has a value before overriding default behavior
//            if (this.hash !== "") {
              // Prevent default anchor click behavior
//              event.preventDefault();

//              // Store hash
//              var hash = this.hash;

              // Using jQuery's animate() method to add smooth page scroll
              // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
//              $('html, body').animate({
//                scrollTop: $(hash).offset().top
//              }, 800, function(){

                // Add hash (#) to URL when done scrolling (default click behavior)
//                window.location.hash = hash;
//              });
//            } // End if
//        });

        
//      });

//} );
jQuery(document).ready(function($) {

  // Mobile device check
 // $is_mobile_device = null !== navigator.userAgent.match(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/);
  
 // if ($is_mobile_device) {
  
  //    // Function to check if an element is in the Viewport
  //    isInViewport = function(elem) {
  //      elementTop = elem.offset().top, elementBottom = elementTop + elem.outerHeight(), viewportTop = $(window).scrollTop(), viewportBottom = viewportTop + $(window).height();
  //      return elementBottom > viewportTop && elementTop < viewportBottom;
  //    };
      
      // Apply Parallax transform calculations when scrolling
   //   $(window).scroll(function() {
   //     $(".et_parallax_bg").each(function() {
   //       var $this_parent = $(this).parent();
   //       // Check if the parent element is on-screen
   //       var $is_visible = isInViewport($this_parent);
   //     if ($is_visible) {
   //       element_top = $this_parent.offset().top,
  //        parallaxHeight = $(this).parent(".girls-header.parallax_container").length && $(window).height() > $this_parent.innerHeight() ? $(window).height() : $this_parent.innerHeight(),
         // bg_height = .3 * $(window).height() + parallaxHeight,
          //main_position = "translate(0, " + .3 * ($(window).scrollTop() + $(window).height() - element_top) + "px)";
        //  $(this).css({height: bg_height,"-webkit-transform": main_position,"-moz-transform": main_position,"-ms-transform": main_position,transform: main_position});
      //  }
    //  });
  //  });  
      
  //}

  var lightbox = $('a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]').simpleLightbox();
  
  $('#menu-icon').on('click',function(){
    $('#site-navigation').toggleClass('active');
    $('#closer').toggleClass('active');
  });
  $('#closer').on('click',function(){
    $('#site-navigation').toggleClass('active');
    $('#closer').toggleClass('active');
  });

  $('[data-toggle="tooltip"]').tooltip();
  
});
