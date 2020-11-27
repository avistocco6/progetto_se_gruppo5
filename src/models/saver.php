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
        case 'saveMaterial':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $aResult['result'] = Material::save($_POST['arguments'][0]);
            break;
        case 'saveSkill':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $aResult['result'] = Skill::save($_POST['arguments'][0]);
            break;
        case 'saveTypology':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $aResult['result'] = Typology::save($_POST['arguments'][0]);
            break;
        case 'saveSite':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $aResult['result'] = Site::save($_POST['arguments'][0]);
            break;
        case 'saveProcedure':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $aResult['result'] = Procedure::save($_POST['arguments'][0]);
            break;
        default:
            $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
            break;
    }

}

echo json_encode($aResult);

