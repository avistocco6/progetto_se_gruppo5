<?php
//When one of the following function is called from the controller layer, 
//it allows to modify the information in the database, using the classes in the items package.
//Here singleton pattern is used.
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
        case 'updateEmail':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }

            $user = json_decode($_POST['arguments'][0], true);

            if($user == null) {
                $aResult['error'] = 'Error in arguments!';
            }
            else{
                $us = User::getInstance();
                $username = $user['username'];
                $email = $user['email'];

                $aResult['result'] = $us->updateEmail($username, $email);
            }
            break;
        case 'updatePassword':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }

            $user = json_decode($_POST['arguments'][0], true);

            if($user == null) {
                $aResult['error'] = 'Error in arguments!';
            }
            else{
                $us = User::getInstance();
                $username = $user['username'];
                $password = $user['password'];

                $aResult['result'] = $us->updatePassword($username, $password);
            }
            break;
        case 'updateMaterial':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }

            $material = json_decode($_POST['arguments'][0], true);

            if($material == null) {
                $aResult['error'] = 'Error in arguments!';
            }
            else{
                $mat = Material::getInstance();
                $name = $material['name'];
                $id = $material['id'];

                $aResult['result'] = $mat->updateMaterial($id, $name);
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
                $sk = Skill::getInstance();
                $name = $skill['name'];
                $id = $skill['id'];

                $aResult['result'] = $sk->updateSkill($id, $name);
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
                $typol = Typology::getInstance();
                $description = $typology['description'];
                $id = $typology['id'];

                $aResult['result'] = $typol->updateTypology($id, $description);
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
                $site_ = Site::getInstance();
                $branch = $site['factory'];
                $id = $site['id'];
                $department = $site['area'];

                $aResult['result'] = $site_->updateSite($id, $branch, $department);
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
                $proc = Procedure::getInstance();
                $description = $procedure['description'];
                $id = $procedure['id'];

                $aResult['result'] = $proc->updateProcedure($id, $description);
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
                $maintenance = Maintenance::getInstance();
                $maid = $activity['maid'];
                $description = $activity['description'];
                $estimatedtime = $activity['estimated_time'];
                $interruptible = $activity['interruptible'];
                $week = $activity['week'];
                $idtypology = $activity['typology_id'];
                $idsite = $activity['site_id'];
                $mtype = $activity['mtype'];

                $aResult['result'] = $maintenance->updateActivity($maid, $description,
                    $idsite, $idtypology, $estimatedtime, $week, $interruptible, $mtype);
            }
            break;
        default:
            $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
            break;
    }

}

echo json_encode($aResult);

