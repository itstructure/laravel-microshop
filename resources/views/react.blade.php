<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel with React</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div id="root" class="content">
            </div>
            <div class="row">
                <div class="col-12">
                    <input type="button" value="Touch" onclick="touch()">
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="../js/app.js"></script>
    <script type="text/javascript">
        function touch() {
            window.card_component.handleChangeOrder(15);
        }
    </script>
</html>
