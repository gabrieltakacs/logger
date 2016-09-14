# Logger

## Example

Class which produces log messages:
```
use Symfony\Component\Console\Output\OutputInterface
use Gabrieltakacs\LogTrait

Class MyClass 
{
  use LogTrait;
  
  public function myMethod() 
  {
    $this->log('My awesome log message', 'info', OutputInterface::VERBOSITY_VERBOSE);
  }
}
```

Class which executes MyClass - typically an instance of SymfonyCommand
```
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

Class MySyfonyCommand extends Command
{
  protected function configure()
  {
    // Some code
  }
  
  protected function execute(InputInterface $input, OutputInterface $output)
  {
      $object = new MyClass();
      $object->addLogger(new ConsoleLogger($output));
      $object->addLogger(new FileLogger('/path/to/log/directory', 'awesomelog' . $time->format('Y-m-d_H-i-s') . '.log'));
      $object->myMethod();
  }
}
```
