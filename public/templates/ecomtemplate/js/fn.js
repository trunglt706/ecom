var showAppLoader = function () {
    $('.app-loading').addClass('open');
    // $('.app-loader').modal('show');
};
var hideAppLoader = function () {
    $('.app-loading').removeClass('open');
    // $('.app-loader').modal('hide');
};
var showLoading = function () {
    $('.loading').addClass('open');
};
var hideLoading = function () {
    $('.loading').removeClass('open');
};
$(document).ready(function(){
    // waves effects
    Waves.init();
    Waves.attach('.button', ['waves-button', 'waves-float', 'waves-effect']);

    $(window).scroll(function () {
        if($(this).scrollTop() > 100) {
            $('#back-top').fadeIn();
        } else {
            $('#back-top').fadeOut();
        }

    });

    // scroll body to 0px on click
    $('#back-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

    $('[data-toggle="tooltip"]').tooltip()
});
function tableRefesh(selecttor){
    var arr = [];
    $(selecttor + ' .table-content thead tr:first-child th').each(function(index, value){
        arr.push($(this).width());
    })
    arr.pop();
    $(selecttor + ' .table-header thead tr:first-child th').each(function(index, value){
        $(this).width(arr[index]);
    })
}
