<?php 

use Gdakuzak\Model\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private $product;
    
    protected function setUp(): void
    {
        $pdo = $this->getMockBuilder(\PDO::class)
                    ->disableOriginalConstructor()
                    ->getMock();
        $this->product = new Product($pdo);
    }
    
    public function testIfTotalIsZero() {
        $this->assertEquals(0.00,$this->product->getTotal());
    }

    public function testIfIdIsZero() {
        $this->assertEquals(0,$this->product->getId());
    }

    /**
     * @dataProvider collectionNames
     */
    public function testEncapsulate($property, $expected){
        if(!is_float($expected) && !is_int($expected)){
            $this->assertNull($this->product->{'get'.ucfirst($property)}());
        } elseif(is_float($expected)){
            $this->assertEquals(0.0, $null);
        } elseif(is_int($expected)) {
            $this->assertEquals(0, $null);
        }

        $this->assertInstanceOf(Product::class,$this->product->{'set'.ucfirst($property)}($expected));
        $this->assertEquals($expected,$this->product->{'get'.ucfirst($property)}());
    }

    public function collectionNames() {
        return [
            ['name','Caju'],
            ['price',10],
            ['quantity',150],
        ];
    }
}