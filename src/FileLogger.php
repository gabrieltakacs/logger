<?php
/**
 * Created by Gabriel Takács, gabriel.takacs@ui42.sk
 */

namespace Gabrieltakacs\Logger;

use Carbon\Carbon;
use Symfony\Component\Console\Output\OutputInterface;

class FileLogger implements LoggerInterface
{
    /**
     * @var string $directory
     */
    protected $directory;

    /**
     * @var string $filename
     */
    protected $filename;

    /**
     * @var resource $fh
     */
    protected $fh;

    /**
     * FileLogger constructor.
     *
     * @param $directory
     * @param $file_name
     */
    public function __construct($directory, $file_name)
    {
        $this->directory = $directory;
        $this->filename = $file_name;

        if (!file_exists($this->directory)) {
            mkdir($this->directory);
        }
    }

    /**
     * @param     $message
     * @param     $tag
     * @param int $verbosity
     */
    public function log($message, $tag = LoggerInterface::OUTPUT_COLOR_DEFAULT, $verbosity = OutputInterface::VERBOSITY_NORMAL)
    {
        $message_tag = '';
        if (!empty($tag)) {
            $message_tag = $tag[0];
        }
        $time = Carbon::create();

        if (!empty($message_tag)) {
            $message = '[' . $message_tag . '] ' . $time->format('Y-m-d H:i:s') . ' ' . $message . PHP_EOL;
        } else {
            $message = $time->format('Y-m-d H:i:s') . ' ' . $message . PHP_EOL;
        }

        $file_full_path = $this->directory . '/' . $this->filename;
        $file_full_path = preg_replace('#/+#','/', $file_full_path);

        file_put_contents($file_full_path, $message, FILE_APPEND);
    }
}
