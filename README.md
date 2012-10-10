FastBackup
==========

Introduction

Fast backups is the web application created using cakephp framework to take backup of filesystem and database periodically on linux based server.

Installation

1. Download code and fastbackups.sql https://nodeload.github.com/maxbohr/FastBackup/zipball/master
2. Upload fastbackup.sql add user for database
3. Change Config/database.php accordingly.
4. Create one more database user with select and lock table previllages.
Ex.CREATE USER 'backupMgr'@'localhost' IDENTIFIED BY  'password';
GRANT SELECT , 
LOCK TABLES ON * . * 
TO  'backupMgr'@'localhost'
IDENTIFIED BY  'password';

5. Create target path Ex. /var/autobackup give read/write previllages to Web server process owner (eg: www-data for Apache) on that folder.
 
Configuration

1. After installation go to application eg. localhost/fastbackups login by default username: admin Password: admin.
2. Go to settings edit globle variables such as target path, backup database user backup database user password and backup key accordingly. 

Using Fast Backups

There are two ways to take backup. 1. periodically 2. current
To take backup periodically you can log in and click on “Run Complete Backup” 
To take current backup go to view by clicking on Name of project and click on “Create Backup”  (blue button on right hand side).

Setting up Cron

To setup automatic backups, use daily execution of below URL:
  wget 'http://localhost/fastbackups/backups/run/<backup_key>'

Where <key> is as per set up in configuration above.