vcl 4.1;

backend default {
  .host = "nginx_server";
  .port = "80";
}

sub vcl_recv {
  if (req.method == "PURGE") {
    if (!client.ip ~ purge) {
      return (synth(405, client.ip + " is not allowed to send PURGE requests."));
    }
    return (purge);
  }
  if (req.method != "GET" && req.method != "HEAD") {
    return (pass);
  }

 if ( ( req.url ~ "/node/.+/edit") ||
   ( req.url ~ "/node/add") ||
   ( req.url ~ "/admin") ||
   ( req.url ~ "/user")) {
    return (pass);
  }

  unset req.http.Cookie;
  unset req.http.x-cache;
}

sub vcl_deliver {

  #if ( ( req.url ~ "/index\.php") ) {
  #  set resp.http.X-Test-reg = "Hello456";
  #}

  if (obj.hits > 0) { # Add debug header to see if it's a HIT/MISS and the number of hits, disable when not needed
    set resp.http.X-Cache = "HIT";
  } else {
    set resp.http.X-Cache = "MISS";
  }
  set resp.http.X-Test = "Hello5";
}

acl purge {
  "localhost";
  "127.0.0.1";
  "::1";
  "nginx_server_php";
}
