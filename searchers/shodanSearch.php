
<?php
error_reporting(E_ERROR | E_PARSE);
include ("../inc/config.php");

class moduleShodan
{

	public $ch;
	public $arrayXData=[];
	public $vuln=[];
	public $ceves=[];
	public $services=[];
	public $services2=[];
	public $tempArray=[];
	public $portsSh=[];

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

	public function dns_resolve_shodan($link)
	{
		$url='https://api.shodan.io/dns/resolve?hostnames='.$link.'&key='.ldelshodan;
		$jsonip = json_decode($str, true);
		$ipdir=$jsonip[$link];
		return $ipdir;
	}


	public function run($laip)
	{
		$urlsh='https://api.shodan.io/shodan/host/'.$laip.'?key='.ldelshodan;

		$this->startConection();
		$strsh=$this->request($urlsh);
		$json_a = json_decode($strsh, JSON_BIGINT_AS_STRING);

		foreach ($json_a as $key => $value) {
			$this->arrayXData['ip']=$json_a['ip'];
			$this->arrayXData['hostnames']=$json_a['hostnames'];
			$this->arrayXData['ports']=$json_a['ports'];
			$this->arrayXData['os']=$json_a['os'];
			$this->arrayXData['city']=$json_a['city'];
			$this->arrayXData['country_name']=$json_a['country_name'];
			$this->arrayXData['country_code']=$json_a['country_code'];
			$this->arrayXData['country_code3']=$json_a['country_code3'];
			$this->arrayXData['region_code']=$json_a['region_code'];
			$this->arrayXData['area_code']=$json_a['area_code'];
			$this->arrayXData['postal_code']=$json_a['postal_code'];
			$this->arrayXData['dma_code']=$json_a['dma_code'];
			$this->arrayXData['latitude']=$json_a['latitude'];
			$this->arrayXData['longitude']=$json_a['longitude'];
		}

		$max = sizeof($json_a['data']);
		// $geo = $json_a[country_code]." ".$json_a[country_name];
		for ($i=0; $i < $max ; $i++) {
				// var_dump($json_a['data'][$i]);
				if (strlen($json_a['data'][$i]['product']) != 0 ) {

					if (isset($json_a['data'][$i]['product']) && isset($json_a['data'][$i]['version'])) {
						// code...
						$this->services[]=$json_a['data'][$i]['product']." ".$json_a['data'][$i]['version'];
					}else{
						continue;
					}

					$this->portsSh[]=$json_a['data'][$i]['port'];
			}else{
				//PROXIMAMENTE BANNER GRABBING
				$tempArray=[];
				$tempArray['module']=$json_a['data'][$i]['_shodan']['module'];
				$tempArray['port']=$json_a['data'][$i]['port'];

				if (isset($json_a['data'][$i]['dns']['software'])){
					$tempArray['dato']=$json_a['data'][$i]['dns']['software'];
				}else{
					if (isset($json_a['data'][$i]['http']['server'])) {
						$tempArray['dato']=$json_a['data'][$i]['http']['server'];
					}else{
						$tempArray['dato']=$json_a['data'][$i]['data'];
					}
				}

				$this->services2[]=$tempArray;

			}
		}

		if (empty(!$json_a['vulns'])) {
			$numV = sizeof($json_a['vulns']);
			for ($v=0; $v < $numV; $v++) {
				// echo "-".$json_a['vulns'][$v];
				$this->ceves[]=$json_a['vulns'][$v]; //LOS CVE QUE DETECTA SHODAN
			}
		}


		//here close curl
		$this->closeConection();

	}

	public function getCeves()
	{
		return $this->ceves;
	}

	public function getData()
	{
		return $this->arrayXData;
	}

	public function getServices()
	{
		return $this->services;
	}
	public function getServices2()
	{
		return $this->services2;
	}
	public function getPorts()
	{
		return $this->portsSh;
	}
}
