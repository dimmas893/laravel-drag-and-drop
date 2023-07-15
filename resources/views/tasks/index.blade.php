<!DOCTYPE html>
<html>
<head>
    <title>Drag and Drop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <style>
        .task-list {
            list-style-type: none;
            padding: 0;
        }

        .task-list li {
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 5px;
            cursor: move;
        }
    </style>
</head>
<body>
    <h1>Task List</h1>

    <ul class="task-list">
        @foreach ($tasks as $task)
            <li data-task-id="{{ $task->id }}">{{ $task->name }}</li>
        @endforeach
    </ul>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.task-list').sortable({
                update: function(event, ui) {
                    var taskIds = [];

                    $('.task-list li').each(function() {
                        taskIds.push($(this).data('task-id'));
                    });

                    // Kirim permintaan Ajax untuk menyimpan posisi tugas
                    $.ajax({
                        url: '/tasks/reorder',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '{{ csrf_token() }}',
                            taskIds: taskIds
                        },
                        success: function(response) {
                            // Tampilkan pesan sukses atau lakukan tindakan lain
                            console.log('Reordering success');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
