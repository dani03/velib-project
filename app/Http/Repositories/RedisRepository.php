<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\Redis;

class RedisRepository
{
  private $redisConnexion;

  public function __construct()
  {
    $this->redisConnexion = Redis::connection();
  }

  public function getAllkeys()
  {
    return $this->redisConnexion->keys('*');
  }

  public function getValues($key)
  {
    return Redis::hgetall($key);
  }

  public function findBy(string $ville = 'ville', string $key)
  {
    return Redis::hget($key, $ville);
  }

  public function create()
  {
  }

  public function suppression($key)
  {
    
  }
}
