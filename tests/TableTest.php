<?php 
use PHPUnit\Framework\TestCase;
require_once 'classes/Table.php';
class TableTest extends TestCase
{
    public function testCreateTable(): void
    {
        $lists = [
            [
                "initialer" => "AB",
                "kmStart" => 0,
                "kmSlut" => 50,
                "samledeKmTal" => 50,
                "dato" => "2021-09-01",
                "EntryID" => 1
            ],
            [
                "initialer" => "CD",
                "kmStart" => 50,
                "kmSlut" => 100,
                "samledeKmTal" => 50,
                "dato" => "2021-09-02",
                "EntryID" => 2
            ],
        ];

        $table = new Table();
        $table->createTable($lists);

        $expectedTable = "<table>
            <thead>
                <tr>
                    <th>Initialer</th>
                    <th>km - Start</th>
                    <th>km - stop</th>
                    <th>km kørt</th>
                    <th>registreret</th>
                    <th>Deletes</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>AB</td>
                    <td>0</td>
                    <td>50</td>
                    <td>50</td>
                    <td>2021-09-01</td>
                    <td>
                        <form action='' method='post'>
                            <button class='btn btn-danger' type='submit' name='data' value='1'>Delete</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>CD</td>
                    <td>50</td>
                    <td>100</td>
                    <td>50</td>
                    <td>2021-09-02</td>
                    <td>
                        <form action='' method='post'>
                            <button class='btn btn-danger' type='submit' name='data' value='2'>Delete</button>
                        </form>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <th scope='row'>Kørt på i Juni</th>
                <td>100 km</td>
            </tfoot>
        </table>";

        $this->assertXmlStringEqualsXmlString($expectedTable, $table->getTable());
    }
}
