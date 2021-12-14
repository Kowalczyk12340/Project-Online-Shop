//require('./bootstrap');

global.$ = global.jQuery = require('jquery');
require('bootstrap');
require('./bootstrap.bundle');
require('./bootstrap.esm');
require('./datatables.min');
require('datatables.net');
require('datatables.net-buttons-bs5');
require('datatables.net-buttons');
require('datatables.net-responsive-bs5');
require('./bootstrap.min.js');
require('./bootstrap.bundle.min.js');
require('bootstrap-icons/font/bootstrap-icons.css');
require('../../public/vendor/jsvalidation/js/jsvalidation');
require('alpinejs');

/*
window.$ = window.jQuery = require(jquery);
window.bootstrap = require('bootstrap');
*/
/*var toastElList = [].slice.call(document.querySelectorAll('.toast'));
var toastList = toastElList.map(function (toastEl) {
    return new bootstrap.Toast(toastEl);
});
toastList.forEach(toast => toast.show());

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

window.Swal = require('sweetalert2');*/