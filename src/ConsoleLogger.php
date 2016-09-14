<?php
/**
 * Created by Gabriel Takács, gabriel.takacs@ui42.sk
 */

namespace Gabrieltakacs\Logger;

use Symfony\Component\Console\Output\OutputInterface;

class ConsoleLogger implements LoggerInterface
{
    /** @var OutputInterface $output_writer */
    protected $output_writer;

    public function __construct(OutputInterface $output)
    {
        $this->output_writer = $output;
    }

    public function log($message, $tag, $verbosity = OutputInterface::VERBOSITY_NORMAL)
    {
        if (!is_null($this->output_writer)) {
            if ($this->output_writer->getVerbosity() >= $verbosity) {
                $output_message = $message;
                if (!empty($tag)) {
                    $output_message = '<' . $tag . '>' . $message . '</' . $tag . '>';
                }
                $this->output_writer->writeln($output_message);
            }
        }
    }
}
