jQuery(function ($) {
  $("body").on("click", ".np-upl", function (e) {
    e.preventDefault();
    var button = $(this),
      custom_uploader = wp
        .media({
          title: "Carregar Logo",
          library: {
            type: "image",
          },
          button: {
            text: "Usar Logo",
          },
          multiple: false,
        })
        .on("select", function () {
          var attachment = custom_uploader
            .state()
            .get("selection")
            .first()
            .toJSON();
          button
            .html('<img src="' + attachment.url + '" />')
            .next()
            .show()
            .next()
            .val(attachment.id);
        })
        .open();
  });

  $("body").on("click", ".np-rmv", function (e) {
    e.preventDefault();
    var button = $(this);
    button.next().val("").button.hide().prev().html("Carregar Logo");
  });
});
