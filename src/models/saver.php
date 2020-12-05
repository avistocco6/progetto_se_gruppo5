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
                $mat = Material::getInstance();
                $name = $material['name'];
                $activity = $material['activity'];

                $aResult['result'] = $mat->save($name, $activity);
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
                $sk = Skill::getInstance();
                $name = $skill['name'];

                $aResult['result'] = $sk->save($name);
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
                $typol = Typology::getInstance();
                $description = $typology['description'];

                $aResult['result'] = $typol->save($description);
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
                $site_ = Site::getInstance();
                $branch = $site['branch'];
                $department = $site['department'];

                $aResult['result'] = $site_->save($branch, $department);
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
                $proc = Procedure::getInstance();
                $description = $procedure['description'];

                $aResult['result'] = $proc->save($description);
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
                $maintenance = Maintenance::getInstance();
                $description = $activity['description'];
                $estimatedtime = $activity['estimatedTime'];
                $interruptible = $activity['interruptible'];
                $week = $activity['week'];
                $idtypology = $activity['typology_id'];
                $idsite = $activity['site_id'];
                $mtype = $activity['mtype'];

                $aResult['result'] = $maintenance->save($idsite, $description,
                    $estimatedtime, $week, $interruptible, $idtypology, $mtype);
            }
            break;
        default:
            $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
            break;
    }

}

echo json_encode($aResult);

