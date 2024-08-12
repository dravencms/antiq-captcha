<?php declare(strict_types = 1);

namespace Dravencms\AntiqCaptcha;

use Nette\SmartObject;
use Dravencms\Captcha\ICaptchaProvider;
use Dravencms\Captcha\Forms\ICaptchaField;
use Dravencms\AntiqCaptcha\Forms\AntiqCaptchaField;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Nette\Forms\Controls\BaseControl;
use Nette\Http\Session;
use Nette\Http\SessionSection;


class AntiqCaptchaProvider implements ICaptchaProvider
{
    use SmartObject;


    /** @var callable[] */
	public array $onValidate = [];

	/** @var callable[] */
	public array $onValidateControl = [];

	/** @var SessionSection */
	private $sessionSection;

	private $phraseBuilder;

    public function __construct(int $phraseLenght, Session $session)
    {
		$this->sessionSection = $session->getSection('antiqCaptcha');
		$this->phraseBuilder = new PhraseBuilder($phraseLenght);
    }

    public function validate(string $response): bool
	{
		// Fire events!
		$this->onValidate($this, $response);
        return $this->phraseBuilder->niceize($this->sessionSection->get('code')) == $this->phraseBuilder->niceize($response);
	}

	public function validateControl(BaseControl $control): bool
	{
		// Fire events!
		$this->onValidateControl($this, $control);

		// Get response
		/** @var scalar $value */
		$value = $control->getValue();
		return $this->validate(strval($value));
	}

	public function buildCaptcha(): CaptchaBuilder {
		
		$captchaBuilder = new CaptchaBuilder(null, $this->phraseBuilder);
		$this->sessionSection->set('code', $captchaBuilder->getPhrase());
		$captchaBuilder->build();

		return $captchaBuilder;
	}

    public function prepareField(string $label, ?string $message = null): ICaptchaField {
		
        return new AntiqCaptchaField($this, $label, $message);
    }
}
