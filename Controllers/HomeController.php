<?php

 class HomeController extends Controller{

    public function page_404(){   
        return $this->view('404');
    }
 }

?>