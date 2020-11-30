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
            $material = json_decode($_POST['arguments'][0], true);

            if($material == null) {
                $aResult['error'] = 'Error in arguments!';
                break;
            }
            else{
                $name = $material['name'];
                $activity = $material['activity'];

                $aResult['result'] = Material::save($name, $activity);
            }
            break;
        case 'saveSkill':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $skill = json_decode($_POST['arguments'][0], true);

            if($skill == null) {
                $aResult['error'] = 'Error in arguments!';
                break;
            }
            else{
                $name = $skill['name'];

                $aResult['result'] = Skill::save($name);
            }
            break;
        case 'saveTypology':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $typology = json_decode($_POST['arguments'][0], true);

            if($typology == null) {
                $aResult['error'] = 'Error in arguments!';
                break;
            }
            else{
                $description = $typology['description'];

                $aResult['result'] = Typology::save($description);
            }
            break;
        case 'saveSite':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $site = json_decode($_POST['arguments'][0], true);

            if($site == null) {
                $aResult['error'] = 'Error in arguments!';
                break;
            }
            else{
                $branch = $site['branch'];
                $department = $site['department'];

                $aResult['result'] = Site::save($branch, $department);
            }
            break;
        case 'saveProcedure':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $procedure = json_decode($_POST['arguments'][0], true);

            if($procedure == null) {
                $aResult['error'] = 'Error in arguments!';
                break;
            }
            else{
                $description = $procedure['description'];

                $aResult['result'] = Procedure::save($description);
            }
            break;
        case 'saveActivity':
             if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $activity = json_decode($_POST['arguments'][0], true);

            if($activity == null) {
                $aResult['error'] = 'Error in arguments!';
                break;
            }
            else{

                $description = $activity['description'];
                $idsite = $activity['idsite'];
                $idtypology = $activity['idtypology'];
                $estimatedtime = $activity['estimatedtime'];
                $week = $activity['week'];
                $interruptible = $activity['interruptible'];

                $aResult['result'] = Activity::addActivity( $description, $idsite,
                    $idtypology, $estimatedtime, $week, $interruptible);
            }
            break;

        default:
            $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
            break;
    }

}

echo json_encode($aResult);

