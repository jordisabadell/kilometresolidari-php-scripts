# Kilòmetre Solidari (PHP scripts)

**Scripts of Kilòmetre Solidari Project** :rocket:  
http://www.kilometresolidari.cat

Scripts of Kilòmetre Solidari web. Developed using Composer dependency manager.

## Available scripts 

### reCaptcha validation
Backend of recpatcha validation v3 used at www.kilometresolidari.cat web. It requires configuration of the following environment variables (validate-token.php file).

```
**${APIKERECATCHA_SECRET}**
```

### Twitter feed
Job to read a specific twitter hashtag. It requires configuration of the following environment variables (tf-script.php file).

```
${CONSUMER_KEY}
${CONSUMER_SECRET}
${ACCESS_TOKEN}
${ACCESS_TOKEN_SECRET}
```

To solve CORS domain problem add .htaccess file to /data directory.
```
Header add Access-Control-Allow-Origin "*"
Header add Access-Control-Allow-Headers "origin, x-requested-with, content-type"
Header add Access-Control-Allow-Methods "PUT, GET, POST, DELETE, OPTIONS"
```

## Tecnology
- PHP 

## APIs
- Twitter API (https://developer.twitter.com)

## Environment
- Composer (https://getcomposer.org)

---

## Local configuration

### Composer and PHP execute commands

Install dependencies.
```
composer install
```

Execute PHP script.
````
php {name-script.php}
```