<?php
require_once('effect.php');
if(isset($_FILES['image']) && $_FILES['image']['error'] == 0 &&  !empty($_POST) && isset($_POST['effect'])){
    $parameter = "";
    $effect_names = array();
    foreach ($_POST['effect'] as $id => $effect){
        if ($effect){
            $effect_names[] = Effect::getEffectById($id)->getName();
        }
    }
    if (isset($_POST['parameter'])){
        $parameter = $_POST['parameter'];
    }

    echo json_encode(array('status' => 101, 'names' => implode(',', $effect_names), 'parameter' => $parameter));
    exit;
}

echo json_encode(array('status' => 201));