<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <p>There's a new event waiting to be approved:</p>
    <br>
    <p>Event name : {{$data->name}}</p>
    <p>From community : {{$data->community->name}}</p>
    <p>Date : {{$data->date->format('d/m/Y H:i')}}</p>
    <br>
    <p>Please don't forget to check and approve this event. Thank you.</p>
</body>
</html>