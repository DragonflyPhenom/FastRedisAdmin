<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="recursive-wrap"></div>
<div class="content-wrap"></div>
<script>
    var obKeys = <?=json_encode($arKeys)?>;
    var firstLevel = <?=json_encode(array_keys($arKeys))?>;
    <?unset($arKeys)?>
</script>
<script src="{{asset('js/lib/jQuery.js')}}"></script>
<script src="{{asset('js/redis.js')}}"></script>
<link rel="stylesheet" href="{{ asset("css/redis.css") }}">