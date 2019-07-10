<?php

/**
 *
 */
class moduleNmap
{
	public $fileout;
	public $port;
	public $portII;
	public $servicesToAnalize;
	public $services;

	function __construct($host)
  {
		// $this->fileout="";
		$this->fileout="db/nmapOuts/nmap_".$host."_".date("Y-m-d.H:i:s")."_output.xml";
		$this->port=[];
		$this->portII=[];
		$this->servicesToAnalize=[];
		$this->services=[];
  }

	public function run($host)
	{
		// echo $this->fileout;
		$nmap = shell_exec("nmap -F -sV -oX ".$this->fileout." ".$host." 1>/dev/null 2>/dev/null");
	}
  public function parseNmapXml()
  {
    $xml=simplexml_load_file($this->fileout) or die("Error: Cannot create object");

		foreach ($xml[0]->host->ports->port as $key => $value) {
			if (isset($value->service['product']) && $value->service['version']) {
				$this->servicesToAnalize[]=$value->service['product']." ".$value->service['version'];
				$this->port[]=$value['portid'];
			}else{
				$this->services[]=$value->service['product']." ".$value->service['version'];
				$this->$portII[]=$value['portid'];
			}
			}
	}
	public function getFileOut(){
		return $this->fileout;
	}

	public function getMoreServices(){
		return $this->services;
	}

  public function getServicesToAnalize()
  {
    return $this->servicesToAnalize;
  }
	public function getPorts()
	{
		return $this->port;
	}
	public function getPortsII()
	{
		return $this->portII;
	}
}


?>
