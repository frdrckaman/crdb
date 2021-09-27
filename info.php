<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
$email = new Email();
$random = new Random();

$successMessage=null;$pageError=null;$errorMessage=null;
if($user->isLoggedIn()) {
    if(Input::exists('post')){
        $validate = new validate();
    }
}else{
    Redirect::to('index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Info </title>
    <?php include "head.php";?>
</head>
<body>
<div class="wrapper">

    <?php include 'topbar.php'?>
    <?php include 'menu.php'?>
    <div class="content">


        <div class="breadLine">

            <ul class="breadcrumb">
                <li><a href="#">Info</a> <span class="divider">></span></li>
            </ul>
            <?php include 'pageInfo.php'?>
        </div>

        <div class="workplace">
            <?php if($errorMessage){?>
                <div class="alert alert-danger">
                    <h4>Error!</h4>
                    <?=$errorMessage?>
                </div>
            <?php }elseif($pageError){?>
                <div class="alert alert-danger">
                    <h4>Error!</h4>
                    <?php foreach($pageError as $error){echo $error.' , ';}?>
                </div>
            <?php }elseif($successMessage){?>
                <div class="alert alert-success">
                    <h4>Success!</h4>
                    <?=$successMessage?>
                </div>
            <?php }?>

            <div class="row">
                <?php if($_GET['id'] == 1 && $user->data()->accessLevel == 1){?>
                    <div class="col-md-12">
                        <div class="head clearfix">
                            <div class="isw-grid"></div>
                            <h1>List of Agents</h1>
                            <ul class="buttons">
                                <li><a href="#" class="isw-download"></a></li>
                                <li><a href="#" class="isw-attachment"></a></li>
                                <li>
                                    <a href="#" class="isw-settings"></a>
                                    <ul class="dd-list">
                                        <li><a href="#"><span class="isw-plus"></span> New document</a></li>
                                        <li><a href="#"><span class="isw-edit"></span> Edit</a></li>
                                        <li><a href="#"><span class="isw-delete"></span> Delete</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="block-fluid">
                            <table cellpadding="0" cellspacing="0" width="100%" class="table">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" name="checkall"/></th>
                                    <th width="25%">Name</th>
                                    <th width="25%">Agent Code</th>
                                    <th width="25%">Account No</th>
                                    <th width="25%">Commission Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($override->get('user','acc_type', 2) as $agent){
                                   ?>
                                    <tr>
                                        <td><input type="checkbox" name="checkbox"/></td>
                                        <td> <?=$agent['name']?></td>
                                        <td><?=$agent['agent_code']?></td>
                                        <td><?=$agent['comm_acc']?></td>
                                        <td><?=$agent['comm_amount']?></td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } elseif ($_GET['id'] == 2){?>
                    <div class="col-md-12">
                        <div class="head clearfix">
                            <div class="isw-grid"></div>
                            <h1>List of Subscribers</h1>
                            <ul class="buttons">
                                <li><a href="#" class="isw-download"></a></li>
                                <li><a href="#" class="isw-attachment"></a></li>
                                <li>
                                    <a href="#" class="isw-settings"></a>
                                    <ul class="dd-list">
                                        <li><a href="#"><span class="isw-plus"></span> New document</a></li>
                                        <li><a href="#"><span class="isw-edit"></span> Edit</a></li>
                                        <li><a href="#"><span class="isw-delete"></span> Delete</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="block-fluid">
                            <table cellpadding="0" cellspacing="0" width="100%" class="table">
                                <thead>
                                <tr>
                                    <th width="25%">Name</th>
                                    <th width="10%">Date of Birth</th>
                                    <th width="15%">Email</th>
                                    <th width="15%">Phone</th>
                                    <th width="25%">Address</th>
                                    <th width="10%">Agent Code</th>
                                    <th width="10%">status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($user->data()->accessLevel == 1){$sub=$override->getData('subscribers');}
                                else{$sub=$override->get('subscribers','agent_id',$user->data()->id);}
                                foreach ($sub as $subscribers){
                                    $agent=$override->get('user','id',$subscribers['agent_id'])[0]?>
                                    <tr>
                                        <td> <?=$subscribers['name']?></td>
                                        <td> <?=$subscribers['birthdate']?></td>
                                        <td> <?=$subscribers['email_address']?></td>
                                        <td> <?=$subscribers['phone_number']?></td>
                                        <td> <?=$subscribers['address']?></td>
                                        <td> <?=$agent['agent_code']?></td>
                                        <td>
                                            <?php if($subscribers['status'] == 1){?>
                                            <button class="btn btn-sm btn-success" type="button" disabled>Approved</button>
                                            <?php }elseif($subscribers['status'] == 2){?>
                                            <button class="btn btn-sm btn-danger" type="button" disabled>Rejected</button>
                                            <?php }else{?>
                                                <button class="btn btn-sm btn-warning" type="button" disabled>Pending</button>
                                            <?php }?></td>
<!--                                        <td><a href="#position--><?//=$subscribers['id']?><!--" role="button" class="btn btn-info" data-toggle="modal">Edit</a></td>-->
                                        <!-- EOF Bootrstrap modal form -->
                                    </tr>

                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php }?>
            </div>

            <div class="dr"><span></span></div>
        </div>
    </div>
</div>
</body>
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
    $(document).ready(function(){
        $('#wait_ds').hide();
        $('#s2_1').change(function(){
            var getUid = $(this).val();
            $('#wait_ds').show();
            $.ajax({
                url:"process.php?cnt=cat",
                method:"GET",
                data:{getUid:getUid},
                success:function(data){
                    $('#s2_2').html(data);
                    $('#wait_ds').hide();
                }
            });

        });

        $('#download').change(function(){
            var getUid = $(this).val();
            $.ajax({
                url:"process.php?cnt=download",
                method:"GET",
                data:{getUid:getUid},
                success:function(data){

                }
            });

        });
    });
</script>

</html>
