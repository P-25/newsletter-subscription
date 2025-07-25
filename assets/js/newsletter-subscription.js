jQuery(document).ready(function ($) {
  $("#ns-newsletter-form").on("submit", function (e) {
    e.preventDefault();

    const form = $(this);
    const message = $("#ns-message");
    const submitButton = form.find('button[type="submit"]');

    const formData = form.serializeArray();

    $.ajax({
      url: ns_obj.ajax_url,
      data: formData,
      method: "POST",
      beforeSend: function () {
        submitButton.html("Subscribing ...").prop("disabled", true);
      },
      success: function (response) {
        const responseMessage = response.data.message;
        if (response.success) {
          message.html(`<p style="color:green;">${responseMessage}</p>`);
        } else {
          message.html(`<p style="color:red;">${responseMessage}</p>`);
        }
      },
      error: function (error) {
        console.error(error);
        message.html(
          `<p style="color:red;">Something went wrong. Please try again.</p>`
        );
      },
      complete: function () {
        submitButton.html("Subscribe").prop("disabled", false);
      },
    });
  });
});
