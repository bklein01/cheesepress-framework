<?php
class Activity_Churro extends Churro {   
    public function indexAction(){
        echo $this->Render('activitylist');
        exit;
    }
}