<?php

namespace App\Http\Services;

use App\Http\Repositories\RedisRepository;

class RedisService
{

  private RedisRepository $redisRepository;

  public function __construct(RedisRepository $redisRepository)
  {
    $this->redisRepository = $redisRepository;
  }

  public function getValues(string $key)
  {
    return  $this->redisRepository->getValues($key);
  }

  public function findAllKeys()
  {
    $keys = $this->redisRepository->getAllkeys();
    if (empty($keys)) {
      return redirect()->back()->with('error', 'aucune clé trouvé');
    }

    return $keys;
  }

  public function find(string $field, string $userResreach)
  {
    $keys = $this->findAllKeys();
    $stationsFound = [];
    foreach ($keys as $key) {
      $theStation = $this->getValues($key);
  
      if (str_contains(strtolower($theStation["$field"]), strtolower($userResreach))) {
        $stationsFound[] = $theStation;
      }

    }
    return $stationsFound;
  }
}
