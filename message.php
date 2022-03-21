<?php
// connecting to database
$conn = mysqli_connect("localhost", "root", "", "bot") or die("Database Error");

// getting user message through ajax
$getMesg = mysqli_real_escape_string($conn, $_POST['text']);
$msg = $getMesg;
$k = 0;

$name = "BRO";

//checking user query to database query
$check_data = "SELECT replies FROM chatbot WHERE queries = '$getMesg'";

//$run_query2= mysqli_query($conn, $insert_data);
$run_query = mysqli_query($conn, $check_data) or die("Error");


$arr = array(
    "eateries bits hyd"=>"These are some of the Eatiries in BITS Hyderabad
                            1. Yumpies 2. Hotspot 3. Amul",
    "eateries bits hyderabad"=>"These are some of the Eatiries in BITS Hyderabad
                            1. Yumpies 2. Hotspot 3. Amul",
    "where yumpies"=>"It's near mess 1",
    "where hotspot"=>"It's near Connaught Place",
    "where amul"=>"It's near Volley ball court",
    "hello"=>"Hello there",
    "hi"=>"Hello",
    "your name"=>"My name is BRO",
    "hey bro"=>"hey dude",
    "good morning"=>"Good Morning, My friend",
    "good NighT"=>"Good Night, Dude",
    "gooD evening"=>"Good Evening",
    "good afternoon"=>"Good Afternoon",
    "how are you"=>"I am fine, How are you?",
    "i am fine"=>"Good to know",
    "your friends"=>"Alexa is my best and only friend. I mean other than you",
    "calculate math"=>"Yes, I can provide answers using my built in web services",
    "weather today"=>"<a href=\"http://www.google.com/search?q=weather\">Click hear to know the weather</a>",
    "weather"=>"<a href=\"http://www.google.com/search?q=weather\">Click hear to know the weather</a>",
    "news today"=>"<a href=\"https://timesofindia.indiatimes.com\">Click hear to know the news today</a>",
    "where taj mahal"=>"It's in India",
    "your age"=>"I am just one day, Old man",
    "your parents"=>"Punith, Raghavendra, Aryaman. Lucky me!!",
    "your home"=>"V452, Vyas Bhawan, BITS-Pilani, Hyderabad Campus",
    "your height"=>"I am an AI bot, Do you really expect me to answer that question",
    "who are you"=>"I am an AI bot, My name is BRO",
    "what you do"=>"I can chat you up; Help you with Math, Translations and little more this and that ",
    "you help me"=>"Yes, I can. I am here for you. Ask me something?",
    "temperature"=>"<a href=\"http://www.google.com/search?q=temperature\">Click hear to know the temperature</a>",
    "what your purpose"=>"I can chat you up; Help you with Math, Translations and little more this and that ",


);



$do = 0;
$replay ;

foreach( $arr as $key => $value){


    $key1 = strtolower($key);
    $getMesg= strtolower($getMesg);

    $words = explode(' ', $getMesg);
    $words1 = explode(' ', $key1);
    $b = 0;
    foreach( $words1 as $v ){

        if(in_array($v,$words)){
            $b = 1;
            $do = 0;
        }else{
            $b = 0;
            $do = 1;
            break;
        }
    }
    if($b == 1){
        echo $arr[$key];
        $replay = $arr[$key];
        break;
    }
}



 if($do == 1){
    
    //$getMesg = preg_replace('/\s+/', '%20', $getMesg);
    $getMesg = rawurlencode($getMesg);
    $getMesg = str_replace('%5C', '', $getMesg);

    $k = 1;
    $f = file_get_contents('http://api.brainshop.ai/get?bid=160167&key=8h8vRUhkZo5zyBrO&uid=[uid]&msg='. $getMesg);

    $str2 = substr($f, 8);
    $str3 = substr_replace($str2, "",-2);
    //echo $getMesg;
    echo $str3;
    //echo "Sorry can't be able to understand you!";
    
}

try{
    if($k > 0){
    $insert = "INSERT INTO `conversations` (`User`, `Bot`) VALUES ('$msg', '$str3')";
    mysqli_query($conn, $insert);}
    else{
    $insert = "INSERT INTO `conversations` (`User`, `Bot`) VALUES ('$msg', '$replay')";
    mysqli_query($conn, $insert);}
    

    }
//catch exception
    catch(Exception $e) {
        echo('Message: ' .$e->getMessage());
    }

?>