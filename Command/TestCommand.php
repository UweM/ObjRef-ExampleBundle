<?php

namespace ObjRef\ExampleBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ObjRef\RemoteBundle\SSH\S7SSH as SSH;
use ObjRef\RemoteBundle\ObjRef\Host;
use ObjRef\RemoteBundle\ObjRef\Proxy;
use ObjRef\RemoteBundle\ObjRef\Transport\SSHTransport;
use ObjRef\RemoteBundle\ObjRef\Transport\StreamClosedException;
use ObjRef\RemoteBundle\Annotation\TransferObject;

/**
 * @TransferObject
 */
class foo {
    public $test;
    public function getOs() {
        return PHP_OS;
    }
}

class TestCommand extends ContainerAwareCommand {


    protected function configure() {
        $this
            ->setName('example:losdfcal')
            ->setDescription('test')
        ;
    }

    private $input, $output, $log;

    /**
     * @param $text
     * @param string $display
     */
    protected function debug($text, $display='info') {
        $this->log .= $display.': '.$text."\r\n";
        if($this->input->getOption('debug')) {
            $this->output->writeln('<'.$display.'>'.$text.'</'.$display.'>');
        }
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @throws \RuntimeException
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->input = $input;
        $this->output = $output;

        $ssh = new SSH('nas.d');
        $ssh->login('root', 'dachwg');

        $ssh->createCmdChannel('php /root/verwaltix/app/console remote:client');

        $transport = new SSHTransport($ssh);
        $host = new Host($transport, null, $this->getContainer()->get('annotation_reader'));
        /** @var ContainerInterface $remoteContainer */
        $remoteContainer = new Proxy($host);


        /*
        $t = $remoteContainer->get('sshtest');
        $os = new foo();
        $os->test = new \stdClass;
        echo $t->foo($os);
        var_dump($os);
        */



        /** @var \SplFileObject $file */
        /*
        $file = $remoteContainer->get('vwx.remote.factory')->create('\\SplFileObject', '/root/test.txt', 'r');
        while (!$file->eof()) {
            echo '# '.$file->fgets();
        }
        //*/

        echo $remoteContainer->get('vwx.remote.file')->read('/root/test.txt');
    }

}


