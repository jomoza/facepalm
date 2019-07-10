<?php
function runSearcherWNmap($hostS, $mn)
{

  $ipinfo = new moduleIpInfo();
  $nmap = new moduleNmap($hostS);
  $fileO=$nmap->getFileOut();
  $mn->showLogNmap($fileO, $hostS);

  $ipinfo->run($hostS);
  $hostData=$ipinfo->getData();

  $nmap->run($hostS);
  $nmap->parseNmapXml();

  $inercion = new exploitInserter($mn, $hostS, $hostData);
  $inercion->inserter($nmap->getServicesToAnalize(), $nmap->getPorts());
  $id=$inercion->getMachineId();

  if (!empty($nmap->getMoreServices())) {
    $inercion->insertMoreServicesNmap($nmap->getMoreServices(), $nmap->getPortsII(),$id);
  }

}

function runSearcherWShodan($hostS, $mn)
{
  $mn->showLogShod($hostS);
  $searchinShodan = new moduleShodan();

  $searchinShodan->run($hostS);
  $hostData = $searchinShodan->getData();

  $inercion = new exploitInserter($mn, $hostS, $hostData);

  if (!empty($searchinShodan->getServices())) {

        $inercion->inserter($searchinShodan->getServices(), $searchinShodan->getPorts());
        $id=$inercion->getMachineId();

        //circl cve-api & insertion
        if (!empty($searchinShodan->getCeves())) {
          // var_dump($searchinShodan->getCeves());
          $id=$inercion->getMachineId();
          // echo $id."\n";
          $inercion->cveInserter($searchinShodan->getCeves(), $id);
        }

        if (!empty($searchinShodan->getServices2())) {
          $inercion->insertMoreServices($searchinShodan->getServices2(), $id);
        }

      }else{

        if (!empty($searchinShodan->getServices2())) {
          $id=$inercion->getMachineId();
          $inercion->insertMoreServices($searchinShodan->getServices2(), $id);
        }else {
          echo "NO SERVICES DETECTED";
        }
      }
  }
?>
