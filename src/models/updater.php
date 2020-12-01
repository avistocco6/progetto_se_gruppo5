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

            $material = json_decode($_POST['arguments'][0], true);

            if($material == null) {
                $aResult['error'] = 'Error in arguments!';
            }
            else{
                $name = $material['name'];
                $id = $material['id'];

                $aResult['result'] = Material::updateMaterial($id, $name);
            }
            break;
        case 'updateSkill':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $skill = json_decode($_POST['arguments'][0], true);

            if($skill == null) {
                $aResult['error'] = 'Error in arguments!';
            }
            else{
                $name = $skill['name'];
                $id = $skill['id'];

                $aResult['result'] = Skill::updateSkill($id, $name);
            }
            break;
        case 'updateTypology':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $typology = json_decode($_POST['arguments'][0], true);

            if($typology == null) {
                $aResult['error'] = 'Error in arguments!';
            }
            else{
                $description = $typology['description'];
                $id = $typology['id'];

                $aResult['result'] = Typology::updateTypology($id, $description);
            }
            break;
        case 'updateSite':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $site = json_decode($_POST['arguments'][0], true);

            if($site == null) {
                $aResult['error'] = 'Error in arguments!';
            }
            else{
                $branch = $site['factory'];
                $id = $site['id'];
                $department = $site['area'];

                $aResult['result'] = Site::updateSite($id, $branch, $department);
            }
            break;
        case 'updateProcedure':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $procedure = json_decode($_POST['arguments'][0], true);

            if($procedure == null) {
                $aResult['error'] = 'Error in arguments!';
            }
            else{
                $description = $procedure['description'];
                $id = $procedure['id'];

                $aResult['result'] = Procedure::updateProcedure($id, $description);
            }
            break;
        case 'updateActivity':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $activity = json_decode($_POST['arguments'][0], true);

            if($activity == null) {
                $aResult['error'] = 'Error in arguments!';
            }
            else{
                $maid = $activity['maid'];
                $description = $activity['description'];
                $idsite = $activity['idsite'];
                $idtypology = $activity['idtypology'];
                $estimatedtime = $activity['estimatedtime'];
                $week = $activity['week'];
                $interruptible = $activity['interruptible'];
                $mtype = $activity['mtype'];

                $aResult['result'] = Maintenance::updateActivity($maid, $description, $idsite,
                    $idtypology, $estimatedtime, $week, $interruptible, $mtype);
            }
            break;
        default:
            $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
            break;
    }

}

echo json_encode($aResult);

