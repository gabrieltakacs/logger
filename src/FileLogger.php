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
    }

    /**
     * @param     $message
     * @param     $tag
     * @param int $verbosity
     */
    public function log($message, $tag, $verbosity = OutputInterface::VERBOSITY_NORMAL)
    {
        $fh = $this->getLogFileHandle();
        $time = Carbon::create();
        $message = $time->format('Y-m-d H:i:s') . ' ' . $message . PHP_EOL;

        fputs($fh, $message);
        fflush($fh);
        ftruncate($fh, ftell($fh));
    }

    public function closeLog()
    {
        $fh = $this->getLogFileHandle();

        fclose($fh);
    }

    /**
     * @return resource
     * @throws \App\Log\FileLoggerException
     */
    protected function getLogFileHandle()
    {
        if (is_null($this->fh)) {
            if (!file_exists($this->directory)) {
                $result = mkdir($this->directory);

                if (false === $result) {
                    throw new FileLoggerException('Unable to create log directory: `' . $this->directory . '`!');
                }
            }

            $file_full_path = $this->directory . '/' . $this->filename;
            $this->fh = fopen($file_full_path, 'a+');
        }

        return $this->fh;
    }
}
