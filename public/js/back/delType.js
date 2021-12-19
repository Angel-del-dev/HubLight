$(document).ready(function() {
    $('span i').on('click',function() {
        let id=$(this).data('id');
        $.ajax({
            url: "/back/admin/tipususer",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "DELETE",
            data: {
                id: id
            },
            dataType: 'json',

            success: function(data){
                window.location="/back/admin/tipususer";
            }

        });
    });
});
