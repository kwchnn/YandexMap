<?php

namespace App\Tests\App\Form;

use App\Entity\Map;
use App\Form\Form;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class FormTest extends TypeTestCase
{
    public function test_add_point_form()
    {
        $data = [
            'user_id' => 30,
            'name' => 'Метка',
            'length' => 42.32,
            'width' => 43.22
        ];

        $map = new Map();
        $map->setUserId(30);

        $form = $this->factory->create(Form::class, $map);

        $map_to_compare = new Map();
        $map_to_compare->setUserId($data["user_id"]);
        $map_to_compare->setName($data["name"]);
        $map_to_compare->setWidth($data["width"]);
        $map_to_compare->setLength($data["length"]);

        $form->submit($data);

        $this->assertTrue($form->isSynchronized());
        
        $this->assertEquals($map->getName(), $map_to_compare->getName());
        $this->assertEquals($map->getUserId(), $map_to_compare->getUserId());
        $this->assertEquals($map->getLength(), $map_to_compare->getLength());
        $this->assertEquals($map->getWidth(), $map_to_compare->getWidth());
    }
}
