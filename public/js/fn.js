var showAppLoader = function () {
    $('.app-loader').modal('show');
};
var hideAppLoader = function () {
    $('.app-loader').modal('hide');
};
var showLoading = function () {
    $('.loading').addClass('open');
};
var hideLoading = function () {
    $('.loading').removeClass('open');
};

$(function(){
    $( ".dropdown" ).hover(function() {
        $( this ).addClass( "open" );
    }, function() {
        $( this ).removeClass( "open" );
    });
    $('div[data-toggle="popover"]').hover(function() {
        $( this ).popover('show');
    }, function() {
        $( this ).popover('hide');
    });

    $('.nestable').nestable();

    $('[data-toggle="tooltip"]').tooltip({placement: 'bottom'});
    $('[data-toggle="popover"]').popover({html: true});
});

// browse_server
function open_popup(url){
    var w = 880;
    var h = 570;
    var l = Math.floor((screen.width-w)/2);
    var t = Math.floor((screen.height-h)/2);
    var win = window.open(url, '', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
}
function delImg(id){
    $('#'+id).val('');
}

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
