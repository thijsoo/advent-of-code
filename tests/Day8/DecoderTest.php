<?php

namespace Day8;

use Thijsvanderheijden\Adventofcode\Day8\Decoder;
use PHPUnit\Framework\TestCase;

class DecoderTest extends TestCase {
	/** @var Decoder */
	private $sut;

	protected function setUp(): void {
		parent::setUp();

		$this->sut = new Decoder( 'fbegcd cbd adcefb dageb afcb bc aefdc ecdab fgdeca fcdbega | efabcd cedba gadfec cb' );}


	public function testCreateWiringMatrix() {

		$shouldBe = [
			0 => "cagedb",
			1 => "ab",
			2 => "gcdfa",
			3 => "fbcad",
			4 => "eafb",
			5 => "cdfbe",
			6 => "cdfgeb",
			7 => "dab",
			8 => "acedgfb",
			9 => "cefabd"
		];
		$this->assertEquals( $shouldBe, $this->sut->createWiringMatrix() );
	}

	public function testDecodeAndCount() {
		$this->sut->createWiringMatrix();

		$this->assertEquals( 9361, $this->sut->decodeAndCount() );
	}

	public function testSolve() {
		$lines = [
			'be cfbegad cbdgef fgaecd cgeb fdcge agebfd fecdb fabcd edb | fdgacbe cefdb cefbgd gcbe',
			'edbfga begcd cbg gc gcadebf fbgde acbgfd abcde gfcbed gfec | fcgedb cgb dgebacf gc',
			'fgaebd cg bdaec gdafb agbcfd gdcbef bgcad gfac gcb cdgabef | cg cg fdcagb cbg',
			'fbegcd cbd adcefb dageb afcb bc aefdc ecdab fgdeca fcdbega | efabcd cedba gadfec cb',
			'aecbfdg fbg gf bafeg dbefa fcge gcbea fcaegb dgceab fcbdga | gecf egdcabf bgf bfgea',
			'fgeab ca afcebg bdacfeg cfaedg gcfdb baec bfadeg bafgc acf | gebdcfa ecba ca fadegcb',
			'dbcfg fgd bdegcaf fgec aegbdf ecdfab fbedc dacgb gdcebf gf | cefg dcbef fcge gbcadfe',
			'bdfegc cbegaf gecbf dfcage bdacg ed bedf ced adcbefg gebcd | ed bcgafe cdgba cbgef',
			'egadfb cdbfeg cegd fecab cgb gbdefca cg fgcdab egfdb bfceg | gbdfcae bgc cg cgb',
			'gcafb gcf dcaebfg ecagb gf abcdeg gaef cafbge fdbac fegbdc | fgae cfgab fg bagce',
		];
		$c     = 0;
		foreach ( $lines as $line ) {
			$decoder = new Decoder( $line );
			$decoder->createWiringMatrix();
			$c += $decoder->decodeAndCount();
		}

		$this->assertEquals(61229,$c);
	}
}
