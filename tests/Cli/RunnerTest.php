<?php

use Vfs\FileSystem;
use Vfs\Node\Directory;
use Vfs\Node\File;
use \Cli\RunnerFactory;
use \Cli\SamplerBuilder;

class RunnerTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @var \Cli\RunnerFactory
	 */
	private $runnerFactory;

	public function setUp() {
		$this->runnerFactory = new RunnerFactory();
	}

	/**
	 * @dataProvider providerRun
	 */
	public function testRun(
		$algorithm,
		$input,
		$length,
		$random,
		$expectedLength
	) {
		$runner = $this->runnerFactory->create(
			$algorithm,
			$input,
			$random
		);
		$result = $runner->run($length);
		$this->assertEquals($expectedLength, strlen($result));
	}

	public function providerRun() {
		return [
			[
				SamplerBuilder::ALGO_SEQ,
				"THEQUICKBROWNFOXJUMPSOVERTHELAZYDOG",
				5,
				0,
				5,
			], [
				SamplerBuilder::ALGO_RES,
				"THEQUICKBROWNFOXJUMPSOVERTHELAZYDOG",
				5,
				0,
				5,
			], [
				SamplerBuilder::ALGO_RES,
				"",
				5,
				10, //random
				5,
			], [
				SamplerBuilder::ALGO_SEQ,
				"THEQUICK",
				8,
				0,
				8,
			], [
				SamplerBuilder::ALGO_RES,
				"THEQUICK",
				8,
				0,
				8,
			], [
				SamplerBuilder::ALGO_SEQ,
				"THEQUICK",
				10,
				0,
				8,
			], [
				SamplerBuilder::ALGO_RES,
				"THEQUICK",
				10,
				0,
				8,
			],
		];
	}

	public function testRunWithUrl() {
		$data = implode(PHP_EOL, str_split("THEQUICKBROWNFOXJUMPSOVERTHELAZYDOG"));
		$fs = FileSystem::factory('vfs://');
		$fs->mount();

		$stream = new Directory(['input' => new File($data)]);
		$fs->get('/')->add('stream.url', $stream);

		$url = "vfs://stream.url/input";
		$runner = $this->runnerFactory->create(
			SamplerBuilder::ALGO_RES,
			$url
		);

		$result = str_replace("\n", "", $runner->run(10));
		$this->assertCount(10, str_split($result));
		$fs->unmount();
	}

}