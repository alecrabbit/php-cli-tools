<?php declare(strict_types=1);

namespace AlecRabbit;

// @codeCoverageIgnoreStart
define(__NAMESPACE__ . '\\' . 'ESC', "\033");
define(__NAMESPACE__ . '\\' . 'CSI', ESC . '[');

// define(__NAMESPACE__ . '\\' . 'TRUECOLOR_TERMINAL', 65535); // for future versions
define(__NAMESPACE__ . '\\' . 'COLOR256_TERMINAL', 255);
define(__NAMESPACE__ . '\\' . 'COLOR_TERMINAL', 16);
define(__NAMESPACE__ . '\\' . 'NO_COLOR_TERMINAL', 0);

define(
    __NAMESPACE__ . '\\' . 'ALLOWED_COLOR_TERMINAL',
    [
        COLOR256_TERMINAL,
        COLOR_TERMINAL,
        NO_COLOR_TERMINAL,
    ]
);

define(
    __NAMESPACE__ . '\\' . 'TERMINAL_COLOR_MODES',
    [
        COLOR256_TERMINAL => '256 COLOR',
        COLOR_TERMINAL => '16 COLOR',
        NO_COLOR_TERMINAL => 'NO COLOR',
    ]
);
