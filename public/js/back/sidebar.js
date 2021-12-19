jQuery(function ($) {

    $(".sidebar-dropdown > a").click(function() {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this)
      .parent()
      .hasClass("active")
  ) {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .parent()
      .removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .next(".sidebar-submenu")
      .slideDown(200);
    $(this)
      .parent()
      .addClass("active");
  }
});

$("#close-sidebar").click(function() {
  $(".page-wrapper").removeClass("toggled");
});
$("#show-sidebar").click(function() {
  $(".page-wrapper").addClass("toggled");
});

function readURL(input) {
    var id = $(input).attr("id");

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('label[for="' + id + '"] .upload-icon').css("border", "none");
        $('label[for="' + id + '"] .icon').hide();
        $('label[for="' + id + '"] .prev').attr('src', e.target.result).show();
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("input[id^='file-input']").change(function() {
    readURL(this);
  });


});
