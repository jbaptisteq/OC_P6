
$(document).ready(function() {
  $(function() {
    $(".deleteTrigger").click(function() {
      $("#deleteButtonImage" + ($(this).data("button-image-id")) ).toggleClass("hidden");
    });
  });
});
