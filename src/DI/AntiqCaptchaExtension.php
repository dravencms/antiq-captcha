<?php declare(strict_types = 1);

namespace Dravencms\AntiqCaptcha\DI;

use Dravencms\AntiqCaptcha\AntiqCaptchaProvider;
use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Schema;

final class AntiqCaptchaExtension extends CompilerExtension
{

	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'phraseLenght' => Expect::int()->required()->dynamic(),
		]);
	}

	/**
	 * Register services
	 */
	public function loadConfiguration(): void
	{
		$config = (array) $this->getConfig();
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('provider'))
			->setFactory(AntiqCaptchaProvider::class, [$config['phraseLenght']]);
	}
}
