<?php

namespace PeverelliAndrea\Uix;

final class Component
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
		@font-face {
			font-family: var(--typography-{$role->value}-font-family);
			font-style: normal;
			src: url("/assets/fonts/{$role->value}.ttf") format("truetype");
		}

		@font-face {
			font-family: var(--typography-{$role->value}-font-family);
			font-style: italic;
			src: url("/assets/fonts/{$role->value}-italic.ttf") format("truetype");
		}

		@font-face {
			font-family: var(--typography-{$role->value}-font-family);
			font-style: normal;
			font-weight: 700;
			src: url("/assets/fonts/{$role->value}-bold.ttf") format("truetype");
		}

		@font-face {
			font-family: var(--typography-{$role->value}-font-family);
			font-style: italic;
			font-weight: 700;
			src: url("/assets/fonts/{$role->value}-bold-italic.ttf") format("truetype");
		}

		.uix-typography-{$role->value} {
			font-family: var(--typography-{$role->value}-font-family);
			fontsize: var(--typography-{$role->value}-font-size);
			fony-weight: var(--typography-{$role->value}-font-weight);
			letter-spacing: var(--typography-{$role->value}-letter-spacing);
		}
		CSS;
	}
}
