<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
$email = new Email();
$random = new Random();

$successMessage=null;$pageError=null;$errorMessage=null;$noE=0;$noC=0;$noD=0;
$users = $override->getData('user');
$activeSub=$override->countData('subscribers','status',1,'agent_id',$user->data()->id);
$activeSub1=$override->countData('subscribers','status',2,'agent_id',$user->data()->id);
$activeSub2=$override->countData('subscribers','status',0,'agent_id',$user->data()->id);
if($user->isLoggedIn()) {
    if(Input::exists('post')){

    }
}else{
    Redirect::to('index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Dashboard | COMPANY </title>
    <?php include "head.php";?>
</head>
<body>
<div class="wrapper">

    <?php include 'topbar.php'?>
    <?php include 'menu.php'?>
    <div class="content">


        <div class="breadLine">

            <ul class="breadcrumb">
                <li><a href="#">Dashboard</a> <span class="divider">></span></li>
            </ul>

            <?php include 'pageInfo.php'?>

        </div>

        <div class="workplace">

            <div class="row">

                <?php if($user->data()->accessLevel == 1){?>
                    <div class="col-md-3">

                        <div class="wBlock blue clearfix">
                            <div class="dSpace">
                                <h3>Agents</h3>
                                <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--130,190,260,230,290,400,340,360,390--></span>
                                <span class="number"><?=$override->getCount('user','acc_type',2)?></span>
                            </div>
                        </div>

                    </div>
                <?php }?>

                <div class="col-md-3">

                    <div class="wBlock green clearfix">
                        <div class="dSpace">
                            <h3>Approve Subscribers</h3>
                            <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--5,10,15,20,23,21,25,20,15,10,25,20,10--></span>
                            <span class="number"><?php if($user->data()->accessLevel != 1){echo $activeSub;}else{echo $override->getCount('subscribers','status',1);}?></span>
                        </div>
                    </div>

                </div>
                <div class="col-md-3">

                    <div class="wBlock yellow clearfix">
                        <div class="dSpace">
                            <h3>Subscribers Pending for Approval</h3>
                            <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--5,10,15,20,23,21,25,20,15,10,25,20,10--></span>
                            <span class="number"><?php if($user->data()->accessLevel != 1){echo $activeSub2;}else{echo $override->getCount('subscribers','status',0);}?></span>
                        </div>
                    </div>

                </div>
                <div class="col-md-3">

                    <div class="wBlock red clearfix">
                        <div class="dSpace">
                            <h3>Rejected Subscribers</h3>
                            <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--5,10,15,20,23,21,25,20,15,10,25,20,10--></span>
                            <span class="number"><?php if($user->data()->accessLevel != 1){echo $activeSub1;}else{echo $override->getCount('subscribers','status',2);}?></span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="dr"><span></span></div>


        </div>

    </div>
</div>
<script>
    <?php if($user->data()->pswd == 0){?>
    $(window).on('load',function(){
        $("#change_password_n").modal({
            backdrop: 'static',
            keyboard: false
        },'show');
    });
    <?php }?>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>

</html>
