<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <p>You successfully registered for the following event:</p>
    <br>
    <p>Event name : {{$data->name}}</p>
    <p>Location : {{$data->location}}</p>
    <p>Date : {{$data->date->format('d/m/Y H:i')}}</p>
    <br>
    <p>Thank you for your registration on the event. You can see updates and full details for the event on ActivEvent.</p>
</body>
</html>