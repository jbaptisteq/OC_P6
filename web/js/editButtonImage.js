
$(document).ready(function() {
  $(function() {
    $(".editTrigger").click(function() {
      $("#editButtonImage" + ($(this).data("button-image-id")) ).toggleClass("hidden");
    });
  });
});
