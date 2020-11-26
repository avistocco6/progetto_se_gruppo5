<?php
foreach (glob("..\items\*.php") as $filename)
{
    include $filename;
}

header('Content-Type: application\json');
//header("Access-Control-Allow-Origin: *");

$aResult = array();

if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

if( !isset($aResult['error']) ) {

    switch($_POST['functionname']) {
        case 'loadMaterials':
            $aResult['result'] = Material::get_materials();
            break;
        case 'loadSkills':
            $aResult['result'] = Skill::get_skills();
            break;
        case 'loadTypologies':
            $aResult['result'] = Typology::get_typologies();
            break;
        case 'loadSites':
            $aResult['result'] = Site::get_sites();
            break;
        case 'loadProcedures':
            $aResult['result'] = Procedure::get_procedures();
            break;
        case 'loadPlanned':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $aResult['result'] = Maintenance::getByWeek($_POST['arguments'][0]);
            break;
        default:
            $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
            break;
    }

}

echo json_encode($aResult);
