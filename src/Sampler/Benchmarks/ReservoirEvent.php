<?php
namespace Sampler\Benchmarks;

use \Athletic\AthleticEvent;

/**
 * @codeCoverageIgnore
 */
final class ReservoirEvent extends AthleticEvent {
	/**
	 * @var \Cli\RunnerFactory
	 */
	private $runnerFactory;
	/**
	 * @var int
	 */
	private $stringLength = 100000;

	public function classSetUp() {
		echo sprintf('Starting benchmark for %s, string length is: %d.%s',
			__CLASS__,
			$this->stringLength,
			PHP_EOL
		);
		ini_set('memory_limit', '4G');
		$this->runnerFactory = new \Cli\RunnerFactory();
	}

	/**
	 * @iterations 1000
	 */
	public function benchReservoir10k() {
		$k = 10;
		$runner = $this->runnerFactory->create(
			\Cli\SamplerBuilder::ALGO_RES,
			\Util\Random::generateStringBy($this->stringLength)
		);
		$runner->run($k);

	}

	/**
	 * @iterations 1000
	 */
	public function benchReservoir100k() {
		$k = 100;
		$runner = $this->runnerFactory->create(
			\Cli\SamplerBuilder::ALGO_RES,
			\Util\Random::generateStringBy($this->stringLength)
		);
		$runner->run($k);
	}

	/**
	 * @iterations 1000
	 */
	public function benchReservoir1000k() {
		$k = 1000;
		$runner = $this->runnerFactory->create(
			\Cli\SamplerBuilder::ALGO_RES,
			\Util\Random::generateStringBy($this->stringLength)
		);
		$runner->run($k);
	}

	/**
	 * @iterations 500
	 */
	public function benchReservoir10000k() {
		$k = 10000;
		$runner = $this->runnerFactory->create(
			\Cli\SamplerBuilder::ALGO_RES,
			\Util\Random::generateStringBy($this->stringLength)
		);
		$runner->run($k);
	}

	/**
	 * @iterations 10
	 */
	public function benchReservoir100000k() {
		$k = 100000;
		$runner = $this->runnerFactory->create(
			\Cli\SamplerBuilder::ALGO_RES,
			\Util\Random::generateStringBy($this->stringLength)
		);
		$runner->run($k);
	}

}
