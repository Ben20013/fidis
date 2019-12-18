<!DOCTYPE html>
<html >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MixPortal</title>
    <link href=/modules/portal/css/portal.css rel=stylesheet>

  </head>
  <body >
    <script>
      const VERSION = '<?php echo $version;?>';
      const MIXPROTAL_URL ='<?php echo $host;?>';
      const MIXPASSPORT_URL ='<?php echo $host;?>';
      const protocol = '';
      const MIXPASSPORT_PROXY_URL = '<?php echo $host;?>';
      const MIX_FIDIS_PROXY_URL = '<?php echo $host;?>';
      const adminSource = 'MixPortal';
    </script>
    <div id="app">
    	<router-view></router-view>
    </div>

  </body>
  <script type=text/javascript src=/modules/portal/js/portal.js>
  </script>
</html>
