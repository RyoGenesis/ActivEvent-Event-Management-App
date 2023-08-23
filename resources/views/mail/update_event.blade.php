<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <p>{{$status}} notice for the event "{{$data->name}}"</p>
    <br>
    @if ($status == 'Update')
        <p>The new time and place for the event is the following :</p>
        <p>Location : {{$data->location}}</p>
        <p>Date : {{$data->date->format('d/m/Y H:i')}}</p>
        <br>
        <p>Please make sure to adjust your schedule to fit the new changes.</p>
    @endif
    @if ($status == 'Cancellation')
        <p>The community that is holding this event has decided to cancel this event due to certain circumstances</p>
        <p>To find out more about the cancellation, please be on a lookout on {{$data->community->display_name}} social media.</p>
    @endif
    <br>
    <p>Thank you for your understanding.</p>
</body>
</html>