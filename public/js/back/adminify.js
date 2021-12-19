$(document).ready(function() {
    let pag = $("#pag").val();
    // Adminify
    $("input:checkbox").on('change',function(e) {

        let aux=(e.target.checked) ? 1 : 0;
        let id=$(this).data("id");

        $.ajax({
            url: (pag==="admin") ? "/back/admin/u/adminify" : "/back/admin/u/block",
            // url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "PUT",
            data: {
                id: id,
                aux: aux
            },
            dataType: 'json',

            success: function(data){
                // console.log(data);
            }

        });
    });

    $('form').on('submit',function(e) {
        e.preventDefault();
        let selects=$('select');
        for(let i=1;i<selects.length;i++) {
            if(selects[i].value>0) {
            let avis=selects[i].value;
            let user=selects[i].closest("tr");
            user=$(user).data('id');

            $.ajax({
                url: "/back/admin/u/notify",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: {
                    avis: avis,
                    user: user
                },
                dataType: 'json',

                success: function(data){
                    // console.log(data);
                }

            });
            }
        }
        $('select').val(0);
    });
});
