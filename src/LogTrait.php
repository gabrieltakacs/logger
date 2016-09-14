<?php
/**
 * Created by Gabriel Takács, gabriel.takacs@ui42.sk
 */

namespace Gabrieltakacs\Logger;

use Symfony\Component\Console\Output\OutputInterface;

trait LogTrait
{
    /**
     * @var LoggerInterface[] $loggers
     */
    protected $loggers = [];

    /**
     * @param \App\Log\LoggerInterface $logger
     */
    public function addLogger(LoggerInterface $logger)
    {
        $this->loggers[] = $logger;
    }

    /**
     * @param        $message
     * @param int    $verbosity
     * @param string $tag
     */
    protected function log($message, $verbosity = OutputInterface::VERBOSITY_NORMAL, $tag = '')
    {
        if (is_array($this->loggers)) {
            foreach ($this->loggers as $logger) { /** @var LoggerInterface $logger */
                $logger->log($message, $verbosity, $tag);
            }
        }
    }
}
