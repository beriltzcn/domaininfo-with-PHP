<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.2/b-2.3.4/b-colvis-2.3.4/b-html5-2.3.4/r-2.4.0/sc-2.0.7/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.2/b-2.3.4/b-colvis-2.3.4/b-html5-2.3.4/r-2.4.0/sc-2.0.7/datatables.min.js"></script>

<form action="/beril" method="get">
    Domain List (*)<br>
    <textarea name="domains" style="width:100%;height: 150px" placeholder="Enter domain names seperated with ," required></textarea>
    <br>
    <button type="submit">SEND</button>
    <br>
    <br>

</form>

<?php

$c = getDB();

if (isset($_GET['domains']))
{
    // https://tc.videntium.com/beril
    
    $apiKey ="at_3DFG4fvY0pz6oKBgMnJlbRWImPeXp";

    $domains = explode(",",$_GET["domains"]);

    foreach($domains as $domain)
    {

        $domain = trim($domain);
        $url = "https://www.whoisxmlapi.com/whoisserver/WhoisService?apiKey=$apiKey&domainName=$domain";
        $data = file_get_contents($url);
        $xml=simplexml_load_string($data);

        /*
        echo "<h4>".$domain."</h4>";
        //echo "<pre>".print_r($xml, true)."</pre><br>";
        echo "Register Name : <br>";
        echo $xml->registrant->name."<br>";

        echo "Register Phone : <br>";
        echo $xml->registrant->telephone."<br>";

        echo "Register E-Mail : <br>";
        echo $xml->registrant->email."<br>";

        echo "Register Address : <br>";
        echo $xml->registrant->street1." ".$xml->registrant->city."<br>";

        echo "Domain Expires At : <br>";
        echo $xml->registryData->expiresDate."<br>";

        echo "<br><br>";
*/

        $q = "INSERT INTO  domains  VALUES (0, :domain:, :reg_ad:, :reg_email:, :reg_phone:, :reg_adres:, :expire:, now());";
        $params = [
            'domain' => $domain,
            'reg_ad' => $xml->registrant->name,
            'reg_email' => $xml->registrant->email,
            'reg_phone' => $xml->registrant->telephone,
            'reg_adres' => $xml->registrant->street1.' '.$xml->registrant->city,
            'expire' => $xml->registryData->expiresDate
        ];

        qWNR($q,$params,$c);


    }



}
?>
<h3>Records : </h3>
    <table style="width:100%" border="1" id="t">
        <thead>
        <tr>
            <th>ID</th>
            <th>Domain</th>
            <th>Name</th>
            <th>E-Mail</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Expire Date</th>
            <th>Add Date</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $rs = qWMR("select * from domains", null, $c);
        foreach($rs as $r)
        {
            $vals = array_values($r);
            echo "<tr>";
            foreach($vals as $v)
                echo "<td>".$v."</td>";
            echo"</tr>";
        }
        ?>
        </tbody>
    </table>

<script>
    var t = $("#t").DataTable({
        dom : 'Bfrtip',
        buttons : ['colvis', 'excel']

    });
</script>