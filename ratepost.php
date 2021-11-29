<?php @system("clear");

/*
# Regular Colors
Black="\[\033[0;30m\]"        # Black
Red="\[\033[0;31m\]"          # Red
Green="\[\033[0;32m\]"        # Green
Yellow="\[\033[0;33m\]"       # Yellow
Blue="\[\033[0;34m\]"         # Blue
Purple="\[\033[0;35m\]"       # Purple
Cyan="\[\033[0;36m\]"         # Cyan
White="\[\033[0;37m\]"        # White


# Bold
BBlack="\[\033[1;30m\]"       # Black
BRed="\[\033[1;31m\]"         # Red
BGreen="\[\033[1;32m\]"       # Green
BYellow="\[\033[1;33m\]"      # Yellow
BBlue="\[\033[1;34m\]"        # Blue
BPurple="\[\033[1;35m\]"      # Purple
BCyan="\[\033[1;36m\]"        # Cyan
BWhite="\[\033[1;37m\]"       # White
*/

//Set font color

$BWhite="\033[1;37m"   ;
$Cyan="\033[0;36m"     ;
$Yellow="\033[0;33m"   ;
$CyanBold="\033[1;36m" ;

echo "$CyanBold";
echo "===================================
";
echo "LYKA auto-rater ver 1.0
modified by aparri software
";

echo "===================================
this script will perform max rate (5 gems)
to your posts! (max of 11 posts)
----
";

//init dummy array
$dummyarray = []; 
//$passarray=[];
//$dummyarray = ['shib_aparri']; 


$NoofDum = readline('No of dummies to use?: ');

//loop to # of dummy account

for ($x = 0;$x < $NoofDum;$x++) {
    $Dummy = readline('dummy username: ');
   array_push($dummyarray, "$Dummy",);
//   $pass = readline('dummy password:' );
//   array_push($passarray,"$pass");
}


//should use one password per dummy account
$pass=readline('dummy password: ');

//$pass ='Myleeyka';

//get acct names to rate
//$acct1 = 'rene_wolverine';
$accounts=[];

for ($x=0; $x<4;$x++){
  $dummyuser=readline('user name to rate : ');
  array_push($accounts,"$dummyuser");

}
/*

$acct1 = readline('Username 1: ');
$acct2 = readline('Username 2: ');
//$acct3 = readline('Username 3: ');
//$acct4 = readline('Username 4: ');
*/

//$accounts=array('jade_ashley01','jie_ferraris','joegie01','joegie01');

foreach ($dummyarray as $user) {
 //  $newpass=$passarray()

    $urll = "https://identity.mylykaapps.com/useraccounts/login";
    $curll = curl_init($urll);
    curl_setopt($curll, CURLOPT_URL, $urll);
    curl_setopt($curll, CURLOPT_POST, true);
    curl_setopt($curll, CURLOPT_RETURNTRANSFER, true);
    $headerss = array("Content-Type: application/json", "user-agent:Lyka/3.6.21 (com.thingsilikeapp; build:821 Android O_MR1 28)");
    curl_setopt($curll, CURLOPT_HTTPHEADER, $headerss);
    $dataa = <<<DATA
    {
    "countryCode": "US",
    "device": {
    "deviceId": "fcbe87b62342fbac",
    "deviceImei": "fcbe87b62342fbac",
    "deviceModel": "Tecno Spark 7 Pro",
    "deviceName": "android",
    "deviceOs": "Android O_MR1 ",
    "isEmulator": false,
    "notificationToken": "eEBjxYrDSJyFw7N-DpEGNG:APA91bEZnWo-TDdSgVCzQcJq3gHioJtFThNyxw6PsgOCI1JHDzd55yqG-QZwAZRj4pwICrXo5VODiUYom7Fsf4Ql66-CWHFumNA2ynrKEP21bstPBMgwsN-3G_Ek0ZLcoKtVMg5oN6-gz",
    "osVersion": "28"
  },
  "password": "$pass",
  "username": "$user"
}
DATA;

    curl_setopt($curll, CURLOPT_POSTFIELDS, $dataa);
    $respp = curl_exec($curll);
    curl_close($curll);
    $jsonn = json_decode($respp);
    $msgn = $jsonn->message;
    $status = $jsonn->status;
    $vuser = $jsonn->data->username;
    $bearer = $jsonn->data->token->accessToken;
    $json = json_decode($respp);   
	
    if ($status == 0) {
        echo "unable to login. incorrect password for $user";
    }
    echo "$Cyan";
    echo "$user login successful
    ";

  $urlbal = "https://wallets.mylykaapps.com/api/v3/wallets/getgems?os=android";
  $curlbal = curl_init($urlbal);
  curl_setopt($curlbal, CURLOPT_URL, $urlbal);
  curl_setopt($curlbal, CURLOPT_RETURNTRANSFER, true);   $headersbal = array("authorization: Bearer $bearer",);
  curl_setopt($curlbal, CURLOPT_HTTPHEADER, $headersbal);
  $respbal = curl_exec($curlbal);
  curl_close($curlbal);

  $jsonbal = json_decode($respbal);
  $tg = $jsonbal->data->totalGem;
  echo "Dummy balance : $tg GEMS   
  ";
  ///
  ///
  ///
  ///
  //
  
  foreach($accounts as $mainacct) {
 //$acct1 - start of code  
    echo "$Yellow"
    echo "$mainacct is being rated
	";
    echo "
    ";
    echo "$Cyan";
    
      if ($status == 1) {
        $urlm = "https://users.mylykaapps.com/api/v3/users/searchsuggestedpeople?searchText=$mainacct&os=android&pageIndex=1&pageSize=16";
        $curlm = curl_init($urlm);
        curl_setopt($curlm, CURLOPT_URL, $urlm);
        curl_setopt($curlm, CURLOPT_RETURNTRANSFER, true);
        $headersm = array("user-agent:Lyka/3.6.21 (com.thingsilikeapp; build:821 Android O_MR1 28)", "authorization: Bearer $bearer",);
        curl_setopt($curlm, CURLOPT_HTTPHEADER, $headersm);
        $respm = curl_exec($curlm);
        curl_close($curlm);
 
        $jsonm = json_decode($respm, true);
        $uid = $jsonm["data"]["0"]["id"];
        $vvuser = $jsonm["data"]["0"]["userName"];
     }
  
    if ($mainacct == $vvuser) {
        $urld = "https://profiles.mylykaapps.com/api/v3/profiles/GetProfilePosts?os=android&pageIndex=1&pageSize=50&id=$uid&category=ALL";
        $curld = curl_init($urld);
        curl_setopt($curld, CURLOPT_URL, $urld);
        curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
        $headersd = array("authorization: Bearer $bearer", "user-agent:Lyka/3.6.21 (com.thingsilikeapp; build:821 Android O_MR1 28)",);
        curl_setopt($curld, CURLOPT_HTTPHEADER, $headersd);
        $respd = curl_exec($curld);
        curl_close($curld);
        $jsond = json_decode($respd, true);
  
        $arr = json_decode($respd, true);
        $p00 = $arr["data"]["0"]["id"];
        $p01 = $arr["data"]["1"]["id"];
        $p02 = $arr["data"]["2"]["id"];
        $p03 = $arr["data"]["3"]["id"];
        $p04 = $arr["data"]["4"]["id"];
        $p05 = $arr["data"]["5"]["id"];
        $p06 = $arr["data"]["6"]["id"];
        $p07 = $arr["data"]["7"]["id"];
        $p08 = $arr["data"]["8"]["id"];
        $p09 = $arr["data"]["9"]["id"];
        $p10 = $arr["data"]["10"]["id"];


    }  
  
    $stat = $arr["status"];
    //echo $stat;
    if ($stat == 0) {
        echo "check your inputs";
    } elseif ($stat == 1) $Cyan= "\033[0;36m";
    echo "$Cyan";  
  
     //LOOP TO ALL 11 POSTS
  

    $url = "https://posts.mylykaapps.com/api/v3/posts/ratepost";
    $headers = array("authorization:Bearer $bearer", "user-agent:Lyka/3.6.21 (com.thingsilikeapp; build:821 Android O_MR1 28))", "deviceos: android", "Content-Type: application/json",);
   
   
//RATING acct1 POST 1    
    echo "
    ";
    echo "Rating $mainacct post #1 - ";
    echo "
    ";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $data = <<<DATA
	{
    "device": {
    "deviceId": "fcbe87b62342fbac",
    "deviceImei": "fcbe87b62342fbac",
    "deviceModel": "Tecno Spark 7 Pro",
    "deviceName": "android",
    "deviceOs": "Android O_MR1 ",
    "isEmulator": false,
    "notificationToken": "eEBjxYrDSJyFw7N-DpEGNB:APA91bEZnWo-TRdSgVCzQcJq3gHioJtFThNyxw6PsgOCI1JHDzd55yqG-QZwAZRj4pwICrXo5VDiUYom7Fsf4Ql66-CWHFumNA2ynrKEP21bstPBMgwsN-3G_Ek0ZLcoKtVMg5oN6-pg",
    "osVersion": "28"
    },
    "postId": $p00,
    "rate": 5,
    "userid": $uid
}
DATA;
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $resp = curl_exec($curl);
    curl_close($curl);
    //var_dump($resp);
    $json = json_decode($resp);
    echo $json->message; 
    echo "                              
    
    ";

//END OF RATING acct1 POST 1
    
//RATING acct1 POST 2   
    echo "rating $mainacct post #2 - ";    
    echo "
    ";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $data = <<<DATA
	{
    "device": {
    "deviceId": "fcbe87b62342fbac",
    "deviceImei": "fcbe87b62342fbac",
    "deviceModel": "Tecno Spark 7 Pro",
    "deviceName": "android",
    "deviceOs": "Android O_MR1 ",
    "isEmulator": false,
    "notificationToken": "eEBjxYrDSJyFw7N-DpEGNB:APA91bEZnWo-TRdSgVCzQcJq3gHioJtFThNyxw6PsgOCI1JHDzd55yqG-QZwAZRj4pwICrXo5VDiUYom7Fsf4Ql66-CWHFumNA2ynrKEP21bstPBMgwsN-3G_Ek0ZLcoKtVMg5oN6-pg",
    "osVersion": "28"
    },
    "postId": $p01,
    "rate": 5,
    "userid": $uid
}
DATA;
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $resp = curl_exec($curl);
    curl_close($curl);
    //var_dump($resp);
    $json = json_decode($resp);
    echo $json->message; 
    echo "
    ";

//END OF RATING acct1 POST 2   
    
//RATING acct1 POST 3    
    echo "Rating $mainacct post #3 - ";    
    echo "
    ";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $data = <<<DATA
	{
    "device": {
    "deviceId": "fcbe87b62342fbac",
    "deviceImei": "fcbe87b62342fbac",
    "deviceModel": "Tecno Spark 7 Pro",
    "deviceName": "android",
    "deviceOs": "Android O_MR1 ",
    "isEmulator": false,
    "notificationToken": "eEBjxYrDSJyFw7N-DpEGNB:APA91bEZnWo-TRdSgVCzQcJq3gHioJtFThNyxw6PsgOCI1JHDzd55yqG-QZwAZRj4pwICrXo5VDiUYom7Fsf4Ql66-CWHFumNA2ynrKEP21bstPBMgwsN-3G_Ek0ZLcoKtVMg5oN6-pg",
    "osVersion": "28"
    },
    "postId": $p02,
    "rate": 5,
    "userid": $uid
}
DATA;
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $resp = curl_exec($curl);
    curl_close($curl);
    //var_dump($resp);
    $json = json_decode($resp);
    echo $json->message; 
    echo "
    ";

//END OF RATING acct1 POST 3 
      
//RATING acct1 POST 4    
    echo "Rating $mainacct post #4 - ";    
    echo "
    ";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $data = <<<DATA
	{
    "device": {
    "deviceId": "fcbe87b62342fbac",
    "deviceImei": "fcbe87b62342fbac",
    "deviceModel": "Tecno Spark 7 Pro",
    "deviceName": "android",
    "deviceOs": "Android O_MR1 ",
    "isEmulator": false,
    "notificationToken": "eEBjxYrDSJyFw7N-DpEGNB:APA91bEZnWo-TRdSgVCzQcJq3gHioJtFThNyxw6PsgOCI1JHDzd55yqG-QZwAZRj4pwICrXo5VDiUYom7Fsf4Ql66-CWHFumNA2ynrKEP21bstPBMgwsN-3G_Ek0ZLcoKtVMg5oN6-pg",
    "osVersion": "28"
    },
    "postId": $p03,
    "rate": 5,
    "userid": $uid
}
DATA;
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $resp = curl_exec($curl);
    curl_close($curl);
    //var_dump($resp);
    $json = json_decode($resp);
    echo $json->message; 
    echo "
    ";

//END OF RATING POST 4
    
    
    
//RATING POST 5   
    echo "Rating $mainacct post #5 - ";    
    echo "
    ";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $data = <<<DATA
	{
    "device": {
    "deviceId": "fcbe87b62342fbac",
    "deviceImei": "fcbe87b62342fbac",
    "deviceModel": "Tecno Spark 7 Pro",
    "deviceName": "android",
    "deviceOs": "Android O_MR1 ",
    "isEmulator": false,
    "notificationToken": "eEBjxYrDSJyFw7N-DpEGNB:APA91bEZnWo-TRdSgVCzQcJq3gHioJtFThNyxw6PsgOCI1JHDzd55yqG-QZwAZRj4pwICrXo5VDiUYom7Fsf4Ql66-CWHFumNA2ynrKEP21bstPBMgwsN-3G_Ek0ZLcoKtVMg5oN6-pg",
    "osVersion": "28"
    },
    "postId": $p04,
    "rate": 5,
    "userid": $uid
}
DATA;
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $resp = curl_exec($curl);
    curl_close($curl);
    //var_dump($resp);
    $json = json_decode($resp);
    echo $json->message; 
    echo "
    ";

    //END OF RATING POST 5
    
        //RATING POST 6    
    echo "Rating $mainacct post #6 - ";    
    echo "
    ";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $data = <<<DATA
	{
    "device": {
    "deviceId": "fcbe87b62342fbac",
    "deviceImei": "fcbe87b62342fbac",
    "deviceModel": "Tecno Spark 7 Pro",
    "deviceName": "android",
    "deviceOs": "Android O_MR1 ",
    "isEmulator": false,
    "notificationToken": "eEBjxYrDSJyFw7N-DpEGNB:APA91bEZnWo-TRdSgVCzQcJq3gHioJtFThNyxw6PsgOCI1JHDzd55yqG-QZwAZRj4pwICrXo5VDiUYom7Fsf4Ql66-CWHFumNA2ynrKEP21bstPBMgwsN-3G_Ek0ZLcoKtVMg5oN6-pg",
    "osVersion": "28"
    },
    "postId": $p05,
    "rate": 5,
    "userid": $uid
}
DATA;
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $resp = curl_exec($curl);
    curl_close($curl);
    //var_dump($resp);
    $json = json_decode($resp);
    echo $json->message; 
    echo "
    ";

    //END OF RATING POST 6
    
        //RATING POST 7    
    echo "Rating $mainacct post #7  - ";    
    echo "
    ";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $data = <<<DATA
	{
    "device": {
    "deviceId": "fcbe87b62342fbac",
    "deviceImei": "fcbe87b62342fbac",
    "deviceModel": "Tecno Spark 7 Pro",
    "deviceName": "android",
    "deviceOs": "Android O_MR1 ",
    "isEmulator": false,
    "notificationToken": "eEBjxYrDSJyFw7N-DpEGNB:APA91bEZnWo-TRdSgVCzQcJq3gHioJtFThNyxw6PsgOCI1JHDzd55yqG-QZwAZRj4pwICrXo5VDiUYom7Fsf4Ql66-CWHFumNA2ynrKEP21bstPBMgwsN-3G_Ek0ZLcoKtVMg5oN6-pg",
    "osVersion": "28"
    },
    "postId": $p06,
    "rate": 5,
    "userid": $uid
}
DATA;
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $resp = curl_exec($curl);
    curl_close($curl);
    //var_dump($resp);
    $json = json_decode($resp);
    echo $json->message; 
    echo "
    ";

    //END OF RATING POST 7
    
        //RATING POST 8   
    echo "Rating $mainacct post #8 - ";    
    echo "
    ";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $data = <<<DATA
	{
    "device": {
    "deviceId": "fcbe87b62342fbac",
    "deviceImei": "fcbe87b62342fbac",
    "deviceModel": "Tecno Spark 7 Pro",
    "deviceName": "android",
    "deviceOs": "Android O_MR1 ",
    "isEmulator": false,
    "notificationToken": "eEBjxYrDSJyFw7N-DpEGNB:APA91bEZnWo-TRdSgVCzQcJq3gHioJtFThNyxw6PsgOCI1JHDzd55yqG-QZwAZRj4pwICrXo5VDiUYom7Fsf4Ql66-CWHFumNA2ynrKEP21bstPBMgwsN-3G_Ek0ZLcoKtVMg5oN6-pg",
    "osVersion": "28"
    },
    "postId": $p07,
    "rate": 5,
    "userid": $uid
}
DATA;
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $resp = curl_exec($curl);
    curl_close($curl);
    //var_dump($resp);
    $json = json_decode($resp);
    echo $json->message; 
    echo "
    ";

    //END OF RATING POST 8
    
        //RATING POST 9    
    echo "Rating $mainacct post #9 - ";    
    echo "
    ";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $data = <<<DATA
	{
    "device": {
    "deviceId": "fcbe87b62342fbac",
    "deviceImei": "fcbe87b62342fbac",
    "deviceModel": "Tecno Spark 7 Pro",
    "deviceName": "android",
    "deviceOs": "Android O_MR1 ",
    "isEmulator": false,
    "notificationToken": "eEBjxYrDSJyFw7N-DpEGNB:APA91bEZnWo-TRdSgVCzQcJq3gHioJtFThNyxw6PsgOCI1JHDzd55yqG-QZwAZRj4pwICrXo5VDiUYom7Fsf4Ql66-CWHFumNA2ynrKEP21bstPBMgwsN-3G_Ek0ZLcoKtVMg5oN6-pg",
    "osVersion": "28"
    },
    "postId": $p08,
    "rate": 5,
    "userid": $uid
}
DATA;
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $resp = curl_exec($curl);
    curl_close($curl);
    //var_dump($resp);
    $json = json_decode($resp);
    echo $json->message; 
    echo "
    ";

    //END OF RATING POST 9
    
        //RATING POST 10    
    echo "Rating $mainacct post #10 - ";    
    echo "
    ";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $data = <<<DATA
	{
    "device": {
    "deviceId": "fcbe87b62342fbac",
    "deviceImei": "fcbe87b62342fbac",
    "deviceModel": "Tecno Spark 7 Pro",
    "deviceName": "android",
    "deviceOs": "Android O_MR1 ",
    "isEmulator": false,
    "notificationToken": "eEBjxYrDSJyFw7N-DpEGNB:APA91bEZnWo-TRdSgVCzQcJq3gHioJtFThNyxw6PsgOCI1JHDzd55yqG-QZwAZRj4pwICrXo5VDiUYom7Fsf4Ql66-CWHFumNA2ynrKEP21bstPBMgwsN-3G_Ek0ZLcoKtVMg5oN6-pg",
    "osVersion": "28"
    },
    "postId": $p09,
    "rate": 5,
    "userid": $uid
}
DATA;
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $resp = curl_exec($curl);
    curl_close($curl);
    //var_dump($resp);
    $json = json_decode($resp);
    echo $json->message; 
    echo "
    ";

    //END OF RATING POST 10  
    
        //RATING POST 11   
    echo "Rating $mainacct post #11 -  ";    
    echo "
    ";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $data = <<<DATA
	{
    "device": {
    "deviceId": "fcbe87b62342fbac",
    "deviceImei": "fcbe87b62342fbac",
    "deviceModel": "Tecno Spark 7 Pro",
    "deviceName": "android",
    "deviceOs": "Android O_MR1 ",
    "isEmulator": false,
    "notificationToken": "eEBjxYrDSJyFw7N-DpEGNB:APA91bEZnWo-TRdSgVCzQcJq3gHioJtFThNyxw6PsgOCI1JHDzd55yqG-QZwAZRj4pwICrXo5VDiUYom7Fsf4Ql66-CWHFumNA2ynrKEP21bstPBMgwsN-3G_Ek0ZLcoKtVMg5oN6-pg",
    "osVersion": "28"
    },
    "postId": $p10,
    "rate": 5,
    "userid": $uid
}
DATA;
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $resp = curl_exec($curl);
    curl_close($curl);
    //var_dump($resp);
    $json = json_decode($resp);
    echo $json->message; 

    echo "
    ";
    //END OF RATING POST 11
    
 //END OF ACCOUNT 1
    
}   //end of foreach $accounts

 
    //retrieve dummy balance
     


  echo "$BWhite";
  echo "Retrieving dummy GEMS ";

  
  echo "$Cyan";

    
    $urlbal2 = "https://wallets.mylykaapps.com/api/v3/wallets/getgems?os=android";
    $curlbal2 = curl_init($urlbal2);
    curl_setopt($curlbal2, CURLOPT_URL, $urlbal2);
    curl_setopt($curlbal2, CURLOPT_RETURNTRANSFER, true);
    $headersbal2 = array("authorization: Bearer $bearer",);
    curl_setopt($curlbal2, CURLOPT_HTTPHEADER, $headersbal2);
    //for debug only!
    curl_setopt($curlbal2, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curlbal2, CURLOPT_SSL_VERIFYPEER, false);
    $respbal2 = curl_exec($curlbal2);
    curl_close($curlbal2);
    //var_dump($respbal);
    $jsonbal2 = json_decode($respbal2);
    $tg2 = $jsonbal2->data->totalGem;
    echo "
DUMMY BALANCE $tg2 GEMS
";

    
    
    $urlbals = "https://wallets.mylykaapps.com/api/v3/wallets/SendGem";
    $curlbals = curl_init($urlbals);
    curl_setopt($curlbals, CURLOPT_URL, $urlbals);
    curl_setopt($curlbals, CURLOPT_POST, true);
    curl_setopt($curlbals, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlbals, CURLOPT_HTTPHEADER, $headers);
    $databals = '{"amount":"' . $tg2 . '","device":{"deviceId":"f606c43d78f50669","deviceImei":"f606c43d78f50669","deviceModel":"Tecno Spark 7 Pro","deviceName":"android","deviceOs":"Android O_MR1","isEmulator":false,"notificationToken":"eFEXEC5pTAeXLu7JjIlpNX:APA91bF8I2ZGs8wUNDjpw5lSnzrz8fB652HYMxWBdTGtFRSUaBEd0pHZQvWXAd00ESKVUO_VtYieRQxtfEU7f3RUIHEs5zXGZSVqk5PfbzjZTJQcue0vHYRiEobXHk8JUlTa0nmPCdgR","osVersion":"28"},"recipientId":' . $uid . '}';
    curl_setopt($curlbals, CURLOPT_POSTFIELDS, $databals);
    $respbals = curl_exec($curlbals);
    curl_close($curlbals);
    //var_dump($respbals);

    $jsonbals = json_decode($respbals);
    echo $jsonbals->message;
    echo "    

    ";
    echo "   

    ";
 
    
    
    echo "Duumy account GEMS transferred to main . $accounts[0] . : +$tg2 GEMS   ";  
    echo "
    ";
      
    echo "$BWhite";
    echo "aparri software  
    
    ";
 
    

} //end of foreach
