<?php declare(strict_types = 1);

namespace Dravencms\AntiqCaptcha;

use Nette\SmartObject;
use Dravencms\Captcha\ICaptchaProvider;
use Dravencms\Captcha\Forms\ICaptchaField;
use Dravencms\AntiqCaptcha\Forms\AntiqCaptchaField;

use Nette\Forms\Controls\BaseControl;

class AntiqCaptchaProvider implements ICaptchaProvider
{
    use SmartObject;


    /** @var callable[] */
	public array $onValidate = [];

	/** @var callable[] */
	public array $onValidateControl = [];

	private string $phraseLenght;

    const FORM_PARAMETER = 'h-captcha-response';

    public function __construct(int $phraseLenght)
    {
        $this->phraseLenght = $phraseLenght;
    }
/*
    public function validate(string $response): ?Response
	{
		// Fire events!
		$this->onValidate($this, $response);

        return $this->verify($response);
	}
*/
	public function validateControl(BaseControl $control): bool
	{
		// Fire events!
		$this->onValidateControl($this, $control);

		// Get response
		/** @var scalar $value */
		$value = $control->getValue();
		return false;
		$response = $this->validate(strval($value));


		return $response->isSuccess();
	}

    public function prepareField(string $label, ?string $message = null): ICaptchaField {
        return new AntiqCaptchaField($this, $label, $message);
    }
}
