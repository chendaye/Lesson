<?php
namespace Di\four;
/**
 * 简单的容器
 * Class Container
 * @package Di\four
 */
class Container
{
    /**
     * 用来保存映射关系  自己定义映射关系
     * 比如 A => Di\four\A::class
     * @var array
     */
    private $contanner = [];

    private static $instance;

    private function __construct()
    {
    }

    /**
     * 单例
     * @return Container
     */
    public static function instance()
    {
        if(empty(self::$instance)) return new self();
    }

    /**
     * 魔术方法
     * 给不可访问的属性赋值是 这个方法会被调用
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
        $this->contanner[$name] = $value;

    }

    /**
     * 魔术方法
     * 读取不可访问的属性是会被调用
     * @param $name
     * @return  mixed
     */
    public function __get($name)
    {
        // TODO: Implement __get() method.
        return $this->bind($this->contanner[$name]);
    }

    /**
     * 获取类的实例
     * @param $className
     * @return mixed|object
     * @throws \Exception
     */
    public function bind($className)
    {
        //如果是闭包 就执行闭包 返回结果
        if($className instanceof \Closure) return $className($this);

        //不是闭包 通过反射来解析类
        $reflector = new \ReflectionClass($className);

        //调用反射方法 检查类是不是能被实例化
        if(!$reflector->isInstantiable()) throw new \Exception('此类无法实例化');

        //如果能实例化获取类的构造函数
        $constructor = $reflector->getConstructor();

        //如果没有构造函数 直接把类实例化 返回
        if(is_null($constructor)) return new $className;

        //如果有构造函数 要解析构造函数的参数 同样有方法获取构造函数的参数列表
        $parameters = $constructor->getParameters();

        //需要一个方法来解析参数
        $dependencies = $this->getDependencies($parameters);

        //用获得的参数 创建一个新的实例 返回
        return $reflector->newInstanceArgs($dependencies);
    }

    /**
     * 解析参数
     * @param $parameters
     * @return array
     * @throws \Exception
     */
    public  function getDependencies($parameters)
    {
        $dependencies = [];

        foreach ($parameters as $parameter){
            //参数是类 通过反射获取类
            $dependency = $parameter->getClass();

            if(is_null($dependency)) {
                // 是变量,有默认值则设置默认值
                $dependencies[] = $this->resolveNonClass($parameter);
            }else{
                //如果参数是类的显然 就要递归的来解析 所以调用 bind 方法
                $dependencies[] = $this->bind($dependency->name);
            }
        }
        return $dependencies;
    }

    public function resolveNonClass($parameter)
    {
        // 有默认值则返回默认值
        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        throw new \Exception('I have no idea what to do here.');
    }
}
