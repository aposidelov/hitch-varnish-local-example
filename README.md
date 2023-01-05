**HITCH / VARNISH / NGINX / PHP - MySQL** **example project via Docker**

1) Setup _my.varnish.test_ domain into _/etc/hosts_
2) Generate self-signed certificate for _my.varnish.test_ using _mkcert_ utility.

    `brew install mkcert`
    `cd devcerts`
    `mkcert -install`
   
3) Combine generated files into one .pem file and put it into ./devcerts/ folder.

    `cat cert.pem cert.key > combined-cert.pem`

4) `docker-compose up -d`

* https://my.varnish.test - HTTPS connection via Hitch
* http://my.varnish.test - HTTP Varnish connection
* http://my.varnish.test:81 - HTTP Nginx connection
