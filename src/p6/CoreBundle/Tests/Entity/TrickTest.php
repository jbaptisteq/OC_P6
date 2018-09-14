<?php

namespace p6\CoreBundle\Tests\Entity;

use Doctrine\ORM\EntityManager;
use p6\CoreBundle\Entity\Trick;
use PHPUnit\Framework\TestCase;


class TrickTest extends TestCase
{
    public function testGetId()
    {
        $trick = new Trick(40, 'name', 'description', 1, 2018-08-21 00:00:00, NULL, 1);

        $this->assertSame(40, $product->getId());
    }
}
