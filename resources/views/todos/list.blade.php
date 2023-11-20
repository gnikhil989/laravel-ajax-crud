<!DOCTYPE html>
<html>
<head>
    <title>Data Table PDF</title>
    <style>
        /* Define styles for the PDF content here */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Data Table PDF</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
