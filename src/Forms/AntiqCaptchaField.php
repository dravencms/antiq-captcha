<?php declare(strict_types = 1);

namespace Dravencms\AntiqCaptcha\Forms;

use Dravencms\Captcha\Forms\ICaptchaField;
use Dravencms\AntiqCaptcha\AntiqCaptchaProvider;
use Nette\Forms\Controls\TextInput;
use Nette\Forms\Rules;
use Nette\Utils\Html;

class AntiqCaptchaField extends TextInput implements ICaptchaField
{
    private AntiqCaptchaProvider $provider;

	private bool $configured = false;

	private ?string $message = null;

	public function __construct(AntiqCaptchaProvider $provider, ?string $label = null, ?string $message = null)
	{
		parent::__construct($label);

		$this->provider = $provider;

		$this->setOmitted(true);

		$this->control->addClass('antiq-captcha');

		$this->message = $message;
	}

	public function setMessage(string $message): self
	{
		$this->message = $message;

		return $this;
	}

	public function validate(): void
	{
		$this->configureValidation();

		parent::validate();
	}

	public function getRules(): Rules
	{
		$this->configureValidation();

		return parent::getRules();
	}

	public function verify(): bool
	{
		return $this->provider->validateControl($this) === true;
	}

	public function getControl(): Html
	{
		$this->configureValidation();

		$el = parent::getControl();
		$el->addAttributes([
			'id' => $this->getHtmlId(),
			'name' => $this->getHtmlName(),
			'data-captcha' => $this->provider->buildCaptcha()->inline()
		]);

		return $el;
	}

	private function configureValidation(): void
	{
		if ($this->configured) {
			return;
		}

		$this->configured = true;
		$message = $this->message ?? 'Are you a bot?';
		$this->addRule(fn ($code): bool => $this->verify() === true, $message);
	}
}
