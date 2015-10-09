<?php
namespace Cli;

final class RunnerFactory {
	/**
	 * @param  string  $algorithm
	 * @param  string  $input
	 * @param  int $random
	 * @return \Cli\Runner
	 */
	public function create($algorithm, $input, $random = 0) {
		$samplerBuilder = new SamplerBuilder(
			$algorithm,
			$input
		);

		$sampler = $samplerBuilder
			->setRandom($random)
			->build()
		;

		return new Runner($sampler);
	}
}