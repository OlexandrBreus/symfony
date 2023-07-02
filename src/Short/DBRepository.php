<?php

namespace App\Short;

use App\Entity\UrlCodePairEntity;
use App\Repository\UrlCodePairEntityRepository;
use App\Short\Exceptions\DataNotFoundException;
use App\Short\Interfaces\ICodeRepository;

class DBRepository implements ICodeRepository
{
    /**
     * @param UrlCodePairEntityRepository $CPRepo
     */
    public function __construct(protected UrlCodePairEntityRepository $CPRepo)
    {
        
    }

    public function getAllData(): array
    {
        $res = [];
        return $res;
    }

    /**
     * @inheritDoc
     */
    public function getCodeByUrl(string $url): string
    {
        return $this->getData(['url' => $url], 'getCode');

//        $res = UrlCode::query()
//            ->where('url', '=', $url)
//            ->first();
//        if (is_null($res)){
//            throw new DataNotFoundException('Code not found');
//        }
//        return $res->code;
    }

    /**
     * @inheritDoc
     */
    public function getUrlByCode(string $code): string
    {
        return $this->getData(['code' => $code], 'getUrl');
//        $res = UrlCode::query()
//            ->where('code', '=', $code)
//            ->first();
//        if (is_null($res)){
//            throw new DataNotFoundException('Url not found');
//        }
//        return $res->url;
    }

    public function checkCode(string $code): bool
    {
        return (bool)$this->CPRepo->findOneBy(['code' => $code]);
//        return (bool)UrlCode::query()
//            ->where('code', '=', $code)
//            ->count();
    }

    /**
     * @inheritDoc
     */
    public function saveCodeAndUrl(string $code, string $url): bool
    {
        $data = ['url' => $url, 'code' => $code];
        try {
            $entity = UrlCodePairEntity::createFromArray($data);
            $this->CPRepo->save($entity, true);
            $result = true;
        } catch (\Throwable) {
            $result = false;
        }
        return $result;
    }
//        $urlCode = new UrlCode();
//        $urlCode->url = $url;
//        $urlCode->code = $code;
//        return $urlCode->save();
//    }

    protected function getData(array $criteria, string $method)
    {
        try {
            $data = $this->CPRepo->findOneBy($criteria)->{$method}();
        } catch (\Throwable){
            throw new DataNotFoundException();
        }
        return $data;
    }

}