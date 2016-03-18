<?php

namespace ObjRef\ExampleBundle\Service;


use Symfony\Component\Console\Output\OutputInterface;

class ExampleService {

    public function getPid() {
        return getmypid();
    }

    public function outputTest(OutputInterface $output) {
        $output->writeln('Writing on object of class '.get_class($output));
    }
}