$(document).ready(function () {

    $('#form_comment_submit').click(function () {
        var new_comment_msg = $('#new_comment_msg').val();
        if (new_comment_msg) {
            var image_id = $('#form_comment_submit').data('id');
            $.ajax({
                type: 'POST',
                url: '/image/comment',
                data: {msg: new_comment_msg, img_id: image_id},
                dataType: 'html',
                success: function (data) {
                    $('#comments').prepend(data);
                    $('#new_comment_msg').val('');
                    var scrollTop = $('#scroll_to_id').offset().top;
                    $(document).scrollTop(scrollTop);
                    $('#myModal').modal('hide')
                }
            });
        } else {
            alert("Введите текст")
        }
        return false;
    });

    


});

