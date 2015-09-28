<?php

namespace Sampler;

final class Sequence implements \Sampler {
	/**
	 * @var array
	 */
	private $values;

	public function __construct(array $values) {
		$this->values = $values;
	}

	/**
	 * @see \Sampler::sample
	 */
	public function sample($length) {
		$amountOfValues = count($this->values);
		$size = ($length > $amountOfValues) ? $amountOfValues : $length;
		$keys = [];
		$res = [];

		for ($i = 0; $i < $size; $i++) {
			$keys[$i] = $i;
			$res[$i] = $this->values[$i];
		}

		//randomize
		for ($i = 0; $i < $size; $i++) {
			$key = (int) mt_rand(0, ($amountOfValues - 1));
			if (!in_array($key, $keys)) {
				$keys[$i] = $key;
				$res[$i] = $this->values[$key];
			}
		}

		return $res;
	}

}