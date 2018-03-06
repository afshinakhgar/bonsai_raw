<?php
namespace App\Serializer\Demo;


use Kernel\JsonApi\JsonApiSerializer;

class DemoSerializer extends JsonApiSerializer
{
    protected $type = 'posts';


    public function __construct($container) {
        $this->container = $container;

        $this->model= [
            'id'=>[
                'value'=>''
            ],'name'
        ];
    }

    public function getAttributes($post, array $fields = null)
    {
        return [
            'name' => $post->name,
        ];
    }

    public function getId($post)
    {
        return $post->id;
    }


}