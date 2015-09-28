<?php

namespace Cli;

use \Sampler\Reservoir;
use \Sampler\Sequence;

final class SamplerBuilder {
	/**
	 * @var string
	 */
	private $input;
	/**
	 * @var int
	 */
	private $random;

	const ALGO_SEQ = "seq";
	const ALGO_RES = "res";

	public function __construct($algorithm, $input) {
		$this->algorithm = $algorithm;
		$this->input = $input;
	}

	/**
	 * @param int $random
	 * @return SamplerBuilder
	 */
	public function setRandom($random) {
		$this->random = $random;
		return $this;
	}

	/**
	 * @return \Sampler
	 */
	public function build() {
		if ($this->random > 0) {
			$input = \Util\Random::generateStringBy($this->random);
			$iterator = new \ArrayIterator(str_split($input));
		} else {
			if (filter_var($this->input, FILTER_VALIDATE_URL) === false) {
				if (empty($this->input)) {
					$iterator = new \Iterator\Stream('php://stdin');
				} else {
					$iterator = new \ArrayIterator(str_split($this->input));
				}
			} else {
				$iterator = new \Iterator\Stream($this->input);
			}
		}

		if (self::ALGO_SEQ == $this->algorithm) {
			return new Sequence(iterator_to_array($iterator));
		}

		return new Reservoir($iterator);
	}

}