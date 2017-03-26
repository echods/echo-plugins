<?php

/*
 * Function to get latest styles
 *
 * Loading manifest for latest styles for cache busting
 */
function latestMedia() {
    $manifest = file_get_contents(get_template_directory() . '/assets/manifest.json');
    $manifest = json_decode($manifest);

    $js = array_filter($manifest->app, "separateJs");
    $css = array_filter($manifest->app, "separateCss");

    $js = array_values($js);
    $css = array_values($css);

    // return array_map('separateAssets', $manifest->app);
    return ['js' => $js[0], 'css' => $css[0]];
}

/*
 * Separate js from manifest
 */
function separateJs($string) {
    preg_match('/^js\/app\.\w+\.js$/', $string, $jsMatch);
    return array_values($jsMatch);
}

/*
 * Separate css from manifest
 */
function separateCss($string) {
    preg_match('/^css\/app\.\w+\.css$/', $string, $cssMatch);
    return $cssMatch;
}

function separateAssets($string) {
    preg_match('/^js\/app\.\w+\.js$/', $string, $jsMatch);
    preg_match('/^css\/app\.\w+\.css$/', $string, $cssMatch);
    // dd($jsMatch[0], $cssMatch[0]);
    return ['js' => $jsMatch[0], 'css' => $cssMatch[0]];
}

/*
 * Dump and die for debugging
 */
function dd($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}