$(function() {

    $('.list .task').each(function(element) {
        $(this).find('.description').hide();

        var name = $(this).find('.item .name').text();

        var newName = $('<a></a>');
        newName.text(name);
        $(this).find('.item .name').empty();
        $(this).find('.item .name').append(newName);
    });

    $('.task .name a').on('click', function() {
        $('.task').has(this).find('.description').slideToggle(100);
    });

});