# DravenCMS AntiqCaptcha package

This is a Draven CMS hcaptcha package implementing dravencms/captcha-impl using gregwar/captcha

## Instalation

The best way to install dravencms/anitq-captcha is using  [Composer](http://getcomposer.org/):


```sh
$ composer require dravencms/anitq-captcha
```

After installation add this code to your `app/config/settings.neon`

```neon
dravencms.antiqCaptcha:
	phraseLenght: 5 # Length of captcha to solve
```
