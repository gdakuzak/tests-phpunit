<?php 

use Gdakuzak\Model\Product;
use PHPUnit\Framework\TestCase;

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

    public function testSetAndGetName(){
        $product = new Product();
        $this->assertNull($product->getName());
        $this->assertInstanceOf(Product::class,$product->setName('Caju'));
        $this->assertEquals('Caju',$product->getName());
    }
    
    public function testSetAndGetPrice(){
        $product = new Product();
        $this->assertNull($product->getPrice());
        $this->assertInstanceOf(Product::class,$product->setPrice(10.11));
        $this->assertEquals(10.11,$product->getPrice());
    }

    public function testSetAndGetQuantity(){
        $product = new Product();
        $this->assertNull($product->getQuantity());
        $this->assertInstanceOf(Product::class,$product->setQuantity(150));
        $this->assertEquals(150,$product->getQuantity());
    }
}