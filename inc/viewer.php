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

  function __construct()
  {
    $this->DB = new Db(DBHost, DBName, DBUser, DBPassword);
  }

  public function getMachineId()
  {
    return $this->machine_id;
  }

  function viewerMachines()
  {
      $getIpDir=$this->DB->query("SELECT ide FROM machines WHERE ip_addrs=?", array($this->ipHost));
  }

}


?>
