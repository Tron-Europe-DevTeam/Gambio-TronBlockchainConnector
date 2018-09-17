<h1 align="center">
  <br>
  <img width="40%" src="https://raw.githubusercontent.com/Tron-Europe-DevTeam/Gambio-TronBlockchainConnector/master/src/tron-europe01.png">
  </br>
</h1>

<p align="center">
  Tron-Europe Dev Team • <a href="https://Tron-Europe.org">Tron-Europe.org</a> • Join the Project 
</p>


## Introduction
Gambio is one of the largest and most used webshops in Germany and parts of Europe. It's an open-source all-in-one e-commerce solution and provides many modules and enhancements. We as tron Europe have decided to integrate the TRON Blockchain technology into the Gambio system. More informations about the Gambio e-commerce system can be found at <a href="https://www.gambio.com/">gambio.com</a>

## Features 
- TRON Blockchain Integration
- Automatic Order Assignment
- TRX and all TRX20 Token support
- TRX and TRX20 Blockchain Payment
- individual setting system
- search and operating functions

## Requirements
- 120 MB Webspace
- Mysql5 Database 
- PHP 5.5 or higher
- Gambio SW Version 3.10.x
- GDlib 2 or higher

## Installation
1. Copy the folder into the Gambio Main Directory
2. Create the following tables 
```
CREATE TABLE trx_transaction(
    pkid BIGINT NOT NULL AUTO_INCREMENT,
    transactionHash varchar(255),
    block varchar(100),
    timestamp varchar(100),
    transferFromAddress varchar(100),
    transferToAddress varchar(100),
    amount varchar(100),
    tokenName varchar(100),
    data varchar(100),
    orderassignment varchar(100),
	orderid varchar(100),
    PRIMARY KEY (pkid)
); 

CREATE TABLE trx_order(
    pkid BIGINT NOT NULL AUTO_INCREMENT,
    orderid varchar(100),
    orderprice varchar(100),
    currency varchar(100),
    orderstatus varchar(100),	
	PRIMARY KEY (pkid)
); 

CREATE TABLE trx_systemsetup(
    pkid BIGINT NOT NULL AUTO_INCREMENT,
    parameter varchar(100),
    value varchar(255),
    PRIMARY KEY (pkid)
); 

```
3. set default values
```
INSERT INTO trx_systemsetup (parameter,value) VALUES ('shopaddress','');
INSERT INTO trx_systemsetup (parameter,value) VALUES ('autosync','');
INSERT INTO trx_systemsetup (parameter,value) VALUES ('synctime','');
INSERT INTO trx_systemsetup (parameter,value) VALUES ('ordersync','');
INSERT INTO trx_systemsetup (parameter,value) VALUES ('walletuserassociation','');
INSERT INTO trx_systemsetup (parameter,value) VALUES ('syncdatacount','');
INSERT INTO trx_systemsetup (parameter,value) VALUES ('tblonlytransnote','');
```
4. create a user user and assign rights
```
<USERNAME> => DB Username
<PASSWORD> => DB Password
<GAMBIODATABASE> => Name of the Gambio Database

CREATE USER '<USERNAME>'@'localhost' IDENTIFIED BY '<PASSWORD>';
GRANT ALL PRIVILEGES ON <GAMBIODATABASE>.orders TO '<USERNAME>'@'localhost';
GRANT ALL PRIVILEGES ON <GAMBIODATABASE>.orders_status_history TO '<USERNAME>'@'localhost';
GRANT ALL PRIVILEGES ON <GAMBIODATABASE>.customers_memo TO '<USERNAME>'@'localhost';
GRANT ALL PRIVILEGES ON <GAMBIODATABASE>.currencies TO '<USERNAME>'@'localhost';
GRANT ALL PRIVILEGES ON <GAMBIODATABASE>.orders_products TO '<USERNAME>'@'localhost';
GRANT ALL PRIVILEGES ON <GAMBIODATABASE>.trx_transaction TO '<USERNAME>'@'localhost';
GRANT ALL PRIVILEGES ON <GAMBIODATABASE>.trx_order TO '<USERNAME>'@'localhost';
GRANT ALL PRIVILEGES ON <GAMBIODATABASE>.trx_systemsetup TO '<USERNAME>'@'localhost';

FLUSH PRIVILEGES;
```

5. change the connection settings -> tron-extension/php/inc/global_settings.php
```
// sql parameter
$server = "127.0.0.1";  => SQL Server
$username = "";         => DB Username
$password = "";         => DB Password
$dbname[0] = "";        => Name of the Gambio Database
```

## Roadmap 
Release Date (full tested Version) : 30.09.2018
  - advanced search menus
  - multi-language support
  - split transfer support
  - automatic installation script

## LiveDemo
  <img width="80%" src="https://raw.githubusercontent.com/Tron-Europe-DevTeam/Gambio-TronBlockchainConnector/master/src/gambio01.png">
  <img width="80%" src="https://raw.githubusercontent.com/Tron-Europe-DevTeam/Gambio-TronBlockchainConnector/master/src/gambio02.png">
