<?php
//When one of the following function is called from the controller layer, 
//it allows to remove the information from the database, using the classes in the items package.

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
        case 'removeMaterial':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }

            $material = json_decode($_POST['arguments'][0], true);

            if($material == null) {
                $aResult['error'] = 'Error in arguments!';
            }
            else{
                $mat = Material::getInstance();
                $id = $material['id'];

                $aResult['result'] = $mat->removeMaterial($id);
            }
            break;
        case 'removeSkill':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $skill = json_decode($_POST['arguments'][0], true);

            if($skill == null) {
                $aResult['error'] = 'Error in arguments!';
            }
            else{
                $sk = Skill::getInstance();
                $id = $skill['id'];

                $aResult['result'] = $sk->removeSkill($id);
            }
            break;
        case 'removeTypology':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $typology = json_decode($_POST['arguments'][0], true);

            if($typology == null) {
                $aResult['error'] = 'Error in arguments!';
            }
            else{
                $typol = Typology::getInstance();
                $id = $typology['id'];

                $aResult['result'] = $typol->removeTypology($id);
            }
            break;
        case 'removeSite':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $site = json_decode($_POST['arguments'][0], true);

            if($site == null) {
                $aResult['error'] = 'Error in arguments!';
            }
            else{
                $site_ = Site::getInstance();
                $id = $site['id'];

                $aResult['result'] = $site_->removeSite($id);
            }
            break;
        case 'removeProcedure':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $procedure = json_decode($_POST['arguments'][0], true);

            if($procedure == null) {
                $aResult['error'] = 'Error in arguments!';
            }
            else{
                $proc = Procedure::getInstance();
                $id = $procedure['id'];

                $aResult['result'] = $proc->removeProcedure($id);
            }
            break;
        case 'removeActivity':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $activity = json_decode($_POST['arguments'][0], true);

            if($activity == null) {
                $aResult['error'] = 'Error in arguments!';
            }
            else{
                $maintenance = Maintenance::getInstance();
                $maid = $activity['id'];

                $aResult['result'] = $maintenance->removeActivity($maid);
            }
            break;
        case 'removeUser':
            if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                $aResult['error'] = 'Error in arguments!';
            }
            $user = json_decode($_POST['arguments'][0], true);

            if($user == null) {
                $aResult['error'] = 'Error in arguments!';
            }
            else{
                $user_ = User::getInstance();
                $username = $user['username'];

                $aResult['result'] = $user_->removeUser($username);
            }
            break;
        default:
            $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
            break;
    }

}

echo json_encode($aResult);

