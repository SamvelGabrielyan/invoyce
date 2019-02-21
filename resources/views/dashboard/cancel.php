<?php
include "config/config.php";
error_reporting(0);
$getUserInfo=getTableIdValue(USERS_TBL,"where id='".base64_decode($_REQUEST['memberShip'])."' ",'*',$db);
if($getUserInfo['id']==''){
	echo "<script>window.location='".url('')."/login';</script>";exit;
}
require 'init.php';
require_once("lib/Stripe.php");
$params = array(
	"testmode"   => "off",
	"private_live_key" => "sk_live_R04aFVGThvrfHts90M2Ru4bg",
	"public_live_key"  => "pk_live_5vttw8UWOYAKKscuD4b3FTMs",
	"private_test_key" => "sk_test_B9jcL9ZysHbW93oxd3zAJEtm",
	"public_test_key"  => "pk_test_0doH5QEsiVrd7fDsdrBtU8xq"
);

if ($params['testmode'] == "on") {
	$pubkey = $params['public_test_key'];
	$key_define=$params['public_test_key'];
    \Stripe\Stripe::setApiKey($params['private_test_key']);
} else {
	$pubkey = $params['public_live_key'];
	$key_define=$params['public_live_key'];
    \Stripe\Stripe::setApiKey($params['private_live_key']);
}


$subscription = \Stripe\Subscription::retrieve($getUserInfo['subscription_id']);
$subscription->cancel();
$sql2=$db->exec("update ".USERS_TBL." set
`subscription_id`='',
`sub_status`='1'
where id='".$getUserInfo['id']."'  ");

$query=getTableIdValue('mail_setting',"where id='2' ",'*',$db);
      $subject='Subscription';
      $to=$getUserInfo['email'];
      $query['message']=str_replace("[USER_NAME]",ucfirst($getUserInfo['fname']),$query['message']);
      $message = htmlspecialchars_decode(stripslashes($query['message'])) ;
      $headers = "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
      $headers .= "FROM: invoyce.me <noreply@topshelfmenu.us>\r\n";
        //echo $message;
     @mail($to, $subject, $message, $headers);


echo "<script>window.location='".url('')."/member/".$getUserInfo['id']."';</script>";  exit;


?>

