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


## Public assets

Released packages include a generated `public/` directory. Packager 3 links it to
`www/assets/` on every Composer install/update; existing asset URLs stay the same.
Development sources, package metadata and tests are kept outside the public directory.

After editing assets, install Composer dependencies and run `composer build:assets`.
The explicit runtime file list is `assets/public-assets.json`; local CSS dependencies
are included automatically. Commit `public/` and `public-assets.manifest.json` with
the source changes. The builder rejects missing dependencies and locally modified
or unmanaged generated files. Admin's `npm run build:admin` also rebuilds public assets.
