<?php
namespace Cli;

final class Runner {
	/**
	 * @var \Sampler
	 */
	private $sampler;

	/**
	 * @param \Sampler $sampler
	 */
	public function __construct(\Sampler $sampler) {
		$this->sampler = $sampler;
	}

	/**
	 * @param  int $length
	 * @return string
	 */
	public function run($length) {
		$sample = $this->sampler->sample($length);
		return implode('', $sample);
	}
}