@extends('openframe::layouts.master')

@section('content')
    <script>
      const version = 'V.1.3.3';
      const mixPortal_url='delivery.mixiot.top';
      const mixPassport_url='passport.delivery.mixiot.top';
      const protocol = 'http://';
      const host = '<?php echo config('system')['admin_url'];?>';
      const adminHost = '<?php echo config('system')['admin_url'];?>';
      const adminSource = 'MixPortal';
    </script>
    <div id="app">
        <router-view></router-view>
    </div>
@stop
