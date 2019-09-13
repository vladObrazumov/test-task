<?php

namespace App\Command;

use App\Service\CatalogManager;
use App\Service\IntutorService;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchDataFromApiCommand extends Command
{
    /**
     * @var IntutorService
     */
    private $intutorService;

    /**
     * @var CatalogManager
     */
    private $catalogManager;

    protected static $defaultName = 'app:fetch-third-part-data';

    public function __construct(IntutorService $intutorService, CatalogManager $catalogManager)
    {
        $this->intutorService = $intutorService;
        $this->catalogManager = $catalogManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Fetch data from third part service');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $arrayOfCatalogs = $this->intutorService->getCatalogs();
            $this->catalogManager->createCatalogsFromPureData($arrayOfCatalogs);
        } catch (GuzzleException $e) {
            //in fact we must use logger like monolog here
            $output->writeln("We got error while requesting data, error message: " . $e->getMessage());
        } catch (\Exception $e) {
            //in fact we must use logger like monolog here
            $output->writeln("Can't parse the json, error message: " . $e->getMessage());
        }
    }
}
