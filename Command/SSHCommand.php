<?php

/*
 * This file is part of the ObjRef package.
 *
 * (c) Uwe Mueller <uwe@namez.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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


