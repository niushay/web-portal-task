<!DOCTYPE html>
<html>
<head>
    <title>Portal</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <style>
        body {
            background: linear-gradient(to bottom, rgba(2,0,36,1) 0%, rgba(104,9,121,1) 35%, rgba(121,0,255,1) 92%);
            height: 100vh;
            margin: 0;
            padding: 0;
            overflow-y: scroll;
        }

        .container {
            width: 80%;
            margin: 3% auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        table {
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="container">
    <table id="data-table" class="display">
        <thead>
        <tr>
            <th>Title</th>
            <th>Task</th>
            <th>Description</th>
            <th>ColorCode</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{$item->title}}</td>
                <td>{{$item->task}}</td>
                <td>{{$item->description}}</td>
                <td style="color: {{$item->colorCode}}">{{$item->colorCode}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#data-table').DataTable({
            "pageLength": 10,
            "lengthChange": false,
        });

        setInterval(function() {
            $.get("{{route('refreshData')}}", function(data) {
                $('#data-table tbody').html(data);
            });
        }, 3600000);
    });
</script>
</body>
</html>
