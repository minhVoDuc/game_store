# Game Store
Full source code of web app using for assignment of Cybersecurity - A simple game store, including front-end, back-end and mysql database. 

## Prerequisite
* Having installed virtualbox and 2 VMs (one of them are CentOS 7)
* 2 VMs could ping each other

## Hosting web using apache 
1. Install apache server
```
sudo yum install httpd
```
2. Get web release (current: v1.0.0)
```
wget https://github.com/minhVoDuc/game_store/archive/refs/tags/v1.0.0.tar.gz
```
> If wget hasn't been install yet
```
sudo yum update
sudo yum install wget -y
```
3. Extract file and rename it to `game_store`
```
tar -xvf file.tar.gz; mv game_store-1.0.0 game_store
```
4. Copy source code to hosting directory (/var/www/)
```
sudo cp -r game_store /var/www
```
5. Change ownership and permission of the directory
```
sudo chown -R apache:apache /var/www/game_store
sudo chmod -R 755 /var/www/game_store
```
6. Create a virtual host file for your web site
```
sudo nano /etc/httpd/conf.d/game_store.conf
```
7. Add those following configs to file created above
```
<VirtualHost *:80>
   ServerName game_store.local
   DocumentRoot /var/www/game_store
   
   <Directory /var/www/game_store>
      Options Indexes FollowSymLinks MultiViews
      AllowOverride All
      Require all granted
   </Directory>
   
   ErrorLog /var/log/httpd/game_store_error.log
   CustomLog /var/log/httpd/game_store_access.log combined
</VirtualHost>
```
8. Restart Apache
```
sudo systemctl restart httpd
```
9. Test hosting directly on CentOS
```
curl localhost
```
10. Open the other VM and test web hosted on CentOS by typing CentOS ip address that this VM could ping to
> Note: using *http* instead of *https* 