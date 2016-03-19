<?php

namespace ObjRef\ExampleBundle\Command;

use ObjRef\Transport\FDTransport;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ObjRef\Host;
use ObjRef\Proxy;

class LocalCommand extends ContainerAwareCommand {


    protected function configure() {
        $this
            ->setName('example:local')
            ->setDescription('Show local two-instance communication')
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output) {


        // start a second symfony process with objref:client command

        $cmd = '';
        foreach($_SERVER['argv'] as $v) {
            if($v == 'example:local') $v = 'objref:client';
            $cmd .= escapeshellarg($v).' ';
            if($v == 'objref:client') break;
        }

        // note: due to a php bug, we need to set the return value of proc_open to a variable
        // otherwise $pipes has no pipes
        $proc=proc_open($cmd,
            [
                ['pipe','r'],
                ['pipe','w'],
                ['file','php://stderr', 'w']
            ],
            $pipes);
        $output->writeln('Second process launched');

        // connect the pipes to a objref transport
        $transport = new FDTransport($pipes[1], $pipes[0]);
        $host = $this->getContainer()->get('objref.host');
        $host->setTransport($transport);


        // get the initial object of the other side.
        // in symfony, this is the container of the second process

        /** @var ContainerInterface $remoteContainer */
        $remoteContainer = $host->getRemoteInitialObject();

        // now we can access remote services!
        $remoteExample = $remoteContainer->get('objref.example');

        // to compare, we get another local one
        $localExample = $this->getContainer()->get('objref.example');

        $output->writeln('First PID:  '.$localExample->getPid());
        $output->writeln('Second PID: '.$remoteExample->getPid());

        $output->write('Write local: ');
        $localExample->outputTest($output);

        $output->write('Write remote: ');
        $remoteExample->outputTest($output);

        proc_close($proc);

    }

}


