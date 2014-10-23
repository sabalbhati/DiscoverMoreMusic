// get ready option
$(document).ready(function(){
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