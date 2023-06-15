<template></template>

<script>
    export default {
        mounted() {
            $('select.template-selector').on('change', function() {
                var target = $(this).attr( 'class' ).indexOf( 'impact' ) > -1 ? 'impact' : 'measure',
                    val = $(this).val();
                    $( 'textarea[name="' + target  +'"]').html( val );
            })
        }
    }
</script>
