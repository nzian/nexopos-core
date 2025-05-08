<?php
$expression = '{{ expression }}';

// we should check for the existence of the file "hot" in the build directory
// to load the hot version of the file
$loadHotFiles   =   false;

if ( file_exists( NS_ROOT . '/public/hot' ) ) {
    $loadHotFiles = true;
} 

foreach( $expression as $file ) {
    // let's check if the extension is either for script tag or link tag
    $extension = pathinfo( $file, PATHINFO_EXTENSION );
    
    if ( $loadHotFiles ) {
        $hotFileContent = file_get_contents( NS_ROOT . '/public/hot' );
        
        if ( in_array( $extension, [ 'js', 'ts' ] ) ) {
            echo '<script type="module" src="' . $hotFileContent . '/' . $file . '"></script>';
        } elseif ( in_array( $extension, [ 'css', 'scss' ] ) ) {
            echo '<link rel="stylesheet" href="' . $hotFileContent . '/' . $file . '">';
        }
    } else {
        $url   =  Illuminate\Support\Facades\Vite::useBuildDirectory( 'vendor/ns/build' )
            ->useManifestFilename( '.vite/manifest.json' )
            ->asset( $file );

        if ( in_array( $extension, [ 'js', 'ts' ] ) ) {
            echo '<script type="module" src="' . $url . '"></script>';
        } elseif ( in_array( $extension, [ 'css', 'scss' ] ) ) {
            echo '<link rel="stylesheet" href="' . $url . '">';
        }
    }
}
?>