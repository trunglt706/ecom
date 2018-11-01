var showLoading = function () {
    $('.loading').addClass('open');
};
var hideLoading = function () {
    $('.loading').removeClass('open');
}; 
$(function(){
    $('[data-toggle="tooltip"]').tooltip({placement: 'bottom'});
});