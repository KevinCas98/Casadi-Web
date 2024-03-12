$(function() {
    $('.open-modal').click(function () {
        var src = $(this).attr("data-src");
        $.get(src, function(data){$("#modal-content").html(data)});  
        $('#contentModal').modal('show');
    });
    $('#myModal button').click(function () {
        $('#myModal iframe').removeAttr('src');
    });
});
