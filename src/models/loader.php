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
        case 'loadUsers':
            $user = User::getInstance();
            $aResult['result'] = $user->getUsers();
            break;
        case 'loadMaterials':
            $material = Material::getInstance();
            $aResult['result'] = $material->getMaterials();
            break;
        case 'loadSkills':
            $sk = Skill::getInstance();
            $aResult['result'] = $sk->getSkills();
            break;
        case 'loadTypologies':
            $typol = Typology::getInstance();
            $aResult['result'] = $typol->getTypologies();
            break;
        case 'loadSites':
            $site = Site::getInstance();
            $aResult['result'] = $site->getSites();
            break;
        case 'loadProcedures':
            $proc = Procedure::getInstance();
            $aResult['result'] = $proc->getProcedures();
            break;
        case 'loadWeeks':
            $maintenance = Maintenance::getInstance();
            $aResult['result'] = $maintenance->loadWeeks();
            break;
        case 'loadPlanned':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            else {
                $maintenance = Maintenance::getInstance();
                $item = json_decode($_POST['arguments'][0], true);
                $week = $item['week'];
                $type = $item['type'];
                $aResult['result'] = $maintenance->getByWeek($week, $type);
            }
            break;
        case 'loadSelected':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            else {
                $maintenance = Maintenance::getInstance();
                $item = json_decode($_POST['arguments'][0], true);
                $id = $item['id'];
                $aResult['result'] = $maintenance->loadActivity($id);
            }
            break;
        case 'loadWeekPercentage':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            else {
                $item = json_decode($_POST['arguments'][0], true);
                $user = User::getInstance();
                $week = $item['week'];
                $id = $item['id'];
                $aResult['result'] = json_encode($user->loadWeekPercentage($week, $id));
                break;
            }
            break;

        default:
            $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
            break;
    }

}

echo json_encode($aResult);
