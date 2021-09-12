<?php

namespace App\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EncryptCommand
{
    public function __invoke(InputInterface $input, OutputInterface $output)
    {
        $action = $input->getArgument('operation');

        switch ($action)
        {
            case 'encrypt':
                $this->operation();
                $output->writeln(PHP_EOL . $this->getEncryptString() . PHP_EOL);
                break;
            case 'decrypt':
                $this->operation();
                $output->writeln('------------------');
                break;
            default:
                $output->writeln('Missing arguments !');
                break;
        }
    }

    public function getEncryptString()
    {
        return sprintf("Bearer %s", $this->operation());
    }

    private function operation()
    {
        $obj = new \stdClass();
        $obj->name = 'Fadil Xcoder';
        $obj->email = 'fadil@xcoder.dvlpr';
        $obj->idx = '6LX8224JXXYQ740T';

        $objToStrng = json_encode($obj);

        $encrypted = $this->myCrypt($objToStrng);
        $decrypted = $this->myDecrypt($encrypted);

        // print("\n" . $encrypted . "\n");
        // print("\n" . $decrypted . "\n");

        return $encrypted;
    }

    private function myCrypt($value)
    {
        return base64_encode(openssl_encrypt($value, 'aes-256-cbc', $_ENV['EKEY'], OPENSSL_RAW_DATA, $_ENV['IVKEY']));
    }
    
    private function myDecrypt($value)
    {
        return openssl_decrypt(base64_decode($value), 'aes-256-cbc', $_ENV['EKEY'], OPENSSL_RAW_DATA, $_ENV['IVKEY']);
    }

}
