<?php
/**
 *
 */
class moduleSploitus
{
  public $dataSend;
  public $arrayR=[];
  public $arrayS=[];

  public $data_string;

  public function getArrayS()
  {
    return $this->arrayS;
  }

  public function run($service)
  {

    $this->dataSend = array("offset" => 0,
                      "query" => $service,
                      "sort" => "default",
                      "title" => "false",
                      "type" => "exploits");

    $this->data_string = json_encode($this->dataSend);

    $ch = curl_init('https://sploitus.com/search');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($this->data_string))
    );

    $result = curl_exec($ch);
    $arrXploit = json_decode($result, true);

    foreach ($arrXploit["exploits"] as $key => $value) {

         $this->arrayR[]=$value["title"];
         $this->arrayR[]=$value["href"];
         $this->arrayR[]=$value["language"];
         $this->arrayR[]=$value["type"];
         $this->arrayS[]=$this->arrayR;
         unset($this->arrayR);
    }
  }
}
?>
