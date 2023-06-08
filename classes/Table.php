<?php
class Table {
    private $table = "<p>Data kommer snart</p>";
    private $allTogether;

    public function createTable($lists) {
        $this->table = '<table class="table">
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
            <tbody>';

        foreach ($lists as $list) {
            $this->table .= "<tr>" .
                "<td>" . $list["initialer"] . "</td>" .
                "<td>" . $list["kmStart"] . "</td>" .
                "<td>" . $list["kmSlut"] . "</td>" .
                "<td>" . $list["samledeKmTal"] . "</td>" .
                "<td>" . $list["dato"] . "</td>" .
                "<td>
                    <form action='' method='post'>
                        <button class='btn btn-danger' type='submit' name='data' value='" . $list['EntryID'] . "'>Delete</button>
                    </form>
                </td>" .
                "</tr>";
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
            <td>' . $this->allTogether . ' km</td>
        </tfoot>';

        $this->table .= '</table>';

        $this->table .= '<button class="btn btn-primary" type="button" onclick="printDiv(\'printableArea\')"><img src="printer.svg"/></button>
        <div>Icons made by <a href="https://www.flaticon.com/authors/simpleicon" title="Printer">Printer</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>';
    }

    public function getTable() {
        return $this->table;
    }
}
?>
