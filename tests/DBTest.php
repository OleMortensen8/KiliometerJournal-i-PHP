<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable('/../../'.__DIR__);
$dotenv->load();
require_once 'classes/DB.php';

class DBTest extends TestCase {
    protected $db;

    protected function setUp(): void {
        $this->db = new DB();
    }

    public function testConstructor() {
        $this->assertIsObject($this->db);
        $this->assertInstanceOf(DB::class, $this->db);
    }

    public function testDBCONNECT()
    {
        $pdo = $this->createMock(PDO::class);
        $pdoStatement = $this->createMock(PDOStatement::class);
        
        $pdo->method('prepare')
            ->willReturn($pdoStatement);
        
        $this->db = $this->getMockBuilder(DB::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->db->expects($this->once())
            ->method('DBCONNECT')
            ->willReturn($pdo);
        
        $result = $this->db->DBCONNECT();
        
        $this->assertInstanceOf(PDO::class, $result);
    }
    

    public function testSendsDataToSql() {
        $pdoStatement = $this->createMock(PDOStatement::class);
        $pdoStatement->method('bindParam')
            ->willReturn(true);
        $pdoStatement->method('execute')
            ->willReturn(true);

        $pdo = $this->createMock(PDO::class);
        $pdo->method('prepare')
            ->willReturn($pdoStatement);

        $this->db->sendsDataToSql('INI', 0, 10, 10);

        $this->assertTrue($pdoStatement->execute());
    }

    public function testGetDataToSql() {
        $pdoStatement = $this->createMock(PDOStatement::class);
        $pdoStatement->method('fetchAll')
            ->willReturn([]);

        $pdo = $this->createMock(PDO::class);
        $pdo->method('query')
            ->willReturn($pdoStatement);

        $data = $this->db->getDataToSql();

        $this->assertIsArray($data);
    }

    public function testDeleteEntry() {
        $pdoStatement = $this->createMock(PDOStatement::class);
        $pdoStatement->method('bindParam')
            ->willReturn(true);
        $pdoStatement->method('execute')
            ->willReturn(true);

        $pdo = $this->createMock(PDO::class);
        $pdo->method('prepare')
            ->willReturn($pdoStatement);

        $this->db->deleteEntry(1);

        $this->assertTrue($pdoStatement->execute());
    }
}