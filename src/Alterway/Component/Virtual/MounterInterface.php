<?php
namespace Alterway\Component\Virtual;

/**
 * Allow to mount virtual objects
 *
 * @namespace Alterway\Component\Virtual
 * @author Jean-François Lépine <jean-francois.lepine@alterway.fr>
 */
interface MounterInterface
{
    const AS_CLASS = 1;
    const AS_INTERFACE = 2;

    /**
     * Mount the given code in memory
     *
     * All unexistent interfaces and classes will be virtualized
     *
     * @param string $code
     * @return Mounter
     */
    public function mountCode($code);


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
    public function mount($class, $type = self::AS_CLASS);
}