<?php

namespace Sampler;

final class Reservoir implements \Sampler {
	/**
	 * @var \Traversable
	 */
	private $iterator;

	/**
	 * @param \Traversable $iterator
	 */
	public function __construct(\Traversable $iterator) {
		$this->iterator = $iterator;
	}

	/**
	 * @see \Sampler::sample
	 */
	public function sample($length) {
		$res = [];
		$i = 0;

		foreach ($this->iterator as $item) {
			if ($i < $length) {
				$res[$i] = $item;
			} else {
				$key = (int) mt_rand(0, $i);
				if ($key < $length) {
					$res[$key] = $item;
				}
			}

			$i++;
		}

		return $res;
	}
}