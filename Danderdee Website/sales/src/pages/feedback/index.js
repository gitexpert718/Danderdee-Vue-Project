
$(() => {
    const subject = $('#subject');
    const message = $('#message');
    const file = $('#file');
    const submit = $('#submit');

    let imageFile;

    const myPixie = Pixie.setOptions({
        onSave: function(data, img) {
            imageFile = data;
            file.next('.glyphicon').removeClass('hidden');
        },
        appendTo: 'body'
    });

    file.on('click', function(e) {
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

        let data = {
             subject: subject.val(),
             message: message.val(),
             file: imageFile
         };

        alert('Submitted');
    })
})
