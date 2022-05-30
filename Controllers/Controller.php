<?php
 
 class Controller {

    const VIEW_FLODER_NAME = 'Views';
    const MODEL_FLODER_NAME = 'Models';

    protected function view($viewPath, array $data=[]){
        foreach ($data as $key => $value) {
            $$key=$value;
        }
        require (self::VIEW_FLODER_NAME.'/'.str_replace('.','/',$viewPath).'.php');
    }

    protected function loadModel($modelPath){
        require (self::MODEL_FLODER_NAME.'/'.$modelPath.'.php');
    }
 }



?>