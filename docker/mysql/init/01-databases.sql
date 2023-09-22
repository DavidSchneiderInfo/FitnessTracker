# create databases
CREATE DATABASE IF NOT EXISTS `appbuild`;
CREATE DATABASE IF NOT EXISTS `apptest`;

# create root user and grant rights
CREATE USER IF NOT EXISTS 'appbuild'@'%' IDENTIFIED BY 'local';
CREATE USER IF NOT EXISTS 'apptest'@'%' IDENTIFIED BY 'local';

# grant priv
GRANT ALL PRIVILEGES ON `appbuild.*` TO 'appbuild'@'%';
GRANT ALL PRIVILEGES ON apptest.* TO 'apptest'@'%';

#flush
flush privileges;
