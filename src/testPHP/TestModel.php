<?php

include_once '..\Model.php';

function test_get_skills() {
    $json_string = get_skills();
    file_put_contents("test_files\skills.json", $json_string);
}

function test_get_sites() {
    $json_string = get_sites();
    file_put_contents("test_files\sites.json", $json_string);
}

function test_get_typologies() {
    $json_string = get_typologies();
    file_put_contents('test_files\typologies.json', $json_string);
}

function test_get_materials() {
    $json_string = get_materials();
    file_put_contents("test_files\materials.json", $json_string);
}

function test_get_procedures() {

}
test_get_skills();
test_get_sites();
test_get_typologies();
test_get_materials();
