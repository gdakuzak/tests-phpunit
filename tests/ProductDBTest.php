<?php 

use Gdakuzak\Model\Product;
use PHPUnit\Framework\TestCase;

class ProductDBTest extends TestCase
{
    public function testIfProductIsSaved()
    {
        global $db;
        $product = new Product($db);
        $result = $product->save([
            'name' => 'Caju',
            'price' => 10.10,
            'quantity' => 10,
        ]);

        $this->assertEquals(1,$result->getId());
        $this->assertEquals('Caju',$result->getName());
        $this->assertEquals(10.10,$result->getPrice());
        $this->assertEquals(10,$result->getQuantity());
        $this->assertEquals(10.10*10,$result->getTotal());

        return $result->getId();
    }

    public function testeIfListProducts()
    {
        global $db;
        $product = new Product($db);
        $result = $product->save([
            'name' => 'Maracujá',
            'price' => 15.20,
            'quantity' => 5,
        ]);

        $products = $product->all();
        $this->assertCount(2,$products);
    }

    /**
     * @depends testIfProductIsSaved
     */
    public function testIfProductIsUpdated($id)
    {
        global $db;
        $product = new Product($db);
        $result = $product->save([
            'id' => $id,
            'name' => 'Caju',
            'price' => 9.10,
            'quantity' => 15,
        ]);

        $this->assertEquals($id,$result->getId());
        $this->assertEquals('Caju',$result->getName());
        $this->assertEquals(9.10,$result->getPrice());
        $this->assertEquals(15,$result->getQuantity());
        $this->assertEquals(9.10*15,$result->getTotal());
        return $id;
    }

    /**
     * @depends testIfProductIsUpdated
     */
    public function testeIfProductCanDeleted($id)
    {
        global $db;
        $product = new Product($db);
        $result = $product->delete($id);
        $this->assertTrue($result);

        $products = $product->all();
        $this->assertCount(1,$products);
    }

}