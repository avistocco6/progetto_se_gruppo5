<?php
foreach (glob("..\items\*.php") as $filename)
{
    include $filename;
}

header('Content-Type: application\json');

$aResult = array();

if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

if( !isset($aResult['error']) ) {

    switch($_POST['functionname']) {
        case 'updateMaterial':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $aResult['result'] = Material::updateMaterial($_POST['arguments'][0]);
            break;
        case 'updateSkill':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $aResult['result'] = Skill::updateSkill($_POST['arguments'][0]);
            break;
        case 'updateTypology':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $aResult['result'] = Typology::updateTypology($_POST['arguments'][0]);
            break;
        case 'updateSite':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $aResult['result'] = Site::updateSite($_POST['arguments'][0]);
            break;
        case 'updateProcedure':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $aResult['result'] = Procedure::updateProcedure($_POST['arguments'][0]);
            break;
        default:
            $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
            break;
        case 'updateActivity':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $aResult['result'] = Activity::updateActivity($_POST['arguments'][0]);
            break;
    }

}

echo json_encode($aResult);

