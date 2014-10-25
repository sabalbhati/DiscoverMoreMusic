// get ready option
$(document).ready(function(){
  
  $("#search").width(33);
  $("#filter").width(0).css("border", "none");

  //on load, minimize search bar
  $("#searchButton").mouseover(function(){
      var toggleWidth = $(this).parent().width() == 33 ? "405px" : "33px";
      var toggleFilter = $("#filter").width() == 0 ? "370px" : "0px";
      $(this).parent().animate({ width: toggleWidth});
      $("#filter").animate({width: toggleFilter});
  });

  // the search index
  $("#filter").keyup(function(){

    // Retrieve the input field text and reset the count to zero
    var filter = $(this).val();
    var count = 0;

    // The items that are to be searched
    $(".title").each(function(){
      // If the list item does not contain the text phrase fade it out
      // case insensitive matching using "i" in the RegExpression
      if ($(this).text().search(new RegExp(filter, "i")) < 0) {
          $(this).parent().fadeOut();

      // Show the list item if the phrase matches and increase the count by 1
      } else {
          $(this).parent().fadeIn();
          count++;
      }
    });

    // Update the count
    var numberItems = count;
    $("#filtered_count").text("Found "+count+ " matches");
  });
});