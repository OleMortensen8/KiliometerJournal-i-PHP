<?php 

// Define constants
define('FUEL_CONSUMPTION_PER_KM', 0.04292);
define('TANK_CAPACITY', 44);
define('THRESHOLD', 2);

class Table 
{
    private $htmlTable = "<p>Data kommer snart</p>"; // 📌 HTML table string
    private $totalKilometersDriven; // 📌 Total kilometers driven

    public function createTable($entries) 
    { 
        // Initialize total fuel consumed
        $totalFuelConsumed = 0; 

        // Start building the table
        $this->htmlTable = '
            <table style="width:100%;">
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

        // Loop through each entry to calculate and append to the table
        foreach ($entries as $entry) 
        {
            $litersConsumed = FUEL_CONSUMPTION_PER_KM * $entry["samledeKmTal"];
            $this->htmlTable .= "<tr>" .
                "<td>" . $entry["initialer"] . "</td>" .
                "<td>" . $entry["kmStart"] . "</td>" .
                "<td>" . $entry["kmSlut"] . "</td>" .
                "<td>" . $entry["samledeKmTal"] . "</td>" .
                "<td>" . $litersConsumed . "</td>" .
                "<td>" . $entry["dato"] . "</td>" .
                "<td> 
                    <form action='' method='post'> 
                        <button class='btn btn-danger' type='submit' name='data' value='" . $entry['EntryID'] . "'>Delete</button> 
                    </form> 
                </td>
            </tr>";
            
            // Add the liters consumed to the total
            $totalFuelConsumed += $litersConsumed;

            // Calculate remaining fuel
            $remainingFuel = TANK_CAPACITY - $totalFuelConsumed;
        
            // Check if refuel is needed
            if ($remainingFuel < THRESHOLD) 
            {
                echo "Fuel level is nearing empty. Please refuel soon!";
            }
        }

        // Close the table body
        $this->htmlTable .= '</tbody>';

        // Reset total kilometers driven
        $this->totalKilometersDriven = 0;

        // Calculate total kilometers driven
        foreach ($entries as $entry) 
        {
            $this->totalKilometersDriven += $entry["samledeKmTal"];
        }

        // Get the current month
        $months = array("", "Januar", "Febuar", "Marts", "April", "Maj", "Juni", "Juli", "August", "Okttober", "September", "November", "December");
        $currentMonth = date("n", strtotime("now"));

        // Append the table footer
        $this->htmlTable .= '
            <tfoot> 
                <th scope="row">Kørt på i ' . $months[$currentMonth] . '</th>
                <td>' . $this->totalKilometersDriven . ' km/'. $totalFuelConsumed . 'L</td> 
            </tfoot>';

        // Close the table
        $this->htmlTable .= '</table>';
    }

    // Get the HTML table
    public function getTable() 
    {
        return $this->htmlTable;
    }
}
?>