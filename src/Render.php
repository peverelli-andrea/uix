<?php

namespace PeverelliAndrea\Uix;

final class Render
{
	final public function __construct(
		public ?string $css = null,
		public ?string $html = null,
	) {}
}
