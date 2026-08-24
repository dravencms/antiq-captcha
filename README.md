# DravenCMS Antiq CAPTCHA

Self-hosted image CAPTCHA provider for `dravencms/captcha`. It generates CAPTCHA images with `gregwar/captcha`, stores the expected phrase in the Nette session, and does not call an external verification service.

## Installation

```bash
composer require dravencms/captcha dravencms/antiq-captcha
```

The DravenCMS package loader publishes the JavaScript asset to `%wwwDir%/assets/antiqCaptcha` and adds it to the frontend WebLoader bundle.

## Configuration

```neon
dravencms.antiqCaptcha:
    phraseLenght: 5

dravencms.captcha:
    provider: @dravencms.antiqCaptcha.provider
```

`phraseLenght` is the configuration key currently exposed by the extension. Its spelling is retained for compatibility.

## Usage

Add the field through the provider-independent form extension:

```php
$form->addCaptcha('captcha', 'Type the text from the image');
```

The control renders the generated image inline and compares a normalized response against the phrase stored in the user's session.

Because verification depends on the session, ensure session cookies work on every form page and avoid caching rendered CAPTCHA controls.

## License

This package is licensed under the LGPL-3.0 license.
