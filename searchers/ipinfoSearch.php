
<?php

//error_reporting(E_ERROR | E_PARSE);
include ("../inc/config.php");


class moduleIpInfo
{

	public $ch;
	public $ipdata=[];

	public function request($uri)
	{
		curl_setopt($this->ch, CURLOPT_URL, $uri);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->ch, CURLOPT_HEADER, 0);
		$str=curl_exec($this->ch);
		return $str;
	}

	public function startConection(){
		$this->ch = curl_init();
	}

	public function closeConection(){
		curl_close($this->ch);
	}

	public function run($laip)
	{
		$urlsh='https://ipinfo.io/'.$laip.'?token='.ipinfotoken;

		$this->startConection();
		$strsh=$this->request($urlsh);
		$json_a = json_decode($strsh, JSON_BIGINT_AS_STRING);
    $this->ipdata=$json_a;
		//here close curl
		$this->closeConection();
  }

  public function getData($value='')
  {
    return $this->ipdata;
  }
}



?>
