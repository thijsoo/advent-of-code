<?php

namespace Day10;

use Thijsvanderheijden\Adventofcode\Day10\SyntaxChecker;
use PHPUnit\Framework\TestCase;

class SyntaxCheckerTest extends TestCase {

	private $sut;
	protected function setUp(): void {
		parent::setUp();

		$lines = ['[({(<(())[]>[[{[]{<()<>>',
					'[(()[<>])]({[<{<<[]>>(',
					'{([(<{}[<>[]}>{[]{[(<()>',
					'(((({<>}<{<{<>}{[]{[]{}',
					'[[<[([]))<([[{}[[()]]]',
					'[{[{({}]{}}([{[{{{}}([]',
					'{<[[]]>}<{[{[{[]{()[[[]',
					'[<(<(<(<{}))><([]([]()',
					'<{([([[(<>()){}]>(<<{{',
					'<{([{{}}[<[[[<>{}]]]>[]]'];
		$this->sut = new SyntaxChecker($lines);
	}


	public function testGetSyntaxScore(  ) {
		$this->assertEquals(26397,$this->sut->getSyntaxScore());
	}

	public function testGetAllValidLines(  ) {

		$expected = ['[({(<(())[]>[[{[]{<()<>>',
					'[(()[<>])]({[<{<<[]>>(',
					'(((({<>}<{<{<>}{[]{[]{}',
					'{<[[]]>}<{[{[{[]{()[[[]',
					'<{([{{}}[<[[[<>{}]]]>[]]'];
		$this->assertEquals($expected,$this->sut->getAllValidLines());
	}

	public function testGetCompletedScore(  ) {
		$this->assertEquals(288957,$this->sut->getCompletedScore());
	}

}
