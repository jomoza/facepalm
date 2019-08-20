# FACEPALM

```
OSINT Tool to information gathering and exploit searching in multiples public databases.
You have install the database and the dependences, or run steup.sh. 
In databases folder you have a backup of the db esctructure.
Is recomended use it in KaliLinux o other security linux distribution.

```

###### For information gathering, you can choose two optioins:
- shodan
- nmap 

###### The vulns searching use diferent exploit database API:
- shodan exploits
- exploit-db (searchsploit and csv reading)
- sploitus
- cve database

## MANUAL INSTALATION

Update your system:
``` sudo apt update && sudo apt upgrade ```

Install mysql server in your computer:
``` sudo apt install mysql-server``` and run ``` sudo /usr/bin/mysql_secure_installation``` 


And install php, and some modules: 
``` sudo apt install php php-mysql php-mcrypt php-mbstring php-zip```

Install searchsploit, if you run it in kali linux skip this options.

If you use Kali Linux repos, you can use ``` apt update && apt -y install exploitdb ```

If not, you have to install it from the git:

``` git clone https://github.com/offensive-security/exploitdb /opt/```

``` ln /opt/exploitdb/searchsploit /bin/searchsploit```

Edit the file ```inc/config.php```

you need to add two API KEYs for facepalm config. 

The shodan api key and the https://ipinfo.io/ token.

Let's config the database. You have to create a databases, the name by default for thisis facepalm, but you can use otherone if you change the config file too.

``` mysql -e "CREATE DATABASE facepalm /*\!40100 DEFAULT CHARACTER SET utf8 */;" ```

Next, create a user for this database, and give it privileges, is not recomended use root user.

	  mysql -e "CREATE USER facepalm@localhost IDENTIFIED BY '1234567';"

``` mysql -e "GRANT ALL PRIVILEGES ON facepalm.* TO facepalm@localhost IDENTIFIED BY '1234567'" ```

In the ```inc/config.php``` file you can add you db name and credential for the tool.

## HOW TO USE

run: ``` php facepalm.php help ```
