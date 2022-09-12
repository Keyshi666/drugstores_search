<?php declare(strict_types = 1);

namespace App\Services;

use Exception;
use Illuminate\Http\Response;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class DrugDataServiceProvider
 * @package App\Services
 */
class DrugDataServiceProvider
{
    /**
     * @var Crawler
     */
    protected $crawler;

    /**
     * @var string
     */
    protected $drugName;

    /**
     * Url to site with drugs
     */
    const DRUG_URL = 'http://www.omdrug.ru/information/drugs.php?find=';

    /**
     * DrugDataServiceProvider constructor.
     * @param Crawler $crawler
     */
    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    public function withDrugName(string $drugName)
    {
        $this->drugName = $drugName;
        return $this;
    }

    /**
     * @return bool|\Illuminate\Http\JsonResponse|string
     */
    public function getData()
    {
        try
        {
            $html = \file_get_contents(self::DRUG_URL . $this->drugName);
            if($html==false)
            {
                throw new Exception( 'Can\'t get content');
            }
            return $html;
        }
        catch (\Exception $e)
        {
            return \response()->json(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }
    public function getBody()
    {
        $data = $this->getData();
        $this->crawler->addHtmlContent($data, 'UTF-8');
        $parsedStore = $this->crawler->filterXPath('//tr[@class="chetn"]')->each(function ($node){
            return [
                'drug' => $node->filter('td')->eq(0)->text(),
                'address' => $node->filter('td')->eq(1)->filter('a')->text(),
                'price' => $node->filter('td')->eq(2)->text(),
            ];
        });

        return \response()->json($parsedStore, Response::HTTP_OK);
    }
}