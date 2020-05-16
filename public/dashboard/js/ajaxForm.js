var url = "/tasks";

//display modal form for task editing
$(document).on('click','.open_modal',function(){
    var id = $(this).val();

    $.get(url + '/' + id, function (data) {
        //success data
        console.log(data);
        $('#id').val(data.id);
        $('#time').val(data.time);
        $('#requester').val(data.requester);
        $('#issue').val(data.issue);
        $('#comment').val(data.comment);
        $('#doneBy').val(data.doneBy);
        $('#status').val(data.status);
        $('#btn-save').val("update");
        $('#myModal').modal('show');

    })
});

//display modal form for creating new product
$('#btn_add').click(function(){
    $('#btn-save').val("add");
    $('#frmTasks').trigger("reset");
    $('#myModal').modal('show');
});

//create new product / update existing product
$("#btn-save").click(function (e) {
	$.ajaxSetup({
		headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
    });

    e.preventDefault();
    var formData = {
        time: $('#time').val(),
        requester: $('#requester').val(),
        issue: $('#issue').val(),
        comment: $('#comment').val(),
        doneBy: $('#doneBy').val(),
        status: $('#status').val()
    }

    //used to determine the http verb to use [add=POST], [update=PUT]
    var state = $('#btn-save').val();
    var type = "POST"; //for creating new resource
    var id = $('#id').val();
    var my_url = url;
    if (state == "update"){
        type = "PUT"; //for updating existing resource
        my_url += '/' + id;
    }
    
    console.log(formData);
    $.ajax({
        type: type,
        url: my_url,
        data: formData,
        dataType: 'json',
        success: function (data) {
            console.log(data);
  
            var task = '<tr id="task' + data.id + '"><td>' + data.id + '</td><td>' + data.time + '</td><td>' + data.requester + '</td><td>' + data.issue + '</td><td>' + data.comment + '</td><td>' + data.doneBy + '</td><td>' + data.status + '</td><td>' + data.created_at + '</td>';
            task += '<td><button class="btn btn-detail open_modal" value="' + data.id + '">Edit</button>';
            task += '<button class="btn btn-delete delete-task" value="' + data.id + '">Delete</button></td></tr>';


            if (state == "add"){ //if user added a new record
                $('#tasks-list').append(task);
            }else{ //if user updated an existing record
                $("#task" + id).replaceWith(task);
            }
            $('#frmTasks').trigger("reset");
            $('#myModal').modal('hide')
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});


// //delete product and remove it from list
$(document).on('click','.delete-task',function(){
    var id = $(this).val();
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    })
    $.ajax({
        type: "DELETE",
        url: url + '/' + id,
        success: function (data) {
            console.log(data);
            $("#task" + id).remove();
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});