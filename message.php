<?php
// connecting to database
$conn = mysqli_connect("localhost", "root", "", "bot") or die("Database Error");

// getting user message through ajax
$getMesg = mysqli_real_escape_string($conn, $_POST['text']);
$msg = $getMesg;




//checking user query to database query
$check_data = "SELECT replies FROM chatbot WHERE queries = '$getMesg'";

//$run_query2= mysqli_query($conn, $insert_data);
$run_query = mysqli_query($conn, $check_data) or die("Error");




// if user query matched to database query we'll show the reply otherwise it go to else statement
if(mysqli_num_rows($run_query) > 0){
    //fetching replay from the database according to the user query
    $fetch_data = mysqli_fetch_assoc($run_query);
    //storing replay to a varible which we'll send to ajax
    $replay = $fetch_data['replies'];
    echo $replay;

    

}else{
    
    //$getMesg = preg_replace('/\s+/', '', $getMesg);
    //$getMesg = preg_replace('/[^A-Za-z0-9]/', "", $getMesg);
    $getMesg = preg_replace('/\s+/', '%20', $getMesg);

   // $url = 'http://api.brainshop.ai/get?bid=160167&key=8h8vRUhkZo5zyBrO&uid=[uid]&msg='. $getMesg;

    //function get_content($url){
    //    $ch = curl_init();
    //    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //    curl_setopt($ch, CURLOPT_URL, $url);
    //    $data = curl_exec($ch);
    //    curl_close($ch);
    //    return $data;
  //}
  
 // echo get_content($url);

    $f = file_get_contents('http://api.brainshop.ai/get?bid=160167&key=8h8vRUhkZo5zyBrO&uid=[uid]&msg='. $getMesg);
    //echo $getMesg;
    //echo $getMesg. "+";
    $str2 = substr($f, 8);
    $str3 = substr_replace($str2, "",-2);
    echo $str3;
    
    $insert = "INSERT INTO `conversations`(`User`, `Bot`) VALUES ($msg,$str3) ";
    

    //echo "Sorry can't be able to understand you!";
    
}

?>