<?php

namespace App\Message;

final class ServiceMethodCallMessage
{
    /*
     * Add whatever properties and methods you need
     * to hold the data for this message class.
     */

    private $serviceName;
    private $methodName;
    private $params;

    public function __construct(string $serviceName, string $methodName, array $params = [])
    {
        $this->serviceName = $serviceName;
        $this->methodName = $methodName;
        $this->params = $params;
    }

    

    /**
     * Get the value of serviceName
     */ 
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * Get the value of methodName
     */ 
    public function getMethodName()
    {
        return $this->methodName;
    }

    /**
     * Get the value of params
     */ 
    public function getParams()
    {
        return $this->params;
    }
}
