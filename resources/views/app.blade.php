<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>nameRP</title>
    <style>
    body {
        background-size: cover;
        margin: 0;
        padding: 0;
    }

    </style>
    @vite('resources/js/app.js')
</head>
<body>
    <div id="app"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var backgrounds = [
                'https://3dnews.ru/assets/external/illustrations/2023/08/02/1090941/gta5_inworld.jpg',
                'https://3dnews.ru/assets/external/illustrations/2023/08/02/1090941/7RHQA.jpg',
                'https://genapilot.ru/wp-content/uploads/2019/09/sluhi-o-gta-5-kotorye-tak-i-ne-podtverdilis-750x400.jpg',
                'https://i.playground.ru/p/7Fb1O13Cqq8E9OFLnGwBSw.jpeg?760-auto'
            ];

            var randomBackground = backgrounds[Math.floor(Math.random() * backgrounds.length)];


            document.body.style.backgroundImage = 'url(' + randomBackground + ')';
        });
        </script>

</body>
</html>
