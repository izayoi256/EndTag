<?php
/*
 * Copyright(c) 2000-2016 Daisy CO., LTD. All Rights Reserved.
 *
 * http://daisy.link/
 */

namespace Plugin\BlankPlugin\Command;

use Eccube\Application;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;

class BlankCommand extends \Knp\Command\Command
{
    /**
     * @var Application
     */
    protected $app;

    public function __construct($app, $name = null)
    {
        parent::__construct($name);
        $this->app = $app;
    }

    protected function configure()
    {
        $this
            ->setName('prefix:suffix')
            ->addArgument('id', InputArgument::REQUIRED, 'id description')
            ->setDescription('Blank command.')
            ->setHelp('The <info>%command.name%</info> command do nothing;');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute($input, $output)
    {
        $app = $this->app;
        $id = $input->getArgument('id');
        $parameter = compact('id');

        $request = Request::create($app->url('blank', $parameter));
        $app->run($request);
        $app->boot();
    }
}
