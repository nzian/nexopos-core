<?php
$expression = '{{ expression }}';

foreach( $expression as $file ) {
    // let's check if the extension is either for script tag or link tag
    $extension = pathinfo( $file, PATHINFO_EXTENSION );
    $url   =  Illuminate\Support\Facades\Vite::useBuildDirectory( 'vendor/ns/build' )->asset( $file );
    
    if ( in_array( $extension, [ 'js', 'ts' ] ) ) {
        echo '<script type="module" src="' . $url . '"></script>';
    } elseif ( in_array( $extension, [ 'css', 'scss' ] ) ) {
        echo '<link rel="stylesheet" href="' . $url . '">';
    }
}
?>