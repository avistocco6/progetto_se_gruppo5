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
            $aResult['result'] = Material::getMaterials();
            break;
        case 'loadSkills':
            $aResult['result'] = Skill::getSkills();
            break;
        case 'loadTypologies':
            $aResult['result'] = Typology::getTypologies();
            break;
        case 'loadSites':
            $aResult['result'] = Site::getSites();
            break;
        case 'loadProcedures':
            $aResult['result'] = Procedure::getProcedures();
            break;
        case 'loadWeeks':
            $aResult['result'] = Maintenance::loadWeeks();
            break;
        case 'loadPlanned':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $item = json_decode($_POST['arguments'][0], true);
            $week = $item['week'];
            $type = $item['type'];
            $aResult['result'] = Maintenance::getByWeek($week, $type);
            break;
        case 'loadSelected':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $item = json_decode($_POST['arguments'][0], true);
            $id = $item['id'];
            $aResult['result'] = Maintenance::loadActivity($id);
            break;
        default:
            $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
            break;
    }

}

echo json_encode($aResult);
