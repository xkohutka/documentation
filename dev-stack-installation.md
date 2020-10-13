# Installation guide for the development stack

## Preparation
- Configure SSH keys for you VM to enable remote access
- Download and install Putty (on Windows) SSH client

### Updating the Ubuntu installation

Connect to your Ubuntu VM and update the system

- `sudo su`
- `apt update`
- `apt upgrade -y`
- `do-release-upgrade`
  - Keep local versions of configs
  - Remove old packages
  - Reboot

### Installing basic packages

We need to install some packages in order to be able to configure the development stack. A rundown of the packages is listed below:

- git: Commandline tool for git repository management
- *(Optional)* mc: Midnight commander - a visual interface for browsing through directory structures (with many useful features)
- wget: Commandline tool for downloading files
- docker: Service for Docker container deployment and management
- docker-compose: Commandline tool for working with Docker container stacks
- nginx: Web server and HTTP/HTTPS/WS/WSS proxy
- php-fpm: PHP file interpretter for integration with Nginx
- *(Optional)* postfix: SMTP mail server
- *(Optional)* dovecot-imapd: IMAP mail server
- *(Optional)* htop: Utility to monitor system resources
- zip & unzip: Utilities for file compression and decompression

`apt install git mc wget htop zip unzip docker docker-compose nginx php-fpm postfix dovecot-imapd`
  - Postifx configuration: Internet site

### Setup your data disk

Your VM should come with a separate data disk. This disk isn't formatted or mounted by default.

To find out if you have an additional disk run `lsblk`:
```
NAME    MAJ:MIN RM  SIZE RO TYPE MOUNTPOINT
loop0     7:0    0 55.3M  1 loop /snap/core18/1885
loop1     7:1    0 70.6M  1 loop /snap/lxd/16922
loop2     7:2    0 30.3M  1 loop /snap/snapd/9279
vda     252:0    0   10G  0 disk
├─vda1  252:1    0  9.9G  0 part /
├─vda14 252:14   0    4M  0 part
└─vda15 252:15   0  106M  0 part /boot/efi
vdb     252:16   0   75G  0 disk
```
From the output above you can clearly see, that the VM has two disks, one named `vda` and the other named `vdb`. The first disk contains your Ubuntu installation and the second one is not formatted.

To set-up the second disk we first need to create a new partition table `cfdisk /dev/vdb`:
- Select partition scheme as `GPT`
- Select the Empty space and press New partition button
- Create a primary partition with the maximum size
- As partition type select `Linux`
- Press quit and save changes

The partition is now set-up but we still need to format it: `mkfs.ext4 /dev/vdb1`.

To auto-mount the partition create a new directory in the root of your filesystem `mkdir /data` and open fstab `vim /etc/fstab`:
```
# Data disk
/dev/vdb1                       /data                   ext4    defaults        0       0
```
Save the file and now you can mount the new disk to your VM with `mount -a`.

### Setting up your webserver

- Create a SSL certificate with Let's Encrypt
- Create a new directory in /etc/nginx/ for SSL certificates: `mkdir /etc/nginx/certs`
- Copy certificate files into /etc/nginx/certs
- Create a new directory in /etc/nginx/ for custom configuration files: `mkdir /etc/nginx/conf`

#### Create configuration files for repetitive tasks

- `vim /etc/nginx/conf/default.conf`
  ```apacheconf
  index index.php index.html;

  location ~ /\.ht {
    deny all;
  }
  ```

- `vim /etc/nginx/conf/logging.conf`
  ```apacheconf
  access_log /data/logs/nginx_access.log main;
  error_log /data/logs/nginx_error.log warn;
  ```

- `vim /etc/nginx/conf/php.conf`
  ```apacheconf
  location ~ \.php$ {
    try_files $uri =404;
    fastcgi_split_path_info ^(.+?\.php)(/.*)$;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    fastcgi_param HTTPS on;
    #Avoid sending the security headers twice
    fastcgi_param modHeadersAvailable true;
    fastcgi_param front_controller_active true;
    fastcgi_pass unix:/var/run/php-fpm/php-fpm.sock;
    fastcgi_intercept_errors on;
    fastcgi_request_buffering off;
  }
  ```

- `vim /etc/nginx/conf/redirect_https.conf`
  ```apacheconf
  return 301 https://$host$request_uri;
  ```

- `vim /etc/nginx/conf/redirect_www.conf`
  ```apacheconf
  return 301 https://www.$host$request_uri;
  ```

- `vim /etc/nginx/conf/ssl_main.conf`
  ```apacheconf
  ssl_certificate /etc/nginx/certs/team01-20.studenti.fiit.stuba.sk.cer;
  ssl_certificate_key /etc/nginx/certs/team01-20.studenti.fiit.stuba.sk.key;
  ssl_stapling on;
  ```

- `vim /etc/nginx/conf/ssl_asicde.org.conf`
  ```apacheconf
  ssl_certificate /etc/nginx/certs/asicde.org.cer;
  ssl_certificate_key /etc/nginx/certs/asicde.org.key;
  ssl_stapling on;
  ```

#### Create your virtual host config

In order to server a web site to the user, you need to define a virtual host configuration that tells the NginX server how to handle incomming connections from your domain name.

Setup a main configuration file for the domain name:
- `mkdir /etc/nginx/sites-available/team01-20.studenti.fiit.stuba.sk`
- `vim /etc/nginx/sites-available/team01-20.studenti.fiit.stuba.sk.conf`
  ```apacheconf
  # Virtual Host: team01-20.studenti.fiit.stuba.sk

  # redirect to https
  server {
    listen 80;
    server_name team01-20.studenti.fiit.stuba.sk;

    include /etc/nginx/conf/redirect_https.conf;
    include /etc/nginx/conf/logging.conf;
  }

  include /etc/nginx/sites-available/team01-20.studenti.fiit.stuba.sk/*.conf;
  ```

Then create configuration files for any subdomains:
- `vim /etc/nginx/sites-available/team01-20.studenti.fiit.stuba.sk/www.conf`
  ```apacheconf
  # Subdomain: www

  server {
    listen 443 ssl http2;
    server_name team01-20.studenti.fiit.stuba.sk;

    # where files are located for this subdomain
    root /data/www/team01-20.studenti.fiit.stuba.sk/www/;

    include /etc/nginx/conf/default.conf;
    include /etc/nginx/conf/ssl_main.conf;
    include /etc/nginx/conf/php.conf;
    include /etc/nginx/conf/logging.conf;
  }
  ```

For additional domains create a new main config:
- `mkdir /etc/nginx/sites-available/asicde.org`
- `vim /etc/nginx/sites-available/asicde.org.conf`
  ```apacheconf
  # Virtual Host: asicde.org

  # redirect to www
  server {
    listen 80;
    server_name asicde.org;

    include /etc/nginx/conf/redirect_www.conf;
    include /etc/nginx/conf/logging.conf;
  }
  server {
    listen 443 ssl http2;
    server_name asicde.org;

    include /etc/nginx/conf/ssl_asicde.org.conf;
    include /etc/nginx/conf/redirect_www.conf;
    include /etc/nginx/conf/logging.conf;
  }

  # redirect to https
  server {
    listen 80;
    server_name *.asicde.org;

    include /etc/nginx/conf/redirect_https.conf;
    include /etc/nginx/conf/logging.conf;
  }

  include /etc/nginx/sites-available/asicde.org/*.conf;
  ```

An example of a Proxy subdomain configuration:
- `vim /etc/nginx/sites-available/asicde.org/proxy.dockerhub.conf`
  ```apacheconf
  # Subdomain: hub

  server {
    listen 443 ssl http2;

    server_name hub.asicde.org;

    chunked_transfer_encoding on;

    # a default website
    location / {
      root /data/www/default/;
    }

    location /v2/ {
      proxy_pass http://localhost:8082/v2/;
      add_header 'Docker-Distribution-Api-Version' 'registry/2.0' always;
      proxy_set_header Host $host;
      proxy_set_header X-Real-IP $remote_addr;
      proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
      proxy_set_header X-Forwarded-Proto 'https';
    }

    include /etc/nginx/conf/ssl_asicde.org.conf;
    include /etc/nginx/conf/logging.conf;

  }
  ```

**To enable a domain name, you need to link the configuration to enabled sites and reload NginX:**
- `ln -s /etc/nginx/sites-available/team01-20.studenti.fiit.stuba.sk.conf /etc/nginx/sites-enabled/team01-20.studenti.fiit.stuba.sk.conf`
- `ln -s /etc/nginx/sites-available/asicde.org.conf /etc/nginx/sites-enabled/asicde.org.conf`
- `systemctl reload nginx`
- *Note: Subdomains are included automatically*

