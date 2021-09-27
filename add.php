<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
$email = new Email();
$random = new Random();
$validate = new validate();
$successMessage=null;$pageError=null;$errorMessage=null;
if($user->isLoggedIn()) {
    if (Input::exists('post')) {
        if (Input::get('add_user')) {
            $validate = new validate();
            $validate = $validate->check($_POST, array(
                'name' => array(
                    'required' => true,
                ),
                'account' => array(
                    'required' => true,
                ),
                'services' => array(
                    'required' => true,
                ),
                'username' => array(
                    'required' => true,
                    'unique' => 'user'
                ),
                'phone_number' => array(
                    'required' => true,
                    'unique' => 'user'
                ),
                'email_address' => array(
                    'unique' => 'user'
                ),
            ));
            if ($validate->passed()) {
                $salt = $random->get_rand_alphanumeric(32);
                $password = '12345678';
                switch (Input::get('position')) {
                    case 1:
                        $accessLevel = 1;
                        break;
                    case 2:
                        $accessLevel = 2;
                        break;
                    case 3:
                        $accessLevel = 3;
                        break;
                }
                try {
                    $user->createRecord('user', array(
                        'name' => Input::get('name'),
                        'agent_code' => Input::get('agent_code'),
                        'username' => Input::get('username'),
                        'comm_acc' => Input::get('account'),
                        'comm_amount' => Input::get('amount'),
                        'acc_type' => Input::get('services'),
                        'phone_number' => Input::get('phone_number'),
                        'password' => Hash::make($password,$salt),
                        'salt' => $salt,
                        'create_on' => date('Y-m-d'),
                        'last_login'=>'',
                        'status' => 1,
                        'power'=>0,
                        'email_address' => Input::get('email_address'),
                        'accessLevel' => 0,
                        'user_id'=>$user->data()->id,
                        'count' => 0,
                        'pswd'=>0,
                    ));
                    $successMessage = 'Account Created Successful';

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else {
                $pageError = $validate->errors();
            }
        }
        if (Input::get('add_customer')) {
            $validate = new validate();
            $validate = $validate->check($_POST, array(
                'name' => array(
                    'required' => true,
                ),
                'services' => array(
                    'required' => true,
                ),
                'birthdate' => array(
                    'required' => true,
                ),
                'address' => array(
                    'required' => true,
                ),
                'phone_number' => array(
                    'required' => true,
                    'unique' => 'subscribers'
                ),
                'email_address' => array(
                    'unique' => 'subscribers'
                ),
            ));
            if ($validate->passed()) {
                try {
                    $user->createRecord('subscribers', array(
                        'name' => Input::get('name'),
                        'birthdate' => Input::get('birthdate'),
                        'address' => Input::get('address'),
                        'service_type' => Input::get('services'),
                        'status' => 0,
                        'phone_number' => Input::get('phone_number'),
                        'email_address' => Input::get('email_address'),
                        'agent_id'=>$user->data()->id,
                    ));
                    $em= $override->lastRow('subscribers','id')[0];
                    $email->sendEmail('frdrckdeveloper@gmail.com',$em['name'],'Submitted for Approval');
                    $successMessage = 'Account Created Successful';

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else {
                $pageError = $validate->errors();
            }
        }
        if (Input::get('approve')) {
            $validate = new validate();
            $validate = $validate->check($_POST, array(
                'subscriber' => array(
                    'required' => true,
                ),
                'status' => array(
                    'required' => true,
                ),
            ));
            if ($validate->passed()) {
                try {
                    $user->updateRecord('subscribers', array(
                        'status' => Input::get('status'),
                    ),Input::get('subscribers'));
                    if(Input::get('status')==1){$fd='Approved';}elseif (Input::get('status')==2){$fd='Rejected';}
                    $em=$override->get('subscribers','id',Input::get('subscribers'))[0];
                    $email->sendEmail('Aloyce.Mwitwa@crdbbank.co.tz',$em['name'],$fd);

                    $successMessage = 'Subscribers Approved Successful';

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else {
                $pageError = $validate->errors();
            }
        }

    }
}else{
    Redirect::to('index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Add | AGENT </title>
    <?php include "head.php";?>
</head>
<body>
<div class="wrapper">

    <?php include 'topbar.php'?>
    <?php include 'menu.php'?>
    <div class="content">


        <div class="breadLine">

            <ul class="breadcrumb">
                <li><a href="#">Simple Admin</a> <span class="divider">></span></li>
                <li class="active">Add Info</li>
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
                <?php if($_GET['id'] == 1){?>
                    <div class="col-md-offset-1 col-md-8">
                        <div class="head clearfix">
                            <div class="isw-ok"></div>
                            <h1>Add Sales Agent</h1>
                        </div>
                        <div class="block-fluid">
                            <form id="validation" method="post" >

                                <div class="row-form clearfix">
                                    <div class="col-md-3">Name:</div>
                                    <div class="col-md-9">
                                        <input value="" class="validate[required]" type="text" name="name" id="name"/>
                                    </div>
                                </div>
                                <div class="row-form clearfix">
                                    <div class="col-md-3">Commission Amount:</div>
                                    <div class="col-md-9">
                                        <input value="" class="validate[required]" type="text" name="amount" id="amount"/>
                                    </div>
                                </div>
                                <div class="row-form clearfix">
                                    <div class="col-md-3">Commission Account:</div>
                                    <div class="col-md-9">
                                        <input value="" class="validate[required]" type="text" name="account" id="account"/>
                                    </div>
                                </div>
                                <div class="row-form clearfix">
                                    <div class="col-md-3">Code:</div>
                                    <div class="col-md-9">
                                        <input value="" class="validate[required]" type="text" name="agent_code" id="agent_code"/>
                                    </div>
                                </div>
                                <div class="row-form clearfix">
                                    <div class="col-md-3">Username:</div>
                                    <div class="col-md-9">
                                        <input value="" class="validate[required]" type="text" name="username" id="username"/>
                                    </div>
                                </div>

                                <div class="row-form clearfix">
                                    <div class="col-md-3">Account Type</div>
                                    <div class="col-md-9">
                                        <select name="services" style="width: 100%;" required>
                                            <option value="">Select position</option>
                                            <option value="2">Sales Agent</option>
                                            <option value="3">Subscriber</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row-form clearfix">
                                    <div class="col-md-3">Phone Number:</div>
                                    <div class="col-md-9"><input value="" class="" type="text" name="phone_number" id="phone" required />  <span>Example: 0700 000 111</span></div>
                                </div>

                                <div class="row-form clearfix">
                                    <div class="col-md-3">E-mail Address:</div>
                                    <div class="col-md-9"><input value="" class="validate[required,custom[email]]" type="text" name="email_address" id="email" />  <span>Example: someone@nowhere.com</span></div>
                                </div>

                                <div class="footer tar">
                                    <input type="submit" name="add_user" value="Submit" class="btn btn-default">
                                </div>

                            </form>
                        </div>

                    </div>
                <?php }elseif ($_GET['id'] == 2){?>
                    <div class="col-md-offset-1 col-md-8">
                        <div class="head clearfix">
                            <div class="isw-ok"></div>
                            <h1>Add Subscriber</h1>
                        </div>
                        <div class="block-fluid">
                            <form id="validation" method="post" >

                                <div class="row-form clearfix">
                                    <div class="col-md-3">Name:</div>
                                    <div class="col-md-9">
                                        <input value="" class="validate[required]" type="text" name="name" id="name"/>
                                    </div>
                                </div>
                                <div class="row-form clearfix">
                                    <div class="col-md-3">Date of Birth</div>
                                    <div class="col-md-9">
                                        <input value="" class="validate[required]" type="text" name="birthdate" id="birthdate"/>
                                        <span>Example: 1970-01-01</span>
                                    </div>
                                </div>

                                <div class="row-form clearfix">
                                    <div class="col-md-3">Service Type</div>
                                    <div class="col-md-9">
                                        <select name="services" style="width: 100%;" required>
                                            <option value="">Select Service</option>
                                            <option value="1">Type1</option>
                                            <option value="2">Type2</option>
                                            <option value="3">Type2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row-form clearfix">
                                    <div class="col-md-3">Address:</div>
                                    <div class="col-md-9"><input value="" class="" type="text" name="address" id="address" required /> </div>
                                </div>
                                <div class="row-form clearfix">
                                    <div class="col-md-3">Phone Number:</div>
                                    <div class="col-md-9"><input value="" class="" type="text" name="phone_number" id="phone" required />  <span>Example: 0700 000 111</span></div>
                                </div>

                                <div class="row-form clearfix">
                                    <div class="col-md-3">E-mail Address:</div>
                                    <div class="col-md-9"><input value="" class="validate[required,custom[email]]" type="text" name="email_address" id="email" />  <span>Example: someone@nowhere.com</span></div>
                                </div>

                                <div class="footer tar">
                                    <input type="submit" name="add_customer" value="Submit" class="btn btn-default">
                                </div>

                            </form>
                        </div>

                    </div>
                <?php }elseif ($_GET['id'] == 3){?>
                    <div class="col-md-offset-1 col-md-8">
                        <div class="head clearfix">
                            <div class="isw-ok"></div>
                            <h1>Subscriber Verification</h1>
                        </div>
                        <div class="block-fluid">
                            <form id="validation" method="post" >
                                <div class="row-form clearfix">
                                    <div class="col-md-3">Subscriber</div>
                                    <div class="col-md-9">
                                        <select name="subscriber" style="width: 100%;" required>
                                            <option value="">Select Subscriber</option>
                                            <?php foreach ($override->get('subscribers','status',0) as $subscriber){?>
                                                <option value="<?=$subscriber?>"><?=$subscriber['name']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row-form clearfix">
                                    <div class="col-md-3">Verification</div>
                                    <div class="col-md-9">
                                        <select name="status" style="width: 100%;" required>
                                            <option value="">Select Status</option>
                                            <option value="1">Approve</option>
                                            <option value="2">Decline</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="footer tar">
                                    <input type="submit" name="approve" value="Submit" class="btn btn-default">
                                </div>

                            </form>
                        </div>

                    </div>
                <?php }?>
                <div class="dr"><span></span></div>
            </div>

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
        $('#wait_ds1').hide();
        $('#wait_ds2').hide();
        $('#rm_py').change(function(){
            var getUid = $(this).val();
            $('#wait_ds1').show();
            $.ajax({
                url:"process.php?cnt=room",
                method:"GET",
                data:{getUid:getUid},
                success:function(data){
                    $('#rm_dt').html(data);
                    $('#wait_ds1').hide();
                }
            });

        });
        $('#r_id').change(function(){
            var getUid = $(this).val();
            $('#wait_ds2').show();
            $.ajax({
                url:"process.php?cnt=client",
                method:"GET",
                data:{getUid:getUid},
                success:function(data){
                    $('#cl_id').html(data);
                    $('#wait_ds2').hide();
                }
            });

        });
    });
</script>
</body>

</html>

