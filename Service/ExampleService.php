<?php

/*
 * This file is part of the ObjRef package.
 *
 * (c) Uwe Mueller <uwe@namez.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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