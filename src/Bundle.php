<?php

namespace PeverelliAndrea\Uix;

final class Bundle
{
	public string $css;
	public array $html;

	final public function __construct(string $css = "", array $html = [])
	{
		$this->css = $css;
		$this->html = $html;
	}
}
