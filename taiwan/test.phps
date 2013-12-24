<?php

$file = $_SERVER['argv'][1];
$source = 'http://bbs.city.tianya.cn/tianyacity/content/333/1/101826.shtml';
$content  = file_get_contents($file);
preg_match_all('#<img[^>]* original="([^"]*)"[^>]*>#', $content, $matches);
foreach ($matches[1] as $id => $match) {
    $output_name = basename($match);
    system("wget -O ./images/{$output_name} --referer {$source} {$match}");
    $content = str_replace($matches[0][$id], '<img src="./images/' . basename($match) . '">', $content);
}
file_put_contents($file, $content);
//system("wget --referer http://bbs.city.tianya.cn/tianyacity/content/333/1/101826.shtml 

