<?php


namespace BlackPanda\CSF;


use Illuminate\Support\ServiceProvider;

class CSFServiceProvider extends ServiceProvider
{
    /*
     * register CSF Facade
     */
    public function register()
    {
        $this->app->bind("CSF",function(){
            return new CSF;
        });
    }

}
