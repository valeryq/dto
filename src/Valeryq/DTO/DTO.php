<?php namespace Valeryq\DTO;

/**
 * Class DTO
 * @package Service
 */
class DTO
{

    /**
     * Instance of EloquentModel or EloquentCollection
     * @var array
     */
    private $instance = null;


    /**
     * Set instance or throw error
     * @param $instance (\Illuminate\Database\Eloquent\Model || \Illuminate\Database\Eloquent\Collection)
     * @return $this
     * @throws Error
     */
    public function make($instance)
    {
        if ($instance instanceof \Illuminate\Database\Eloquent\Model || $instance instanceof \Illuminate\Database\Eloquent\Collection) {
            $this->instance = $instance;
        } else {
            throw new Error('Instance must be a EloquentModel or EloquentCollection');
        }
        return $this;
    }

    /**
     * Get array with only input items
     * @param array $items
     * @return array
     */
    public function only(array $items)
    {
        return $this->each(function ($value) use ($items) {

            $arrayOnly = [];

            //Get only
            foreach ($items as $item) {
                $arrayOnly[$item] = array_get($value, $item);
            }

            //Create array with new data
            $array = $this->createArrayFromDot($arrayOnly);

            return $array;
        });
    }

    /**
     * Get array except input items
     * @param array $items
     * @return array
     */
    public function except(array $items)
    {
        return $this->each(function ($value) use ($items) {

            //Except values
            $arrayExceptedValues = array_except($value, $items);
            $arrayDotExceptedValues = array_except(array_dot($arrayExceptedValues), $items);

            //Create array with new data
            $array = $this->createArrayFromDot($arrayDotExceptedValues);

            return $array;
        });
    }

    /**
     * Iterate items if collection or return data if model
     * @param callable $callback
     * @return array
     */
    private function each(\Closure $callback)
    {
        if ($this->instance instanceof \Illuminate\Database\Eloquent\Collection) {
            return array_map($callback, $this->instance->toArray());
        } else {
            return $callback($this->instance->toArray());
        }
    }

    /**
     * Create array from dot array
     * @param array $originalArray - original array
     * @return array
     */
    private function createArrayFromDot(array $originalArray)
    {
        $array = [];
        foreach ($originalArray as $key => $value) {
            array_set($array, $key, $value);
        }
        return $array;
    }

}
