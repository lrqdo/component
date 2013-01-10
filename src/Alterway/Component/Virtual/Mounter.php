<?php
namespace Alterway\Component\Virtual;

/**
 * Allow to mount virtual objects
 *
 * @namespace Alterway\Component\Virtual
 * @implements MounterInterface
 * @author Jean-François Lépine <jean-francois.lepine@alterway.fr>
 */
class Mounter implements MounterInterface
{

    /**
     * Mount the given code in memory
     *
     * All unexistent interfaces and classes will be virtualized
     *
     * @param string $code
     * @return Mounter
     */
    public function mountCode($code)
    {
        //
        // we need to found interfaces first
        $this->mountInterfacesOfCode($code);

        //
        // At this step, we just need to add an autoloader : if any class is not found, it is automatically mounted
        $self = $this;
        $autoloader = function ($class) use ($self) {
            $self->mount($class);
        };
        spl_autoload_register($autoloader);


        $file = tempnam(sys_get_temp_dir(), 'atw.com.virt');
        file_put_contents($file, $code);
        require $file;
        unlink($file);

        spl_autoload_unregister($autoloader);
        return $this;
    }

    /**
     * Mount interfaces found in the given code
     *
     * @param string $code
     * @return Mounter
     */
    public function mountInterfacesOfCode($code) {
        if (preg_match_all('!\bimplements\b\s*([\w\s,]*)!m', $code, $matches)) {
            $interfaces = array();
            array_walk($matches[1], function (&$v) use (&$interfaces) {
                $interfaces = array_merge($interfaces, (array)preg_split('!,!', $v));
            });
            $interfaces = array_map('trim', $interfaces);

            // prepend the namespace
            $namespace = null;
            if (preg_match('!\bnamespace\b\s+(\w*)\s?;!m', $code, $matches)) {
                $namespace = trim($matches[1]);
            }


            foreach ($interfaces as $interface) {
                if (!is_null($namespace)) {
                    $interface = $namespace . '\\' . $interface;
                }

                $this->mount($interface, self::AS_INTERFACE);
            }
        }
        return $this;
    }

    /**
     * Mount the given class in memory
     *
     * All used interfaces, classes... will be also mounted
     * Please use the second parameter to mount interfaces instead of classes
     *
     * @param $class
     * @param int $type
     * @return Mounter
     */
    public function mount($class, $type = self::AS_CLASS)
    {
        // Get informations about the used namespace
        $info = $this->getNameInfo($class);

        // build content
        $content = '<?php '
            . (
            !$info->hasNamespace ? '' : sprintf('namespace %s ; ', $info->namespace)
            )
            . sprintf('%1$s %2$s {}'
                , $type == self::AS_CLASS ? 'class' : 'interface'
                , $info->class);

        $this->mountCode($content);
        return $this;
    }

    /**
     * Get informations about class : namespace, name
     *
     * @param $class
     * @return \StdClass
     */
    private function getNameInfo($class)
    {
        $inf = new \StdClass;
        $class = ltrim($class, '\\Ò');
        preg_match('!((?:\w*\\\\)*)(\w*)!', $class, $matches);
        list(, $inf->namespace, $inf->class) = $matches;
        $inf->namespace = rtrim($inf->namespace, '\\');
        $inf->hasNamespace = strlen($inf->namespace) > 0;
        return $inf;
    }
}