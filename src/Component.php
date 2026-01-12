<?php

namespace PeverelliAndrea\Uix;

abstract class Component
{
	final private function __construct() {}

	final protected static function getColorCss(PaletteColor $color, CssProperty $css_property): string
	{
		return <<<CSS
		.uix-palette-{$color->value}-{$css_property->value} {
			{$css_property->value}: var(--palette-light-default-{$color->value});

			@media (prefers-contrast: less) {
				{$css_property->value}: var(--palette-light-less-{$color->value});
			}

			@media (prefers-contrast: more) {
				{$css_property->value}: var(--palette-light-more-{$color->value});
			}
			
			@media (color-scheme: dark) {
				{$css_property->value}: var(--palette-dark-default-{$color->value});
			}

			@media (color-scheme: dark) and (prefers-contrast: less) {
				{$css_property->value}: var(--palette-dark-less-{$color->value});
			}

			@media (color-scheme: dark) and (prefers-contrast: more) {
				{$css_property->value}: var(--palette-dark-more-{$color->value});
			}
		}
		CSS;
	}

	final protected static function getTypographyCss(TypographyRole $role): string
	{
		return <<<CSS
		.uix-typography-{$role->value} {
			font-family: "{$role->value}";
			font-size: var(--typography-{$role->value}-font-size);
			font-weight: var(--typography-{$role->value}-font-weight);
			line-height: var(--typography-{$role->value}-line-height);
			letter-spacing: var(--typography-{$role->value}-letter-spacing);
		}
		CSS;
	}
}
