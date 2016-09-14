# Logger
Simple logger for PHP. This package contains basic classes and traits which simplifies logging to console or file so that it makes logging very elegant and simple.

## Usage
Usage is very simple. Suppose we have a class called `MyClass` which produces log messages. `MyClass` could be for example an import class. `MyClass` has to use `Gabrieltakacs\LogTrait` which enables us to use the `log` method anywhere in the class.

The `log` method accepts following arguments:
* `$message` - message to be logged (string)
* `$verbosity` - integer from 0 to 4 (constants in `OutputInterface`), see Options section. Default value is 1 - `VERBOSITY_NORMAL`
* `$tag` - tag which is used for colorful log messages in console. See Options section. Default value is an empty string.

The class which uses `LogTrait` can log using more than one logger. Loggers have to be added to class by `addLogger` method. This package provides following loggers out-of-the-box:

### ConsoleLogger
Logs into console. Useful for commands (`SymfonyCommand`).

### FileLogger
Logs into a file. Accepts 2 arguments:
* log directory - if doesn't exist, it will be automatically created
* log file name
Note: `FileLogger` logs messages without tags, which are used for colorful logs in console. `FileLogger` automatically adds current date and time to the beginning of every message.

### Custom loggers
You can also use your custom loggers. The logger only has to implement `LoggerInterface`.

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

Class which executes `MyClass` - typically an instance of `SymfonyCommand`
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
      $object->addLogger(new FileLogger('/path/to/log/directory', 'awesomelog' . Carbon::create()->format('Y-m-d_H-i-s') . '.log'));
      $object->myMethod();
  }
}
```

## Options

### Verbosity
Verbosity has to be an integer value between 0 and 4:
* 0: `OutputInterface:VERBOSITY_QUIET`
* 1: `OutputInterface:VERBOSITY_NORMAL`
* 2: `OutputInterface:VERBOSITY_VERBOSE`
* 3: `OutputInterface:VERBOSITY_VERY_VERBOSE`
* 4: `OutputInterface:VERBOSITY_DEBUG`

### Tag
Tags are used to produce colorful messages in the console. The tag argument can be an empty string (for non-colorful message) or one of the following strings:
* `info` for green message
* `comment` for yellow message
* `question` for black text on cyan background
* `error` for white text on red background

For other options, see [Symfony docs](http://symfony.com/doc/current/console/coloring.html)
