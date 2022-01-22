$('document').ready(
    function () {
        var ar = [];
        $.each(firstLevel,function(key,val) {
            $('.recursive-wrap').append('<div class="recursive-block" data-val='+val+'><span class="recursive-title">'+val+'</span></div>');
        });
        $('body').on('click','.recursive-block .recursive-title',function () {
            if ($(this).hasClass('active')) {
                $(this).closest('.recursive-block').find('.recursive-block').remove();
                $(this).closest('.recursive-block').find('.recursive-content').remove();
                $(this).closest('.recursive-block').find('.recursive-content-delete').remove();
                $(this).removeClass('active')
                return true;
            }
            let e = $(this).closest('.recursive-block');
            getRecursive(e);
            ar.reverse();
            val = getRecursiveVal(ar,obKeys);
            console.log(val);
            if (typeof val != 'object') {
                e.append('<div class="recursive-content">'+val+'</div><div class="recursive-content-delete" data-key="'+val+'">Удалить</div>');
            } else {
                $.each(Object.keys(val),function(key,val) {
                    e.append('<div class="recursive-block" data-val='+val+'><span class="recursive-title">'+val+'</span></div>');
                });
            }
            $(this).addClass('active');
        });

        function getRecursive(val) {
            ar.push(val.data('val'));
            var e = val.parent();
            if (e.hasClass('recursive-block'))
                getRecursive(e);
        }
        function getRecursiveVal(ar,keys) {
            let k = ar.shift();
            let v = keys[k];
            if (ar.length == 0)
                return v;

            return getRecursiveVal(ar,v);
        }
        $('body').on('click','.recursive-content',function () {
            $.ajax({
                url: '/',
                data: {KEY:$(this).text()},
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $( ".content-wrap" ).html('<pre>'+data+'</pre>');
                }
            });
        });
        $('body').on('click','.recursive-content-delete',function () {
            $.ajax({
                url: '/',
                data: {'KEY':$(this).data('key')},
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(this).closest('.recursive-block').remove();
        });
    }
);