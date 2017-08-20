/**
 * Preview function.
 */
function preview()
{
    var name = $("#name").val();
    var email = $("#email").val();
    var text = $("#text").val();
    var file = document.getElementById("image");
    var preview = $("#preview");
    preview.empty();
    preview.append("<h2>Предпросмотр</h2>");
    preview.append("<p><b>Имя:</b> " + name + "</p>");
    preview.append("<p><b>E-mail:</b> " + email + "</p>");
    preview.append("<p><b>Текст:</b> " + text + "</p>");
    preview.append("<p><b>Изображение:</b></p>");
    preview.append("<p><img id='previewImg' style='max-width: 320px; max-height: 240px;'/></p>");
    previewImage(file);
}

/**
 * Image preview function/
 * @param input  Input element.
 */
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#previewImg').attr('src', e.target.result)
        };

        reader.readAsDataURL(input.files[0]);
    }
}