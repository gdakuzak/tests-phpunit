<?php 

use Gdakuzak\Model\Product;
use PHPUnit\Framework\TestCase;

class ProductDBTest extends TestCase
{

    private $db;

    protected function setUp(): void
    {
        $this->db = getPDO();
    }

    public function testIfProductIsSaved()
    {
        $result = $this->createProduct();
        $product = new Product($this->db);
        
        $this->assertEquals(1,$result->getId());
        $this->assertEquals('Maracujá',$result->getName());
        $this->assertEquals(15.20,$result->getPrice());
        $this->assertEquals(5,$result->getQuantity());
        $this->assertEquals(15.20*5,$result->getTotal());

        return $result->getId();
    }

    public function testeIfListProducts()
    {
        $product = new Product($this->db);
        $this->createProduct();
        $this->createProduct();
        $products = $product->all();
        $this->assertCount(2,$products);
    }

    /**
     * @depends testIfProductIsSaved
     */
    public function testIfProductIsUpdated($id)
    {
        $product = new Product($this->db);
        $result = $product->save([
            'id' => $id,
            'name' => 'Caju',
            'price' => 9.10,
            'quantity' => 15,
        ]);

        $this->assertEquals(1,$result->getId());
        $this->assertEquals('Caju',$result->getName());
        $this->assertEquals(9.10,$result->getPrice());
        $this->assertEquals(15,$result->getQuantity());
        $this->assertEquals(9.10*15,$result->getTotal());
        return $result->getId();
    }

    public function testeIfProductCanBeRecovered()
    {
        $result = $this->createProduct();
        $product = new Product($this->db);
        $result = $product->find($result->getId());

        $this->assertEquals(1,$result->getId());
        $this->assertEquals('Maracujá',$result->getName());
        $this->assertEquals(15.20,$result->getPrice());
        $this->assertEquals(5,$result->getQuantity());
        $this->assertEquals(15.20*5,$result->getTotal());
    }

    /**
     * @depends testIfProductIsUpdated
     */
    public function testeIfProductCanDeleted()
    {
        $this->createProduct();
        $this->createProduct();
        $product = new Product($this->db);
        $result = $product->delete(1);
        $this->assertTrue($result);

        $products = $product->all();
        $this->assertCount(1,$products);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Product does not exist
     */
    public function testeIfProductNotFound()
    {
        $db = $this->db;
        $product = new Product($db);
        $result = $product->find(9999999999999999);
    }

    private function createProduct()
    {
        $product = new Product($this->db);
        return $product->save([
            'name' => 'Maracujá',
            'price' => 15.20,
            'quantity' => 5,
        ]);
    }

}