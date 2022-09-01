<?php


namespace BlackPanda\CSF;


use Illuminate\Support\Facades\Facade;

class CSFFacade extends Facade
{
    /*
     * register facade for CSF
     */
    protected static function getFacadeAccessor()
    {
        return 'CSF';
    }
}
