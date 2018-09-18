
$(document).ready(function() {
  $(function() {
    $(".deleteTrigger").click(function() {
      $("#deleteButtonVideo" + ($(this).data("button-video-id")) ).toggleClass("hidden");
    });
  });
});
