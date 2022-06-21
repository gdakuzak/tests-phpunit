<?php 

use Gdakuzak\Model\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testSetName(){
        $product = new Product();
        $product->setName('Caju');
        $this->assertEquals('Caju',$product->getName());
    }
    
    public function testSetPrice(){
        $product = new Product();
        $product->setPrice(10.10);
        $this->assertEquals(10.10,$product->getPrice());
        $this->assertInstanceOf(Product::class,$product);
    }

}