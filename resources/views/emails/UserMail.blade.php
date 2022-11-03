<!DOCTYPE html>

<html>

<head>

    <title>I'm Here</title>

</head>

<body>

    <h1>{{ $userMailData['title'] }}</h1>

    <p> كود التفعيل : {{ $userMailData['code'] }}</p>
    
    <p>{{ $userMailData['body'] }}</p>

    <p> شكرا لك</p>

</body>

</html>