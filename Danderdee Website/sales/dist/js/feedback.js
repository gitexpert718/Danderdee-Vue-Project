webpackJsonp([3],{

/***/ 24:
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {

$(function () {
    var subject = $('#subject');
    var message = $('#message');
    var file = $('#file');
    var submit = $('#submit');

    var imageFile = void 0;

    var myPixie = Pixie.setOptions({
        onSave: function onSave(data, img) {
            imageFile = data;
            file.next('.glyphicon').removeClass('hidden');
        },
        appendTo: 'body'
    });

    file.on('click', function (e) {
        myPixie.open();
    });

    $('#feedback-form').on('submit', function (e) {
        e.preventDefault();
        $(this).find('.form-group').removeClass('has-error');

        if (!subject.val()) {
            subject.closest('.form-group').addClass('has-error');
            return false;
        }

        if (!message.val()) {
            message.closest('.form-group').addClass('has-error');
            return false;
        }

        var data = {
            subject: subject.val(),
            message: message.val(),
            file: imageFile
        };

        alert('Submitted');
    });
});
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(0)))

/***/ })

},[24]);
//# sourceMappingURL=feedback.js.map