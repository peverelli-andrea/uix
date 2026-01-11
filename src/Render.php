<?php

namespace PeverelliAndrea\Uix;

final class Render
{
	final public function __construct(
		/** @var null|string[] $css */
		public ?array $css = null,
		public ?string $html = null,
	) {}
}
