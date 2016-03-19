<?php

namespace ObjRef\ExampleBundle\Command;

use ObjRef\Transport\FDTransport;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ObjRef\Host;
use ObjRef\Proxy;

class SSHCommand extends ContainerAwareCommand {


    protected function configure() {
        $this
            ->setName('example:ssh')
            ->setDescription('Show ssh communication')
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output) {
        // TODO
        $output->writeln('<error>not implemented yet</error>');
    }

}


