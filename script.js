$(function () {

  $("#reload-captcha").click(function () {

    $('#img-captcha').attr('src', 'captcha.php?id=' + Math.random() + '');
  });


  $('#contactForm').submit(function (event) {

    event.preventDefault();

    var formValid = true;

    $('#contactForm input,textarea').each(function () {

      if ($(this).attr('id') == 'text-captcha') {
        return true;
      }

      var formGroup = $(this).parents('.form-group');

      var glyphicon = formGroup.find('.form-control-feedback');

      if (this.checkValidity()) {

        formGroup.addClass('has-success').removeClass('has-error');

        glyphicon.addClass('glyphicon-ok').removeClass('glyphicon-remove');
      } else {

        formGroup.addClass('has-error').removeClass('has-success');

        glyphicon.addClass('glyphicon-remove').removeClass('glyphicon-ok');

        formValid = false;
      }
    });

    var captcha = $("#text-captcha").val();

    if (captcha.length != 6) {

      inputCaptcha = $("#text-captcha");

      formGroupCaptcha = inputCaptcha.parents('.form-group');

      glyphiconCaptcha = formGroupCaptcha.find('.form-control-feedback');

      formGroupCaptcha.addClass('has-error').removeClass('has-success');

      glyphiconCaptcha.addClass('glyphicon-remove').removeClass('glyphicon-ok');
    }

    if (formValid && captcha.length == 6) {

      var name = $("#name").val();

      var email = $("#email").val();

      var message = $("#message").val();
      var captcha = $("#text-captcha").val();
      var formData = new FormData();

      formData.append('name', name);

      formData.append('email', email);

      formData.append('message', message);

      formData.append('captcha', captcha);

      $.ajax({

        type: "POST",

        url: "process.php",

        data: formData,

        contentType: false,

        processData: false,

        cache: false,

        success: function (data) {
          var $data = JSON.parse(data);

          $('#error').text('');


          if ($data.result == "success") {

            $('#contactForm input,textarea').each(function () {
              var formGroup = $(this).parents('.form-group');

              var glyphicon = formGroup.find('.form-control-feedback');

              formGroup.removeClass('has-success has-error');

              glyphicon.removeClass('glyphicon-remove glyphicon-ok');
            });

            $('#contactForm input,textarea').val('');
            $('#contactForm input,textarea').css('background-color', '#fff')

            $('#img-captcha').attr('src', 'captcha.php?id=' + Math.random() + '');

            $('#successMessageModal').modal('show');
          } else if ($data.result == "invalidCaptcha") {

            inputCaptcha = $("#text-captcha");

            formGroupCaptcha = inputCaptcha.parents('.form-group');

            glyphiconCaptcha = formGroupCaptcha.find('.form-control-feedback');

            formGroupCaptcha.addClass('has-error').removeClass('has-success');

            glyphiconCaptcha.addClass('glyphicon-remove').removeClass('glyphicon-ok');

            $('#img-captcha').attr('src', 'captcha.php?id=' + Math.random() + '');

            $("#text-captcha").val('');
          } else {

            $('#error').text('Произошли ошибки при отправке формы на сервер.');
          }
        },
        error: function (request) {
          $('#error').text('Произошла ошибка ' + request.responseText + ' при отправке данных.');
        }
      });
    }
  });
});