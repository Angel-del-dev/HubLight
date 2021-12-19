$(document).ready(function() {

    let info = $("#table-info");
    // Perfil
    $(info).on('focusout',function(e) {

        $.ajax({
            url: "/usuaris/update",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                // console.log(data);
            }
        });
    });


});
