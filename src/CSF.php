<?php


namespace BlackPanda\CSF;


class CSF
{
    CONST CSF_PATH = "/usr/sbin/csf";
    public function __construct()
    {
        $output = $this->silentExecute("sudo " . self::CSF_PATH . " -l");
        if(strpos(implode(PHP_EOL , $output),"iptables filter table") === false)
            throw new \Exception("CSF not found or your user is not privileged !");
    }

    /**
     * make and IP address allow in Firewall rules
     * @param string|array $ip
     */
    public function allow($ip)
    {
        if(is_array($ip))
        {
            foreach ($ip as $item){
                $output = $this->silentExecute("sudo " . self::CSF_PATH . " -a {$item}");
                $output = implode(PHP_EOL , $output);
                if( strpos($output , "is in already in the allow file") === false  && strpos($output , "to csf.allow and iptables ACCEPT") == false && strpos($output , "is one of this servers addresses") == false )
                    throw new \Exception("something happened wrong with {$item} \n Logs : {$output}");
            }

            $output = $this->silentExecute("sudo " . self::CSF_PATH . " -r");

            return true;
        }

        $output = $this->silentExecute("sudo " . self::CSF_PATH . " -a {$ip}");
        $output = implode(PHP_EOL , $output);
        if( strpos($output , "is in already in the allow file") === false  && strpos($output , "to csf.allow and iptables ACCEPT") == false && strpos($output , "is one of this servers addresses") == false )
            throw new \Exception("something happened wrong with {$ip} \n Logs : {$output}");

        $output = $this->silentExecute("sudo " . self::CSF_PATH . " -r");

        return true;
    }

    protected function silentExecute($command){
        exec($command ,$output);
        return $output;
    }

}
