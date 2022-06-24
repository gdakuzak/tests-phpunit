<?php 

use Gdakuzak\Model\Product;
use PHPUnit\Framework\TestCase;

// before add PDO in Product Model.
class ProductTest extends TestCase
{
    public function testIfTotalIsNull() {
        $product = new Product();
        $this->assertNull($product->getTotal());
    }

    public function testIfIdNull() {
        $product = new Product();
        $this->assertNull($product->getId());
    }

    /**
     * @dataProvider collectionNames
     */
    public function testEncapsulate($property, $expected){
        $product = new Product();
        $this->assertNull($product->{'get'.ucfirst($property)}());
        $this->assertInstanceOf(Product::class,$product->{'set'.ucfirst($property)}($expected));
        $this->assertEquals($expected,$product->{'get'.ucfirst($property)}());
    }

    public function collectionNames() {
        return [
            ['name','Caju'],
            ['price',10],
            ['quantity',150],
        ];
    }
}