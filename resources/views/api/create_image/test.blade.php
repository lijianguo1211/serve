<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate('Make me into an QrCode!')) !!} ">
</body>
</html>
