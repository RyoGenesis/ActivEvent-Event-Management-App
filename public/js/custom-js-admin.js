// $(document).ready(function() {
//     $('#faculty_id').change(function() {
//         $.ajax({
//             url : ''+'/api/faculty-majors',
//             type : 'get',
//             data : {
//                 id: $(this).val(),
//             },
//             success : function (response) {
//                 var majorId = $("#major_id");
//                 $majorID.html('');
//                 $.each(response, function (i, item) {
//                     majorId.append("<option value='" + item['id'] + "'>" + item['name'] + "</option>");
//                 });
//                 majorId.prop('disabled',false);
//             },
//             error: function(err) {
//             }
//         })
//     });
// });