<?php
namespace Iterator;

final class Stream implements \IteratorAggregate {
	/**
	 * @var string
	 */
	private $entryPoint;

	/**
	 * @param string $entryPoint
	 */
	public function __construct($entryPoint) {
		$this->entryPoint = $entryPoint;
	}

	/**
	 * @see \IteratorAggregate::getIterator
	 */
	public function getIterator() {
		$stream = fopen($this->entryPoint, 'r');
		if (!$stream) {
			throw new \Exception();
		}

		while (!feof($stream)) {
			$line = fgetc($stream);
			if (false !== $line) {
				yield $line;
			}
		}

		fclose($stream);
	}
}
