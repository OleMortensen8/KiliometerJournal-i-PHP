<?php
class Table {
    private $table = "<p>Data kommer snart</p>";
    private $allTogether;

    public function createTable($lists) {
        $this->table = '<table style="width:100%;">
            <thead>
                <tr>
                    <th>Initialer</th>
                    <th>km - Start</th>
                    <th>km - stop</th>
                    <th>km kørt</th>
                    <th>registreret</th>
                    <th>Liters/Total km.</th>
                    <th>Deletes</th>
                </tr>   
            </thead>
            <tbody>';
    $totalliter = 0;
    foreach ($lists as $list) {
        $fuelConsumptionPerKm = 0.04292;
        $totalKmDriven = $list["samledeKmTal"];
        $liter = $fuelConsumptionPerKm * $totalKmDriven;
        $tankCapacity = 44;
        $threshold = 2;
       
        $this->table .= "<tr>" .
            "<td>" . $list["initialer"] . "</td>" .
            "<td>" . $list["kmStart"] . "</td>" .
            "<td>" . $list["kmSlut"] . "</td>" .
            "<td>" . $list["samledeKmTal"] . "</td>" .
            "<td>" . $liter . "</td>" .
            "<td>" . $list["dato"] . "</td>" .
            "<td>
                <form action='' method='post'>
                    <button class='btn btn-danger' type='submit' name='data' value='" . $list['EntryID'] . "'>Delete</button>
                </form>
            </td>" .
            "</tr>";
    $totalliter += $liter;
    $remainingFuel = $tankCapacity - $totalliter;
    }
    if ($remainingFuel < $threshold) {
        echo "Fuel level is nearing empty. Please refuel soon!";
    }
        $this->table .= '</tbody>';

        $this->allTogether = 0;
        foreach ($lists as $list) {
            $this->allTogether += $list["samledeKmTal"];
        }

        $maaneder = array("", "Januar", "Febuar", "Marts", "April", "Maj", "Juni", "Juli", "August", "Okttober", "September", "November", "December");
        $pos = date("n", strtotime("now"));
        $this->table .= '<tfoot>
            <th scope="row">Kørt på i ' . $maaneder[$pos] . '</th>
            <td>' . $this->allTogether . ' km/'. $totalliter . 'L</td>
        </tfoot>';

        $this->table .= '</table>';
    }

    public function getTable() {
        return $this->table;
    }
}
