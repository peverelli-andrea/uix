<?php

namespace PeverelliAndrea\Uix\atoms\span;

use PeverelliAndrea\Uix\Component;
use PeverelliAndrea\Uix\Render;
use PeverelliAndrea\Uix\PaletteColor;
use PeverelliAndrea\Uix\TypographyRole;
use PeverelliAndrea\Uix\CssProperty;

final class Span extends Component
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
				self::getTypographyCss(role: $role),
				self::getColorCss(color: $color, css_property: CssProperty::COLOR),
			]
			html: <<<HTML
			<span class="uix-typography-{$role->value} uix-palette-{$color->value}-color">$content</span>
			HTML,
		);
	}
}
