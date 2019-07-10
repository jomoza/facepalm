<?php
//error_reporting(E_ERROR | E_PARSE);
require('inc/menu.php');
require("inc/inserter.php");
include ("inc/core.php");

try {

      $menu = new menuModule();
      $menu->headerMessage();

      if (isset($argv[1])) {
        // code...
        switch ($argv[1]) {
          case 'help':
            $menu->printhelp();
            break;
          case 'scannmap':
            runSearcherWNmap($argv[2], $menu);
            break;
          case 'shodscan':
            runSearcherWShodan($argv[2], $menu);
            break;
          case 'rangescann':
            echo "range scann \n";
            break;
          case 'file scann':
            echo " \n";
            break;
          case 'viewer':
            echo "show hosts \n";
            break;
          case 'dumpdb':
            // echo "dumpdb \n";
            $menu->runDumpDb();
            system("mysqldump ".DBName." -u ".DBUser." -p > ./db/backup".date("Y-m-d@H:i:s").".sql");
            break;
          default:
            $menu->runHelp();
            break;
        }
      }else{
        $menu->runHelp();
        echo "\n";
      }

  } catch (Exception $e) {
      echo $e;
  }
 ?>
