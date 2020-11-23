<?php
foreach (glob("..\items\*.php") as $filename)
{
    include $filename;
}

header('Content-Type: application\json');

$aResult = array();

if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

if( !isset($aResult['error']) ) {

    switch($_POST['functionname']) {
        case 'loadModels':
            $aResult['result'] = Material::get_materials();
            break;
        case 'loadSkills':
            $aResult['result'] = Skill::get_skills();
            break;
        case 'loadTypologies':
            $aResult['result'] = Typology::get_typologies();
            break;
        case 'loadSites':
            $aResult['result'] = Material::get_materials();
            break;
        default:
            $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
            break;
    }

}

echo json_encode($aResult);
