<?php
/**
 *
 */

include 'colors.php';

class menuModule
{
  public $colors;
  function __construct()
  {
     $this->colors= new Colors();
    // code...
  }


  function printhelp()
  {
    echo $this->colors->getColoredString("            \n", "white");
    echo $this->colors->getColoredString("            List of Options\n", "white");
    echo $this->colors->getColoredString("            \n", "white");
    echo $this->colors->getColoredString("            [#] shodscan <ip> (Standart scanner, it use Nmap to Info Gathering and )\n", "white");
    echo $this->colors->getColoredString("            [#] scannmap <ip> (Standart scanner, it use Shodan to Info Gathering and )\n", "white");
    echo $this->colors->getColoredString("            [#] dumpdb (Dump facepalm database)\n", "white");
    echo $this->colors->getColoredString("            \n", "white");
    echo $this->colors->getColoredString("            \n", "white");

  }

  function headerMessage()
  {

    $art = "

                    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░▄▄▄░░░░░
                    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░███▀█░░░░
                    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░███░██░░░
                    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░███░░██░░░
                    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░▄██░░░░██░░
                    ░░░░░░░░░░░░░░░░▄▄█▀▀▀▀█▄▄▄▄███▄░░░██░░
                    ░░░░░░░░░░░░░▄█▀░░░░░░░░░▀▀▀▀█░▀█░░██░░
                    ░░░░░░░░░░░░█▀░░░░░░░░░░░░░░░▀█▄█▀▀▀░░░
                    ░░░░░░░░░░░▄▀░░░░░░░░░░░░░░░░▀█▄░░░░░░░
                    ░░░░░░░░░░░▀█▄░█░░▄▀░░░░░░░▄▄█░░░░░░░░░
                    ░░░░░░░░▄▄▄▄█▀▀▀██▄▄░░░░░░▄▀░░░░░░░░░░░
                    ░░░░▄▄██▄▀▀░░░░░█▀░░░░░░▄██▄░░░░░░░░░░░
                    ░░▄██▀▀░░░░░░░░▄█░░░░░▄█▀▄█░▀▀█▄▄▄▄▄▄▄▄
                    ░██▀░░░░░░░░▄██░░░░░░▄▀▄▄▀░░░░░░░░░░░░░
                    █▀▀░░░░░░▄█▀▄░▀▄▄▄▄██▀▀▀░░░░░█░░░░░░░░░
                    █░░░░░▄▄▀░░░░█░░░░░░░░░░░░░░░▀░░░░░░░░░
                    ░▀▀▀▀▀▀░░░░░░░█░░░░░░░░░░░░░░░▀▀█▀▀▀▀▀▀
                    ░░░░░░░░░░░░░░█░░░░░░░░░░░░░░░░█▀░░░░░░
                    ░░░░░░░░░░░░░░█░░░░░░░░░░░░░░░▄█░░░░░░░


";

    echo $this->colors->getColoredString($art."\n", "white");
    echo $this->colors->getColoredString("[*]                                                                            [*]\n", "white");
    echo $this->colors->getColoredString("[*]                #######################################                     [*]\n", "white");
    echo $this->colors->getColoredString("[*]                                                                            [*]\n", "white");
    echo $this->colors->getColoredString("[*]                      Facepalm: OSINT vulnerabilities                       [*]\n", "white");
    echo $this->colors->getColoredString("[*]                        searching tool.                                     [*]\n", "white");
    echo $this->colors->getColoredString("[*]                                                                            [*]\n", "white");
    echo $this->colors->getColoredString("[*]                Git: https://github.com/jomoza/facepalm                     [*]\n", "white");
    echo $this->colors->getColoredString("[*]                Author: @j0moz4                                             [*]\n", "white");
    echo $this->colors->getColoredString("[*]                                                                            [*]\n", "white");
    echo $this->colors->getColoredString("[*]                #######################################                     [*]\n", "white");

  }

  public function showLogShod($host)
  {
    echo $this->colors->getColoredString("[*]                                                                            \n", "light_cyan");
    echo $this->colors->getColoredString("[*]                #######################################                     \n", "light_cyan");
    echo $this->colors->getColoredString("[*]                                                                            \n", "light_cyan");
    echo $this->colors->getColoredString("[*]                RUNNING SHODAN SCANNER FOR ".$host."                                      \n", "light_cyan");
    echo $this->colors->getColoredString("[*]                                                                            \n", "light_cyan");
    echo $this->colors->getColoredString("[*]                #######################################                     \n", "light_cyan");
  }

  public function showLogNmap($file, $host)
  {
    echo $this->colors->getColoredString("[*]                                                                            \n", "light_cyan");
    echo $this->colors->getColoredString("[*]                #######################################                     \n", "light_cyan");
    echo $this->colors->getColoredString("[*]                                                                            \n", "light_cyan");
    echo $this->colors->getColoredString("[*]                RUNNING NMAP SCANNER FOR ".$host."                                      \n", "light_cyan");
    echo $this->colors->getColoredString("[*]                                                                            \n", "light_cyan");
    echo $this->colors->getColoredString("[*]                Saving result in ".$file."                                  \n", "light_cyan");
    echo $this->colors->getColoredString("[*]                                                                            \n", "light_cyan");
    echo $this->colors->getColoredString("[*]                #######################################                     \n", "light_cyan");
  }

    public function showLogServices($serviceList)
    {
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_cyan");
      echo $this->colors->getColoredString("[*]                #######################################                     \n", "light_cyan");
      echo $this->colors->getColoredString("[*]                         SERVICES FOUND:                                    \n", "light_cyan");
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_cyan");
      foreach ($serviceList as $key => $value) {
        echo $this->colors->getColoredString("[*]                      ".$value."                                                \n", "light_cyan");
      }
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_cyan");
      echo $this->colors->getColoredString("[*]                #######################################                     \n", "light_cyan");

    }

    function showLogShodan($infoArray)
    {
      echo $this->colors->getColoredString("[*]                                                                            \n", "brown");
      echo $this->colors->getColoredString("[*]                #######################################                     \n", "brown");
      echo $this->colors->getColoredString("[*]                                                                            \n", "brown");
      echo $this->colors->getColoredString("[*]                      INFORMATION GATHERING RESULT                        \n", "brown");
      echo $this->colors->getColoredString("[*]                                                                            \n", "brown");
      foreach ($infoArray as $key => $value) {
        if ($key != "ports") {
          echo $this->colors->getColoredString("[*]                   ".$key.":  ".$value."                                        \n", "brown");
        }
      }
      echo $this->colors->getColoredString("[*]                                                                            \n", "brown");
      echo $this->colors->getColoredString("[*]                #######################################                     \n", "brown");

    }

    function showLogShodanExploits($exploitsArray)
    {
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_red");
      echo $this->colors->getColoredString("[*]                #######################################                     \n", "light_red");
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_red");
      echo $this->colors->getColoredString("[*]                SHODAN EXPLOITS RESULT                                      \n", "light_red");
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_red");
      echo $this->colors->getColoredString("[*]                ".sizeof($exploitsArray)." EXPLOITS FOUNDED               \n", "light_red");
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_red");
      echo $this->colors->getColoredString("[*]                #######################################                     \n", "light_red");

    }

    function showLogExploitdb($xpldbArray)
    {
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_green");
      echo $this->colors->getColoredString("[*]                #######################################                     \n", "light_green");
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_green");
      echo $this->colors->getColoredString("[*]                EXPLOITDB RESULT                                            \n", "light_green");
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_green");
      echo $this->colors->getColoredString("[*]                ".sizeof($xpldbArray)." EXPLOITS FOUNDED                                   \n", "light_green");
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_green");
      echo $this->colors->getColoredString("[*]                #######################################                     \n", "light_green");
    }

    function showLogSploitus($sploitusArray)
    {
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_purple");
      echo $this->colors->getColoredString("[*]                #######################################                     \n", "light_purple");
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_purple");
      echo $this->colors->getColoredString("[*]                SPLOITUS RESULT                                             \n", "light_purple");
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_purple");
      echo $this->colors->getColoredString("[*]                 ".sizeof($sploitusArray)." EXPLOITS FOUNDED                   \n", "light_purple");
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_purple");
      echo $this->colors->getColoredString("[*]                #######################################                     \n", "light_purple");
    }

    function showLogShodCve($shodceves)
    {
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_blue");
      echo $this->colors->getColoredString("[*]                #######################################                     \n", "light_blue");
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_blue");
      echo $this->colors->getColoredString("[*]                CVE DATABASE RESULT                                            \n", "light_blue");
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_blue");
      echo $this->colors->getColoredString("[*]                ".sizeof($shodceves)." CVE's FOUNDED                                   \n", "light_blue");
      echo $this->colors->getColoredString("[*]                                                                            \n", "light_blue");
      echo $this->colors->getColoredString("[*]                #######################################                     \n", "light_blue");
    }

    function runHelp()
    {
      echo $this->colors->getColoredString("                                                                            \n", "white");
      echo $this->colors->getColoredString("                                     \n", "white");
      echo $this->colors->getColoredString("                                                                            \n", "white");
      echo $this->colors->getColoredString("                Use: 'php facepalm.php help' to show help message        \n", "white");
      echo $this->colors->getColoredString("                                                                            \n", "white");

    }
    function runDumpDb()
    {
      echo $this->colors->getColoredString("[*]                                                                            \n", "white");
      echo $this->colors->getColoredString("[*]                DUMP MERRYXPLOIT DATABASE. We need database password...        \n", "white");
      echo $this->colors->getColoredString("[*]                                                                            \n", "white");

    }


}

 ?>
