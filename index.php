<?php
$input=file_get_contents('php://input');
$data=json_decode($input);
$chat_id=$data->message->chat->id;
$text=$data->message->text;
//$msg="$text";
echo "Hello I am here";
$handle = fopen("log.txt", "a");
    $date = (new DateTime())->setTimeZone(new DateTimeZone('Asia/Kolkata'))->format('Y-m-d H:i:s');
$msg=str_replace("\n"," %0A",$text);


$msg = preg_replace_callback('/\:\s*\K\w/', 
    function($m) {
        return strtoupper($m[0]);
    },
    $msg);
    $msg = preg_replace_callback('/\➥\s*\K\w/', 
    function($m) {
        return strtoupper($m[0]);
    },
    $msg);
$msg=str_replace("Definition:","<u>Definition</u>: ",$msg);
$msg=str_replace("Example:","<u>Example</u>: ",$msg);
$msg=str_replace("Examples:","<u>Examples</u>: ",$msg);
$msg=str_replace("Today in News:","<u>Today in News</u>: ",$msg);
$msg=str_replace("Today in news:","<u>Today in News</u>: ",$msg);
$msg=str_replace("Today in newspaper:","<u>Today in newspaper</u>: ",$msg);
$msg=str_replace("Today in Newspaper:","<u>Tday in Newspaper</u>: ",$msg);

$pieces = explode(" ", $msg);
if (in_array("📚", $pieces))
  {
  	 $arrIndex=array_search('📚', $pieces); 
  	 $worrd=$pieces[$arrIndex+1];
  //	 $str = $pizza; 
  	$pos = strpos($msg,$worrd);
		if ($pos !== false) {
		    $worrd
		    =strtolower($worrd);
  		  $msg = substr($msg,0,$pos+1) .str_replace($worrd,('<b><u>'.$worrd.'</u></b>'),substr($msg,$pos+1));
				}
}
$msg = preg_replace_callback('/\📚\s*\K\w/', 
    function($m) {
        return strtoupper($m[0]);
    },
    $msg);
$msg=urlencode($msg);
$msg=str_replace("%250A","%0A",$msg);
$msg=str_replace("%3C","<",$msg);
$msg=str_replace("%3E",">",$msg);

$url="https://api.telegram.org/bot5532663799:AAF6Kzt0Ux4rYW9ctNckvm7b_cKHp5om6kk/sendMessage?text=$msg&chat_id=@trymybott&parse_mode=html";
file_get_contents($url);
?>
