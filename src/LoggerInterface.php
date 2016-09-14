<?php
/**
 * Created by Gabriel Takács, gabriel.takacs@ui42.sk
 */

namespace Gabrieltakacs\Logger;

use Symfony\Component\Console\Output\OutputInterface;

interface LoggerInterface
{
    public function log($message, $tag, $verbosity = OutputInterface::VERBOSITY_NORMAL);
}
