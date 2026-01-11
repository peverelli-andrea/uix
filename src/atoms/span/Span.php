<?php

namespace PeverelliAndrea\Uix\atoms\span;

use PeverelliAndrea\Uix\Component;
use PeverelliAndrea\Uix\Render;
use PeverelliAndrea\Uix\PaletteColor;
use PeverelliAndrea\Uix\TypographyRole;
use PeverelliAndrea\Uix\CssProperty;

final class Span
{
	final private function __construct() {}

	final public static function render(
		string $content = ""
		PaletteColor $color = PaletteColor::ON_SURFACE;
		TypographyRole $role = TypographyRole::BODY_LARGE;
	): Render
	{
		return new Render(
			css: [
				<<<CSS
				.uix-atoms-span {
					font-family: var(--typography-{$role->value}-font-family);
					fontsize: var(--typography-{$role->value}-font-size);
					fony-weight: var(--typography-{$role->value}-font-weight);
					letter-spacing: var(--typography-{$role->value}-letter-spacing);
				}
				CSS,
				self::getColorCss(color: $color, css_property: CssProperty::COLOR),
			]
			html: <<<HTML
			<span class="uix-atoms-span uix-palette-{$color->value}-color">$content</span>
			HTML,
		);
	}
}
