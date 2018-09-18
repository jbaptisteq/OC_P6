
$(document).ready(function() {
  $(function() {
    $(".editTrigger").click(function() {
      $("#editButtonVideo" + ($(this).data("button-video-id")) ).toggleClass("hidden");
    });
  });
});
