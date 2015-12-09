$(function(){
    $('.book-view-link').click(function() {
        $.get(
            '/book/view',
            {
                id: $(this).closest('tr').data('key')
            },
            function (data) {
                $('.modal-body').html(data);
                $('#book-modal').modal();
            }
        );
    });
    $('.image-view-link').click(function() {
        $.get(
            '/book/image',
            {
                id: $(this).closest('tr').data('key')
            },
            function (data) {
                $('.modal-body').html(data);
                $('#book-modal').modal();
            }
        );
    });
});