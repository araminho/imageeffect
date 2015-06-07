$('document').ready(function(){


    $('body').on('click', '.form_submit', function(){
        var form = $(this).closest('form');
        var formData = new FormData(form[0]);

        // Make the ajax call
        $.ajax({
            url: 'applyeffect.php',
            type: 'POST',
            xhr: function() {
                return $.ajaxSettings.xhr();
            },
            //add beforesend handler to validate or something
            //beforeSend: functionname,
            success: function (json) {
                var res = JSON.parse(json);
                if (res.status == 101 && res.names){
                    var output = 'Applied effects: ' + res.names;
                    if (res.parameter){
                        output += ". Additional parameter: " + res.parameter;
                    }
                    alert (output);
                }
                else {
                    alert ('No effects were applied');
                }
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });

        return false;
    });

});



function addFormRow(){
    var content = $('.form_container').wrap('<div/>').parent().html();
    //console.log(content);
    $('.container').append(content);
}