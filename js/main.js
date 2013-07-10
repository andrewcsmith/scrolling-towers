jQuery(function() {
  // Things to do with desktop
  if(($('.primary-menu').css('font-size') != '20px')) {
   jQuery("#feed-container").width((jQuery(".article-container-wrapper").size() * 440));
   
   var height_change_callback = function() {
     var bodyheight = jQuery(window).height();
     jQuery("#feed-container .article-container").each(function() {
   		jQuery(this).css("height", bodyheight-80);
   	});
   }
   var width_change_callback = function() {
   	var bodywidth = jQuery(window).width();
   	jQuery("#main.horizontal .left article.post").each(function() {
   		jQuery(this).css("width", bodywidth-554);
   	});
   }
   jQuery(document).ready(height_change_callback);
   jQuery(document).ready(width_change_callback);
   // for the window resize
   jQuery(window).resize(height_change_callback);
   // for the horizontal post resize
   jQuery(window).resize(width_change_callback);

   // Hide all the submenus whenever we depart the area
   function hideSubMenus() {jQuery("ul.sub-menu").hide();}
   jQuery(".primary-menu").mouseleave(function() {hideSubMenus();});

   // An array of the top-level menus we want to use
   var primaryMenus = jQuery('#menu-primary-menu > li.menu-item');
   jQuery.each(primaryMenus, function(index, el) {
   	jQuery("#"+el.id).mouseenter(function() {
   		hideSubMenus();
   		jQuery("#"+el.id + " ul.sub-menu").show();
   	});
   });
  } else {
    // Do these with mobile
    
    // Scroll to where you can see the menu bar
    jQuery(document).scrollTop($('div.article-container-wrapper').position().top);
  }
});

// If the namenav.gif image exists, replaces the home button with it.
jQuery(function() {
  var icon_url = 'http://www.bethobrien.com/images/namenav.gif';
  jQuery.ajax({
    url:icon_url,
    type:'HEAD',
    error: function() {
      jQuery(".menu-item-home a").html("Home");
    },
    success: function() {
      // if(!$('#feed-container').css('margin') == '0px'){
      jQuery(".menu-item-home a").html("<img src=\""+ icon_url + "\">")}
    // }
  });
});

// Centering machine
jQuery(function() {
  var to_center = jQuery("[centered=yes]");
  to_center.css('position', 'relative');
  to_center.css('left', function(index, value){
    console.log(this);
    return (360 - this.width) / 2;
  });
});