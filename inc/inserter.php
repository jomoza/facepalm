<?php
/**
 *
 */

require('searchers/shodanSearch.php');
require('searchers/sploitusSearch.php');
require('searchers/circlSearch.php');
require('searchers/exploitdbSearch.php');
require('searchers/shodanExploitsSearch.php');
require('searchers/nmapSearch.php');
require('searchers/ipinfoSearch.php');
require("inc/pdo/PDO.class.php");

include ("inc/config.php");

class exploitInserter
{
  public $DB;
  public $sploitus;
  public $xpltdb;
  public $shodxploit;
  public $machine_id;
  public $menuIndex;
  public $ipHost;
  public $infoHost;

  function __construct($mnu, $addrs, $inf)
  {
    $this->DB = new Db(DBHost, DBName, DBUser, DBPassword);
    $this->sploitus = new moduleSploitus();
    $this->xpltdb = new moduleExploitdb();
    $this->shodxploit = new moduleShodanExploits();
    $this->menuIndex=$mnu;
    $this->ipHost=$addrs;
    $this->infoHost=$inf;

  }

  public function getMachineId()
  {
    return $this->machine_id;
  }

  function inserter($servicesList, $portsList)
  {
      // var_dump($this->infoHost);
      $this->menuIndex->showLogShodan($this->infoHost);
      if ($this->DB->query("SELECT ide FROM machines WHERE ip_addrs=?", array($this->ipHost))) {
        $getIpDir=$this->DB->query("SELECT ide FROM machines WHERE ip_addrs=?", array($this->ipHost));
      }else{
        $this->DB->query("INSERT IGNORE INTO machines(ip_addrs,ip_info) VALUES(?,?) ", array($this->ipHost, json_encode($this->infoHost)));
        $getIpDir=$this->DB->query("SELECT ide FROM machines WHERE ip_addrs=?", array($this->ipHost));
      }

      //catch id
      $this->machine_id=$getIpDir[0]['ide'];
      $i=0;
      //Insert services
      $this->menuIndex->showLogServices($servicesList);
      foreach ($servicesList as $key => $value) {
        $this->DB->query("INSERT IGNORE INTO services(ide, service,	port, info) VALUES(?,?,?,?) ", array($this->machine_id, "tcp", $portsList[$i], $value));
        $i++;
      }

      //run searchers
      foreach ($servicesList as $key => $value) {
        $this->shodxploit->searchShodanSploits($value);
        $this->xpltdb->run($value);
        $this->sploitus->run($value);
      }
      //shodan $exploits

      $this->menuIndex->showLogShodanExploits($this->shodxploit->getVulns());
      foreach ($this->shodxploit->getVulns() as $kky => $shxplinfo) {
        $this->DB->query("INSERT IGNORE INTO vulns(machine_id,source_vuln,info) VALUES(?,?,?)", array( $this->machine_id, "shodan",json_encode($shxplinfo)));
      }

      //exploit db
      // echo "caca";
      // $this->menuIndex->showLogExploitdb($this->xpltdb->getXploits());
      if (!empty($this->xpltdb->getXploits())) {
        $this->menuIndex->showLogExploitdb($this->xpltdb->getXploits());
        foreach ($this->xpltdb->getXploits() as $clv => $xploinfo) {
          if (!empty($xploinfo)) {
            // var_dump($xploinfo);
            $this->DB->query("INSERT IGNORE INTO vulns(machine_id,source_vuln,info) VALUES(?,?,?)", array( $this->machine_id, "exploitdb",json_encode($xploinfo)));
          }
        }
      }

      //sploitus
      if (!empty($this->sploitus->getArrayS())){
        // var_dump($this->sploitus->getArrayS());
        $this->menuIndex->showLogSploitus($this->sploitus->getArrayS());
        foreach ($this->sploitus->getArrayS() as $ey => $sploitnfo) {
          // code...
          $this->DB->query("INSERT IGNORE INTO vulns(machine_id,source_vuln,info) VALUES(?,?,?)", array( $this->machine_id, "sploitus",json_encode($sploitnfo)));
        }
      }

  }

  public function insertMoreServicesNmap($serviceList, $portlist,$idi)
  {
    $i=0;
    // $this->menuIndex->showLogServices($servicesList);
    foreach ($serviceList as $k => $datue) {
      $this->DB->query("INSERT IGNORE INTO services(ide, service,	port, info) VALUES(?,?,?,?) ", array($idi, "nmap", $portlist[$i], $datue));
      $i++;
    }
  }

  function insertMoreServices($serviceList, $idi)
  {
    // $this->menuIndex->showLogServices($servicesList);
    foreach ($serviceList as $k => $datue) {
      // echo $datue['port'];
      $this->DB->query("INSERT IGNORE INTO services(ide, service,	port, info) VALUES(?,?,?,?) ", array($idi, $datue['module'], $datue['port'], $datue['dato']));
      //el buen banner grabbing
    }
  }

  function cveInserter($cveList, $machIde){
    $circl = new moduleCircl();
    $this->menuIndex->showLogShodCve($cveList);
    foreach ($cveList as $kk => $ceve) {
      $cveString=$circl->run($ceve);
      $this->DB->query("INSERT IGNORE INTO ceves(machine_ide, source, cve_info) VALUES(?,?,?) ", array($machIde, $ceve, json_encode($cveString)));
    }
  }
}


?>
