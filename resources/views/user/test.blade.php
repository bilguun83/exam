{!!display_test(Auth::user()->id)!!}
<script>

function handleChange(id,q_id) {
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url : "/student/postdata",
    type: "POST",
    dataType: "JSON",
    data: {id:id, q_id:q_id },
    async: true,
    success: function(json)
    {
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Error getting data from ajax');
    }
});

// alert('Trainee_Quiz_ID (QUIZ ID) : ' + a+' Answer Num (Answer_ID):'+b);

}
</script>


