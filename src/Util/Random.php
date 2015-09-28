<?php

namespace Util;

final class Random {
	/**
	 * @param  int $length
	 * @return string
	 */
	public static function generateStringBy($length) {
		return bin2hex(openssl_random_pseudo_bytes($length));
	}
}