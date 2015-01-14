<?php namespace Valeryq\DTO;

use Illuminate\Support\Facades\Facade;

/**
 * Class SerializerFacade
 * @package Service
 */
class DTOFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dto';
    }
}
