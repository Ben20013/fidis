<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FIDIS</title>
    <link href="css/app.css" rel="stylesheet">

</head>
<style>
html,body{
    height: 100%;
    width: 100%;
}
</style>
<body>
<div id="app" style="height: 100%;">
    <router-view :style="{height: '100%'}"><router-view>
</div>
<script src="js/app.js"></script>
</body>

</html>
