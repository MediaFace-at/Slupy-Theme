( function( $ ) {
    wp.customize(
        'primary_color',
        function ( value ) {
            value.bind(
                function ( to ) {

                    //$( 'a' ).css( 'color', to );
                    $( ':root' ).css( '--primary', to );

                }
            );
        }
    );

} )( jQuery );