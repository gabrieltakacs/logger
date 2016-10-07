<?php
/**
 * Created by Gabriel Takács, gabriel.takacs@ui42.sk
 */

namespace Gabrieltakacs\Logger;

use Symfony\Component\Console\Output\OutputInterface;

interface LoggerInterface
{
    const OUTPUT_COLOR_DEFAULT = '';

    const OUTPUT_COLOR_GREEN = 'info';

    const OUTPUT_COLOR_YELLOW = 'comment';

    const OUTPUT_COLOR_CYAN = 'question';

    const OUTPUT_COLOR_RED = 'error';

    public function log($message, $tag = LoggerInterface::OUTPUT_COLOR_DEFAULT, $verbosity = OutputInterface::VERBOSITY_NORMAL);
}
