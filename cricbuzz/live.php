<?php
include_once 'simple_html_dom.php';
header('content-type: application/json');

$url = '';

if(isset($_GET['url'])){
    $url = $_GET['url'];
}
if (empty($url)){
        echo 'false';
}

$html = file_get_html($url);

$items['title'] = $html->find('.cb-list-item.ui-header.ui-branding-header')[0]->innertext;
$items['status'] = $html->find('.cbz-ui-status')[0]->innertext;
$items['live_score'] = $html->find('.miniscore-teams.ui-bat-team-scores')[0]->innertext;
$items['crr'] = $html->find('span.crr')[0]->innertext;

$bat_one_data_more = $html->find('tr')[1];

$items['batsman_one'] = $bat_one_data_more->find('span.bat-bowl-miniscore')[0]->innertext;
$items['batsman_one_runs'] = str_replace(" ","",$bat_one_data_more->find('td')[1]->plaintext);
$items['batsman_one_four'] = $bat_one_data_more->find('td')[2]->plaintext;
$items['batsman_one_six'] = $bat_one_data_more->find('td')[3]->plaintext;
$items['batsman_one_sr'] = $bat_one_data_more->find('td')[4]->plaintext;
$items['batsman_one_url'] = "https://m.cricbuzz.com" . $bat_one_data_more->find('a')[0]->href;

$bat_two_data_more = $html->find('tr')[2];

$items['batsman_two'] = $bat_two_data_more->find('span.bat-bowl-miniscore')[0]->innertext;
$items['batsman_two_runs'] = str_replace(" ","",$bat_two_data_more->find('td')[1]->plaintext);
$items['batsman_two_four'] = $bat_two_data_more->find('td')[2]->plaintext;
$items['batsman_two_six'] = $bat_two_data_more->find('td')[3]->plaintext;
$items['batsman_two_sr'] = $bat_two_data_more->find('td')[4]->plaintext;
$items['batsman_two_url'] = "https://m.cricbuzz.com" . $bat_two_data_more->find('a')[0]->href;

$bowl_data_more = $html->find('tr')[4];

$items['bowl'] = $bowl_data_more->find('span.bat-bowl-miniscore')[0]->innertext;
$items['bowl_overs'] = $bowl_data_more->find('td')[1]->plaintext;
$items['bowl_maiden'] = $bowl_data_more->find('td')[2]->plaintext;
$items['bowl_runs'] = $bowl_data_more->find('td')[3]->plaintext;
$items['bowl_wickets'] = $bowl_data_more->find('td')[4]->plaintext;
$items['bowl_url'] = "https://m.cricbuzz.com" . $bowl_data_more->find('a')[0]->href;

$data_more = $html->find('.list-content')[3];
$items['partnership'] = $data_more->find('span')[1]->innertext;
$items['last_wicket'] = $data_more->find('span')[3]->innertext;
$items['recent_balls'] = $data_more->find('span')[5]->innertext;

$comments[0] = $html->find('.commtext')[1]->plaintext;
$comments[1] = $html->find('.commtext')[2]->plaintext;
$comments[2] = $html->find('.commtext')[3]->plaintext;
$comments[3] = $html->find('.commtext')[4]->plaintext;
$comments[4] = $html->find('.commtext')[5]->plaintext;
$comments[5] = $html->find('.commtext')[6]->plaintext;
$comments[6] = $html->find('.commtext')[7]->plaintext;
$comments[7] = $html->find('.commtext')[8]->plaintext;
$comments[8] = $html->find('.commtext')[9]->plaintext;
$comments[9] = $html->find('.commtext')[10]->plaintext;

$data['data'] = $items;
$data['comments'] = $comments;
echo json_encode($data, JSON_PRETTY_PRINT);