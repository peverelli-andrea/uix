<?php

namespace PeverelliAndrea\Uix\atoms\icon;

enum IconVariant: string
{
	case PLAY_CIRCLE = "play-circle";
	case SHOPPING_BAG = "shopping-bag";

	final public function getWeights(): string
	{
		return match($this) {
			self::PLAY_CIRCLE => "400",
			self::SHOPPING_BAG => "100 700",
		};
	}
}
