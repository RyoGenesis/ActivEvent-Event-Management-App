<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <p>This email is a reminder for the following event that is happening tomorrow :</p>
    <br>
    <p>Event name : {{$data->name}}</p>
    <p>Location : {{$data->location}}</p>
    <p>Date : {{$data->date->format('d/m/Y H:i')}}</p>
    <br>
    <p>Please don't forget to attend the event at the time and place mentioned above. Thank you for your attention.</p>
</body>
</html>