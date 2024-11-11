$(document).ready(function(){
    $('#seeMoreStudios').click(function(){
      // Slide down additional studio rows
      $('.more-studios').slideDown("slow");
      
      // Hide the 'See more studios' button
      $(this).hide();
      
      // Show the 'See all studios' link
      $('#seeAllStudios').show();
    });
  
  //login dropdown menu 
  $('#dropdown-login-button').click(function(){
    $('.dropdown-menu').slideToggle();
    });
  });