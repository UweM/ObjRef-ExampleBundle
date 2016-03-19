# ObjRef ExampleBundle
Example symfony bundle that shows my [RemoteBundle](https://github.com/UweM/ObjRef-RemoteBundle) which
 itself is a symfony bundle of my [ObjRef](https://github.com/UweM/ObjRef) remote php objects

## Installation
Just run `composer require uwem/objref-examplebundle` in a working symfony installation.
It may be a good idea to just kick up a new instance with `symfony new objreftest` and then require the
examplebundle.

If you get errors like `"config.platform.php" version (5.5.9) does not satisfy that requirement.`,
make sure to remove the config.platform.php part out of the generated `composer.json` file
## Run
Only one demo is implemented at the moment. Run `bin/console example:local` to launch two processes that
talk to each other via ObjRef.

Have a look into the [LocalCommand.php](https://github.com/UweM/ObjRef-ExampleBundle/blob/master/Command/LocalCommand.php) file to look how it works

